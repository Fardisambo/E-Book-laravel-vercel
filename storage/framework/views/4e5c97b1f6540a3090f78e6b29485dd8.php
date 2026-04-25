

<?php $__env->startSection('title', 'Dashboard Petugas'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-[#0f0f0f] py-10 px-4 sm:px-6 lg:px-8">
    <div class="max-w-5xl mx-auto">
        <h1 class="text-2xl font-bold mb-4 text-white">Dashboard Petugas</h1>
        <div class="glass-panel rounded-[28px] border border-white/10 p-6">
            <p class="text-gray-300">Selamat datang, <?php echo e(auth()->user()->name); ?>!<br>
            Ini adalah halaman dashboard khusus petugas.</p>
            <div class="mt-6 flex flex-wrap gap-3">
                <a href="<?php echo e(route('author.books.index')); ?>" class="inline-flex items-center justify-center rounded-full bg-amber-300 px-5 py-3 text-sm font-semibold text-slate-900 hover:bg-amber-200 transition">Kelola Buku</a>
                <a href="<?php echo e(route('author.borrows.index')); ?>" class="inline-flex items-center justify-center rounded-full border border-white/10 bg-white/10 px-5 py-3 text-sm font-semibold text-gray-200 hover:bg-white/20 transition">Kelola Peminjaman</a>
                <a href="<?php echo e(route('author.payment-methods.index')); ?>" class="inline-flex items-center justify-center rounded-full border border-white/10 bg-white/10 px-5 py-3 text-sm font-semibold text-gray-200 hover:bg-white/20 transition">Metode Pembayaran</a>
                <a href="<?php echo e(route('author.payments.index')); ?>" class="inline-flex items-center justify-center rounded-full border border-white/10 bg-white/10 px-5 py-3 text-sm font-semibold text-gray-200 hover:bg-white/20 transition">Pembayaran</a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\laravel\laravel_ebook\resources\views/author/dashboard.blade.php ENDPATH**/ ?>