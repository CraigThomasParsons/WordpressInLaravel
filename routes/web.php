<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\TestimonialsController;
use App\Http\Controllers\MailController;

Route::get('/construct', function () {
    return view('hello');
});

Route::get('/', [HomeController::class, 'getIndex'])->name('home');

Route::get('/home', [HomeController::class, 'getIndex'])->name('home');

Route::get('/about', [AboutController::class, 'getIndex'])->name('about');

Route::get('/contact', [ContactController::class, 'getIndex'])->name('contact');

Route::get('/portfolio', [PortfolioController::class, 'getAllGalleries'])->name('portfolio');

Route::get('/portfolio/{gallery}', [PortfolioController::class, 'getIndex'])->name('portfolio-gallery');

Route::get('/testimonials', [TestimonialsController::class, 'getIndex'])->name('testimonials');

Route::post('/contact/send', [MailController::class, 'sendContactEmail'])->name('contact.email');
