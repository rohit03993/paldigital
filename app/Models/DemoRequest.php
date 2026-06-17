<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DemoRequest extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'company', 'industry', 'product',
        'preferred_date', 'preferred_time', 'message', 'status',
        'demo_scheduled_at', 'admin_notes', 'source',
    ];

    protected $casts = [
        'preferred_date' => 'date',
        'demo_scheduled_at' => 'datetime',
    ];

    public const PRODUCTS = [
        'education-erp' => 'Education ERP & Admission CRM',
        'custom-software' => 'Custom Software Development',
        'crm' => 'CRM Solution',
        'mobile-app' => 'Mobile Application',
        'other' => 'Other / Not Sure',
    ];

    public const STATUSES = [
        'new' => 'New Request',
        'contacted' => 'Contacted',
        'demo_scheduled' => 'Demo Scheduled',
        'demo_completed' => 'Demo Completed',
        'converted' => 'Converted to Client',
        'closed' => 'Closed',
    ];

    public const TIME_SLOTS = [
        'morning' => 'Morning (9 AM – 12 PM)',
        'afternoon' => 'Afternoon (12 PM – 4 PM)',
        'evening' => 'Evening (4 PM – 7 PM)',
    ];
}
