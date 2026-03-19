@extends('layouts.app')

@section('title', ($profile?->full_name ?? config('app.name')) . ' | ' . __('frontend.nav.contact'))

@section('content')
<section class="page-hero">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-5">
                <div class="content-card p-4 p-lg-5 h-100">
                    <div class="section-label mb-2">{{ __('frontend.sections.get_in_touch') }}</div>
                    <h1 class="mb-4">{{ __('frontend.nav.contact') }}</h1>
                    <p class="mb-4">{{ __('frontend.texts.contact_intro') }}</p>
                    <div class="d-grid gap-3">
                        <div><strong>{{ __('frontend.fields.email') }}:</strong><br>{{ $profile?->email ?: __('frontend.empty.not_provided_yet') }}</div>
                        <div><strong>{{ __('frontend.fields.phone') }}:</strong><br>{{ $profile?->phone ?: __('frontend.empty.not_provided_yet') }}</div>
                        <div><strong>{{ __('frontend.fields.address') }}:</strong><br>{{ $profile?->address ?: __('frontend.empty.not_provided_yet') }}</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="content-card p-4 p-lg-5">
                    <h2 class="h3 mb-4">{{ __('frontend.sections.send_a_message') }}</h2>

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if ($errors->has('form'))
                        <div class="alert alert-danger">{{ $errors->first('form') }}</div>
                    @endif

                    <form method="POST" action="{{ route('contact.store') }}" class="row g-3">
                        @csrf
                        <div class="col-md-6">
                            <label for="name" class="form-label">{{ __('frontend.fields.name') }}</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">{{ __('frontend.fields.email') }}</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <label for="subject" class="form-label">{{ __('frontend.fields.subject') }}</label>
                            <input type="text" class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" value="{{ old('subject') }}">
                            @error('subject')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <label for="message" class="form-label">{{ __('frontend.fields.message') }}</label>
                            <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="7" required>{{ old('message') }}</textarea>
                            @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <div class="@error('captcha') is-invalid @enderror">
                                <div class="cf-turnstile" data-sitekey="{{ config('services.turnstile.site_key') }}"></div>
                            </div>
                            @error('captcha')<div class="text-danger small mt-2">{{ $message }}</div>@enderror
                            @error('cf-turnstile-response')<div class="text-danger small mt-2">{{ __('frontend.messages.captcha_required') }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-academic px-4">{{ __('frontend.actions.send_message') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
@endpush
