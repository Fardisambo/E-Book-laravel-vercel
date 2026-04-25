

<?php $__env->startSection('title', 'Kategori'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold text-white-900">Kategori</h1>
    <a href="<?php echo e(route('admin.categories.create')); ?>" class="bg-[#FF2D20] text-white px-4 py-2 rounded-lg hover:bg-red-600 transition-colors">
        + Tambah Kategori
    </a>
</div>

<div class="ui-card overflow-hidden">
    <table class="min-w-full divide-y divide-white-200">
        <thead class="bg-white-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-white-500 uppercase tracking-wider">Nama</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-white-500 uppercase tracking-wider">Deskripsi</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-white-500 uppercase tracking-wider">Jumlah Buku</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-white-500 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-white-200">
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-white-900"><?php echo e($category->name); ?></div>
                </td>
                <td class="px-6 py-4">
                    <div class="text-sm text-white-500"><?php echo e(\Illuminate\Support\Str::limit($category->description ?? '-', 50)); ?></div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-white-900"><?php echo e($category->books_count ?? $category->books()->count() ?? 0); ?></div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <a href="<?php echo e(route('admin.categories.edit', $category->id)); ?>" class="text-[#FF2D20] hover:text-red-600 mr-4">Edit</a>
                    <form action="<?php echo e(route('admin.categories.destroy', $category->id)); ?>" method="POST" class="inline">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <div class="px-6 py-4 border-t border-white-200">
        <?php if($categories instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator): ?>
            <?php echo e($categories->links()); ?>

        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\laravel_ebook\resources\views/admin/categories/index.blade.php ENDPATH**/ ?>