

<?php $__env->startSection('title', 'Profil Saya'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto px-4 py-8 space-y-6">
    <div class="flex items-center justify-between gap-3">
        <div>
            <h1 class="font-serif text-2xl sm:text-3xl text-white flex items-center gap-2">
                <i data-lucide="user" class="w-6 h-6 text-amber-300"></i>
                Profil Saya
            </h1>
            <p class="text-xs sm:text-sm text-gray-400 mt-1">
                Kelola informasi akun dan detail pribadi Anda.
            </p>
        </div>
        <a href="<?php echo e(route('profile.edit')); ?>" class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/5 text-xs sm:text-sm text-gray-100 hover:bg-white/10 transition-colors">
            <i data-lucide="pencil" class="w-4 h-4"></i>
            Edit Profil
        </a>
    </div>

    <!-- Reading Statistics -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="ui-card rounded-2xl p-4">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-10 h-10 rounded-xl bg-emerald-500/10 flex items-center justify-center">
                    <i data-lucide="book-check" class="w-5 h-5 text-emerald-400"></i>
                </div>
            </div>
            <p class="text-2xl font-serif font-semibold text-white"><?php echo e($readingStats['totalBooksRead']); ?></p>
            <p class="text-xs text-gray-500 mt-1">Buku Selesai Dibaca</p>
        </div>

        <div class="ui-card rounded-2xl p-4">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-10 h-10 rounded-xl bg-amber-500/10 flex items-center justify-center">
                    <i data-lucide="book-open" class="w-5 h-5 text-amber-400"></i>
                </div>
            </div>
            <p class="text-2xl font-serif font-semibold text-white"><?php echo e($readingStats['currentlyReading']); ?></p>
            <p class="text-xs text-gray-500 mt-1">Sedang Dibaca</p>
        </div>

        <div class="ui-card rounded-2xl p-4">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-10 h-10 rounded-xl bg-purple-500/10 flex items-center justify-center">
                    <i data-lucide="shopping-bag" class="w-5 h-5 text-purple-400"></i>
                </div>
            </div>
            <p class="text-2xl font-serif font-semibold text-white"><?php echo e($readingStats['purchasedBooks']); ?></p>
            <p class="text-xs text-gray-500 mt-1">Buku Dibeli</p>
        </div>

        <div class="ui-card rounded-2xl p-4">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-10 h-10 rounded-xl bg-rose-500/10 flex items-center justify-center">
                    <i data-lucide="heart" class="w-5 h-5 text-rose-400"></i>
                </div>
            </div>
            <p class="text-2xl font-serif font-semibold text-white"><?php echo e($readingStats['favoriteBooks']); ?></p>
            <p class="text-xs text-gray-500 mt-1">Favorit</p>
        </div>
    </div>

    <!-- User Info Card -->
    <div class="ui-card rounded-3xl p-6 sm:p-8 space-y-6">
        <div class="flex items-center gap-4">
            <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full bg-gradient-to-br from-amber-600 to-amber-300 flex items-center justify-center text-black text-2xl font-semibold">
                <?php echo e(strtoupper(substr($user->name, 0, 1))); ?>

            </div>
            <div>
                <p class="text-sm text-gray-400">Nama</p>
                <p class="text-xl sm:text-2xl font-medium text-white"><?php echo e($user->name); ?></p>
            </div>
        </div>

        <div class="grid sm:grid-cols-2 gap-4 text-sm text-gray-200">
            <div>
                <p class="text-[11px] text-gray-400 mb-1 uppercase tracking-[0.15em]">Email</p>
                <p><?php echo e($user->email); ?></p>
            </div>
            <div>
                <p class="text-[11px] text-gray-400 mb-1 uppercase tracking-[0.15em]">Terdaftar Sejak</p>
                <p><?php echo e($user->created_at?->format('d M Y')); ?></p>
            </div>
        </div>
    </div>

    <!-- Recent Reading Progress -->
    <?php if($recentReading->count() > 0): ?>
    <div class="ui-card rounded-3xl p-6 sm:p-8">
        <h2 class="font-serif text-xl text-white mb-4 flex items-center gap-2">
            <i data-lucide="history" class="w-5 h-5 text-amber-300"></i>
            Aktivitas Membaca Terakhir
        </h2>
        <div class="space-y-4">
            <?php $__currentLoopData = $recentReading; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $progress): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('books.read', $progress->book_id)); ?>" class="flex items-center gap-4 p-3 rounded-xl hover:bg-white/5 transition-colors">
                    <div class="w-12 h-16 rounded-lg overflow-hidden flex-shrink-0">
                        <img src="<?php echo e($progress->book->cover_url ? asset('storage/' . $progress->book->cover_url) : 'https://placehold.co/100x150?text=No+Cover'); ?>" 
                             alt="<?php echo e($progress->book->title); ?>" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-white truncate"><?php echo e($progress->book->title); ?></p>
                        <p class="text-xs text-gray-500">Halaman <?php echo e($progress->current_page); ?> dari <?php echo e($progress->total_pages); ?></p>
                        <div class="mt-2 h-1.5 bg-gray-700 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-amber-500 to-amber-400 rounded-full" style="width: <?php echo e($progress->progress_percentage); ?>%"></div>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-amber-300"><?php echo e(round($progress->progress_percentage)); ?>%</p>
                        <p class="text-[10px] text-gray-500"><?php echo e($progress->last_read_at?->diffForHumans()); ?></p>
                    </div>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\laravel_ebook\resources\views/profile/show.blade.php ENDPATH**/ ?>