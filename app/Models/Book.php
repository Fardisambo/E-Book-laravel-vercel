<?php

namespace App\Models;

use App\Models\Borrow;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'author',
        'description',
        'isbn',
        'published_year',
        'publisher',
        'language',
        'total_pages',
        'library_total_copies',
        'free_pages',
        'price',
        'cover_url',
        'file_url',
        'file_path',
        'file_type',
        'file_size',
        'is_featured',
        'is_published',
        'views',
        'downloads',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
        'published_year' => 'integer',
        'total_pages' => 'integer',
        'library_total_copies' => 'integer',
        'free_pages' => 'integer',
        'price' => 'decimal:2',
        'file_size' => 'integer',
        'views' => 'integer',
        'downloads' => 'integer',
    ];

    /**
     * Get the categories for the book.
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'book_category');
    }

    /**
     * Get the reading progress for the book.
     */
    public function readingProgress(): HasMany
    {
        return $this->hasMany(ReadingProgress::class);
    }

    /**
     * Get the bookmarks for the book.
     */
    public function bookmarks(): HasMany
    {
        return $this->hasMany(Bookmark::class);
    }

    /**
     * Get the reviews for the book.
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Get the average rating for the book.
     */
    public function getAverageRatingAttribute(): float
    {
        return $this->reviews()->where('is_approved', true)->avg('rating') ?? 0;
    }

    /**
     * Get the purchases for the book.
     */
    public function purchases(): HasMany
    {
        return $this->hasMany(Purchase::class);
    }

    /**
     * Get the borrow requests for the book.
     */
    public function borrows(): HasMany
    {
        return $this->hasMany(Borrow::class);
    }

    /**
     * Get the approved borrow requests for the book.
     */
    public function approvedBorrows(): HasMany
    {
        return $this->hasMany(Borrow::class)->where('status', Borrow::STATUS_APPROVED);
    }

    public function getLibraryBorrowedCopiesAttribute(): int
    {
        return $this->approvedBorrows()->count();
    }

    public function getLibraryAvailableCopiesAttribute(): int
    {
        return max(0, ($this->library_total_copies ?? 0) - $this->library_borrowed_copies);
    }

    public function getLibraryStatusAttribute(): string
    {
        return $this->library_available_copies > 0 ? 'available' : 'out_of_stock';
    }

    /**
     * Get the author/owner of the book.
     */
    public function authorUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Check whether this book is sold by a penulis author.
     */
    public function isAuthorOwned(): bool
    {
        return $this->authorUser && $this->authorUser->isAuthor();
    }

    /**
     * Cek apakah buku gratis (harga 0 atau null).
     */
    public function isFree(): bool
    {
        return (float) ($this->price ?? 0) <= 0;
    }

    /**
     * Get the users who favorited this book.
     */
    public function favoritedByUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }
}
