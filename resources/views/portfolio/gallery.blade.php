@extends('layouts.app')

@section('title', ($profile?->full_name ?? config('app.name')) . ' | ' . __('frontend.nav.gallery'))

@section('content')
<section class="page-hero">
    <div class="container">
        <div class="section-heading">
            <div>
                <div class="section-label mb-2">{{ __('frontend.sections.media_archive') }}</div>
                <h1 class="mb-2">{{ __('frontend.nav.gallery') }}</h1>
                <p>{{ __('frontend.texts.gallery_intro') }}</p>
            </div>
        </div>

        <div class="row g-4">
            @forelse ($galleryItems as $item)
                <div class="col-6 col-md-4 col-xl-3">
                    <div class="feature-card h-100 overflow-hidden">
                        @if ($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title ?: __('frontend.empty.gallery_item') }}" class="gallery-image rounded-0">
                        @else
                            <div class="image-placeholder" style="min-height: 240px; border-radius: 0;">
                                <div>{{ __('frontend.empty.image_not_available') }}</div>
                            </div>
                        @endif
                        <div class="p-3">
                            <h2 class="h6 mb-1">{{ $item->title ?: __('frontend.empty.gallery_item') }}</h2>
                            <p class="text-accent small mb-1">{{ $item->category ?: __('frontend.empty.academic_activity') }}</p>
                            @if ($item->description)
                                <p class="small mb-0">{{ \Illuminate\Support\Str::limit($item->description, 70) }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12"><div class="empty-state p-4 text-center">{{ __('frontend.empty.no_gallery_items') }}</div></div>
            @endforelse
        </div>
    </div>
</section>
@endsection
