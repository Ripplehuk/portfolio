<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AcademicDegree;
use App\Models\Achievement;
use App\Models\Event;
use App\Models\GalleryItem;
use App\Models\Profile;
use App\Models\Publication;
use Illuminate\Contracts\View\View;

class PortfolioController extends Controller
{
    public function home(): View
    {
        $profile = Profile::query()->first();
        $highestAcademicDegree = AcademicDegree::query()
            ->orderBy('sort_order')
            ->orderByDesc('year')
            ->first();

        $featuredPublications = Publication::query()
            ->where('type', Publication::TYPE_ARTICLE)
            ->where('is_featured', true)
            ->orderBy('sort_order')
            ->orderByDesc('publication_year')
            ->limit(6)
            ->get();

        if ($featuredPublications->isEmpty()) {
            $featuredPublications = Publication::query()
                ->where('type', Publication::TYPE_ARTICLE)
                ->orderByDesc('publication_year')
                ->orderBy('sort_order')
                ->limit(6)
                ->get();
        }

        $featuredBooks = Publication::query()
            ->whereIn('type', [Publication::TYPE_BOOK, Publication::TYPE_MONOGRAPH])
            ->orderByDesc('publication_year')
            ->orderBy('sort_order')
            ->limit(3)
            ->get();

        $latestEvents = Event::query()
            ->orderByDesc('event_date')
            ->orderBy('sort_order')
            ->limit(3)
            ->get();

        $achievements = Achievement::query()
            ->orderByDesc('achievement_date')
            ->orderBy('sort_order')
            ->limit(3)
            ->get();

        $galleryItems = GalleryItem::query()
            ->orderByDesc('created_at')
            ->orderBy('sort_order')
            ->limit(6)
            ->get();

        return view('portfolio.home', compact(
            'profile',
            'highestAcademicDegree',
            'featuredPublications',
            'featuredBooks',
            'latestEvents',
            'achievements',
            'galleryItems',
        ));
    }

    public function about(): View
    {
        $profile = Profile::query()->first();
        $academicDegrees = AcademicDegree::query()
            ->orderBy('sort_order')
            ->orderByDesc('year')
            ->get();

        return view('portfolio.about', compact('profile', 'academicDegrees'));
    }

    public function publications(): View
    {
        $profile = Profile::query()->first();

        $publicationsByType = Publication::query()
            ->orderBy('sort_order')
            ->orderByDesc('publication_year')
            ->get()
            ->groupBy(function (Publication $publication): string {
                return $publication->type ?: Publication::TYPE_ARTICLE;
            });

        $publicationTypeLabels = Publication::typeOptions();

        return view('portfolio.publications.index', compact('profile', 'publicationsByType', 'publicationTypeLabels'));
    }

    public function publication(Publication $publication): View
    {
        $profile = Profile::query()->first();

        return view('portfolio.publications.show', compact('profile', 'publication'));
    }

    public function events(): View
    {
        $profile = Profile::query()->first();

        $events = Event::query()
            ->orderByDesc('event_date')
            ->orderBy('sort_order')
            ->get();

        return view('portfolio.events', compact('profile', 'events'));
    }

    public function achievements(): View
    {
        $profile = Profile::query()->first();

        $achievements = Achievement::query()
            ->orderByDesc('achievement_date')
            ->orderBy('sort_order')
            ->get();

        return view('portfolio.achievements', compact('profile', 'achievements'));
    }

    public function gallery(): View
    {
        $profile = Profile::query()->first();

        $galleryItems = GalleryItem::query()
            ->orderByDesc('created_at')
            ->orderBy('sort_order')
            ->get();

        return view('portfolio.gallery', compact('profile', 'galleryItems'));
    }

    public function contact(): View
    {
        $profile = Profile::query()->first();

        return view('portfolio.contact', compact('profile'));
    }
}
