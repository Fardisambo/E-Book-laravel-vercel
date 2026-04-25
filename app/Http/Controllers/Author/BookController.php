<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('categories')
            ->latest()
            ->paginate(10);

        return view('author.books.index', compact('books'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('author.books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
            'isbn' => 'nullable|string|unique:books,isbn',
            'published_year' => 'nullable|integer|min:1000|max:' . date('Y'),
            'publisher' => 'nullable|string|max:255',
            'language' => 'nullable|string|max:10',
            'total_pages' => 'required|integer|min:1',
            'free_pages' => 'nullable|integer|min:0',
            'price' => 'required|numeric|min:0',
            'file' => 'required|file|mimes:pdf,epub|max:10240',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['slug'] = Str::slug($validated['title']);
        $validated['free_pages'] = $validated['free_pages'] ?? 10;
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_published'] = $request->has('is_published');

        if ($request->hasFile('cover')) {
            $validated['cover_url'] = $request->file('cover')->store('covers', 'public');
        }

        $file = $request->file('file');
        $validated['file_path'] = $file->store('books', 'public');
        $validated['file_type'] = $file->getClientOriginalExtension();
        $validated['file_size'] = $file->getSize();

        $book = Book::create($validated);

        if ($request->has('categories')) {
            $book->categories()->attach($request->categories);
        }

        return redirect()->route('author.books.index')->with('success', 'Buku berhasil diupload!');
    }

    public function edit(string $id)
    {
        $book = Book::with('categories')->findOrFail($id);
        $categories = Category::orderBy('name')->get();
        return view('author.books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, string $id)
    {
        $book = Book::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
            'isbn' => 'nullable|string|unique:books,isbn,' . $id,
            'published_year' => 'nullable|integer|min:1000|max:' . date('Y'),
            'publisher' => 'nullable|string|max:255',
            'language' => 'nullable|string|max:10',
            'total_pages' => 'nullable|integer|min:1',
            'free_pages' => 'nullable|integer|min:0',
            'price' => 'required|numeric|min:0',
            'file' => 'nullable|file|mimes:pdf,epub|max:10240',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_published'] = $request->has('is_published');

        if ($request->hasFile('cover')) {
            if ($book->cover_url && Storage::disk('public')->exists($book->cover_url)) {
                Storage::disk('public')->delete($book->cover_url);
            }
            $validated['cover_url'] = $request->file('cover')->store('covers', 'public');
        }

        if ($request->hasFile('file')) {
            if ($book->file_path && Storage::disk('public')->exists($book->file_path)) {
                Storage::disk('public')->delete($book->file_path);
            }
            $file = $request->file('file');
            $validated['file_path'] = $file->store('books', 'public');
            $validated['file_type'] = $file->getClientOriginalExtension();
            $validated['file_size'] = $file->getSize();
        }

        $book->update($validated);

        if ($request->has('categories')) {
            $book->categories()->sync($request->categories);
        } else {
            $book->categories()->detach();
        }

        return redirect()->route('author.books.index')->with('success', 'Buku berhasil diperbarui.');
    }
}
