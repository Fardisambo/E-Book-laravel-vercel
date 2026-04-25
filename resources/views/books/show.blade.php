@extends('layouts.app')

@section('title', $book->title)

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8 space-y-6">
    <a href="{{ route('books.index') }}" class="inline-flex items-center gap-2 text-sm text-amber-300 hover:text-amber-200">
        <i data-lucide="arrow-left" class="w-4 h-4"></i>
        Kembali ke Koleksi Ebook
    </a>
    
    <div class="ui-card rounded-3xl  p-6 sm:p-8">
        <div class="grid md:grid-cols-2 gap-8">
            <!-- Book Cover -->
            <div>
                <div class="relative">
                    <div class="absolute -inset-2 bg-gradient-to-br from-amber-500/20 to-amber-300/10 rounded-3xl blur-xl"></div>
                    <div class="relative rounded-2xl overflow-hidden ">
                        <img 
                            src="{{ $book->cover_url ? asset('storage/' . $book->cover_url) : 'https://placehold.co/400x600?text=No+Cover' }}" 
                            alt="Cover {{ $book->title }}" 
                            class="w-full rounded-2xl object-cover"
                        />
                    </div>
                    <div class="absolute top-3 left-3 px-3 py-1 rounded-full bg-black/70  text-[11px] text-amber-200 flex items-center gap-1">
                        <i data-lucide="eye" class="w-3 h-3"></i>
                        {{ number_format($book->views) }}x dilihat
                    </div>
                    @if(!$book->isFree())
                        <div class="absolute bottom-3 right-3 px-3 py-1 rounded-full bg-amber-500 text-[11px] text-black font-semibold">
                            Rp {{ number_format($book->price, 0, ',', '.') }}
                        </div>
                    @else
                        <div class="absolute bottom-3 right-3 px-3 py-1 rounded-full bg-emerald-500 text-[11px] text-black font-semibold">
                            Gratis
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Book Info -->
            <div class="space-y-5">
                <div>
                    <h1 class="font-serif text-2xl sm:text-3xl text-white mb-2">{{ $book->title }}</h1>
                    <p class="text-sm text-gray-400">
                        Oleh <span class="text-amber-200">{{ $book->author }}</span>
                    </p>
                </div>
                
                <div class="grid grid-cols-2 gap-4 text-xs text-gray-300">
                    @if($book->published_year)
                    <div>
                        <p class="text-gray-500 mb-1">Tahun Terbit</p>
                        <p>{{ $book->published_year }}</p>
                    </div>
                    @endif
                    
                    @if($book->publisher)
                    <div>
                        <p class="text-gray-500 mb-1">Penerbit</p>
                        <p>{{ $book->publisher }}</p>
                    </div>
                    @endif
                    
                    @if($book->total_pages)
                    <div>
                        <p class="text-gray-500 mb-1">Jumlah Halaman</p>
                        <p>{{ $book->total_pages }} halaman</p>
                    </div>
                    @endif

                    @if($book->free_pages)
                    <div>
                        <p class="text-gray-500 mb-1">Halaman Gratis</p>
                        <p>{{ $book->free_pages }} halaman pertama</p>
                    </div>
                    @endif

                    @if($book->categories->count() > 0)
                    <div class="col-span-2">
                        <p class="text-gray-500 mb-1">Kategori</p>
                        <p class="text-xs">
                            {{ $book->categories->pluck('name')->join(', ') }}
                        </p>
                    </div>
                    @endif
                </div>

                <div>
                    <p class="text-xs text-gray-500 mb-1">Harga</p>
                    @if($book->isFree())
                        <p class="text-lg font-semibold text-emerald-300">Gratis</p>
                    @else
                        <p class="text-lg font-semibold text-amber-300">Rp {{ number_format($book->price, 0, ',', '.') }}</p>
                    @endif
                </div>

                <div class="grid grid-cols-2 gap-4 text-sm text-gray-300 mb-4">
                    <div>
                        <p class="text-gray-500 mb-1">Stok Perpustakaan</p>
                        <p>{{ $book->library_total_copies }} buku</p>
                    </div>
                    <div>
                        <p class="text-gray-500 mb-1">Tersedia</p>
                        <p>{{ $book->library_available_copies }} buku</p>
                    </div>
                </div>

                @auth
                    <div class="mb-4">
                        @if($book->library_available_copies > 0)
                            <form action="{{ route('books.borrow', $book->id) }}" method="POST" class="grid gap-3 sm:grid-cols-[160px_1fr] items-end">
                                @csrf
                                <div>
                                    <label for="duration" class="block text-sm font-medium text-gray-300 mb-2">Lama Pinjam</label>
                                    <select id="duration" name="duration" class="w-full rounded-3xl bg-slate-900/80  px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-amber-400">
                                        @foreach([3, 7, 14, 21, 30] as $days)
                                            <option value="{{ $days }}" {{ old('duration') == $days ? 'selected' : ($days === 7 ? 'selected' : '') }}>{{ $days }} hari</option>
                                        @endforeach
                                    </select>
                                    @error('duration')
                                        <p class="mt-2 text-xs text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                                <button type="submit" class="w-full px-5 py-3 rounded-full bg-violet-600/90 text-white text-sm font-medium hover:bg-violet-500 transition-colors">
                                    Pinjam Buku Fisik dari Perpustakaan
                                </button>
                            </form>
                            <p class="mt-3 text-xs text-gray-400">Denda keterlambatan Rp {{ number_format(config('borrow.daily_penalty', 5000), 0, ',', '.') }}/hari setelah tanggal kembali.</p>
                        @else
                            <button disabled class="px-5 py-2.5 rounded-full bg-gray-500/70 text-white text-sm font-medium cursor-not-allowed">
                                Buku Fisik Tidak Tersedia
                            </button>
                        @endif
                    </div>
                @endauth

                @if($book->description)
                <div>
                    <h2 class="font-serif text-lg text-white mb-1">Deskripsi</h2>
                    <p class="text-sm text-gray-300 leading-relaxed">{{ $book->description }}</p>
                </div>
                @endif

                <!-- Copyright Protection Notice -->
                <div class="bg-blue-50/10 border border-blue-500/30 rounded-lg p-3 my-4">
                    <div class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-blue-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 1C6.48 1 2 5.48 2 11s4.48 10 10 10 10-4.48 10-10S17.52 1 12 1zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm3.5-9c.83 0 1.5-.67 1.5-1.5S16.33 7 15.5 7 14 7.67 14 8.5s.67 1.5 1.5 1.5zm-7 0c.83 0 1.5-.67 1.5-1.5S9.33 7 8.5 7 7 7.67 7 8.5 7.67 10 8.5 10zm3.5 6.5c2.33 0 4.31-1.46 5.11-3.5H6.89c.8 2.04 2.78 3.5 5.11 3.5z"/>
                        </svg>
                        <div class="text-sm text-blue-300">
                            <p class="font-semibold text-blue-200">📚 Konten Dilindungi Hak Cipta</p>
                            <p class="text-xs mt-1 text-blue-200/80">Karya penulis dilindungi. Baca dan nikmati buku di platform kami dengan aman. Download dan distribusi konten tanpa izin dilarang.</p>
                        </div>
                    </div>
                </div>
                
                <div class="flex flex-wrap gap-3 pt-1">
                    @auth
                        @if($book->file_path || $book->file_url)
                            <a href="{{ route('books.read', $book->id) }}" 
                               class="px-5 py-2.5 rounded-full bg-gradient-to-r from-amber-600 to-amber-500 text-black text-sm font-medium hover:shadow-lg hover:shadow-amber-500/25 transition-all">
                                Baca Ebook
                            </a>
                            
                            {{-- @if(auth()->user()->hasPurchasedBook($book->id) || $book->isFree())
                                <a href="{{ route('books.download', $book->id) }}" 
                                   class="px-5 py-2.5 rounded-full bg-emerald-600/90 text-white text-sm font-medium hover:bg-emerald-500 transition-colors">
                                    {{ $book->isFree() ? 'Download Gratis' : 'Download' }}
                                </a>
                            @else
                                <form action="{{ route('books.purchase', $book->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" 
                                            class="px-5 py-2.5 rounded-full bg-blue-600/90 text-white text-sm font-medium hover:bg-blue-500 transition-colors">
                                        Beli untuk Download (Rp {{ number_format($book->price, 0, ',', '.') }})
                                    </button>
                                </form>
                            @endif --}}

                            <!-- Favorite Button -->
                            <button onclick="toggleFavorite(event, {{ $book->id }})" 
                                    class="favorite-btn px-5 py-2.5 rounded-full text-white text-sm font-medium transition-colors flex items-center gap-2
                                    {{ auth()->user()->hasFavorited($book->id) ? 'bg-red-600 hover:bg-red-500' : 'bg-white/10 hover:bg-white/20' }}">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                                </svg>
                                <span class="favorite-text">
                                    {{ auth()->user()->hasFavorited($book->id) ? 'Hapus dari Favorit' : 'Tambah ke Favorit' }}
                                </span>
                            </button>
                        @else
                            <button disabled class="px-5 py-2.5 rounded-full bg-gray-500/70 text-white text-sm font-medium cursor-not-allowed">
                                File Tidak Tersedia
                            </button>
                        @endif
                    @else
                        <a href="{{ route('login') }}" 
                           class="px-5 py-2.5 rounded-full bg-gradient-to-r from-amber-600 to-amber-500 text-black text-sm font-medium hover:shadow-lg hover:shadow-amber-500/25 transition-all">
                            Login untuk Membaca
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
    
    <!-- Reviews Section -->
    @if($book->reviews->where('is_approved', true)->count() > 0)
    <div class="ui-card mt-6 rounded-3xl  p-6 sm:p-8">
        <h2 class="font-serif text-xl text-white mb-4">Ulasan Pembaca</h2>
        <div class="space-y-4">
            @foreach($book->reviews->where('is_approved', true) as $review)
            <div class="border-b border-white/5 pb-4 last:border-b-0">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm font-medium text-white">{{ $review->user->name }}</span>
                    <div class="flex items-center gap-0.5">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $review->rating)
                                <span class="text-amber-300 text-xs">★</span>
                            @else
                                <span class="text-gray-600 text-xs">★</span>
                            @endif
                        @endfor
                    </div>
                </div>
                @if($review->comment)
                <p class="text-sm text-gray-300">{{ $review->comment }}</p>
                @endif
                <p class="text-[11px] text-gray-500 mt-1">{{ $review->created_at->format('d M Y') }}</p>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>

