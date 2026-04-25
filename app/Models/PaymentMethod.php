<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PaymentMethod extends Model
{
    protected $fillable = [
        'name',
        'type',
        'description',
        'account_number',
        'account_holder',
        'icon_url',
        'fee_percentage',
        'fee_fixed',
        'is_active',
        'display_order',
    ];

    protected $casts = [
        'fee_percentage' => 'decimal:2',
        'fee_fixed' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    /**
     * Get payments using this payment method
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Calculate transaction fee
     */
    public function calculateFee($amount)
    {
        $percentageFee = ($amount * $this->fee_percentage) / 100;
        return $percentageFee + $this->fee_fixed;
    }

    /**
     * Get active payment methods
     */
    public static function active()
    {
        return static::where('is_active', true)->orderBy('display_order')->get();
    }
}
