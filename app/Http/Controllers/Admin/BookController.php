<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (!auth()->user()->isAdmin() && !auth()->user()->isAuthor()) {
                abort(403, 'Unauthorized');
            }
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::with('categories')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        return view('admin.books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.books.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
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
            'total_pages' => 'nullable|integer|min:1',
            'library_total_copies' => 'nullable|integer|min:0',
            'free_pages' => 'nullable|integer|min:0',
            'price' => 'nullable|numeric|min:0',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'file' => 'nullable|file|mimes:pdf,epub|max:10240',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
        ], [
            'file.mimes' => 'File harus berformat PDF atau EPUB',
            'file.max' => 'Ukuran file maksimal 10MB',
            'cover.mimes' => 'Cover harus berformat JPEG, PNG, JPG, atau GIF',
            'cover.max' => 'Ukuran cover maksimal 2MB',
            'isbn.unique' => 'ISBN sudah terdaftar',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['free_pages'] = $validated['free_pages'] ?? 10;
        $validated['price'] = $validated['price'] ?? 0;
        $validated['library_total_copies'] = $validated['library_total_copies'] ?? 0;
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_published'] = $request->has('is_published');
        $validated['user_id'] = auth()->id();

        try {
            // Handle cover upload
            if ($request->hasFile('cover')) {
                $validated['cover_url'] = $request->file('cover')->store('covers', 'public');
            }

            // Handle file upload
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $validated['file_path'] = $file->store('books', 'public');
                $validated['file_type'] = $file->getClientOriginalExtension();
                $validated['file_size'] = $file->getSize();
            }

            $book = Book::create($validated);

            // Attach categories
            if ($request->has('categories')) {
                $book->categories()->attach($request->categories);
            }

            return redirect()->route('admin.books.index')
                ->with('success', 'Buku berhasil ditambahkan.');
        } catch (\Exception $e) {
            \Log::error('Error uploading book: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat mengupload file. Silakan coba lagi.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::with(['categories', 'reviews'])->findOrFail($id);
        return view('admin.books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = Book::with('categories')->findOrFail($id);
        $categories = Category::orderBy('name')->get();
        return view('admin.books.edit', compact('book', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
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
            'library_total_copies' => 'nullable|integer|min:0',
            'free_pages' => 'nullable|integer|min:0',
            'price' => 'nullable|numeric|min:0',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'file' => 'nullable|file|mimes:pdf,epub|max:10240',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
        ], [
            'file.mimes' => 'File harus berformat PDF atau EPUB',
            'file.max' => 'Ukuran file maksimal 10MB',
            'cover.mimes' => 'Cover harus berformat JPEG, PNG, JPG, atau GIF',
            'cover.max' => 'Ukuran cover maksimal 2MB',
            'isbn.unique' => 'ISBN sudah terdaftar',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['library_total_copies'] = $validated['library_total_copies'] ?? 0;
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_published'] = $request->has('is_published');

        try {
            // Handle cover upload
            if ($request->hasFile('cover')) {
                if ($book->cover_url && Storage::disk('public')->exists($book->cover_url)) {
                    Storage::disk('public')->delete($book->cover_url);
                }
                $validated['cover_url'] = $request->file('cover')->store('covers', 'public');
            }

            // Handle file upload
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

            // Sync categories
            if ($request->has('categories')) {
                $book->categories()->sync($request->categories);
            } else {
                $book->categories()->detach();
            }

            return redirect()->route('admin.books.index')
                ->with('success', 'Buku berhasil diperbarui.');
        } catch (\Exception $e) {
            \Log::error('Error updating book: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat mengupload file. Silakan coba lagi.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);

        // Delete files
        if ($book->cover_url && Storage::disk('public')->exists($book->cover_url)) {
            Storage::disk('public')->delete($book->cover_url);
        }
        if ($book->file_path && Storage::disk('public')->exists($book->file_path)) {
            Storage::disk('public')->delete($book->file_path);
        }

        $book->delete();

        return redirect()->route('admin.books.index')
            ->with('success', 'Buku berhasil dihapus.');
    }
}
