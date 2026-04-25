

<?php $__env->startSection('title', 'Detail Reservasi Pinjaman'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-6xl mx-auto px-4 py-8">
    <div class="ui-card rounded-3xl  p-6">
        <div class="mb-6">
            <h1 class="text-3xl font-semibold text-white">Detail Permintaan Pinjam</h1>
            <p class="text-sm text-gray-400">Status pinjaman buku fisik Anda.</p>
        </div>

        <div class="grid gap-6 md:grid-cols-2">
            <div class="space-y-4">
                <div>
                    <p class="text-sm text-gray-400">Judul Buku</p>
                    <h2 class="text-xl font-semibold text-white"><?php echo e($borrow->book->title); ?></h2>
                </div>
                <div>
                    <p class="text-sm text-gray-400">Status</p>
                    <p class="text-lg font-semibold text-white"><?php echo e(ucfirst($borrow->status)); ?></p>
                </div>
                <div>
                    <p class="text-sm text-gray-400">Diajukan pada</p>
                    <p class="text-white"><?php echo e($borrow->requested_at->format('d M Y H:i')); ?></p>
                </div>
                <?php if($borrow->approved_at): ?>
                <div>
                    <p class="text-sm text-gray-400">Disetujui pada</p>
                    <p class="text-white"><?php echo e($borrow->approved_at->format('d M Y H:i')); ?></p>
                </div>
                <?php endif; ?>
                <?php if($borrow->borrow_days): ?>
                <div>
                    <p class="text-sm text-gray-400">Durasi Pinjam</p>
                    <p class="text-white"><?php echo e($borrow->borrow_days); ?> hari</p>
                </div>
                <?php endif; ?>
                <?php if($borrow->due_date): ?>
                <div>
                    <p class="text-sm text-gray-400">Tanggal Kembali</p>
                    <p class="text-white"><?php echo e($borrow->due_date->format('d M Y')); ?></p>
                </div>
                <?php endif; ?>
                <?php if($borrow->late_fee > 0): ?>
                <div>
                    <p class="text-sm text-gray-400">Denda Keterlambatan</p>
                    <p class="text-white">Rp <?php echo e(number_format($borrow->late_fee, 0, ',', '.')); ?> <?php if($borrow->late_days): ?>(<?php echo e($borrow->late_days); ?> hari terlambat)<?php endif; ?></p>
                </div>
                <?php elseif($borrow->is_overdue): ?>
                <div>
                    <p class="text-sm text-gray-400">Denda Saat Ini</p>
                    <p class="text-white">Rp <?php echo e(number_format($borrow->late_fee, 0, ',', '.')); ?> (Belum dikembalikan)</p>
                </div>
                <?php endif; ?>
                <?php if($borrow->returned_at): ?>
                <div>
                    <p class="text-sm text-gray-400">Dikembalikan pada</p>
                    <p class="text-white"><?php echo e($borrow->returned_at->format('d M Y H:i')); ?></p>
                </div>
                <?php endif; ?>
                <?php if($borrow->notes): ?>
                <div>
                    <p class="text-sm text-gray-400">Catatan Anda</p>
                    <p class="text-white"><?php echo e($borrow->notes); ?></p>
                </div>
                <?php endif; ?>
                <?php if($borrow->admin_notes): ?>
                <div>
                    <p class="text-sm text-gray-400">Catatan Admin</p>
                    <p class="text-white"><?php echo e($borrow->admin_notes); ?></p>
                </div>
                <?php endif; ?>
            </div>

            <div class="bg-slate-900/70 rounded-3xl p-6 space-y-4">
                <div>
                    <p class="text-sm text-gray-400">Penulis</p>
                    <p class="text-white"><?php echo e($borrow->book->author); ?></p>
                </div>
                <div>
                    <p class="text-sm text-gray-400">Stok Perpustakaan</p>
                    <p class="text-white"><?php echo e($borrow->book->library_total_copies); ?> buku</p>
                </div>
                <div>
                    <p class="text-sm text-gray-400">Sisa Tersedia</p>
                    <p class="text-white"><?php echo e($borrow->book->library_available_copies); ?> buku</p>
                </div>
                <div class="rounded-3xl border border-amber-500/30 bg-amber-500/10 p-4 text-sm text-amber-100">
                    <p class="font-semibold">Tunjukkan halaman ini kepada petugas perpustakaan saat mengambil buku.</p>
                    <p class="mt-2 text-gray-300">Status reservasi: <?php echo e(ucfirst($borrow->status)); ?>.</p>
                </div>
                <div>
                    <a href="<?php echo e(route('borrows.index')); ?>" class="inline-flex items-center justify-center rounded-full bg-amber-400 px-5 py-3 text-sm font-semibold text-black hover:bg-amber-300 transition">Kembali ke Reservasi</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\laravel_ebook\resources\views/borrows/show.blade.php ENDPATH**/ ?>