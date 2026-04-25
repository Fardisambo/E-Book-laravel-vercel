

<?php $__env->startSection('title', 'Langganan'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-6xl mx-auto px-4 py-8 space-y-6">
    <div class="flex items-center justify-between gap-3">
        <div>
            <h1 class="font-serif text-2xl sm:text-3xl text-white flex items-center gap-2">
                <i data-lucide="badge-check" class="w-6 h-6 text-amber-300"></i>
                Paket Langganan
            </h1>
            <p class="text-xs sm:text-sm text-gray-400 mt-1">
                Nikmati akses penuh ke semua koleksi dengan paket bulanan atau tahunan.
            </p>
        </div>
        <a href="<?php echo e(route('orders.paid')); ?>" class="text-xs sm:text-sm text-amber-300 hover:text-amber-200 flex items-center gap-1">
            <i data-lucide="book-open-check" class="w-4 h-4"></i>
            Lihat Riwayat Pembelian
        </a>
    </div>

    <?php if($activeSubscription): ?>
    <div class="glass-panel rounded-2xl border border-emerald-500/30 p-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div>
            <p class="text-[11px] text-emerald-300 uppercase tracking-[0.2em] mb-1">Langganan Aktif</p>
            <p class="text-sm text-gray-100">
                <?php echo e(ucfirst($activeSubscription->plan)); ?> plan - berlaku hingga 
                <span class="text-emerald-200 font-medium"><?php echo e($activeSubscription->expires_at->format('d M Y')); ?></span>
            </p>
        </div>
        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-[11px] font-semibold bg-emerald-500/15 text-emerald-200 border border-emerald-500/30">
            <i data-lucide="check-circle-2" class="w-3 h-3"></i>
            Aktif
        </span>
    </div>
    <?php endif; ?>

    <?php if($pendingSubscription): ?>
    <div class="glass-panel rounded-2xl border border-amber-500/40 p-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div>
            <p class="text-[11px] text-amber-300 uppercase tracking-[0.2em] mb-1">Menunggu Pembayaran</p>
            <p class="text-sm text-gray-100">
                Pesanan <?php echo e(ucfirst($pendingSubscription->plan)); ?> (Rp <?php echo e(number_format($pendingSubscription->amount, 0, ',', '.')); ?>) masih menunggu pembayaran.
            </p>
        </div>
        <a href="<?php echo e($pendingPayment ? route('payments.show', $pendingPayment->id) : route('payments.create-subscription', $pendingSubscription->id)); ?>" 
           class="inline-flex items-center justify-center bg-gradient-to-r from-amber-600 to-amber-500 text-black px-4 py-1.5 rounded-full hover:shadow-lg hover:shadow-amber-500/25 transition-colors font-medium text-xs whitespace-nowrap">
            <i data-lucide="credit-card" class="w-4 h-4 mr-1"></i>
            Lanjutkan Pembayaran
        </a>
    </div>
    <?php endif; ?>

    <div class="grid md:grid-cols-2 gap-6">
        <div class="glass-panel rounded-2xl p-6 sm:p-8 border border-white/10">
            <h2 class="font-serif text-xl text-white mb-3">Monthly Plan</h2>
            <div class="mb-5">
                <span class="text-3xl sm:text-4xl font-semibold text-amber-300">Rp 50.000</span>
                <span class="text-gray-400 text-sm">/bulan</span>
            </div>
            <ul class="space-y-3 mb-6 text-sm text-gray-200">
                <li class="flex items-center gap-2">
                    <i data-lucide="check" class="w-4 h-4 text-emerald-300"></i>
                    Akses membaca semua buku
                </li>
                <li class="flex items-center gap-2">
                    <i data-lucide="check" class="w-4 h-4 text-emerald-300"></i>
                    Tidak ada batasan halaman
                </li>
            </ul>
            <form action="<?php echo e(route('subscriptions.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="plan" value="monthly">
                <button type="submit" class="w-full bg-gradient-to-r from-amber-600 to-amber-500 text-black py-2.5 rounded-full hover:shadow-lg hover:shadow-amber-500/25 transition-colors text-sm font-medium">
                    Berlangganan Bulanan
                </button>
            </form>
        </div>

        <div class="glass-panel rounded-2xl p-6 sm:p-8 border border-amber-500/50 relative">
            <div class="absolute top-0 right-0 bg-gradient-to-r from-amber-600 to-amber-400 text-black px-4 py-1 rounded-bl-xl text-[11px] font-semibold tracking-[0.18em] uppercase">
                Populer
            </div>
            <h2 class="font-serif text-xl text-white mb-3">Yearly Plan</h2>
            <div class="mb-5">
                <span class="text-3xl sm:text-4xl font-semibold text-amber-300">Rp 500.000</span>
                <span class="text-gray-400 text-sm">/tahun</span>
                <p class="text-xs text-emerald-300 mt-2">Hemat Rp 100.000 dibanding bulanan</p>
            </div>
            <ul class="space-y-3 mb-6 text-sm text-gray-200">
                <li class="flex items-center gap-2">
                    <i data-lucide="check" class="w-4 h-4 text-emerald-300"></i>
                    Akses membaca semua buku
                </li>
                <li class="flex items-center gap-2">
                    <i data-lucide="check" class="w-4 h-4 text-emerald-300"></i>
                    Tidak ada batasan halaman
                </li>
                <li class="flex items-center gap-2">
                    <i data-lucide="check" class="w-4 h-4 text-emerald-300"></i>
                    Hemat 20% dari bulanan
                </li>
            </ul>
            <form action="<?php echo e(route('subscriptions.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="plan" value="yearly">
                <button type="submit" class="w-full bg-gradient-to-r from-amber-600 to-amber-500 text-black py-2.5 rounded-full hover:shadow-lg hover:shadow-amber-500/25 transition-colors text-sm font-medium">
                    Berlangganan Tahunan
                </button>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\laravel\laravel_ebook\resources\views/subscriptions/index.blade.php ENDPATH**/ ?>