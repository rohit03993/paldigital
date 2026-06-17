<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'company', 'type',
        'subject', 'message', 'source_page', 'status', 'notes',
    ];

    public const TYPES = [
        'consultation' => 'Free Consultation',
        'demo' => 'Demo Request',
        'project' => 'Project Discussion',
        'contact' => 'General Contact',
    ];

    public const STATUSES = [
        'new' => 'New',
        'contacted' => 'Contacted',
        'qualified' => 'Qualified',
        'closed' => 'Closed',
    ];
}
