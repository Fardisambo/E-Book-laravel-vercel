<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class Borrow extends Model
{
    use HasFactory;

    public const STATUS_PENDING = 'pending';
    public const STATUS_APPROVED = 'approved';
    public const STATUS_REJECTED = 'rejected';
    public const STATUS_RETURNED = 'returned';
    public const STATUS_CANCELLED = 'cancelled';

    protected $fillable = [
        'user_id',
        'book_id',
        'status',
        'requested_at',
        'approved_at',
        'returned_at',
        'due_date',
        'borrow_days',
        'late_days',
        'late_fee',
        'notes',
        'admin_notes',
    ];

    protected $casts = [
        'requested_at' => 'datetime',
        'approved_at' => 'datetime',
        'returned_at' => 'datetime',
        'due_date' => 'date',
        'borrow_days' => 'integer',
        'late_days' => 'integer',
        'late_fee' => 'integer',
    ];

    public static function getStatuses(): array
    {
        return [
            self::STATUS_PENDING,
            self::STATUS_APPROVED,
            self::STATUS_REJECTED,
            self::STATUS_RETURNED,
            self::STATUS_CANCELLED,
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public function isActive(): bool
    {
        return $this->status === self::STATUS_PENDING || $this->status === self::STATUS_APPROVED;
    }

    public function getDailyPenaltyAttribute(): int
    {
        return config('borrow.daily_penalty', 5000);
    }

    public function getLateDaysAttribute($value): int
    {
        if ($value !== null) {
            return $value;
        }

        return $this->computeLateDays();
    }

    public function computeLateDays(): int
    {
        if (! $this->due_date) {
            return 0;
        }

        $reference = $this->returned_at ?? Carbon::now();
        return max(0, $reference->diffInDays($this->due_date));
    }

    public function getLateFeeAttribute($value): int
    {
        if ($value !== null) {
            return $value;
        }

        return $this->computeLateDays() * $this->daily_penalty;
    }

    public function getIsOverdueAttribute(): bool
    {
        return $this->due_date && Carbon::now()->isAfter($this->due_date) && $this->status !== self::STATUS_RETURNED;
    }
}
