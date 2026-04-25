

<?php $__env->startSection('title', 'Detail Pembayaran Buku Saya'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-[#0f0f0f] py-10 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto space-y-6">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-white">Detail Pembayaran</h1>
                <p class="text-sm text-gray-400 mt-1">Informasi transaksi untuk buku Anda.</p>
            </div>
            <a href="<?php echo e(route('author.payments.index')); ?>" class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-white/10 text-sm text-gray-200 hover:bg-white/10 transition">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Kembali ke Pembayaran
            </a>
        </div>

        <div class="glass-panel rounded-[32px] border border-white/10 p-6 space-y-5">
            <div class="grid gap-4 sm:grid-cols-2">
                <div>
                    <p class="text-xs uppercase tracking-[0.22em] text-gray-500">Transaction ID</p>
                    <p class="mt-2 text-sm text-gray-200 font-semibold"><?php echo e($payment->transaction_id); ?></p>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-[0.22em] text-gray-500">Tanggal</p>
                    <p class="mt-2 text-sm text-gray-200 font-semibold"><?php echo e($payment->created_at->format('d M Y H:i')); ?></p>
                </div>
            </div>

            <div class="grid gap-4 sm:grid-cols-2">
                <div>
                    <p class="text-xs uppercase tracking-[0.22em] text-gray-500">Pembeli</p>
                    <p class="mt-2 text-sm text-gray-200 font-semibold"><?php echo e($payment->user?->name ?? 'Guest'); ?></p>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-[0.22em] text-gray-500">Status</p>
                    <span class="inline-flex items-center mt-2 px-3 py-1 rounded-full text-[11px] font-semibold
                        <?php if($payment->status === 'completed'): ?> bg-emerald-500/15 text-emerald-200 border border-emerald-500/40
                        <?php elseif($payment->status === 'pending'): ?> bg-amber-500/15 text-amber-200 border border-amber-500/40
                        <?php else: ?> bg-red-500/15 text-red-200 border border-red-500/40 <?php endif; ?>">
                        <?php echo e(ucfirst($payment->status)); ?>

                    </span>
                </div>
            </div>

            <div class="grid gap-4 sm:grid-cols-2">
                <div>
                    <p class="text-xs uppercase tracking-[0.22em] text-gray-500">Buku</p>
                    <p class="mt-2 text-sm text-gray-200 font-semibold"><?php echo e($payment->paymentable->book->title ?? '-'); ?></p>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-[0.22em] text-gray-500">Jumlah</p>
                    <p class="mt-2 text-sm text-amber-300 font-semibold">Rp <?php echo e(number_format($payment->amount, 0, ',', '.')); ?></p>
                </div>
            </div>

            <div>
                <p class="text-xs uppercase tracking-[0.22em] text-gray-500">Metode Pembayaran</p>
                <p class="mt-2 text-sm text-gray-200 font-semibold"><?php echo e($payment->paymentMethod?->name ?? $payment->authorPaymentMethod?->name ?? '-'); ?></p>
            </div>

            <?php $selectedMethod = $payment->paymentMethod ?? $payment->authorPaymentMethod; ?>
            <?php if($selectedMethod): ?>
            <div class="grid gap-4 sm:grid-cols-2">
                <?php if($selectedMethod->account_number): ?>
                <div>
                    <p class="text-xs uppercase tracking-[0.22em] text-gray-500">No. Rekening / Akun</p>
                    <p class="mt-2 text-sm text-gray-200 font-semibold"><?php echo e($selectedMethod->account_number); ?></p>
                </div>
                <?php endif; ?>
                <?php if(($selectedMethod->account_holder ?? $selectedMethod->account_name)): ?>
                <div>
                    <p class="text-xs uppercase tracking-[0.22em] text-gray-500">Atas Nama</p>
                    <p class="mt-2 text-sm text-gray-200 font-semibold"><?php echo e($selectedMethod->account_holder ?? $selectedMethod->account_name); ?></p>
                </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <?php if($payment->paymentable->book->author): ?>
            <div class="bg-white/5 rounded-3xl p-4 border border-white/10">
                <p class="text-xs uppercase tracking-[0.22em] text-gray-500">Penulis Buku</p>
                <p class="mt-2 text-sm text-gray-200"><?php echo e($payment->paymentable->book->author); ?></p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\laravel\laravel_ebook\resources\views/author/payments/show.blade.php ENDPATH**/ ?>