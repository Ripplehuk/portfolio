@extends('layouts.app')

@section('title', ($profile?->full_name ?? config('app.name')) . ' | ' . __('frontend.nav.home'))

@section('content')
<section class="page-hero">
    <div class="container">
        <div class="hero-card p-4 p-lg-5">
            <div class="row align-items-center g-5">
                <div class="col-lg-7 position-relative">
                    <div class="section-label mb-3">{{ __('frontend.sections.scientist_portfolio') }}</div>
                    <h1 class="display-4 fw-semibold mb-3">
                        {{ $profile?->full_name ?? config('app.name') }}
                        @if ($highestAcademicDegree?->title)
                            <span class="hero-degree">, {{ $highestAcademicDegree->title }}</span>
                        @endif
                    </h1>
                    @if ($profile?->position || $profile?->organization)
                        <p class="lead text-accent mb-3">
                            {{ $profile?->position ?: __('frontend.texts.hero_default_position') }}
                            @if ($profile?->organization)
                                <span class="d-inline-block">, {{ $profile->organization }}</span>
                            @endif
                        </p>
                    @endif
                    <p class="fs-5 mb-4">
                        {{ $profile?->short_bio ?: __('frontend.texts.hero_default_bio') }}
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="{{ route('publications.index') }}" class="btn btn-academic px-4">{{ __('frontend.actions.view_publications') }}</a>
                        <a href="{{ route('contact') }}" class="btn btn-outline-academic px-4">{{ __('frontend.actions.contact') }}</a>
                        @if ($profile?->cv_file)
                            <a href="{{ asset('storage/' . $profile->cv_file) }}" target="_blank" class="btn btn-outline-academic px-4">{{ __('frontend.actions.download_cv') }}</a>
                        @endif
                    </div>
                </div>
                <div class="col-lg-5 text-center">
                    @if ($profile?->photo)
                        <img src="{{ asset('storage/' . $profile->photo) }}" alt="{{ $profile->full_name }}" class="hero-photo">
                    @else
                        <div class="hero-photo-placeholder">
                            <div>
                                <div class="section-label mb-2">{{ __('frontend.sections.profile_photo') }}</div>
                                <div class="fs-5">{{ __('frontend.empty.photograph_not_available') }}</div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<section class="pb-5">
    <div class="container">
        <div class="section-heading">
            <div>
                <div class="section-label mb-2">{{ __('frontend.sections.research') }}</div>
                <h2 class="mb-2">{{ __('frontend.sections.featured_publications') }}</h2>
                <p>{{ __('frontend.sections.featured_publications_desc') }}</p>
            </div>
            <a href="{{ route('publications.index') }}" class="btn btn-outline-academic">{{ __('frontend.actions.see_all_publications') }}</a>
        </div>
        <div class="row g-4">
            @forelse ($featuredPublications as $publication)
                <div class="col-md-6 col-xl-4">
                    <div class="feature-card h-100 p-4 d-flex flex-column">
                        <div class="mb-3 d-flex flex-wrap gap-2">
                            <span class="soft-badge">{{ $publication->type_label }}</span>
                            @if ($publication->publication_year)
                                <span class="meta-badge">{{ $publication->publication_year }}</span>
                            @endif
                        </div>
                        <h3 class="h5 mb-3">{{ $publication->title }}</h3>
                        <p class="text-accent mb-2">{{ $publication->authors ?: __('frontend.empty.authors_not_specified') }}</p>
                        <p class="mb-4 small">{{ $publication->journal ?: __('frontend.empty.journal_not_specified') }}</p>
                        <div class="mt-auto">
                            <a href="{{ route('publications.show', $publication) }}" class="btn btn-sm btn-outline-academic">{{ __('frontend.actions.read_more') }}</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="empty-state p-4 text-center">{{ __('frontend.empty.no_publications') }}</div>
                </div>
            @endforelse
        </div>
    </div>
</section>

