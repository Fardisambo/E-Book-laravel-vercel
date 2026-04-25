

<?php $__env->startSection('title', $book->title); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-6xl mx-auto px-4 py-8 space-y-6">
    <a href="<?php echo e(route('books.index')); ?>" class="inline-flex items-center gap-2 text-sm text-amber-300 hover:text-amber-200">
        <i data-lucide="arrow-left" class="w-4 h-4"></i>
        Kembali ke Koleksi Ebook
    </a>
    
    <div class="glass-panel rounded-3xl border border-white/10 p-6 sm:p-8">
        <div class="grid md:grid-cols-2 gap-8">
            <!-- Book Cover -->
            <div>
                <div class="relative">
                    <div class="absolute -inset-2 bg-gradient-to-br from-amber-500/20 to-amber-300/10 rounded-3xl blur-xl"></div>
                    <div class="relative rounded-2xl overflow-hidden border border-white/10">
                        <img 
                            src="<?php echo e($book->cover_url ? asset('storage/' . $book->cover_url) : 'https://placehold.co/400x600?text=No+Cover'); ?>" 
                            alt="Cover <?php echo e($book->title); ?>" 
                            class="w-full rounded-2xl object-cover"
                        />
                    </div>
                    <div class="absolute top-3 left-3 px-3 py-1 rounded-full bg-black/70 border border-white/10 text-[11px] text-amber-200 flex items-center gap-1">
                        <i data-lucide="eye" class="w-3 h-3"></i>
                        <?php echo e(number_format($book->views)); ?>x dilihat
                    </div>
                    <?php if(!$book->isFree()): ?>
                        <div class="absolute bottom-3 right-3 px-3 py-1 rounded-full bg-amber-500 text-[11px] text-black font-semibold">
                            Rp <?php echo e(number_format($book->price, 0, ',', '.')); ?>

                        </div>
                    <?php else: ?>
                        <div class="absolute bottom-3 right-3 px-3 py-1 rounded-full bg-emerald-500 text-[11px] text-black font-semibold">
                            Gratis
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Book Info -->
            <div class="space-y-5">
                <div>
                    <h1 class="font-serif text-2xl sm:text-3xl text-white mb-2"><?php echo e($book->title); ?></h1>
                    <p class="text-sm text-gray-400">
                        Oleh <span class="text-amber-200"><?php echo e($book->author); ?></span>
                    </p>
                </div>
                
                <div class="grid grid-cols-2 gap-4 text-xs text-gray-300">
                    <?php if($book->published_year): ?>
                    <div>
                        <p class="text-gray-500 mb-1">Tahun Terbit</p>
                        <p><?php echo e($book->published_year); ?></p>
                    </div>
                    <?php endif; ?>
                    
                    <?php if($book->publisher): ?>
                    <div>
                        <p class="text-gray-500 mb-1">Penerbit</p>
                        <p><?php echo e($book->publisher); ?></p>
                    </div>
                    <?php endif; ?>
                    
                    <?php if($book->total_pages): ?>
                    <div>
                        <p class="text-gray-500 mb-1">Jumlah Halaman</p>
                        <p><?php echo e($book->total_pages); ?> halaman</p>
                    </div>
                    <?php endif; ?>

                    <?php if($book->free_pages): ?>
                    <div>
                        <p class="text-gray-500 mb-1">Halaman Gratis</p>
                        <p><?php echo e($book->free_pages); ?> halaman pertama</p>
                    </div>
                    <?php endif; ?>

                    <?php if($book->categories->count() > 0): ?>
                    <div class="col-span-2">
                        <p class="text-gray-500 mb-1">Kategori</p>
                        <p class="text-xs">
                            <?php echo e($book->categories->pluck('name')->join(', ')); ?>

                        </p>
                    </div>
                    <?php endif; ?>
                </div>

                <div>
                    <p class="text-xs text-gray-500 mb-1">Harga</p>
                    <?php if($book->isFree()): ?>
                        <p class="text-lg font-semibold text-emerald-300">Gratis</p>
                    <?php else: ?>
                        <p class="text-lg font-semibold text-amber-300">Rp <?php echo e(number_format($book->price, 0, ',', '.')); ?></p>
                    <?php endif; ?>
                </div>

                <div class="grid grid-cols-2 gap-4 text-sm text-gray-300 mb-4">
                    <div>
                        <p class="text-gray-500 mb-1">Stok Perpustakaan</p>
                        <p><?php echo e($book->library_total_copies); ?> buku</p>
                    </div>
                    <div>
                        <p class="text-gray-500 mb-1">Tersedia</p>
                        <p><?php echo e($book->library_available_copies); ?> buku</p>
                    </div>
                </div>

                <?php if(auth()->guard()->check()): ?>
                    <div class="mb-4">
                        <?php if($book->library_available_copies > 0): ?>
                            <form action="<?php echo e(route('books.borrow', $book->id)); ?>" method="POST" class="grid gap-3 sm:grid-cols-[160px_1fr] items-end">
                                <?php echo csrf_field(); ?>
                                <div>
                                    <label for="duration" class="block text-sm font-medium text-gray-300 mb-2">Lama Pinjam</label>
                                    <select id="duration" name="duration" class="w-full rounded-3xl bg-slate-900/80 border border-white/10 px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-amber-400">
                                        <?php $__currentLoopData = [3, 7, 14, 21, 30]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $days): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($days); ?>" <?php echo e(old('duration') == $days ? 'selected' : ($days === 7 ? 'selected' : '')); ?>><?php echo e($days); ?> hari</option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['duration'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="mt-2 text-xs text-red-400"><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <button type="submit" class="w-full px-5 py-3 rounded-full bg-violet-600/90 text-white text-sm font-medium hover:bg-violet-500 transition-colors">
                                    Pinjam Buku Fisik dari Perpustakaan
                                </button>
                            </form>
                            <p class="mt-3 text-xs text-gray-400">Denda keterlambatan Rp <?php echo e(number_format(config('borrow.daily_penalty', 5000), 0, ',', '.')); ?>/hari setelah tanggal kembali.</p>
                        <?php else: ?>
                            <button disabled class="px-5 py-2.5 rounded-full bg-gray-500/70 text-white text-sm font-medium cursor-not-allowed">
                                Buku Fisik Tidak Tersedia
                            </button>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <?php if($book->description): ?>
                <div>
                    <h2 class="font-serif text-lg text-white mb-1">Deskripsi</h2>
                    <p class="text-sm text-gray-300 leading-relaxed"><?php echo e($book->description); ?></p>
                </div>
                <?php endif; ?>

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
                    <?php if(auth()->guard()->check()): ?>
                        <?php if($book->file_path || $book->file_url): ?>
                            <a href="<?php echo e(route('books.read', $book->id)); ?>" 
                               class="px-5 py-2.5 rounded-full bg-gradient-to-r from-amber-600 to-amber-500 text-black text-sm font-medium hover:shadow-lg hover:shadow-amber-500/25 transition-all">
                                Baca Ebook
                            </a>
                            
                            

                            <!-- Favorite Button -->
                            <button onclick="toggleFavorite(event, <?php echo e($book->id); ?>)" 
                                    class="favorite-btn px-5 py-2.5 rounded-full text-white text-sm font-medium transition-colors flex items-center gap-2
                                    <?php echo e(auth()->user()->hasFavorited($book->id) ? 'bg-red-600 hover:bg-red-500' : 'bg-white/10 hover:bg-white/20'); ?>">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                                </svg>
                                <span class="favorite-text">
                                    <?php echo e(auth()->user()->hasFavorited($book->id) ? 'Hapus dari Favorit' : 'Tambah ke Favorit'); ?>

                                </span>
                            </button>
                        <?php else: ?>
                            <button disabled class="px-5 py-2.5 rounded-full bg-gray-500/70 text-white text-sm font-medium cursor-not-allowed">
                                File Tidak Tersedia
                            </button>
                        <?php endif; ?>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>" 
                           class="px-5 py-2.5 rounded-full bg-gradient-to-r from-amber-600 to-amber-500 text-black text-sm font-medium hover:shadow-lg hover:shadow-amber-500/25 transition-all">
                            Login untuk Membaca
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Reviews Section -->
    <?php if($book->reviews->where('is_approved', true)->count() > 0): ?>
    <div class="glass-panel mt-6 rounded-3xl border border-white/10 p-6 sm:p-8">
        <h2 class="font-serif text-xl text-white mb-4">Ulasan Pembaca</h2>
        <div class="space-y-4">
            <?php $__currentLoopData = $book->reviews->where('is_approved', true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="border-b border-white/5 pb-4 last:border-b-0">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm font-medium text-white"><?php echo e($review->user->name); ?></span>
                    <div class="flex items-center gap-0.5">
                        <?php for($i = 1; $i <= 5; $i++): ?>
                            <?php if($i <= $review->rating): ?>
                                <span class="text-amber-300 text-xs">★</span>
                            <?php else: ?>
                                <span class="text-gray-600 text-xs">★</span>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </div>
                </div>
                <?php if($review->comment): ?>
                <p class="text-sm text-gray-300"><?php echo e($review->comment); ?></p>
                <?php endif; ?>
                <p class="text-[11px] text-gray-500 mt-1"><?php echo e($review->created_at->format('d M Y')); ?></p>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <?php endif; ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\laravel\laravel_ebook\resources\views/books/show.blade.php ENDPATH**/ ?>