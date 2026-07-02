<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\JsonResponse;

class ManifestController extends Controller
{
    public function __invoke(): JsonResponse
    {
        $name = SiteSetting::get('site_name', 'Pal Digital');
        $favicon = SiteSetting::asset('site_favicon');
        $logo = SiteSetting::asset('site_logo');
        $icon512 = $logo ?: $favicon;

        $icons = [];

        if ($favicon) {
            $icons[] = [
                'src' => $favicon,
                'sizes' => '192x192',
                'type' => 'image/png',
                'purpose' => 'any',
            ];
            $icons[] = [
                'src' => $favicon,
                'sizes' => '192x192',
                'type' => 'image/png',
                'purpose' => 'maskable',
            ];
        }

        if ($icon512) {
            $icons[] = [
                'src' => $icon512,
                'sizes' => '512x512',
                'type' => 'image/png',
                'purpose' => 'any',
            ];
            $icons[] = [
                'src' => $icon512,
                'sizes' => '512x512',
                'type' => 'image/png',
                'purpose' => 'maskable',
            ];
        }

        if ($icons === []) {
            $icons[] = [
                'src' => asset('favicon.ico'),
                'sizes' => '64x64',
                'type' => 'image/x-icon',
            ];
        }

        return response()->json([
            'name' => $name,
            'short_name' => $name,
            'description' => SiteSetting::get('tagline', 'Custom Software, CRM & Automation Solutions'),
            'start_url' => '/',
            'scope' => '/',
            'display' => 'standalone',
            'background_color' => '#050505',
            'theme_color' => '#050505',
            'orientation' => 'portrait-primary',
            'icons' => $icons,
        ], 200, [
            'Content-Type' => 'application/manifest+json; charset=UTF-8',
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }
}
