<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', ($profile?->full_name ?? config('app.name')) . ' ' . __('frontend.site_title_suffix'))</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        :root {
            --portfolio-navy: #16324a;
            --portfolio-blue: #34556f;
            --portfolio-slate: #69849a;
            --portfolio-mist: #edf3f7;
            --portfolio-paper: #fbfcfd;
            --portfolio-ink: #1f3442;
            --portfolio-gold: #a6864b;
            --portfolio-border: #d6e0e7;
        }

        body {
            color: var(--portfolio-ink);
            background:
                radial-gradient(circle at top left, rgba(166, 134, 75, 0.10), transparent 28%),
                linear-gradient(180deg, #f9fbfc 0%, #eef3f6 100%);
            font-family: Georgia, "Times New Roman", serif;
        }

        a {
            color: var(--portfolio-blue);
        }

        a:hover {
            color: var(--portfolio-navy);
        }

        .navbar-brand,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            color: var(--portfolio-navy);
        }

        .navbar {
            background: rgba(255, 255, 255, 0.95);
            border-bottom: 1px solid rgba(22, 50, 74, 0.08);
            backdrop-filter: blur(10px);
        }

        .navbar .nav-link {
            color: var(--portfolio-blue);
            font-weight: 600;
        }

        .navbar .nav-link.active {
            color: var(--portfolio-navy) !important;
        }

        .locale-switcher {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            margin-left: 1rem;
        }

        .locale-link {
            text-decoration: none;
            border: 1px solid rgba(22, 50, 74, 0.14);
            color: var(--portfolio-blue);
            padding: 0.35rem 0.7rem;
            border-radius: 999px;
            font-size: 0.8rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            background: rgba(255, 255, 255, 0.8);
        }

        .locale-link.active {
            background: var(--portfolio-navy);
            border-color: var(--portfolio-navy);
            color: #fff;
        }

        .page-hero {
            padding: 4.75rem 0 2.75rem;
        }

        .hero-card,
        .content-card,
        .feature-card,
        .info-card,
        .footer-card,
        .placeholder-card {
            background: rgba(255, 255, 255, 0.96);
            border: 1px solid var(--portfolio-border);
            box-shadow: 0 16px 36px rgba(22, 50, 74, 0.08);
        }

        .hero-card {
            border-radius: 1.75rem;
            overflow: hidden;
            position: relative;
        }

        .hero-card::after {
            content: "";
            position: absolute;
            inset: auto 0 0 auto;
            width: 280px;
            height: 280px;
            background: radial-gradient(circle, rgba(166, 134, 75, 0.15), transparent 70%);
            pointer-events: none;
        }

        .content-card,
        .feature-card,
        .info-card,
        .footer-card,
        .placeholder-card {
            border-radius: 1.15rem;
        }

        .section-label {
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: var(--portfolio-slate);
            font-size: 0.75rem;
            font-weight: 700;
        }

        .section-heading {
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 1.75rem;
        }

        .section-heading p {
            margin-bottom: 0;
            color: var(--portfolio-slate);
        }

        .hero-photo,
        .card-image,
        .gallery-image,
        .achievement-image {
            object-fit: cover;
        }

        .hero-photo {
            width: 100%;
            max-width: 360px;
            aspect-ratio: 4 / 5;
            border-radius: 1.35rem;
            border: 6px solid rgba(255, 255, 255, 0.94);
            box-shadow: 0 20px 36px rgba(22, 50, 74, 0.15);
            background: linear-gradient(180deg, #dfe8ee, #f7fafc);
        }

        .hero-photo-placeholder,
        .image-placeholder {
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(180deg, #e6edf2 0%, #f8fbfd 100%);
            color: var(--portfolio-slate);
            border: 1px dashed #bfd0db;
            text-align: center;
        }

        .hero-photo-placeholder {
            width: 100%;
            max-width: 360px;
            aspect-ratio: 4 / 5;
            border-radius: 1.35rem;
            margin-inline: auto;
            padding: 2rem;
        }

        .image-placeholder {
            width: 100%;
            min-height: 220px;
            border-radius: 1rem;
            padding: 1rem;
        }

        .card-image {
            height: 220px;
            width: 100%;
            border-top-left-radius: 1.15rem;
            border-top-right-radius: 1.15rem;
        }

        .achievement-image {
            height: 180px;
            width: 100%;
            border-radius: 1rem;
        }

        .gallery-image {
            width: 100%;
            aspect-ratio: 1 / 1;
            border-radius: 1rem;
        }

        .soft-badge,
        .meta-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            border-radius: 999px;
            padding: 0.45rem 0.9rem;
            font-size: 0.85rem;
        }

        .soft-badge {
            background: rgba(22, 50, 74, 0.08);
            color: var(--portfolio-navy);
        }

        .meta-badge {
            background: rgba(166, 134, 75, 0.11);
            color: #7d6636;
        }

        .text-accent {
            color: var(--portfolio-slate);
        }

        .hero-degree {
            color: var(--portfolio-gold);
            font-size: 0.78em;
            font-weight: 500;
        }

        .degree-card {
            padding: 1.5rem;
            border-radius: 1rem;
            border: 1px solid rgba(22, 50, 74, 0.08);
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.96), rgba(237, 243, 247, 0.85));
        }

        .degree-year {
            align-self: start;
            white-space: nowrap;
        }

        .btn-academic {
            background: var(--portfolio-navy);
            color: #fff;
            border-color: var(--portfolio-navy);
            font-weight: 600;
        }

        .btn-academic:hover,
        .btn-academic:focus {
            background: #0f283d;
            border-color: #0f283d;
            color: #fff;
        }

        .btn-outline-academic {
            color: var(--portfolio-navy);
            border-color: rgba(22, 50, 74, 0.22);
            font-weight: 600;
            background: rgba(255, 255, 255, 0.75);
        }

        .btn-outline-academic:hover,
        .btn-outline-academic:focus {
            color: #fff;
            background: var(--portfolio-blue);
            border-color: var(--portfolio-blue);
        }

        .empty-state {
            border: 1px dashed var(--portfolio-border);
            border-radius: 1rem;
            background: rgba(255, 255, 255, 0.78);
            color: var(--portfolio-slate);
        }

        .footer {
            background: linear-gradient(180deg, #17324a 0%, #132739 100%);
            color: rgba(255, 255, 255, 0.82);
        }

        .footer h5,
        .footer h6,
        .footer a {
            color: #fff;
        }

        .footer a {
            text-decoration: none;
        }

        .footer a:hover {
            color: #d4e4ef;
        }

        .footer-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-list li + li {
            margin-top: 0.55rem;
        }

        .detail-list dt {
            font-size: 0.82rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--portfolio-slate);
            margin-bottom: 0.35rem;
        }

        .detail-list dd {
            margin-bottom: 1.25rem;
        }

        .rich-text p:last-child {
            margin-bottom: 0;
        }

        @media (max-width: 991.98px) {
            .page-hero {
                padding: 3.75rem 0 2.25rem;
            }

            .section-heading {
                align-items: start;
                flex-direction: column;
            }

            .locale-switcher {
                margin-left: 0;
                margin-top: 1rem;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container py-2">
        <a class="navbar-brand fw-semibold" href="{{ route('home') }}">
            {{ $profile?->full_name ?? config('app.name') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav ms-auto gap-lg-2">
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">{{ __('frontend.nav.home') }}</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">{{ __('frontend.nav.about') }}</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('publications.*') ? 'active' : '' }}" href="{{ route('publications.index') }}">{{ __('frontend.nav.publications') }}</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('events') ? 'active' : '' }}" href="{{ route('events') }}">{{ __('frontend.nav.events') }}</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('achievements') ? 'active' : '' }}" href="{{ route('achievements') }}">{{ __('frontend.nav.achievements') }}</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('gallery') ? 'active' : '' }}" href="{{ route('gallery') }}">{{ __('frontend.nav.gallery') }}</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">{{ __('frontend.nav.contact') }}</a></li>
            </ul>
            <div class="locale-switcher">
                <a href="{{ route('locale.switch', 'en') }}" class="locale-link {{ app()->getLocale() === 'en' ? 'active' : '' }}">EN</a>
                <a href="{{ route('locale.switch', 'uz') }}" class="locale-link {{ app()->getLocale() === 'uz' ? 'active' : '' }}">UZ</a>
            </div>
        </div>
    </div>