<script>
    function toggleFavorite(event, bookId) {
        event.preventDefault();
        event.stopPropagation();

        const btn = event.currentTarget;
        const isFavorited = btn.classList.contains('bg-red-600');
        const route = isFavorited ? `/books/${bookId}/remove-favorite` : `/books/${bookId}/add-favorite`;

        // Get CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
        
        if (!csrfToken) {
            console.error('CSRF token not found');
            showNotification('Error: CSRF token tidak ditemukan', 'error');
            return;
        }

        fetch(route, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            },
            body: JSON.stringify({})
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // Update button state
                const favoriteBtn = document.querySelector('.favorite-btn');
                const favoriteText = document.querySelector('.favorite-text');

                if (data.is_favorited) {
                    favoriteBtn.classList.remove('bg-white/10', 'hover:bg-white/20');
                    favoriteBtn.classList.add('bg-red-600', 'hover:bg-red-500');
                    favoriteText.textContent = 'Hapus dari Favorit';
                } else {
                    favoriteBtn.classList.remove('bg-red-600', 'hover:bg-red-500');
                    favoriteBtn.classList.add('bg-white/10', 'hover:bg-white/20');
                    favoriteText.textContent = 'Tambah ke Favorit';
                }

                // Show notification
                showNotification(data.message, 'success');
            } else {
                showNotification(data.message || 'Terjadi kesalahan', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('Terjadi kesalahan: ' + error.message, 'error');
        });
    }

    function showNotification(message, type = 'success') {
        const notif = document.createElement('div');
        notif.className = 'fixed top-4 right-4 px-4 py-3 rounded-lg text-white font-medium z-50';
        notif.textContent = message;
        
        if (type === 'success') {
            notif.classList.add('bg-emerald-500');
        } else {
            notif.classList.add('bg-red-500');
        }
        
        notif.style.animation = 'slideInDown 0.3s ease-out';
        document.body.appendChild(notif);
        
        setTimeout(() => {
            notif.style.animation = 'slideOutUp 0.3s ease-in';
            setTimeout(() => notif.remove(), 300);
        }, 3000);
    }
</script>

<style>
    @keyframes slideInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideOutUp {
        from {
            opacity: 1;
            transform: translateY(0);
        }
        to {
            opacity: 0;
            transform: translateY(-20px);
        }
    }
</style>
@endsection
