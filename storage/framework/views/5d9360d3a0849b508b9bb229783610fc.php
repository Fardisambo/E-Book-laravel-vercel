

<?php $__env->startSection('title', 'Pembayaran Buku Saya'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-[#0f0f0f] py-10 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto space-y-6">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-white">Pembayaran Buku Saya</h1>
                <p class="text-sm text-gray-400 mt-1">Lihat semua pesanan dan status pembayaran untuk buku yang Anda jual.</p>
            </div>
            <a href="<?php echo e(route('author.dashboard')); ?>" class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-white/10 text-sm text-gray-200 hover:bg-white/10 transition">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Kembali ke Dashboard
            </a>
        </div>

        <div class="grid gap-4 sm:grid-cols-3">
            <div class="glass-panel rounded-3xl p-5 border border-white/10">
                <p class="text-xs uppercase tracking-[0.24em] text-gray-500">Total Pembayaran</p>
                <p class="mt-3 text-3xl font-semibold text-white"><?php echo e($totalSales); ?></p>
                <p class="text-sm text-gray-400 mt-1">Jumlah transaksi</p>
            </div>
            <div class="glass-panel rounded-3xl p-5 border border-white/10">
                <p class="text-xs uppercase tracking-[0.24em] text-gray-500">Selesai</p>
                <p class="mt-3 text-3xl font-semibold text-emerald-300">Rp <?php echo e(number_format($totalCompleted, 0, ',', '.')); ?></p>
                <p class="text-sm text-gray-400 mt-1">Total pembayaran selesai</p>
            </div>
            <div class="glass-panel rounded-3xl p-5 border border-white/10">
                <p class="text-xs uppercase tracking-[0.24em] text-gray-500">Pending</p>
                <p class="mt-3 text-3xl font-semibold text-amber-300"><?php echo e($totalPending); ?></p>
                <p class="text-sm text-gray-400 mt-1">Pembayaran tertunda</p>
            </div>
        </div>

        <div class="glass-panel rounded-[32px] border border-white/10 p-6 overflow-x-auto">
            <table class="min-w-full text-left text-sm text-gray-300">
                <thead class="border-b border-white/10 text-xs uppercase tracking-[0.2em] text-gray-500">
                    <tr>
                        <th class="px-4 py-3">Tanggal</th>
                        <th class="px-4 py-3">Pembeli</th>
                        <th class="px-4 py-3">Buku</th>
                        <th class="px-4 py-3">Metode</th>
                        <th class="px-4 py-3">Jumlah</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="border-b border-white/10 hover:bg-white/5 transition">
                        <td class="px-4 py-4 text-gray-400"><?php echo e($payment->created_at->format('d M Y')); ?></td>
                        <td class="px-4 py-4"><?php echo e($payment->user?->name ?? '-'); ?></td>
                        <td class="px-4 py-4"><?php echo e($payment->paymentable->book->title ?? '-'); ?></td>
                        <td class="px-4 py-4"><?php echo e($payment->paymentMethod?->name ?? $payment->authorPaymentMethod?->name ?? '-'); ?></td>
                        <td class="px-4 py-4 text-amber-300">Rp <?php echo e(number_format($payment->amount, 0, ',', '.')); ?></td>
                        <td class="px-4 py-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-semibold
                                <?php if($payment->status === 'completed'): ?> bg-emerald-500/15 text-emerald-200 border border-emerald-500/40
                                <?php elseif($payment->status === 'pending'): ?> bg-amber-500/15 text-amber-200 border border-amber-500/40
                                <?php else: ?> bg-red-500/15 text-red-200 border border-red-500/40 <?php endif; ?>">
                                <?php echo e(ucfirst($payment->status)); ?>

                            </span>
                        </td>
                        <td class="px-4 py-4">
                            <a href="<?php echo e(route('author.payments.show', $payment->id)); ?>" class="text-amber-300 hover:text-amber-200">Detail</a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="7" class="px-4 py-8 text-center text-gray-500">Belum ada pembayaran untuk buku Anda.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            <?php echo e($payments->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\laravel\laravel_ebook\resources\views/author/payments/index.blade.php ENDPATH**/ ?>