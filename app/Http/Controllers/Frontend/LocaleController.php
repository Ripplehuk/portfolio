<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LocaleController extends Controller
{
    public function switch(Request $request, string $locale): RedirectResponse
    {
        abort_unless(in_array($locale, ['en', 'uz'], true), 404);

        $request->session()->put('locale', $locale);

        return redirect()->back();
    }
}
