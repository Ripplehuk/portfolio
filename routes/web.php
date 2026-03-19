<?php

use App\Http\Controllers\Frontend\ContactMessageController;
use App\Http\Controllers\Frontend\LocaleController;
use App\Http\Controllers\Frontend\PortfolioController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PortfolioController::class, 'home'])->name('home');
Route::get('/about', [PortfolioController::class, 'about'])->name('about');
Route::get('/publications', [PortfolioController::class, 'publications'])->name('publications.index');
Route::get('/publications/{publication}', [PortfolioController::class, 'publication'])->name('publications.show');
Route::get('/events', [PortfolioController::class, 'events'])->name('events');
Route::get('/achievements', [PortfolioController::class, 'achievements'])->name('achievements');
Route::get('/gallery', [PortfolioController::class, 'gallery'])->name('gallery');
Route::get('/contact', [PortfolioController::class, 'contact'])->name('contact');
Route::get('/lang/{locale}', [LocaleController::class, 'switch'])->name('locale.switch');
Route::post('/contact', [ContactMessageController::class, 'store'])
    ->middleware('throttle:contact-form')
    ->name('contact.store');
