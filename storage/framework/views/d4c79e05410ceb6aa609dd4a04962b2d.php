

<?php $__env->startSection('title', 'Tambah Kategori'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-2xl">
    <h1 class="text-3xl font-bold text-white-900 mb-6">Tambah Kategori</h1>

    <form action="<?php echo e(route('admin.categories.store')); ?>" method="POST" class="ui-card p-6">
        <?php echo csrf_field(); ?>
        <div class="space-y-4">
            <div>
                <label for="name" class="block text-sm font-medium text-white-700 mb-2">Nama Kategori *</label>
                <input type="text" name="name" id="name" required
                    class="w-full px-4 py-2 border border-white-300 rounded-lg focus:ring-2 focus:ring-[#FF2D20] focus:border-transparent <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    value="<?php echo e(old('name')); ?>">
                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-white-700 mb-2">Deskripsi</label>
                <textarea name="description" id="description" rows="4"
                    class="w-full px-4 py-2 border border-white-300 rounded-lg focus:ring-2 focus:ring-[#FF2D20] focus:border-transparent"><?php echo e(old('description')); ?></textarea>
            </div>
        </div>

        <div class="mt-6 flex space-x-4">
            <button type="submit" class="bg-[#FF2D20] text-white px-6 py-2 rounded-lg hover:bg-red-600 transition-colors">
                Simpan
            </button>
            <a href="<?php echo e(route('admin.categories.index')); ?>" class="bg-white-200 text-white-700 px-6 py-2 rounded-lg hover:bg-white-300 transition-colors">
                Batal
            </a>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\laravel_ebook\resources\views/admin/categories/create.blade.php ENDPATH**/ ?>