@if ($featuredBooks->isNotEmpty())
<section class="pb-5">
    <div class="container">
        <div class="section-heading">
            <div>
                <div class="section-label mb-2">{{ __('frontend.sections.library') }}</div>
                <h2 class="mb-2">{{ __('frontend.sections.books_monographs') }}</h2>
                <p>{{ __('frontend.sections.books_monographs_desc') }}</p>
            </div>
            <a href="{{ route('publications.index') }}" class="btn btn-outline-academic">{{ __('frontend.actions.browse_all_works') }}</a>
        </div>
        <div class="row g-4">
            @foreach ($featuredBooks as $publication)
                <div class="col-md-6 col-xl-4">
                    <div class="content-card h-100 p-4 d-flex flex-column">
                        <div class="d-flex flex-wrap gap-2 mb-3">
                            <span class="soft-badge">{{ $publication->type_label }}</span>
                            @if ($publication->publication_year)
                                <span class="meta-badge">{{ $publication->publication_year }}</span>
                            @endif
                        </div>
                        <h3 class="h5 mb-2">{{ $publication->title }}</h3>
                        <p class="text-accent mb-3">{{ $publication->authors ?: __('frontend.empty.authors_not_specified') }}</p>
                        <p class="mb-4">{{ \Illuminate\Support\Str::limit(strip_tags($publication->abstract ?: __('frontend.sections.publication_detail')), 120) }}</p>
                        <div class="mt-auto">
                            <a href="{{ route('publications.show', $publication) }}" class="btn btn-sm btn-outline-academic">{{ __('frontend.actions.view_work') }}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<section class="pb-5">
    <div class="container">
        <div class="section-heading">
            <div>
                <div class="section-label mb-2">{{ __('frontend.sections.activities') }}</div>
                <h2 class="mb-2">{{ __('frontend.sections.recent_events') }}</h2>
                <p>{{ __('frontend.sections.recent_events_desc') }}</p>
            </div>
            <a href="{{ route('events') }}" class="btn btn-outline-academic">{{ __('frontend.actions.all_events') }}</a>
        </div>
        <div class="row g-4">
            @forelse ($latestEvents as $event)
                <div class="col-md-6 col-xl-4">
                    <div class="feature-card h-100 overflow-hidden">
                        @if ($event->image)
                            <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="card-image">
                        @else
                            <div class="image-placeholder">
                                <div>
                                    <div class="section-label mb-2">{{ __('frontend.sections.event') }}</div>
                                    <div>{{ __('frontend.empty.image_not_available') }}</div>
                                </div>
                            </div>
                        @endif
                        <div class="p-4 d-flex flex-column h-100">
                            <h3 class="h5 mb-2">{{ $event->title }}</h3>
                            <p class="text-accent mb-2">{{ optional($event->event_date)->format('F d, Y') ?? __('frontend.empty.date_tba') }}</p>
                            <p class="mb-2"><strong>{{ __('frontend.fields.location') }}:</strong> {{ $event->location ?: __('frontend.empty.location_tba') }}</p>
                            <p class="mb-0">{{ \Illuminate\Support\Str::limit(strip_tags($event->description ?: __('frontend.empty.event_details_soon')), 120) }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="empty-state p-4 text-center">{{ __('frontend.empty.no_events_added') }}</div>
                </div>
            @endforelse
        </div>
    </div>
</section>

<section class="pb-5">
    <div class="container">
        <div class="section-heading">
            <div>
                <div class="section-label mb-2">{{ __('frontend.sections.recognition') }}</div>
                <h2 class="mb-2">{{ __('frontend.sections.latest_achievements') }}</h2>
                <p>{{ __('frontend.sections.latest_achievements_desc') }}</p>
            </div>
            <a href="{{ route('achievements') }}" class="btn btn-outline-academic">{{ __('frontend.actions.view_achievements') }}</a>
        </div>
        <div class="row g-4">
            @forelse ($achievements as $achievement)
                <div class="col-md-6 col-xl-4">
                    <div class="content-card h-100 p-4 d-flex flex-column">
                        @if ($achievement->image)
                            <img src="{{ asset('storage/' . $achievement->image) }}" alt="{{ $achievement->title }}" class="achievement-image mb-4">
                        @endif
                        <h3 class="h5 mb-2">{{ $achievement->title }}</h3>
                        <p class="text-accent mb-2">{{ $achievement->issuer ?: __('frontend.empty.academic_recognition') }}</p>
                        <p class="mb-3">{{ optional($achievement->achievement_date)->format('F d, Y') ?? __('frontend.empty.date_tba') }}</p>
                        <p class="mb-0">{{ \Illuminate\Support\Str::limit(strip_tags($achievement->description ?: __('frontend.empty.achievement_details_soon')), 120) }}</p>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="empty-state p-4 text-center">{{ __('frontend.empty.no_achievements_added') }}</div>
                </div>
            @endforelse
        </div>
    </div>
</section>

<section class="pb-5">
    <div class="container">
        <div class="section-heading">
            <div>
                <div class="section-label mb-2">{{ __('frontend.sections.media') }}</div>
                <h2 class="mb-2">{{ __('frontend.sections.gallery_preview') }}</h2>
                <p>{{ __('frontend.sections.gallery_preview_desc') }}</p>
            </div>
            <a href="{{ route('gallery') }}" class="btn btn-outline-academic">{{ __('frontend.actions.open_gallery') }}</a>
        </div>
        <div class="row g-4">
            @forelse ($galleryItems as $item)
                <div class="col-6 col-md-4 col-xl-2">
                    <div class="feature-card h-100 overflow-hidden">
                        @if ($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title ?: __('frontend.empty.gallery_item') }}" class="gallery-image rounded-0">
                        @else
                            <div class="image-placeholder" style="min-height: 180px; border-radius: 0;">
                                <div>{{ __('frontend.empty.image_not_available') }}</div>
                            </div>
                        @endif
                        <div class="p-3">
                            <h3 class="h6 mb-1">{{ $item->title ?: __('frontend.empty.gallery_item') }}</h3>
                            <p class="small text-accent mb-0">{{ $item->category ?: __('frontend.empty.academic_activity') }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="empty-state p-4 text-center">{{ __('frontend.empty.no_gallery_items') }}</div>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
