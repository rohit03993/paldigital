<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeadController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/services', [HomeController::class, 'services'])->name('services');
Route::get('/industries', [HomeController::class, 'industries'])->name('industries');
Route::get('/solutions', [HomeController::class, 'solutions'])->name('solutions');
Route::get('/portfolio', [HomeController::class, 'portfolio'])->name('portfolio');
Route::get('/case-studies', [HomeController::class, 'caseStudies'])->name('case-studies');
Route::get('/case-studies/{slug}', [HomeController::class, 'caseStudyShow'])->name('case-studies.show');
Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
Route::get('/blog/{slug}', [HomeController::class, 'blogShow'])->name('blog.show');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

Route::get('/sitemap.xml', \App\Http\Controllers\SitemapController::class)->name('sitemap');
Route::get('/robots.txt', function () {
    $baseUrl = rtrim(\App\Models\SiteSetting::get('site_url', config('app.url')), '/');

    return response("User-agent: *\nAllow: /\n\nSitemap: {$baseUrl}/sitemap.xml\n", 200, [
        'Content-Type' => 'text/plain',
    ]);
})->name('robots');

Route::post('/leads', [LeadController::class, 'store'])->name('leads.store');
Route::post('/demo-requests', [\App\Http\Controllers\DemoRequestController::class, 'store'])->name('demo-requests.store');
