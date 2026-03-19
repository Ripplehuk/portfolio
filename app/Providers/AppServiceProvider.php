<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::useBootstrapFive();

        RateLimiter::for('contact-form', function (Request $request): Limit {
            return Limit::perMinute(3)
                ->by($request->ip())
                ->response(function () {
                    return redirect()
                        ->route('contact')
                        ->withInput()
                        ->withErrors([
                            'form' => __('frontend.messages.rate_limited'),
                        ]);
                });
        });
    }
}
