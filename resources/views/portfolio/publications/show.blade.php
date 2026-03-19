@extends('layouts.app')

@section('title', $publication->title . ' | ' . __('frontend.nav.publications'))

@section('content')
<section class="page-hero">
    <div class="container">
        <div class="content-card p-4 p-lg-5">
            <a href="{{ route('publications.index') }}" class="text-decoration-none">&larr; {{ __('frontend.actions.back_to_publications') }}</a>
            <div class="section-label mt-4 mb-2">{{ __('frontend.sections.publication_detail') }}</div>
            <h1 class="mb-3">{{ $publication->title }}</h1>
            <p class="fs-5 text-accent mb-2">{{ $publication->authors ?: __('frontend.empty.authors_not_specified') }}</p>
            <p class="mb-4">{{ $publication->journal ?: __('frontend.empty.journal_not_specified') }}{{ $publication->publication_year ? ' • ' . $publication->publication_year : '' }}</p>

            @if ($publication->cover_image)
                <img src="{{ asset('storage/' . $publication->cover_image) }}" alt="{{ $publication->title }}" class="img-fluid rounded-4 mb-4" style="max-height: 420px; width: 100%; object-fit: cover;">
            @else
                <div class="image-placeholder mb-4" style="min-height: 280px;">
                    <div>
                        <div class="section-label mb-2">{{ __('frontend.sections.publication_cover') }}</div>
                        <div>{{ __('frontend.empty.image_not_available') }}</div>
                    </div>
                </div>
            @endif

            <div class="row g-4">
                <div class="col-lg-8">
                    <h2 class="h5 mb-3">{{ __('frontend.sections.abstract') }}</h2>
                    @if ($publication->abstract)
                        <div class="rich-text lh-lg">{!! $publication->abstract !!}</div>
                    @else
                        <div class="empty-state p-4">{{ __('frontend.empty.no_abstract') }}</div>
                    @endif
                </div>
                <div class="col-lg-4">
                    <div class="info-card p-4">
                        <h3 class="h6 mb-3">{{ __('frontend.sections.reference_information') }}</h3>
                        <p class="mb-2"><strong>{{ __('frontend.fields.doi') }}:</strong> {{ $publication->doi ?: __('frontend.empty.not_provided') }}</p>
                        <p class="mb-2"><strong>{{ __('frontend.fields.keywords') }}:</strong> {{ $publication->keywords ?: __('frontend.empty.not_provided') }}</p>
                        <div class="d-grid gap-2 mt-3">
                            @if ($publication->link)
                                <a href="{{ $publication->link }}" target="_blank" rel="noreferrer" class="btn btn-outline-academic">{{ __('frontend.actions.external_link') }}</a>
                            @endif
                            @if ($publication->pdf_file)
                                <a href="{{ asset('storage/' . $publication->pdf_file) }}" target="_blank" class="btn btn-academic">{{ __('frontend.actions.open_pdf') }}</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
