<?php

namespace App\Http\Controllers;

use App\Models\DemoRequest;
use Illuminate\Http\Request;

class DemoRequestController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'company' => 'nullable|string|max:255',
            'industry' => 'nullable|string|max:255',
            'product' => 'required|in:' . implode(',', array_keys(DemoRequest::PRODUCTS)),
            'preferred_date' => 'nullable|date|after_or_equal:today',
            'preferred_time' => 'nullable|in:' . implode(',', array_keys(DemoRequest::TIME_SLOTS)),
            'message' => 'nullable|string|max:2000',
        ]);

        $validated['source'] = $request->header('referer') ? 'website' : 'direct';

        DemoRequest::create($validated);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Demo request received! Our team will contact you within 24 hours.',
            ]);
        }

        return back()->with('demo_success', 'Demo request received! We will contact you shortly to schedule your session.');
    }
}
