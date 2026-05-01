

<?php $__env->startSection('title', 'Edit Profil'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-3xl mx-auto px-4 py-8 space-y-6">
    <div class="flex items-center justify-between gap-3">
        <div>
            <h1 class="font-serif text-2xl sm:text-3xl text-white flex items-center gap-2">
                <i data-lucide="pencil" class="w-6 h-6 text-amber-300"></i>
                Edit Profil
            </h1>
            <p class="text-xs sm:text-sm text-gray-400 mt-1">
                Perbarui nama, email, atau password akun Anda.
            </p>
        </div>
        <a href="<?php echo e(route('profile.show')); ?>" class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/5 text-xs sm:text-sm text-gray-100 hover:bg-white/10 transition-colors">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
            Kembali
        </a>
    </div>

    <div class="ui-card rounded-3xl  p-6 sm:p-8">
        <form method="POST" action="<?php echo e(route('profile.update')); ?>" class="space-y-5">
            <?php echo csrf_field(); ?>

            <div class="grid sm:grid-cols-2 gap-4">
                <div class="sm:col-span-2">
                    <label for="name" class="block text-xs font-medium text-gray-300 mb-1.5 uppercase tracking-[0.12em]">
                        Nama Lengkap
                    </label>
                    <input
                        id="name"
                        name="name"
                        type="text"
                        value="<?php echo e(old('name', $user->name)); ?>"
                        required
                        class="w-full px-3 py-2.5 rounded-xl bg-black/40  text-sm text-gray-100 placeholder-gray-600 focus:outline-none focus:ring-1 focus:ring-amber-500/70 <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500/60 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        placeholder="Nama lengkap Anda"
                    >
                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-xs text-red-300"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="sm:col-span-2">
                    <label for="email" class="block text-xs font-medium text-gray-300 mb-1.5 uppercase tracking-[0.12em]">
                        Email
                    </label>
                    <input
                        id="email"
                        name="email"
                        type="email"
                        value="<?php echo e(old('email', $user->email)); ?>"
                        required
                        class="w-full px-3 py-2.5 rounded-xl bg-black/40  text-sm text-gray-100 placeholder-gray-600 focus:outline-none focus:ring-1 focus:ring-amber-500/70 <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500/60 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        placeholder="nama@email.com"
                    >
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-xs text-red-300"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <div class="border-t border-white/10 pt-4 mt-2 space-y-3">
                <p class="text-xs text-gray-400">
                    Jika tidak ingin mengubah password, biarkan bagian ini kosong.
                </p>

                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label for="password" class="block text-xs font-medium text-gray-300 mb-1.5 uppercase tracking-[0.12em]">
                            Password Baru
                        </label>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            class="w-full px-3 py-2.5 rounded-xl bg-black/40  text-sm text-gray-100 placeholder-gray-600 focus:outline-none focus:ring-1 focus:ring-amber-500/70 <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500/60 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            placeholder="Minimal 8 karakter"
                        >
                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1 text-xs text-red-300"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-xs font-medium text-gray-300 mb-1.5 uppercase tracking-[0.12em]">
                            Konfirmasi Password Baru
                        </label>
                        <input
                            id="password_confirmation"
                            name="password_confirmation"
                            type="password"
                            class="w-full px-3 py-2.5 rounded-xl bg-black/40  text-sm text-gray-100 placeholder-gray-600 focus:outline-none focus:ring-1 focus:ring-amber-500/70"
                            placeholder="Ulangi password baru"
                        >
                    </div>
                </div>
            </div>

            <div class="pt-2 flex gap-3">
                <a href="<?php echo e(route('profile.show')); ?>" class="flex-1 text-center border border-white/15 text-xs sm:text-sm text-gray-100 px-4 py-2.5 rounded-full hover:bg-white/5 transition-colors font-medium">
                    Batal
                </a>
                <button type="submit" class="flex-1 bg-gradient-to-r from-amber-600 to-amber-500 text-black px-4 py-2.5 rounded-full hover:shadow-lg hover:shadow-amber-500/25 transition-colors text-xs sm:text-sm font-medium">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\laravel_ebook\resources\views/profile/edit.blade.php ENDPATH**/ ?>