

<?php $__env->startSection('title', 'Hasil Pencarian'); ?>

<?php $__env->startSection('content'); ?>
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <h2 class="font-serif text-2xl text-white">Hasil Pencarian</h2>
            <p class="text-sm text-gray-400">Menampilkan hasil untuk: <span class="text-amber-200 font-medium"><?php echo e($q ?? '-'); ?></span></p>
        </div>

        <section class="grid gap-5 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            <?php $__empty_1 = true; $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="book-card glass-panel rounded-2xl border border-white/5 overflow-hidden cursor-pointer">
                    <a href="<?php echo e(route('books.show', $book->id)); ?>">
                        <div class="relative h-52 sm:h-60 overflow-hidden">
                            <img
                                src="<?php echo e($book->cover_url ? asset('storage/' . $book->cover_url) : 'https://placehold.co/400x225?text=No+Cover'); ?>"
                                alt="Cover <?php echo e($book->title); ?>"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                            >
                            <?php if(!$book->isFree()): ?>
                                <div class="absolute top-3 left-3 px-2 py-1 rounded-full bg-black/70 border border-white/10 text-[11px] text-amber-200">
                                    Rp <?php echo e(number_format($book->price, 0, ',', '.')); ?>

                                </div>
                            <?php else: ?>
                                <div class="absolute top-3 left-3 px-2 py-1 rounded-full bg-emerald-500/80 text-[11px] text-black font-semibold">
                                    Gratis
                                </div>
                            <?php endif; ?>
                        </div>
                    </a>
                    <div class="p-4 space-y-2">
                        <h3 class="font-medium text-sm sm:text-base text-white line-clamp-2">
                            <a href="<?php echo e(route('books.show', $book->id)); ?>" class="hover:text-amber-300">
                                <?php echo e($book->title); ?>

                            </a>
                        </h3>
                        <p class="text-xs text-gray-400">
                            Oleh <?php echo e($book->author); ?>

                        </p>
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
                        <a href="<?php echo e(route('books.show', $book->id)); ?>"
                           class="mt-2 block w-full text-center px-3 py-2 rounded-full bg-white/5 text-xs text-gray-100 font-medium hover:bg-white/10 transition-colors">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-span-full glass-panel rounded-2xl p-10 text-center text-gray-400">
                    <p class="text-lg">Tidak ditemukan hasil untuk kata kunci Anda.</p>
                    <a href="<?php echo e(route('books.index')); ?>" class="text-amber-300 hover:text-amber-200 mt-4 inline-block text-sm">Kembali ke semua buku</a>
                </div>
            <?php endif; ?>
        </section>

        <div class="mt-6">
            <?php echo e($books->links()); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\laravel\laravel_ebook\resources\views/search.blade.php ENDPATH**/ ?>