<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuoteRequest extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'company',
        'website_url',
        'services',
        'budget_range',
        'message',
        'status',
    ];

    protected $casts = [
        'services' => 'array',
    ];
}
