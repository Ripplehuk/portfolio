@extends('layouts.app')

@section('title', ($profile?->full_name ?? config('app.name')) . ' | ' . __('frontend.nav.achievements'))

@section('content')
<section class="page-hero">
    <div class="container">
        <div class="section-heading">
            <div>
                <div class="section-label mb-2">{{ __('frontend.sections.recognition') }}</div>
                <h1 class="mb-2">{{ __('frontend.nav.achievements') }}</h1>
                <p>{{ __('frontend.texts.achievements_intro') }}</p>
            </div>
        </div>

        <div class="row g-4">
            @forelse ($achievements as $achievement)
                <div class="col-md-6">
                    <div class="content-card h-100 p-4 p-lg-5">
                        <div class="row g-4 align-items-start">
                            <div class="col-lg-4">
                                @if ($achievement->image)
                                    <img src="{{ asset('storage/' . $achievement->image) }}" alt="{{ $achievement->title }}" class="achievement-image">
                                @else
                                    <div class="image-placeholder" style="min-height: 180px;">
                                        <div>{{ __('frontend.empty.image_not_available') }}</div>
                                    </div>
                                @endif
                            </div>
                            <div class="col-lg-8">
                                <h2 class="h4 mb-2">{{ $achievement->title }}</h2>
                                <p class="text-accent mb-2">{{ $achievement->issuer ?: __('frontend.empty.academic_recognition') }}</p>
                                <p class="mb-3">{{ optional($achievement->achievement_date)->format('F d, Y') ?? __('frontend.empty.date_tba') }}</p>
                                <p class="mb-3">{{ \Illuminate\Support\Str::limit(strip_tags($achievement->description ?: __('frontend.empty.achievement_details_soon')), 180) }}</p>
                                <div class="d-flex flex-wrap gap-2">
                                    @if ($achievement->image)
                                        <a href="{{ asset('storage/' . $achievement->image) }}" target="_blank" class="btn btn-outline-academic">{{ __('frontend.actions.view_image') }}</a>
                                    @endif
                                    @if ($achievement->certificate_file)
                                        <a href="{{ asset('storage/' . $achievement->certificate_file) }}" target="_blank" class="btn btn-academic">{{ __('frontend.actions.certificate') }}</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12"><div class="empty-state p-4 text-center">{{ __('frontend.empty.no_achievements') }}</div></div>
            @endforelse
        </div>
    </div>
</section>
@endsection
