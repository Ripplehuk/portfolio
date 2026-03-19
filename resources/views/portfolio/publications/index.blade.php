@extends('layouts.app')

@section('title', ($profile?->full_name ?? config('app.name')) . ' | ' . __('frontend.nav.publications'))

@section('content')
<section class="page-hero">
    <div class="container">
        <div class="section-heading">
            <div>
                <div class="section-label mb-2">{{ __('frontend.sections.research_output') }}</div>
                <h1 class="mb-2">{{ __('frontend.nav.publications') }}</h1>
                <p>{{ __('frontend.texts.publications_intro') }}</p>
            </div>
        </div>

        @php
            $orderedTypes = [
                \App\Models\Publication::TYPE_ARTICLE,
                \App\Models\Publication::TYPE_BOOK,
                \App\Models\Publication::TYPE_TEXTBOOK,
                \App\Models\Publication::TYPE_MONOGRAPH,
                \App\Models\Publication::TYPE_MANUAL,
                \App\Models\Publication::TYPE_THESIS,
                \App\Models\Publication::TYPE_PATENT,
                \App\Models\Publication::TYPE_OTHER,
            ];
        @endphp

        @php $hasAnyPublication = false; @endphp

        @foreach ($orderedTypes as $type)
            @continue(blank($publicationsByType->get($type)))
            @php $hasAnyPublication = true; @endphp

            <section class="mb-5">
                <div class="section-heading mb-4">
                    <div>
                        <div class="section-label mb-2">{{ $type === \App\Models\Publication::TYPE_ARTICLE ? __('frontend.sections.scholarly_works') : __('frontend.sections.academic_works') }}</div>
                        <h2 class="mb-2">{{ $publicationTypeLabels[$type] ?? __('frontend.sections.academic_works') }}</h2>
                        <p>{{ __('frontend.texts.curated_from_portfolio', ['type' => strtolower($publicationTypeLabels[$type] ?? __('frontend.sections.academic_works'))]) }}</p>
                    </div>
                </div>

                <div class="row g-4">
                    @foreach ($publicationsByType->get($type, collect()) as $publication)
                        <div class="col-12">
                            <div class="content-card p-4 p-lg-5">
                                <div class="row g-4 align-items-start">
                                    <div class="col-lg-9">
                                        <div class="d-flex flex-wrap gap-2 mb-3">
                                            <span class="soft-badge">{{ $publication->type_label }}</span>
                                            @if ($publication->publication_year)
                                                <span class="meta-badge">{{ $publication->publication_year }}</span>
                                            @endif
                                            @if ($publication->journal)
                                                <span class="soft-badge">{{ $publication->journal }}</span>
                                            @endif
                                        </div>
                                        <h3 class="h4 mb-2">{{ $publication->title }}</h3>
                                        <p class="mb-2 text-accent">{{ $publication->authors ?: __('frontend.empty.authors_not_specified') }}</p>
                                        @if ($publication->keywords)
                                            <p class="small mb-0"><strong>{{ __('frontend.fields.keywords') }}:</strong> {{ $publication->keywords }}</p>
                                        @endif
                                    </div>
                                    <div class="col-lg-3 text-lg-end">
                                        <a href="{{ route('publications.show', $publication) }}" class="btn btn-academic">{{ __('frontend.actions.view_details') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endforeach

        @unless ($hasAnyPublication)
            <div class="empty-state p-4 text-center">{{ __('frontend.empty.no_publications') }}</div>
        @endunless
    </div>
</section>
@endsection
