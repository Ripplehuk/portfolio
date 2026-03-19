@extends('layouts.app')

@section('title', ($profile?->full_name ?? config('app.name')) . ' | ' . __('frontend.nav.events'))

@section('content')
<section class="page-hero">
    <div class="container">
        <div class="section-heading">
            <div>
                <div class="section-label mb-2">{{ __('frontend.sections.academic_activities') }}</div>
                <h1 class="mb-2">{{ __('frontend.nav.events') }}</h1>
                <p>{{ __('frontend.texts.events_intro') }}</p>
            </div>
        </div>

        <div class="row g-4">
            @forelse ($events as $event)
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
                        <div class="p-4">
                            <span class="soft-badge mb-3 d-inline-block">{{ __('frontend.statuses.' . ($event->status ?: 'completed')) }}</span>
                            <h2 class="h5 mb-2">{{ $event->title }}</h2>
                            <p class="text-accent mb-2">{{ optional($event->event_date)->format('F d, Y') ?? __('frontend.empty.date_tba') }}</p>
                            <p class="mb-2"><strong>{{ __('frontend.fields.location') }}:</strong> {{ $event->location ?: __('frontend.empty.location_tba') }}</p>
                            <p class="mb-0">{{ \Illuminate\Support\Str::limit(strip_tags($event->description ?: __('frontend.empty.event_details_soon')), 140) }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12"><div class="empty-state p-4 text-center">{{ __('frontend.empty.no_events') }}</div></div>
            @endforelse
        </div>
    </div>
</section>
@endsection
