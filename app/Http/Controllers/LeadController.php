<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:255',
            'type' => 'required|in:consultation,demo,project,contact',
            'subject' => 'nullable|string|max:255',
            'message' => 'nullable|string|max:5000',
        ]);

        $validated['source_page'] = $request->header('referer') ?? url()->previous();

        Lead::create($validated);

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Thank you! We will contact you shortly.']);
        }

        return back()->with('success', 'Thank you! We will contact you shortly.');
    }
}
