

<?php $__env->startSection('title', 'Profil Saya'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-3xl mx-auto px-4 py-8 space-y-6">
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

    <div class="ui-card rounded-3xl  p-6 sm:p-8 space-y-6">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-full bg-gradient-to-br from-amber-600 to-amber-300 flex items-center justify-center text-black text-lg font-semibold">
                <?php echo e(strtoupper(substr($user->name, 0, 1))); ?>

            </div>
            <div>
                <p class="text-sm text-gray-400">Nama</p>
                <p class="text-base sm:text-lg font-medium text-white"><?php echo e($user->name); ?></p>
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
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\laravel_ebook\resources\views/profile/show.blade.php ENDPATH**/ ?>