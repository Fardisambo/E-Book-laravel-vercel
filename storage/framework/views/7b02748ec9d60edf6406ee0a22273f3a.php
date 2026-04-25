

<?php $__env->startSection('title', 'Reservasi Pinjam Buku'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-6xl mx-auto px-4 py-8">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-3xl font-semibold text-white">Reservasi Pinjam Buku</h1>
            <p class="text-sm text-gray-400">Tunjukkan halaman ini kepada petugas perpustakaan untuk memperlihatkan reservasi yang sudah Anda buat.</p>
        </div>
    </div>

    <div class="ui-card rounded-3xl  p-6">
        <?php if($borrows->count()): ?>
            <div class="space-y-4">
                <?php $__currentLoopData = $borrows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $borrow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="border-b border-white/10 pb-4 last:border-b-0">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                            <div>
                                <h2 class="text-lg font-semibold text-white"><?php echo e($borrow->book->title); ?></h2>
                                <p class="text-sm text-gray-400"><?php echo e($borrow->book->author); ?></p>
                                <p class="text-sm text-gray-300 mt-1">Diminta: <?php echo e($borrow->requested_at->format('d M Y H:i')); ?></p>
                            </div>
                            <div class="flex flex-wrap items-center gap-2 text-sm">
                                <span class="px-3 py-1 rounded-full <?php echo e($borrow->status === 'approved' ? 'bg-emerald-500 text-black' : ($borrow->status === 'returned' ? 'bg-sky-500 text-black' : ($borrow->status === 'rejected' ? 'bg-red-500 text-white' : ($borrow->status === 'cancelled' ? 'bg-gray-500 text-white' : 'bg-amber-500 text-black')))); ?>">
                                    <?php echo e(ucfirst($borrow->status)); ?>

                                </span>
                                <a href="<?php echo e(route('borrows.show', $borrow->id)); ?>" class="text-amber-300 hover:underline">Detail</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div class="mt-6">
                <?php echo e($borrows->links()); ?>

            </div>
        <?php else: ?>
            <p class="text-gray-300">Belum ada permintaan pinjam buku. Kunjungi halaman buku dan ajukan pinjaman.</p>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\laravel_ebook\resources\views/borrows/index.blade.php ENDPATH**/ ?>