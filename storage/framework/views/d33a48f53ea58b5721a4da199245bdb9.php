<?php $__env->startSection('title', 'Katalog Ebook'); ?>

<?php $__env->startSection('content'); ?>
<?php
    $featuredBook = $popularBooks->first() ?? $newBooks->first() ?? $books->first();
?>

<div class="space-y-8">
    <!-- Hero Section -->
    <?php if($featuredBook): ?>
        <section class="relative overflow-hidden rounded-3xl glass-panel border border-white/10 p-6 sm:p-10">
            <div class="absolute top-0 right-0 w-64 h-64 sm:w-80 sm:h-80 bg-amber-500/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/3"></div>
            <div class="relative z-10 flex flex-col md:flex-row items-center gap-8">
                <div class="flex-1 space-y-4">
                    <span class="inline-block px-3 py-1 rounded-full bg-amber-500/10 border border-amber-500/20 text-amber-300 text-[11px] font-medium tracking-[0.2em] uppercase">
                        Buku Pilihan Untuk Anda
                    </span>
                    <h1 class="font-serif text-3xl sm:text-4xl font-semibold text-white leading-tight">
                        <?php echo e($featuredBook->title); ?>

                    </h1>
                    <p class="text-sm text-gray-400">
                        Oleh <span class="text-amber-200"><?php echo e($featuredBook->author); ?></span>
                    </p>
                    <p class="text-gray-400 max-w-xl text-sm sm:text-base leading-relaxed">
                        <?php echo e(\Illuminate\Support\Str::limit($featuredBook->description ?? 'Temukan pengalaman membaca yang elegan dengan koleksi eksklusif kami.', 150)); ?>

                    </p>
                    <div class="flex flex-wrap items-center gap-3 pt-2">
                        <a href="<?php echo e(route('books.read', $featuredBook->id)); ?>"
                           class="px-5 py-2.5 bg-gradient-to-r from-amber-600 to-amber-500 text-black text-sm font-medium rounded-full hover:shadow-lg hover:shadow-amber-500/25 transition-all transform hover:scale-105 flex items-center gap-2">
                            <i data-lucide="book-open" class="w-4 h-4"></i>
                            Baca Sekarang
                        </a>
                        <a href="<?php echo e(route('books.show', $featuredBook->id)); ?>"
                           class="px-5 py-2.5 border border-white/15 text-sm text-gray-100 rounded-full hover:bg-white/5 transition-all flex items-center gap-2">
                            <i data-lucide="info" class="w-4 h-4"></i>
                            Detail Buku
                        </a>
                    </div>
                </div>
                <div class="relative w-36 sm:w-44 md:w-56 aspect-[2/3]">
                    <div class="absolute inset-0 bg-gradient-to-br from-amber-400 to-amber-600 rounded-lg transform rotate-6 opacity-20"></div>
                    <img
                        src="<?php echo e($featuredBook->cover_url ? asset('storage/' . $featuredBook->cover_url) : 'https://placehold.co/400x600?text=No+Cover'); ?>"
                        alt="<?php echo e($featuredBook->title); ?>"
                        class="relative w-full h-full object-cover rounded-lg shadow-2xl shadow-black/50 border border-white/10"
                    >
                    <div class="absolute -bottom-4 -right-4 w-20 h-20 bg-black/80 backdrop-blur-xl rounded-2xl border border-white/10 flex items-center justify-center">
                        <div class="text-center">
                            <span class="block text-xs text-gray-500 uppercase tracking-[0.18em] mb-1">Dibaca</span>
                            <span class="block text-lg font-semibold text-amber-300">
                                <?php echo e(number_format($featuredBook->views)); ?>

                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- Stats Row -->
    <section class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="glass-panel rounded-2xl p-4 sm:p-5 border border-white/5">
            <div class="flex items-center justify-between mb-3">
                <div class="w-9 h-9 rounded-full bg-amber-500/10 flex items-center justify-center">
                    <i data-lucide="book" class="w-4 h-4 text-amber-400"></i>
                </div>
                <span class="text-[11px] text-gray-500">Total Buku</span>
            </div>
            <p class="text-2xl font-serif font-semibold text-white"><?php echo e(number_format($books->total() ?? $books->count())); ?></p>
            <p class="text-[11px] text-gray-500 mt-1">Dalam perpustakaan Anda</p>
        </div>

        <div class="glass-panel rounded-2xl p-4 sm:p-5 border border-white/5">
            <div class="flex items-center justify-between mb-3">
                <div class="w-9 h-9 rounded-full bg-emerald-500/10 flex items-center justify-center">
                    <i data-lucide="clock" class="w-4 h-4 text-emerald-400"></i>
                </div>
                <span class="text-[11px] text-gray-500">Buku Baru</span>
            </div>
            <p class="text-2xl font-serif font-semibold text-white"><?php echo e(number_format($newBooks->count())); ?></p>
            <p class="text-[11px] text-gray-500 mt-1">1 minggu terakhir</p>
        </div>

        <div class="glass-panel rounded-2xl p-4 sm:p-5 border border-white/5">
            <div class="flex items-center justify-between mb-3">
                <div class="w-9 h-9 rounded-full bg-purple-500/10 flex items-center justify-center">
                    <i data-lucide="flame" class="w-4 h-4 text-purple-400"></i>
                </div>
            <span class="text-[11px] text-gray-500">Populer</span>
            </div>
            <p class="text-2xl font-serif font-semibold text-white"><?php echo e(number_format($popularBooks->count())); ?></p>
            <p class="text-[11px] text-gray-500 mt-1">Sering dibaca</p>
        </div>

        <div class="glass-panel rounded-2xl p-4 sm:p-5 border border-white/5">
            <div class="flex items-center justify-between mb-3">
                <div class="w-9 h-9 rounded-full bg-rose-500/10 flex items-center justify-center">
                    <i data-lucide="heart" class="w-4 h-4 text-rose-400"></i>
                </div>
                <span class="text-[11px] text-gray-500">Koleksi</span>
            </div>
            <p class="text-2xl font-serif font-semibold text-white"><?php echo e(number_format($books->count())); ?></p>
            <p class="text-[11px] text-gray-500 mt-1">Siap dinikmati</p>
        </div>
    </section>

    <!-- Buku Baru & Populer -->
    <section class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-8">
            <?php if($newBooks->count() > 0): ?>
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="font-serif text-xl text-white">Buku Baru Minggu Ini</h2>
                        <a href="<?php echo e(route('books.browse')); ?>" class="text-xs text-amber-300 hover:text-amber-200 flex items-center gap-1">
                            Lihat Semua
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <?php $__currentLoopData = $newBooks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('books.show', $book->id)); ?>" class="group">
                                <div class="book-card glass-panel rounded-2xl p-3 border border-white/5 cursor-pointer">
                                    <div class="relative aspect-[2/3] mb-3 overflow-hidden rounded-xl">
                                        <img
                                            src="<?php echo e($book->cover_url ? asset('storage/' . $book->cover_url) : 'https://placehold.co/200x300?text=No+Cover'); ?>"
                                            alt="<?php echo e($book->title); ?>"
                                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                        >
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                    </div>
                                    <h3 class="font-medium text-xs sm:text-sm text-white mb-1 line-clamp-2 group-hover:text-amber-300 transition-colors">
                                        <?php echo e($book->title); ?>

                                    </h3>
                                    <p class="text-[11px] text-gray-500">
                                        <?php echo e($book->author); ?>

                                    </p>
                                </div>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if($popularBooks->count() > 0): ?>
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="font-serif text-xl text-white">Buku Populer</h2>
                        <a href="<?php echo e(route('books.browse')); ?>" class="text-xs text-amber-300 hover:text-amber-200 flex items-center gap-1">
                            Lihat Semua
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <?php $__currentLoopData = $popularBooks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('books.show', $book->id)); ?>" class="group">
                                <div class="book-card glass-panel rounded-2xl p-3 border border-white/5 cursor-pointer">
                                    <div class="relative aspect-[2/3] mb-3 overflow-hidden rounded-xl">
                                        <img
                                            src="<?php echo e($book->cover_url ? asset('storage/' . $book->cover_url) : 'https://placehold.co/200x300?text=No+Cover'); ?>"
                                            alt="<?php echo e($book->title); ?>"
                                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                        >
                                        <div class="absolute top-2 right-2 bg-amber-500 text-black text-[10px] font-semibold px-2 py-1 rounded-full flex items-center gap-1">
                                            <i data-lucide="flame" class="w-3 h-3"></i>
                                            <?php echo e(number_format($book->views)); ?>

                                        </div>
                                    </div>
                                    <h3 class="font-medium text-xs sm:text-sm text-white mb-1 line-clamp-2 group-hover:text-amber-300 transition-colors">
                                        <?php echo e($book->title); ?>

                                    </h3>
                                    <p class="text-[11px] text-gray-500 mb-1">
                                        <?php echo e($book->author); ?>

                                    </p>
                                    <p class="text-[11px] text-gray-500 flex items-center gap-2">
                                        <span><i data-lucide="eye" class="inline w-3 h-3 mr-1"></i><?php echo e(number_format($book->views)); ?></span>
                                        <span><i data-lucide="download" class="inline w-3 h-3 mr-1"></i><?php echo e(number_format($book->downloads)); ?></span>
                                    </p>
                                </div>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Filter / Ringkasan -->
        <aside class="space-y-4">
            <div class="glass-panel rounded-2xl p-5 border border-white/5">
                <h3 class="font-serif text-lg text-white mb-4">Pilih Kategori</h3>
                <form action="<?php echo e(route('books.index')); ?>" method="GET" class="space-y-2">
                    <select name="category" class="w-full bg-black/30 border border-white/10 rounded-lg px-3 py-2 text-sm text-gray-300 focus:outline-none focus:border-amber-500/50 appearance-none cursor-pointer"
                        onchange="this.form.submit()">
                        <option value="">Semua Kategori</option>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($cat->id); ?>" <?php echo e(request('category') == $cat->id ? 'selected' : ''); ?>>
                                <?php echo e($cat->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </form>
                <a href="<?php echo e(route('books.browse')); ?>" class="block mt-3 px-4 py-2 bg-amber-600 hover:bg-amber-500 text-black text-sm font-medium rounded-lg text-center transition-colors">
                    <i data-lucide="sliders" class="w-4 h-4 inline mr-2"></i>
                    Filter Lanjutan
                </a>
            </div>

            <?php if(request('category')): ?>
                <?php
                    $selectedCategory = \App\Models\Category::find(request('category'));
                ?>
                <?php if($selectedCategory): ?>
                    <div class="glass-panel rounded-2xl p-4 border border-blue-500/30">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <p class="text-[11px] text-blue-300 uppercase tracking-[0.2em] mb-1">Filter aktif</p>
                                <p class="text-sm text-white">
                                    Kategori: <span class="font-semibold text-amber-200"><?php echo e($selectedCategory->name); ?></span>
                                </p>
                            </div>
                            <a href="<?php echo e(route('books.index')); ?>" class="text-xs text-blue-200 hover:text-blue-100 flex items-center gap-1">
                                <i data-lucide="x-circle" class="w-4 h-4"></i>
                                Hapus
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <div class="glass-panel rounded-2xl p-5 border border-white/5">
                <h3 class="font-serif text-lg text-white mb-3">Semua Buku</h3>
                <p class="text-xs text-gray-400 mb-4">
                    Jelajahi seluruh katalog ebook dengan kurasi yang elegan.
                </p>
                <div class="space-y-3 text-xs text-gray-300">
                    <div class="flex items-center justify-between">
                        <span>Total</span>
                        <span class="font-medium text-amber-200">
                            <?php echo e(number_format($books->total() ?? $books->count())); ?> judul
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span>Halaman ini</span>
                        <span><?php echo e($books->count()); ?> buku</span>
                    </div>
                </div>
            </div>
        </aside>
    </section>

    <!-- Grid Semua Buku -->
    <section class="space-y-4">
        <div class="flex items-center justify-between">
            <h2 class="font-serif text-xl text-white">
                <?php if(request('category')): ?>
                    Buku Kategori: <?php echo e($selectedCategory->name ?? 'Tidak Ditemukan'); ?>

                <?php else: ?>
                    Semua Buku
                <?php endif; ?>
            </h2>
        </div>

        <div class="grid gap-5 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
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
                    <p class="text-lg">Belum ada ebook tersedia.</p>
                    <?php if(request('category')): ?>
                        <a href="<?php echo e(route('books.index')); ?>" class="text-amber-300 hover:text-amber-200 mt-4 inline-block text-sm">
                            Kembali ke semua buku
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="mt-6">
            <?php echo e($books->links()); ?>

        </div>
    </section>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\laravel\laravel_ebook\resources\views/welcome.blade.php ENDPATH**/ ?>