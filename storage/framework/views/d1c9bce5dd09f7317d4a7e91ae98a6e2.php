

<?php $__env->startSection('title', 'Jelajahi Semua Buku'); ?>

<?php $__env->startSection('content'); ?>
<div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
    <!-- Filter Sidebar -->
    <aside class="lg:col-span-1">
        <div class="sticky top-20 space-y-4">
            <h3 class="font-serif text-xl text-white">Filter</h3>
            
            <form method="GET" action="<?php echo e(route('books.browse')); ?>" class="space-y-4">
                <!-- Category Filter -->
                <div class="glass-panel rounded-xl p-4 border border-white/5">
                    <label class="block text-sm font-medium text-gray-200 mb-3">Kategori</label>
                    <select name="category" class="w-full bg-black/30 border border-white/10 rounded-lg px-3 py-2 text-sm text-gray-300 focus:outline-none focus:border-amber-500/50 appearance-none cursor-pointer"
                        onchange="this.form.submit()">
                        <option value="">Semua Kategori</option>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($cat->id); ?>" <?php echo e(request('category') == $cat->id ? 'selected' : ''); ?>>
                                <?php echo e($cat->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <!-- Price Type Filter -->
                <div class="glass-panel rounded-xl p-4 border border-white/5">
                    <label class="block text-sm font-medium text-gray-200 mb-3">Jenis Harga</label>
                    <div class="space-y-2">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="price_type" value="" class="w-4 h-4 cursor-pointer" 
                                <?php echo e(!request('price_type') ? 'checked' : ''); ?> onchange="this.form.submit()">
                            <span class="text-sm text-gray-300">Semua</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="price_type" value="free" class="w-4 h-4 cursor-pointer"
                                <?php echo e(request('price_type') == 'free' ? 'checked' : ''); ?> onchange="this.form.submit()">
                            <span class="text-sm text-gray-300">Gratis</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="price_type" value="paid" class="w-4 h-4 cursor-pointer"
                                <?php echo e(request('price_type') == 'paid' ? 'checked' : ''); ?> onchange="this.form.submit()">
                            <span class="text-sm text-gray-300">Berbayar</span>
                        </label>
                    </div>
                </div>

                <!-- Price Range Filter -->
                <div class="glass-panel rounded-xl p-4 border border-white/5">
                    <label class="block text-sm font-medium text-gray-200 mb-3">Rentang Harga</label>
                    <div class="space-y-2">
                        <input type="number" name="price_min" placeholder="Harga Min (Rp)" 
                            value="<?php echo e(request('price_min')); ?>"
                            class="w-full bg-black/30 border border-white/10 rounded-lg px-3 py-2 text-sm text-gray-300 placeholder-gray-600 focus:outline-none focus:border-amber-500/50">
                        <input type="number" name="price_max" placeholder="Harga Max (Rp)"
                            value="<?php echo e(request('price_max')); ?>"
                            class="w-full bg-black/30 border border-white/10 rounded-lg px-3 py-2 text-sm text-gray-300 placeholder-gray-600 focus:outline-none focus:border-amber-500/50">
                        <button type="submit" class="w-full mt-2 px-3 py-2 bg-amber-600 hover:bg-amber-500 text-black text-sm font-medium rounded-lg transition-colors">
                            Terapkan
                        </button>
                    </div>
                </div>

                <!-- Publisher Filter -->
                <div class="glass-panel rounded-xl p-4 border border-white/5">
                    <label class="block text-sm font-medium text-gray-200 mb-3">Penerbit</label>
                    <input type="text" name="publisher" placeholder="Cari penerbit..."
                        value="<?php echo e(request('publisher')); ?>"
                        class="w-full bg-black/30 border border-white/10 rounded-lg px-3 py-2 text-sm text-gray-300 placeholder-gray-600 focus:outline-none focus:border-amber-500/50">
                    <button type="submit" class="w-full mt-2 px-3 py-2 bg-amber-600 hover:bg-amber-500 text-black text-sm font-medium rounded-lg transition-colors">
                        Cari
                    </button>
                </div>

                <!-- Page Count Filter -->
                <div class="glass-panel rounded-xl p-4 border border-white/5">
                    <label class="block text-sm font-medium text-gray-200 mb-3">Jumlah Halaman</label>
                    <div class="space-y-2">
                        <input type="number" name="min_pages" placeholder="Min Halaman"
                            value="<?php echo e(request('min_pages')); ?>"
                            class="w-full bg-black/30 border border-white/10 rounded-lg px-3 py-2 text-sm text-gray-300 placeholder-gray-600 focus:outline-none focus:border-amber-500/50">
                        <input type="number" name="max_pages" placeholder="Max Halaman"
                            value="<?php echo e(request('max_pages')); ?>"
                            class="w-full bg-black/30 border border-white/10 rounded-lg px-3 py-2 text-sm text-gray-300 placeholder-gray-600 focus:outline-none focus:border-amber-500/50">
                        <button type="submit" class="w-full mt-2 px-3 py-2 bg-amber-600 hover:bg-amber-500 text-black text-sm font-medium rounded-lg transition-colors">
                            Terapkan
                        </button>
                    </div>
                </div>

                <!-- Preview Filter -->
                <div class="glass-panel rounded-xl p-4 border border-white/5">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="has_preview" value="1" class="w-4 h-4 cursor-pointer"
                            <?php echo e(request('has_preview') ? 'checked' : ''); ?> onchange="this.form.submit()">
                        <span class="text-sm text-gray-300">Hanya buku dengan preview</span>
                    </label>
                </div>

                <!-- Sort Filter -->
                <div class="glass-panel rounded-xl p-4 border border-white/5">
                    <label class="block text-sm font-medium text-gray-200 mb-3">Urutkan</label>
                    <select name="sort_by" class="w-full bg-black/30 border border-white/10 rounded-lg px-3 py-2 text-sm text-gray-300 focus:outline-none focus:border-amber-500/50 appearance-none cursor-pointer mb-2"
                        onchange="this.form.submit()">
                        <option value="created_at" <?php echo e(request('sort_by', 'created_at') == 'created_at' ? 'selected' : ''); ?>>Terbaru</option>
                        <option value="title" <?php echo e(request('sort_by') == 'title' ? 'selected' : ''); ?>>Judul (A-Z)</option>
                        <option value="views" <?php echo e(request('sort_by') == 'views' ? 'selected' : ''); ?>>Paling Dikunjungi</option>
                        <option value="downloads" <?php echo e(request('sort_by') == 'downloads' ? 'selected' : ''); ?>>Paling Diunduh</option>
                        <option value="price" <?php echo e(request('sort_by') == 'price' ? 'selected' : ''); ?>>Harga</option>
                    </select>
                    <select name="sort_order" class="w-full bg-black/30 border border-white/10 rounded-lg px-3 py-2 text-sm text-gray-300 focus:outline-none focus:border-amber-500/50 appearance-none cursor-pointer"
                        onchange="this.form.submit()">
                        <option value="desc" <?php echo e(request('sort_order', 'desc') == 'desc' ? 'selected' : ''); ?>>Menurun</option>
                        <option value="asc" <?php echo e(request('sort_order') == 'asc' ? 'selected' : ''); ?>>Meningkat</option>
                    </select>
                </div>

                <!-- Clear Filters -->
                <?php if(request()->anyFilled(['category', 'price_type', 'price_min', 'price_max', 'publisher', 'min_pages', 'max_pages', 'has_preview'])): ?>
                    <a href="<?php echo e(route('books.browse')); ?>" class="block w-full px-4 py-2 bg-red-600/20 hover:bg-red-600/30 text-red-300 text-sm font-medium rounded-lg text-center border border-red-500/30 transition-colors">
                        Hapus Semua Filter
                    </a>
                <?php endif; ?>
            </form>
        </div>
    </aside>

    <!-- Books Grid -->
    <div class="lg:col-span-3">
        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <h2 class="font-serif text-2xl text-white">Jelajahi Perpustakaan</h2>
                <span class="text-sm text-gray-400"><?php echo e($books->total()); ?> buku ditemukan</span>
            </div>

            <div class="grid gap-5 sm:grid-cols-2 md:grid-cols-3">
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
                                <?php if($book->free_pages > 0): ?>
                                    <div class="absolute bottom-3 right-3 px-2 py-1 rounded-full bg-blue-500/80 text-[11px] text-white font-semibold">
                                        Preview
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
                            <?php if($book->publisher): ?>
                                <p class="text-xs text-gray-500">
                                    <?php echo e($book->publisher); ?>

                                </p>
                            <?php endif; ?>
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
                            <?php if($book->total_pages): ?>
                                <p class="text-xs text-gray-500">
                                    <?php echo e($book->total_pages); ?> halaman
                                </p>
                            <?php endif; ?>
                            <a href="<?php echo e(route('books.show', $book->id)); ?>"
                               class="mt-2 block w-full text-center px-3 py-2 rounded-full bg-white/5 text-xs text-gray-100 font-medium hover:bg-white/10 transition-colors">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="col-span-full glass-panel rounded-2xl p-10 text-center text-gray-400">
                        <i data-lucide="search" class="w-12 h-12 mx-auto mb-4 text-gray-500"></i>
                        <p class="text-lg">Tidak ada buku yang sesuai dengan filter Anda.</p>
                        <a href="<?php echo e(route('books.browse')); ?>" class="text-amber-300 hover:text-amber-200 mt-4 inline-block text-sm">
                            Hapus filter
                        </a>
                    </div>
                <?php endif; ?>
            </div>

            <div class="mt-6">
                <?php echo e($books->links()); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\laravel\laravel_ebook\resources\views/browse.blade.php ENDPATH**/ ?>