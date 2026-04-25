

<?php $__env->startSection('title', 'Daftar'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen flex items-center justify-center bg-[#060606] py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-5xl grid gap-10 lg:grid-cols-2">
        <div class="hidden lg:flex flex-col justify-center glass-panel rounded-[32px] border border-white/10 p-10 shadow-2xl">
            <span class="text-xs uppercase tracking-[0.35em] text-amber-300/80">Bergabung dengan F-Collection</span>
            <h2 class="mt-4 text-4xl font-semibold text-white leading-tight">Daftar sekarang dan nikmati koleksi ebook premium.</h2>
            <p class="mt-5 text-sm text-gray-400 leading-relaxed">Dapatkan akses ke rekomendasi buku eksklusif, riwayat pembelian, serta pengalaman membaca yang didesain khusus untuk Anda.</p>

            <div class="mt-10 space-y-4">
                <div class="rounded-3xl bg-white/5 border border-white/10 p-5">
                    <p class="text-sm font-medium text-white">Akses Lebih Cepat</p>
                    <p class="mt-2 text-sm text-gray-400">Masuk dengan satu akun untuk melihat koleksi lengkap dan pembaruan terbaru.</p>
                </div>
                <div class="rounded-3xl bg-white/5 border border-white/10 p-5">
                    <p class="text-sm font-medium text-white">Keamanan Terjamin</p>
                    <p class="mt-2 text-sm text-gray-400">Data Anda disimpan dengan aman, dan privasi Anda adalah prioritas kami.</p>
                </div>
            </div>
        </div>

        <div class="glass-panel rounded-[32px] border border-white/10 p-10 shadow-2xl">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-semibold text-white">Buat Akun Baru</h2>
                <p class="mt-3 text-sm text-gray-400">Sudah punya akun? <a href="<?php echo e(route('login')); ?>" class="font-semibold text-amber-300 hover:text-amber-200">Masuk di sini</a></p>
            </div>

            <form method="POST" action="<?php echo e(route('register')); ?>" class="space-y-6">
                <?php echo csrf_field(); ?>
                <div class="space-y-5">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Nama Lengkap</label>
                        <input id="name" name="name" type="text" required
                            class="w-full rounded-2xl bg-white/5 border border-white/10 px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-amber-400 <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            placeholder="Nama Lengkap" value="<?php echo e(old('name')); ?>">
                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-2 text-sm text-red-500"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email</label>
                        <input id="email" name="email" type="email" required
                            class="w-full rounded-2xl bg-white/5 border border-white/10 px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-amber-400 <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            placeholder="nama@email.com" value="<?php echo e(old('email')); ?>">
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-2 text-sm text-red-500"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Password</label>
                        <input id="password" name="password" type="password" required
                            class="w-full rounded-2xl bg-white/5 border border-white/10 px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-amber-400 <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            placeholder="Minimal 8 karakter">
                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-2 text-sm text-red-500"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-2">Konfirmasi Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" required
                            class="w-full rounded-2xl bg-white/5 border border-white/10 px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-amber-400"
                            placeholder="Ulangi password">
                    </div>
                </div>

                <button type="submit"
                    class="w-full rounded-2xl bg-amber-300 px-4 py-3 text-sm font-semibold text-black hover:bg-amber-200 transition-colors">
                    Daftar
                </button>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\laravel_ebook\resources\views/auth/register.blade.php ENDPATH**/ ?>