

<?php $__env->startSection('title', 'Tambah Metode Pembayaran'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-6">
    <a href="<?php echo e(route('admin.payment-methods.index')); ?>" class="text-[#FF2D20] hover:text-red-600">← Kembali</a>
    <h1 class="text-3xl font-bold text-gray-900 mt-2">Tambah Metode Pembayaran</h1>
</div>

<div class="max-w-2xl">
    <div class="bg-white rounded-lg shadow p-6">
        <form action="<?php echo e(route('admin.payment-methods.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Metode *</label>
                <input type="text" id="name" name="name" required 
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#FF2D20]"
                    value="<?php echo e(old('name')); ?>"
                    placeholder="contoh: BCA Transfer, OVO, Dana">
                <?php $__errorArgs = ['name'];
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

            <div class="mb-4">
                <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Tipe Metode *</label>
                <select id="type" name="type" required 
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#FF2D20]">
                    <option value="">-- Pilih Tipe --</option>
                    <option value="bank" <?php if(old('type') === 'bank'): ?> selected <?php endif; ?>>Transfer Bank</option>
                    <option value="e-wallet" <?php if(old('type') === 'e-wallet'): ?> selected <?php endif; ?>>E-Wallet</option>
                    <option value="qris" <?php if(old('type') === 'qris'): ?> selected <?php endif; ?>>Qris</option>
                    <option value="other" <?php if(old('type') === 'other'): ?> selected <?php endif; ?>>Lainnya</option>
                </select>
                <?php $__errorArgs = ['type'];
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

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea id="description" name="description" rows="2" 
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#FF2D20]"
                    placeholder="Deskripsi metode pembayaran (opsional)"><?php echo e(old('description')); ?></textarea>
                <?php $__errorArgs = ['description'];
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

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="account_number" class="block text-sm font-medium text-gray-700 mb-1">No. Rekening / Akun</label>
                    <input type="text" id="account_number" name="account_number" 
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#FF2D20]"
                        value="<?php echo e(old('account_number')); ?>"
                        placeholder="contoh: 1234567890">
                    <?php $__errorArgs = ['account_number'];
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

                <div>
                    <label for="account_holder" class="block text-sm font-medium text-gray-700 mb-1">Nama Pemilik Akun</label>
                    <input type="text" id="account_holder" name="account_holder" 
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#FF2D20]"
                        value="<?php echo e(old('account_holder')); ?>"
                        placeholder="Nama pemilik">
                    <?php $__errorArgs = ['account_holder'];
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
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <label for="fee_percentage" class="block text-sm font-medium text-gray-700 mb-1">Biaya (%)</label>
                    <input type="number" id="fee_percentage" name="fee_percentage" step="0.01" min="0" max="100"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#FF2D20]"
                        value="<?php echo e(old('fee_percentage', 0)); ?>">
                    <?php $__errorArgs = ['fee_percentage'];
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

                <div>
                    <label for="fee_fixed" class="block text-sm font-medium text-gray-700 mb-1">Biaya Tetap (Rp)</label>
                    <input type="number" id="fee_fixed" name="fee_fixed" step="0.01" min="0"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#FF2D20]"
                        value="<?php echo e(old('fee_fixed', 0)); ?>">
                    <?php $__errorArgs = ['fee_fixed'];
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
            </div>

            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" 
                        <?php if(old('is_active', true)): ?> checked <?php endif; ?>
                        class="w-4 h-4 text-[#FF2D20] border-gray-300 rounded focus:ring-2 focus:ring-[#FF2D20]">
                    <span class="ml-2 text-sm font-medium text-gray-700">Aktifkan metode ini</span>
                </label>
            </div>

            <div class="flex gap-2">
                <a href="<?php echo e(route('admin.payment-methods.index')); ?>" class="flex-1 text-center border border-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-50 transition-colors">
                    Batal
                </a>
                <button type="submit" class="flex-1 bg-[#FF2D20] text-white px-4 py-2 rounded hover:bg-red-600 transition-colors">
                    Simpan Metode Pembayaran
                </button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\laravel\laravel_ebook\resources\views/admin/payment-methods/create.blade.php ENDPATH**/ ?>