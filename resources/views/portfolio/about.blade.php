@extends('layouts.app')

@section('title', ($profile?->full_name ?? config('app.name')) . ' | ' . __('frontend.nav.about'))

@section('content')
<section class="page-hero">
    <div class="container">
        <div class="row g-4 align-items-start">
            <div class="col-lg-4">
                <div class="content-card p-4 p-lg-5 sticky-top" style="top: 6rem;">
                    @if ($profile?->photo)
                        <img src="{{ asset('storage/' . $profile->photo) }}" alt="{{ $profile->full_name }}" class="hero-photo mb-4 mx-auto d-block">
                    @else
                        <div class="hero-photo-placeholder mb-4">
                            <div>
                                <div class="section-label mb-2">{{ __('frontend.sections.profile_photo') }}</div>
                                <div>{{ __('frontend.empty.photograph_not_available') }}</div>
                            </div>
                        </div>
                    @endif

                    <h1 class="h2 mb-2">{{ $profile?->full_name ?? __('frontend.texts.profile_not_available') }}</h1>
                    @if ($profile?->position || $profile?->organization)
                        <p class="text-accent mb-1">{{ $profile?->position }}</p>
                        <p class="mb-3">{{ $profile?->organization }}</p>
                    @endif

                    @if ($profile)
                        <div class="d-grid gap-2">
                            @if ($profile->email)
                                <a href="mailto:{{ $profile->email }}" class="btn btn-outline-academic">{{ __('frontend.actions.email') }}</a>
                            @endif
                            @if ($profile->cv_file)
                                <a href="{{ asset('storage/' . $profile->cv_file) }}" target="_blank" class="btn btn-academic">{{ __('frontend.actions.download_cv') }}</a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-8">
                <div class="content-card p-4 p-lg-5 mb-4">
                    <div class="section-label mb-2">{{ __('frontend.sections.biography') }}</div>
                    <h2 class="mb-4">{{ __('frontend.sections.academic_profile') }}</h2>
                    @if ($profile?->full_bio)
                        <div class="rich-text lh-lg">{!! $profile->full_bio !!}</div>
                    @elseif ($profile?->short_bio)
                        <p class="mb-0 fs-5">{{ $profile->short_bio }}</p>
                    @else
                        <div class="empty-state p-4">{{ __('frontend.texts.about_empty_bio') }}</div>
                    @endif
                </div>

                <div class="content-card p-4 p-lg-5">
                    <div class="section-label mb-2">{{ __('frontend.sections.details') }}</div>
                    <h2 class="mb-4">{{ __('frontend.sections.profile_information') }}</h2>
                    @if ($profile)
                        <div class="row g-4">
                            <div class="col-md-6">
                                <dl class="detail-list mb-0">
                                    <dt>{{ __('frontend.fields.full_name') }}</dt>
                                    <dd>{{ $profile->full_name }}</dd>

                                    <dt>{{ __('frontend.fields.position') }}</dt>
                                    <dd>{{ $profile->position ?: __('frontend.empty.not_provided') }}</dd>

                                    <dt>{{ __('frontend.fields.organization') }}</dt>
                                    <dd>{{ $profile->organization ?: __('frontend.empty.not_provided') }}</dd>

                                    <dt>{{ __('frontend.fields.email') }}</dt>
                                    <dd>{{ $profile->email ?: __('frontend.empty.not_provided') }}</dd>

                                    <dt>{{ __('frontend.fields.phone') }}</dt>
                                    <dd>{{ $profile->phone ?: __('frontend.empty.not_provided') }}</dd>
                                </dl>
                            </div>
                            <div class="col-md-6">
                                <dl class="detail-list mb-0">
                                    <dt>{{ __('frontend.fields.address') }}</dt>
                                    <dd>{{ $profile->address ?: __('frontend.empty.not_provided') }}</dd>

                                    <dt>{{ __('frontend.fields.telegram') }}</dt>
                                    <dd>{{ $profile->telegram ?: __('frontend.empty.not_provided') }}</dd>

                                    <dt>{{ __('frontend.fields.orcid') }}</dt>
                                    <dd>{{ $profile->orcid ?: __('frontend.empty.not_provided') }}</dd>

                                    <dt>{{ __('frontend.fields.scopus') }}</dt>
                                    <dd>{{ $profile->scopus ?: __('frontend.empty.not_provided') }}</dd>

                                    <dt>{{ __('frontend.fields.researchgate') }}</dt>
                                    <dd>{{ $profile->researchgate ?: __('frontend.empty.not_provided') }}</dd>
                                </dl>
                            </div>
                        </div>

                        <div class="d-flex flex-wrap gap-2 mt-4">
                            @if ($profile->google_scholar)
                                <a href="{{ $profile->google_scholar }}" target="_blank" rel="noreferrer" class="btn btn-outline-academic">{{ __('frontend.fields.google_scholar') }}</a>
                            @endif
                            @if ($profile->orcid)
                                <a href="{{ $profile->orcid }}" target="_blank" rel="noreferrer" class="btn btn-outline-academic">{{ __('frontend.fields.orcid') }}</a>
                            @endif
                            @if ($profile->scopus)
                                <a href="{{ $profile->scopus }}" target="_blank" rel="noreferrer" class="btn btn-outline-academic">{{ __('frontend.fields.scopus') }}</a>
                            @endif
                            @if ($profile->researchgate)
                                <a href="{{ $profile->researchgate }}" target="_blank" rel="noreferrer" class="btn btn-outline-academic">{{ __('frontend.fields.researchgate') }}</a>
                            @endif
                        </div>
                    @else
                        <div class="empty-state p-4">{{ __('frontend.empty.profile_details_empty') }}</div>
                    @endif
                </div>

                <div class="content-card p-4 p-lg-5 mt-4">
                    <div class="section-label mb-2">{{ __('frontend.sections.academic_background') }}</div>
                    <h2 class="mb-4">{{ __('frontend.actions.academic_degrees') }}</h2>
                    @forelse ($academicDegrees as $degree)
                        <article class="degree-card {{ $loop->last ? '' : 'mb-3' }}">
                            <div class="d-flex flex-column flex-md-row align-items-md-start justify-content-md-between gap-3 mb-3">
                                <div>
                                    <h3 class="h4 mb-1">{{ $degree->title }}</h3>
                                    @if ($degree->field)
                                        <p class="text-accent mb-0">{{ $degree->field }}</p>
                                    @endif
                                </div>
                                @if ($degree->year)
                                    <span class="meta-badge degree-year">{{ $degree->year }}</span>
                                @endif
                            </div>

                            @if ($degree->institution || $degree->country)
                                <p class="mb-3">
                                    <strong>{{ __('frontend.fields.institution') }}:</strong> {{ $degree->institution ?: __('frontend.empty.not_provided') }}
                                    @if ($degree->country)
                                        <span class="text-accent">, {{ $degree->country }}</span>
                                    @endif
                                </p>
                            @endif

                            @if ($degree->description)
                                <p class="mb-0">{{ $degree->description }}</p>
                            @else
                                <p class="text-accent mb-0">{{ __('frontend.empty.additional_degree_details') }}</p>
                            @endif
                        </article>
                    @empty
                        <div class="empty-state p-4">{{ __('frontend.empty.degrees_empty') }}</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
