

<?php $__env->startSection('title', 'Buku Favorit Saya'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="font-serif text-3xl text-white mb-2">Buku Favorit Saya</h1>
            <p class="text-gray-400">
                Anda memiliki <span class="text-amber-400 font-semibold"><?php echo e($favorites->total()); ?></span> buku favorit
            </p>
        </div>
        <a href="<?php echo e(route('books.browse')); ?>" class="px-4 py-2 bg-amber-600 hover:bg-amber-500 text-black text-sm font-medium rounded-lg transition-colors">
            Jelajahi Lebih Banyak
        </a>
    </div>

    <!-- Favorites Grid -->
    <div class="grid gap-5 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
        <?php $__empty_1 = true; $__currentLoopData = $favorites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="book-card glass-panel rounded-2xl border border-white/5 overflow-hidden hover:border-amber-500/30 transition-all duration-300">
                <!-- Book Cover -->
                <a href="<?php echo e(route('books.show', $book->id)); ?>" class="relative h-52 sm:h-60 overflow-hidden block group">
                    <img
                        src="<?php echo e($book->cover_url ? asset('storage/' . $book->cover_url) : 'https://placehold.co/400x225?text=No+Cover'); ?>"
                        alt="Cover <?php echo e($book->title); ?>"
                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                    >
                    
                    <!-- Price Badge -->
                    <?php if(!$book->isFree()): ?>
                        <div class="absolute top-3 left-3 px-2 py-1 rounded-full bg-black/70 border border-white/10 text-[11px] text-amber-200">
                            Rp <?php echo e(number_format($book->price, 0, ',', '.')); ?>

                        </div>
                    <?php else: ?>
                        <div class="absolute top-3 left-3 px-2 py-1 rounded-full bg-emerald-500/80 text-[11px] text-black font-semibold">
                            Gratis
                        </div>
                    <?php endif; ?>
                    
                    <!-- Preview Badge -->
                    <?php if($book->free_pages > 0): ?>
                        <div class="absolute bottom-3 right-3 px-2 py-1 rounded-full bg-blue-500/80 text-[11px] text-white font-semibold">
                            Preview
                        </div>
                    <?php endif; ?>

                    <!-- Favorite Button Overlay -->
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition-colors duration-300 flex items-center justify-center">
                        <button class="favorite-btn opacity-0 group-hover:opacity-100 transition-opacity duration-300 p-3 rounded-full bg-red-500 hover:bg-red-600 text-white" 
                            data-book-id="<?php echo e($book->id); ?>"
                            data-is-favorited="true"
                            onclick="toggleFavorite(event)">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                            </svg>
                        </button>
                    </div>
                </a>

                <!-- Book Info -->
                <div class="p-4 space-y-2">
                    <!-- Title -->
                    <h3 class="font-medium text-sm sm:text-base text-white line-clamp-2">
                        <a href="<?php echo e(route('books.show', $book->id)); ?>" class="hover:text-amber-300 transition-colors">
                            <?php echo e($book->title); ?>

                        </a>
                    </h3>

                    <!-- Author -->
                    <p class="text-xs text-gray-400">
                        Oleh <?php echo e($book->author); ?>

                    </p>

                    <!-- Publisher -->
                    <?php if($book->publisher): ?>
                        <p class="text-xs text-gray-500">
                            <?php echo e($book->publisher); ?>

                        </p>
                    <?php endif; ?>

                    <!-- Stats -->
                    <div class="flex items-center justify-between text-[11px] text-gray-500">
                        <span class="flex items-center gap-1">
                            <i data-lucide="eye" class="w-3 h-3"></i>
                            <?php echo e(number_format($book->views)); ?>

                        </span>
                        <span class="flex items-center gap-1">
                            <i data-lucide="download" class="w-3 h-3"></i>
                            <?php echo e(number_format($book->downloads)); ?>

                        </span>
                    </div>

                    <!-- Pages -->
                    <?php if($book->total_pages): ?>
                        <p class="text-xs text-gray-500">
                            <?php echo e($book->total_pages); ?> halaman
                        </p>
                    <?php endif; ?>

                    <!-- Rating -->
                    <div class="flex items-center gap-1">
                        <div class="flex items-center gap-0.5">
                            <?php
                                $rating = $book->average_rating;
                                $fullStars = floor($rating);
                                $hasHalfStar = ($rating - $fullStars) >= 0.5;
                            ?>
                            <?php for($i = 0; $i < 5; $i++): ?>
                                <?php if($i < $fullStars): ?>
                                    <i data-lucide="star" class="w-3 h-3 fill-amber-400 text-amber-400"></i>
                                <?php elseif($i == $fullStars && $hasHalfStar): ?>
                                    <i data-lucide="star-half-2" class="w-3 h-3 fill-amber-400 text-amber-400"></i>
                                <?php else: ?>
                                    <i data-lucide="star" class="w-3 h-3 text-gray-600"></i>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </div>
                        <span class="text-[10px] text-gray-500">
                            <?php echo e(round($book->average_rating, 1)); ?>

                        </span>
                    </div>

                    <!-- Detail Button -->
                    <a href="<?php echo e(route('books.show', $book->id)); ?>"
                       class="mt-2 block w-full text-center px-3 py-2 rounded-full bg-white/5 text-xs text-gray-100 font-medium hover:bg-white/10 transition-colors">
                        Lihat Detail
                    </a>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <!-- Empty State -->
            <div class="col-span-full">
                <div class="glass-panel rounded-2xl p-12 text-center border border-white/5">
                    <i data-lucide="heart" class="w-16 h-16 mx-auto mb-4 text-gray-600"></i>
                    <h2 class="text-xl font-serif text-white mb-2">Belum Ada Buku Favorit</h2>
                    <p class="text-gray-400 mb-6">
                        Tambahkan buku favorit Anda dengan mengklik tombol hati pada setiap buku.
                    </p>
                    <a href="<?php echo e(route('books.browse')); ?>"
                       class="inline-block px-6 py-3 bg-amber-600 hover:bg-amber-500 text-black font-medium rounded-lg transition-colors">
                        Mulai Jelajahi Buku
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Pagination -->
    <?php if($favorites->hasPages()): ?>
        <div class="mt-8">
            <?php echo e($favorites->links()); ?>

        </div>
    <?php endif; ?>
</div>

<!-- Favorite Toggle Script -->
<script>
    function toggleFavorite(event) {
        event.preventDefault();
        event.stopPropagation();

        const btn = event.currentTarget;
        const bookId = btn.dataset.bookId;
        const isFavorited = btn.dataset.isFavorited === 'true';

        // Determine which route to use
        const route = isFavorited ? '/books/' + bookId + '/remove-favorite' : '/books/' + bookId + '/add-favorite';

        // Make request
        fetch(route, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update button state
                btn.dataset.isFavorited = data.is_favorited;
                
                // Update UI
                if (data.is_favorited) {
                    btn.classList.remove('bg-white/20');
                    btn.classList.add('bg-red-500', 'hover:bg-red-600');
                } else {
                    btn.classList.remove('bg-red-500', 'hover:bg-red-600');
                    btn.classList.add('bg-white/20');
                    
                    // Remove card from favorites page after a short delay
                    setTimeout(() => {
                        btn.closest('.book-card').style.opacity = '0';
                        btn.closest('.book-card').style.transform = 'scale(0.95)';
                        setTimeout(() => {
                            btn.closest('.book-card').remove();
                            
                            // Check if no books left
                            const grid = document.querySelector('.grid');
                            if (grid.children.length === 0) {
                                location.reload();
                            }
                        }, 300);
                    }, 200);
                }
                
                // Show notification
                showNotification(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('Terjadi kesalahan', 'error');
        });
    }

    function showNotification(message, type = 'success') {
        // Create notification element
        const notif = document.createElement('div');
        notif.className = 'fixed top-4 right-4 px-4 py-3 rounded-lg text-white font-medium z-50 animate-fade-in-down';
        notif.textContent = message;
        
        if (type === 'success') {
            notif.classList.add('bg-emerald-500');
        } else {
            notif.classList.add('bg-red-500');
        }
        
        document.body.appendChild(notif);
        
        setTimeout(() => {
            notif.remove();
        }, 3000);
    }
</script>

<style>
    @keyframes fade-in-down {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fade-out {
        from {
            opacity: 1;
            transform: translateY(0);
        }
        to {
            opacity: 0;
            transform: translateY(-20px);
        }
    }

    .animate-fade-in-down {
        animation: fade-in-down 0.3s ease-out;
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\laravel\laravel_ebook\resources\views/favorites/index.blade.php ENDPATH**/ ?>