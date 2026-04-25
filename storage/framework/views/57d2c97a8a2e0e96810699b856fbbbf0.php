

<?php $__env->startSection('title', 'Tambah Metode Pembayaran'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-xl mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Tambah Metode Pembayaran</h1>
    <div class="glass-panel rounded-xl p-6 border border-white/10">
        <form action="<?php echo e(route('author.payment-methods.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="mb-4">
                <label class="block font-semibold mb-1 text-gray-200">Nama Metode</label>
                <input type="text" name="name" class="form-input w-full bg-black/20 border border-white/10 text-gray-200 rounded-lg" value="<?php echo e(old('name')); ?>" required>
                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-red-500 text-sm mt-1"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1 text-gray-200">No. Rekening/ID</label>
                <input type="text" name="account_number" class="form-input w-full bg-black/20 border border-white/10 text-gray-200 rounded-lg" value="<?php echo e(old('account_number')); ?>" required>
                <?php $__errorArgs = ['account_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-red-500 text-sm mt-1"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1 text-gray-200">Atas Nama</label>
                <input type="text" name="account_name" class="form-input w-full bg-black/20 border border-white/10 text-gray-200 rounded-lg" value="<?php echo e(old('account_name')); ?>" required>
                <?php $__errorArgs = ['account_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-red-500 text-sm mt-1"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1 text-gray-200">Jenis (Bank/Ewallet)</label>
                <input type="text" name="type" class="form-input w-full bg-black/20 border border-white/10 text-gray-200 rounded-lg" value="<?php echo e(old('type')); ?>" required>
                <?php $__errorArgs = ['type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-red-500 text-sm mt-1"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="flex gap-2 mt-6">
                <button type="submit" class="px-4 py-2 rounded-lg bg-amber-600 text-white font-semibold hover:bg-amber-700 transition">Simpan</button>
                <a href="<?php echo e(route('author.payment-methods.index')); ?>" class="px-4 py-2 rounded-lg bg-gray-700 text-gray-200 font-semibold hover:bg-gray-800 transition">Kembali</a>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\laravel\laravel_ebook\resources\views/author/payment_methods/create.blade.php ENDPATH**/ ?>