</nav>

<main>
    @unless ($profile)
        <section class="pt-4">
            <div class="container">
                <div class="alert alert-warning border-0 shadow-sm mb-0">
                    {{ __('frontend.texts.profile_placeholder') }}
                </div>
            </div>
        </section>
    @endunless

    @yield('content')
</main>

<footer class="footer mt-5 py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <h5 class="mb-3">{{ $profile?->full_name ?? 'Scientist Portfolio' }}</h5>
                <p class="mb-3">
                    {{ $profile?->short_bio ?: __('frontend.texts.footer_default_bio') }}
                </p>
                @if ($profile?->position || $profile?->organization)
                    <p class="mb-0 small">
                        {{ $profile?->position }}{{ $profile?->position && $profile?->organization ? ', ' : '' }}{{ $profile?->organization }}
                    </p>
                @endif
            </div>
            <div class="col-sm-6 col-lg-2">
                <h6 class="mb-3">{{ __('frontend.links.navigate') }}</h6>
                <ul class="footer-list">
                    <li><a href="{{ route('home') }}">{{ __('frontend.nav.home') }}</a></li>
                    <li><a href="{{ route('about') }}">{{ __('frontend.nav.about') }}</a></li>
                    <li><a href="{{ route('publications.index') }}">{{ __('frontend.nav.publications') }}</a></li>
                    <li><a href="{{ route('events') }}">{{ __('frontend.nav.events') }}</a></li>
                    <li><a href="{{ route('contact') }}">{{ __('frontend.nav.contact') }}</a></li>
                </ul>
            </div>
            <div class="col-sm-6 col-lg-3">
                <h6 class="mb-3">{{ __('frontend.links.contact') }}</h6>
                <ul class="footer-list">
                    @if ($profile?->email)<li>{{ $profile->email }}</li>@endif
                    @if ($profile?->phone)<li>{{ $profile->phone }}</li>@endif
                    @if ($profile?->address)<li>{{ $profile->address }}</li>@endif
                    @unless ($profile?->email || $profile?->phone || $profile?->address)
                        <li>{{ __('frontend.empty.contact_details_empty') }}</li>
                    @endunless
                </ul>
            </div>
            <div class="col-lg-3">
                <h6 class="mb-3">{{ __('frontend.links.academic_links') }}</h6>
                <div class="d-flex flex-wrap gap-2">
                    @if ($profile?->google_scholar)
                        <a href="{{ $profile->google_scholar }}" target="_blank" rel="noreferrer" class="btn btn-sm btn-outline-light">{{ __('frontend.fields.google_scholar') }}</a>
                    @endif
                    @if ($profile?->orcid)
                        <a href="{{ $profile->orcid }}" target="_blank" rel="noreferrer" class="btn btn-sm btn-outline-light">{{ __('frontend.fields.orcid') }}</a>
                    @endif
                    @if ($profile?->scopus)
                        <a href="{{ $profile->scopus }}" target="_blank" rel="noreferrer" class="btn btn-sm btn-outline-light">{{ __('frontend.fields.scopus') }}</a>
                    @endif
                    @if ($profile?->researchgate)
                        <a href="{{ $profile->researchgate }}" target="_blank" rel="noreferrer" class="btn btn-sm btn-outline-light">{{ __('frontend.fields.researchgate') }}</a>
                    @endif
                    @unless ($profile?->google_scholar || $profile?->orcid || $profile?->scopus || $profile?->researchgate)
                        <p class="mb-0">{{ __('frontend.empty.academic_links_empty') }}</p>
                    @endunless
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
@stack('scripts')
</body>
</html>
