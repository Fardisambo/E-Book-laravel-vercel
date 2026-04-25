<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the books.
     */
    public function index(Request $request)
    {
        $query = Book::where('is_published', true);

        // Filter by category if provided
        if ($request->has('category') && $request->category) {
            $query->whereHas('categories', function($q) use ($request) {
                $q->where('categories.id', $request->category);
            });
        }

        $books = $query->orderBy('created_at', 'desc')->paginate(12);

        // Get books for banners
        $newBooks = Book::where('is_published', true)
            ->where('created_at', '>=', now()->subWeek())
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();

        $popularBooks = Book::where('is_published', true)
            ->orderBy('views', 'desc')
            ->orderBy('downloads', 'desc')
            ->take(8)
            ->get();

        $categories = Category::orderBy('name')->get();

        return view('welcome', compact('books', 'newBooks', 'popularBooks', 'categories'));
    }

    /**
     * Display the specified book.
     */
    public function show($id)
    {
        $book = Book::with(['categories', 'reviews.user'])
            ->where('is_published', true)
            ->findOrFail($id);

        // Increment views
        $book->increment('views');

        return view('books.show', compact('book'));
    }

    /**
     * Search books for users.
     */
    public function search(Request $request)
    {
        $q = $request->get('q');

        $query = Book::where('is_published', true);

        if ($q) {
            $query->where(function ($sub) use ($q) {
                $sub->where('title', 'like', "%{$q}%")
                    ->orWhere('author', 'like', "%{$q}%")
                    ->orWhere('description', 'like', "%{$q}%")
                        ->orWhere('isbn', 'like', "%{$q}%")
                    ->orWhereHas('categories', function ($c) use ($q) {
                        $c->where('name', 'like', "%{$q}%");
                    });
            });
        }

        $books = $query->orderBy('created_at', 'desc')
            ->paginate(12)
            ->appends(['q' => $q]);

        return view('search', compact('books', 'q'));
    }

    /**
     * Browse all books with filters.
     */
    public function browse(Request $request)
    {
        $query = Book::where('is_published', true);

        // Filter by category
        if ($request->has('category') && $request->category) {
            $query->whereHas('categories', function($q) use ($request) {
                $q->where('categories.id', $request->category);
            });
        }

        // Filter by price type (free, paid)
        if ($request->has('price_type') && $request->price_type) {
            if ($request->price_type === 'free') {
                $query->where(function($q) {
                    $q->where('price', 0)->orWhereNull('price');
                });
            } elseif ($request->price_type === 'paid') {
                $query->where('price', '>', 0);
            }
        }

        // Filter by price range
        if ($request->has('price_min') && $request->price_min) {
            $query->where('price', '>=', $request->price_min);
        }
        if ($request->has('price_max') && $request->price_max) {
            $query->where('price', '<=', $request->price_max);
        }

        // Filter by publisher
        if ($request->has('publisher') && $request->publisher) {
            $query->where('publisher', 'like', "%{$request->publisher}%");
        }

        // Filter by page count
        if ($request->has('min_pages') && $request->min_pages) {
            $query->where('total_pages', '>=', $request->min_pages);
        }
        if ($request->has('max_pages') && $request->max_pages) {
            $query->where('total_pages', '<=', $request->max_pages);
        }

        // Filter by free pages (preview pages)
        if ($request->has('has_preview') && $request->has_preview) {
            $query->where('free_pages', '>', 0);
        }

        // Sort
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');

        if ($sortBy === 'views') {
            $query->orderBy('views', $sortOrder);
        } elseif ($sortBy === 'downloads') {
            $query->orderBy('downloads', $sortOrder);
        } elseif ($sortBy === 'title') {
            $query->orderBy('title', $sortOrder);
        } elseif ($sortBy === 'price') {
            $query->orderBy('price', $sortOrder);
        } else {
            $query->orderBy('created_at', $sortOrder);
        }

        $books = $query->paginate(12)->appends($request->query());

        // Get data for filters
        $categories = Category::orderBy('name')->get();
        $publishers = Book::where('is_published', true)
            ->whereNotNull('publisher')
            ->distinct()
            ->pluck('publisher')
            ->sort();

        return view('browse', compact('books', 'categories', 'publishers'));
    }
}
