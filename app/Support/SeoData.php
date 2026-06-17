<?php

namespace App\Support;

use App\Models\Blog;
use App\Models\CaseStudy;
use App\Models\SeoMeta;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SeoData
{
    public function __construct(
        public string $title,
        public string $description,
        public ?string $keywords,
        public string $canonical,
        public ?string $image,
        public string $type,
        public ?array $jsonLd = null,
        public bool $noindex = false,
        public ?string $imageAlt = null,
        public ?string $author = null,
    ) {}

    public static function resolve(Request $request, ?SeoMeta $seo = null, ?Blog $post = null, ?CaseStudy $caseStudy = null): self
    {
        $siteName = SiteSetting::get('site_name', 'Pal Digital');
        $baseUrl = rtrim(SiteSetting::get('site_url', config('app.url')), '/');
        $canonical = $baseUrl . $request->getPathInfo();
        $defaultDescription = SiteSetting::get('tagline', 'Custom Software, CRM & Automation Solutions for Every Industry');
        $defaultImage = SiteSetting::asset('seo_default_og_image') ?? SiteSetting::asset('site_logo');

        if ($post) {
            $title = trim(($post->meta_title ?: $post->title) . ' | ' . $siteName);
            $description = $post->meta_description ?: ($post->excerpt ?: strip_tags(substr($post->content, 0, 160)));
            $image = $post->imageUrl() ?? $defaultImage;
            $jsonLd = [
                '@context' => 'https://schema.org',
                '@type' => 'BlogPosting',
                'headline' => $post->title,
                'description' => $description,
                'image' => $image,
                'datePublished' => $post->published_at?->toIso8601String(),
                'author' => ['@type' => 'Organization', 'name' => $post->author ?: $siteName],
                'publisher' => self::organizationSchema($siteName, $defaultImage, $baseUrl),
            ];

            return new self($title, $description, null, $canonical, $image, 'article', $jsonLd);
        }

        if ($caseStudy) {
            $title = trim($caseStudy->title . ' | Case Study | ' . $siteName);
            $description = strip_tags(substr($caseStudy->content, 0, 160));
            $image = $caseStudy->imageUrl() ?? $defaultImage;
            $jsonLd = [
                '@context' => 'https://schema.org',
                '@type' => 'Article',
                'headline' => $caseStudy->title,
                'description' => $description,
                'image' => $image,
                'publisher' => self::organizationSchema($siteName, $defaultImage, $baseUrl),
            ];

            return new self($title, $description, null, $canonical, $image, 'article', $jsonLd);
        }

        $title = $seo?->title ?? $siteName;
        $description = $seo?->description ?? $defaultDescription;
        $keywords = $seo?->keywords;
        $image = ($seo?->og_image ? asset('storage/' . ltrim($seo->og_image, '/')) : null) ?? $defaultImage;
        $imageAlt = null;
        $type = 'website';

        if ($request->routeIs('about')) {
            return self::forAboutPage($seo, $baseUrl, $canonical, $siteName, $defaultImage);
        }

        $jsonLd = [
            '@context' => 'https://schema.org',
            '@graph' => [
                self::organizationSchema($siteName, $defaultImage, $baseUrl),
                [
                    '@type' => 'WebSite',
                    'name' => $siteName,
                    'url' => $baseUrl,
                    'description' => $description,
                    'publisher' => ['@id' => $baseUrl . '#organization'],
                ],
            ],
        ];

        if ($request->routeIs('home')) {
            $jsonLd['@graph'][] = [
                '@type' => 'WebPage',
                '@id' => $canonical . '#webpage',
                'url' => $canonical,
                'name' => $title,
                'description' => $description,
                'isPartOf' => ['@id' => $baseUrl . '#website'],
            ];
        }

        return new self($title, $description, $keywords, $canonical, $image, $type, $jsonLd, false, $imageAlt);
    }

    private static function forAboutPage(?SeoMeta $seo, string $baseUrl, string $canonical, string $siteName, ?string $defaultImage): self
    {
        $name = SiteSetting::get('about_ceo_name', 'Rohit Pal');
        $jobTitle = SiteSetting::get('about_ceo_title', 'Developer & CEO, Pal Digital');
        $education = SiteSetting::get('about_ceo_education', 'IIT Roorkee · Artificial Intelligence & Data Science');
        $founderPhoto = SiteSetting::asset('about_ceo_photo');
        $linkedin = SiteSetting::get('about_ceo_linkedin');

        $defaultDescription = "Meet {$name} — {$jobTitle}. {$education}. 8+ years delivering custom software, business automation, and AI-ready solutions through Pal Digital.";

        $title = $seo?->title ?? "{$name} | {$jobTitle} | IIT Roorkee";
        $description = $seo?->description ?? $defaultDescription;
        $keywords = $seo?->keywords ?? 'Rohit Pal, Pal Digital, IIT Roorkee, custom software developer, AI, automation, CEO';
        $image = ($seo?->og_image ? asset('storage/' . ltrim($seo->og_image, '/')) : null) ?? $founderPhoto ?? $defaultImage;
        $imageAlt = "{$name} — {$jobTitle}, {$education}";

        $personId = $canonical . '#person';
        $organizationId = $baseUrl . '#organization';

        $person = array_filter([
            '@type' => 'Person',
            '@id' => $personId,
            'name' => $name,
            'url' => $canonical,
            'image' => $founderPhoto ?? $image,
            'jobTitle' => $jobTitle,
            'description' => $description,
            'worksFor' => ['@id' => $organizationId],
            'alumniOf' => [
                '@type' => 'CollegeOrUniversity',
                'name' => 'Indian Institute of Technology Roorkee',
            ],
            'knowsAbout' => [
                'Custom Software Development',
                'Artificial Intelligence',
                'Data Science',
                'Business Process Automation',
                'ERP Systems',
                'CRM Development',
            ],
            'sameAs' => $linkedin ? [$linkedin] : null,
        ]);

        $jsonLd = [
            '@context' => 'https://schema.org',
            '@graph' => array_values(array_filter([
                self::organizationSchema($siteName, $defaultImage, $baseUrl),
                [
                    '@type' => 'WebSite',
                    '@id' => $baseUrl . '#website',
                    'name' => $siteName,
                    'url' => $baseUrl,
                    'publisher' => ['@id' => $organizationId],
                ],
                [
                    '@type' => 'ProfilePage',
                    '@id' => $canonical . '#profilepage',
                    'url' => $canonical,
                    'name' => "{$name} — About",
                    'description' => $description,
                    'inLanguage' => 'en-IN',
                    'isPartOf' => ['@id' => $baseUrl . '#website'],
                    'mainEntity' => ['@id' => $personId],
                ],
                $person,
            ])),
        ];

        return new self($title, $description, $keywords, $canonical, $image, 'profile', $jsonLd, false, $imageAlt, $name);
    }

    private static function organizationSchema(string $name, ?string $logo, string $baseUrl): array
    {
        return array_filter([
            '@type' => 'Organization',
            '@id' => $baseUrl . '#organization',
            'name' => $name,
            'url' => $baseUrl,
            'logo' => $logo,
            'email' => SiteSetting::get('contact_email'),
            'telephone' => SiteSetting::get('contact_phone'),
            'address' => SiteSetting::get('address') ? [
                '@type' => 'PostalAddress',
                'addressCountry' => SiteSetting::get('address'),
            ] : null,
        ]);
    }
}
