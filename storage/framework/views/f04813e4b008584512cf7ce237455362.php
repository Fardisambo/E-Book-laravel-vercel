

<?php $__env->startSection('title', 'Edit Pesanan'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-6">
    <a href="<?php echo e(route('admin.purchases.index')); ?>" class="text-[#FF2D20] hover:text-red-600">← Kembali</a>
    <h1 class="text-3xl font-bold text-gray-900 mt-2">Edit Pesanan #<?php echo e($purchase->id); ?></h1>
</div>

<div class="max-w-2xl">
    <div class="bg-white rounded-lg shadow p-6">
        <form action="<?php echo e(route('admin.purchases.update', $purchase->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PATCH'); ?>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Pembeli</label>
                <input type="text" value="<?php echo e($purchase->user->name); ?> (<?php echo e($purchase->user->email); ?>)" readonly 
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-100 text-gray-600">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Buku</label>
                <input type="text" value="<?php echo e($purchase->book->title); ?>" readonly 
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-100 text-gray-600">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Harga</label>
                <input type="text" value="Rp <?php echo e(number_format($purchase->price, 0, ',', '.')); ?>" readonly 
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-100 text-gray-600">
            </div>

            <div class="mb-6">
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select id="status" name="status" required 
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#FF2D20]">
                    <option value="">-- Pilih Status --</option>
                    <option value="pending" <?php if($purchase->status === 'pending'): ?> selected <?php endif; ?>>Menunggu</option>
                    <option value="completed" <?php if($purchase->status === 'completed'): ?> selected <?php endif; ?>>Selesai</option>
                    <option value="failed" <?php if($purchase->status === 'failed'): ?> selected <?php endif; ?>>Gagal</option>
                    <option value="cancelled" <?php if($purchase->status === 'cancelled'): ?> selected <?php endif; ?>>Batal</option>
                </select>
                <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-600 text-sm mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="flex gap-2">
                <a href="<?php echo e(route('admin.purchases.index')); ?>" class="flex-1 text-center border border-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-50 transition-colors">
                    Batal
                </a>
                <button type="submit" class="flex-1 bg-[#FF2D20] text-white px-4 py-2 rounded hover:bg-red-600 transition-colors">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\laravel\laravel_ebook\resources\views/admin/purchases/edit.blade.php ENDPATH**/ ?>