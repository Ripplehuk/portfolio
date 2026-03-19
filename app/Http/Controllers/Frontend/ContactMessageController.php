<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;

class ContactMessageController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string'],
            'cf-turnstile-response' => ['required', 'string'],
        ], [
            'cf-turnstile-response.required' => __('frontend.messages.captcha_required'),
        ]);

        $this->validateTurnstile($validated['cf-turnstile-response'], $request->ip());

        unset($validated['cf-turnstile-response']);

        ContactMessage::query()->create($validated);

        return redirect()
            ->route('contact')
            ->with('success', __('frontend.messages.contact_success'));
    }

    /**
     * @throws ValidationException
     */
    protected function validateTurnstile(string $token, ?string $ipAddress): void
    {
        $secretKey = (string) config('services.turnstile.secret_key');
        $verifyUrl = (string) config('services.turnstile.verify_url');

        if ($secretKey === '' || $verifyUrl === '') {
            throw ValidationException::withMessages([
                'captcha' => __('frontend.messages.captcha_not_configured'),
            ]);
        }

        try {
            $response = Http::asForm()
                ->timeout(10)
                ->post($verifyUrl, [
                    'secret' => $secretKey,
                    'response' => $token,
                    'remoteip' => $ipAddress,
                ])
                ->throw()
                ->json();
        } catch (RequestException) {
            throw ValidationException::withMessages([
                'captcha' => __('frontend.messages.captcha_unavailable'),
            ]);
        }

        if (! ($response['success'] ?? false)) {
            throw ValidationException::withMessages([
                'captcha' => __('frontend.messages.captcha_failed'),
            ]);
        }
    }
}
