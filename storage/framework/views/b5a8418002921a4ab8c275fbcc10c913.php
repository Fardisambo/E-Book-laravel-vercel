

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
                
                <?php if($book->description): ?>
                <div>
                    <h2 class="font-serif text-lg text-white mb-1">Deskripsi</h2>
                    <p class="text-sm text-gray-300 leading-relaxed"><?php echo e($book->description); ?></p>
                </div>
                <?php endif; ?>
                
                <div class="flex flex-wrap gap-3 pt-1">
                    <?php if(auth()->guard()->check()): ?>
                        <?php if($book->file_path || $book->file_url): ?>
                            <a href="<?php echo e(route('books.read', $book->id)); ?>" 
                               class="px-5 py-2.5 rounded-full bg-gradient-to-r from-amber-600 to-amber-500 text-black text-sm font-medium hover:shadow-lg hover:shadow-amber-500/25 transition-all">
                                Baca Ebook
                            </a>
                            
                            <?php if(auth()->user()->hasPurchasedBook($book->id) || $book->isFree()): ?>
                                <a href="<?php echo e(route('books.download', $book->id)); ?>" 
                                   class="px-5 py-2.5 rounded-full bg-emerald-600/90 text-white text-sm font-medium hover:bg-emerald-500 transition-colors">
                                    <?php echo e($book->isFree() ? 'Download Gratis' : 'Download'); ?>

                                </a>
                            <?php else: ?>
                                <form action="<?php echo e(route('books.purchase', $book->id)); ?>" method="POST" class="inline">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" 
                                            class="px-5 py-2.5 rounded-full bg-blue-600/90 text-white text-sm font-medium hover:bg-blue-500 transition-colors">
                                        Beli untuk Download (Rp <?php echo e(number_format($book->price, 0, ',', '.')); ?>)
                                    </button>
                                </form>
                            <?php endif; ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\laravel\laravel_ebook\resources\views/books/show.blade.php ENDPATH**/ ?>