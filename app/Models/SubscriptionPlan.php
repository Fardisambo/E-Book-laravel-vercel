<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionPlan extends Model
{
    protected $fillable = [
        'plan',
        'price',
        'description',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];
}

