<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use App\Models\AuthorPaymentMethod;

class Payment extends Model
{
    protected $fillable = [
        'user_id',
        'paymentable_type',
        'paymentable_id',
        'amount',
        'method',
        'payment_method_id',
        'author_payment_method_id',
        'qr_code',
        'transfer_proof',
        'transaction_id',
        'status',
        'notes',
        'paid_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'paid_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function paymentable(): MorphTo
    {
        return $this->morphTo();
    }

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function authorPaymentMethod(): BelongsTo
    {
        return $this->belongsTo(AuthorPaymentMethod::class);
    }

    public function getSelectedPaymentMethodAttribute()
    {
        return $this->paymentMethod ?? $this->authorPaymentMethod;
    }
}
