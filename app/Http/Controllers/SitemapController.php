<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\CaseStudy;
use App\Models\SiteSetting;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function __invoke(): Response
    {
        $baseUrl = rtrim(SiteSetting::get('site_url', config('app.url')), '/');

        $urls = [
            ['loc' => $baseUrl, 'priority' => '1.0', 'changefreq' => 'weekly'],
            ['loc' => $baseUrl . '/about', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['loc' => $baseUrl . '/services', 'priority' => '0.9', 'changefreq' => 'monthly'],
            ['loc' => $baseUrl . '/industries', 'priority' => '0.9', 'changefreq' => 'monthly'],
            ['loc' => $baseUrl . '/solutions', 'priority' => '0.9', 'changefreq' => 'monthly'],
            ['loc' => $baseUrl . '/portfolio', 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['loc' => $baseUrl . '/case-studies', 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['loc' => $baseUrl . '/blog', 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['loc' => $baseUrl . '/contact', 'priority' => '0.7', 'changefreq' => 'monthly'],
        ];

        foreach (CaseStudy::published()->orderByDesc('updated_at')->get() as $study) {
            $urls[] = [
                'loc' => $baseUrl . '/case-studies/' . $study->slug,
                'lastmod' => $study->updated_at?->toAtomString(),
                'priority' => '0.7',
                'changefreq' => 'monthly',
            ];
        }

        foreach (Blog::published()->orderByDesc('updated_at')->get() as $post) {
            $urls[] = [
                'loc' => $baseUrl . '/blog/' . $post->slug,
                'lastmod' => $post->updated_at?->toAtomString(),
                'priority' => '0.6',
                'changefreq' => 'monthly',
            ];
        }

        $xml = view('sitemap', compact('urls'))->render();

        return response($xml, 200, ['Content-Type' => 'application/xml; charset=UTF-8']);
    }
}
