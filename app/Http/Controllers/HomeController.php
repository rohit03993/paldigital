<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\CaseStudy;
use App\Models\Client;
use App\Models\Industry;
use App\Models\Portfolio;
use App\Models\SeoMeta;
use App\Models\Service;
use App\Models\Solution;
use App\Models\TeamMember;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        $seo = SeoMeta::forPage('home');

        return view('home', [
            'seo' => $seo,
            'services' => Service::active()->ordered()->get()->groupBy('category'),
            'industries' => Industry::active()->ordered()->get(),
            'flagship' => Solution::active()->where('is_flagship', true)->first(),
            'solutions' => Solution::active()->ordered()->get(),
            'testimonials' => Testimonial::active()->limit(6)->get(),
            'clients' => Client::active()->get(),
        ]);
    }

    public function about()
    {
        return view('pages.about', [
            'seo' => SeoMeta::forPage('about'),
            'team' => TeamMember::active()->get(),
        ]);
    }

    public function services()
    {
        return view('pages.services', [
            'seo' => SeoMeta::forPage('services'),
            'services' => Service::active()->ordered()->get()->groupBy('category'),
        ]);
    }

    public function industries()
    {
        return view('pages.industries', [
            'seo' => SeoMeta::forPage('industries'),
            'industries' => Industry::active()->ordered()->get(),
        ]);
    }

    public function solutions()
    {
        return view('pages.solutions', [
            'seo' => SeoMeta::forPage('solutions'),
            'solutions' => Solution::active()->ordered()->get(),
            'flagship' => Solution::active()->where('is_flagship', true)->first(),
        ]);
    }

    public function portfolio()
    {
        return view('pages.portfolio', [
            'seo' => SeoMeta::forPage('portfolio'),
            'portfolios' => Portfolio::active()->orderBy('sort_order')->get(),
        ]);
    }

    public function caseStudies()
    {
        return view('pages.case-studies', [
            'seo' => SeoMeta::forPage('case-studies'),
            'caseStudies' => CaseStudy::published()->orderByDesc('published_at')->get(),
        ]);
    }

    public function caseStudyShow(string $slug)
    {
        $caseStudy = CaseStudy::published()->where('slug', $slug)->firstOrFail();

        return view('pages.case-study-show', compact('caseStudy'));
    }

    public function blog()
    {
        return view('pages.blog', [
            'seo' => SeoMeta::forPage('blog'),
            'posts' => Blog::published()->paginate(9),
        ]);
    }

    public function blogShow(string $slug)
    {
        $post = Blog::published()->where('slug', $slug)->firstOrFail();

        return view('pages.blog-show', compact('post'));
    }

    public function contact()
    {
        return view('pages.contact', [
            'seo' => SeoMeta::forPage('contact'),
        ]);
    }
}
