

<?php $__env->startSection('title', 'Metode Pembayaran'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold text-white-900">Metode Pembayaran</h1>
    <a href="<?php echo e(route('admin.payment-methods.create')); ?>" class="bg-[#FF2D20] text-white px-4 py-2 rounded-lg hover:bg-red-600 transition-colors">
        + Tambah Metode
    </a>
</div>

<?php if(session('success')): ?>
    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>

<?php if(session('error')): ?>
    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
        <?php echo e(session('error')); ?>

    </div>
<?php endif; ?>

<div class="ui-card overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. Akun</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Biaya (%)</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            <?php $__currentLoopData = $paymentMethods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-white-900"><?php echo e($method->name); ?></div>
                    <?php if($method->description): ?>
                        <div class="text-xs text-gray-500"><?php echo e(\Illuminate\Support\Str::limit($method->description, 40)); ?></div>
                    <?php endif; ?>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                        <?php if($method->type === 'bank'): ?>
                            bg-blue-100 text-blue-800
                        <?php elseif($method->type === 'e-wallet'): ?>
                            bg-purple-100 text-purple-800
                        <?php elseif($method->type === 'cash'): ?>
                            bg-green-100 text-green-800
                        <?php else: ?>
                            bg-gray-100 text-white-900
                        <?php endif; ?>
                    ">
                        <?php echo e(ucfirst(str_replace('-', ' ', $method->type))); ?>

                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-white-900"><?php echo e($method->account_number ?? '-'); ?></div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-white-900">
                        <?php echo e(number_format($method->fee_percentage, 2)); ?>% 
                        <?php if($method->fee_fixed > 0): ?>
                            + Rp <?php echo e(number_format($method->fee_fixed, 0, ',', '.')); ?>

                        <?php endif; ?>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <form action="<?php echo e(route('admin.payment-methods.toggleActive', $method->id)); ?>" method="POST" class="inline">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PATCH'); ?>
                        <button type="submit" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full cursor-pointer
                            <?php if($method->is_active): ?>
                                bg-green-100 text-green-800 hover:bg-green-200
                            <?php else: ?>
                                bg-red-100 text-red-800 hover:bg-red-200
                            <?php endif; ?>
                        ">
                            <?php echo e($method->is_active ? 'Aktif' : 'Nonaktif'); ?>

                        </button>
                    </form>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <a href="<?php echo e(route('admin.payment-methods.show', $method->id)); ?>" class="text-[#FF2D20] hover:text-red-600 mr-4">Lihat</a>
                    <a href="<?php echo e(route('admin.payment-methods.edit', $method->id)); ?>" class="text-blue-600 hover:text-blue-800 mr-4">Edit</a>
                    <form action="<?php echo e(route('admin.payment-methods.destroy', $method->id)); ?>" method="POST" class="inline">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <div class="px-6 py-4 border-t border-gray-200">
        <?php if($paymentMethods instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator): ?>
            <?php echo e($paymentMethods->links()); ?>

        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\laravel_ebook\resources\views/admin/payment-methods/index.blade.php ENDPATH**/ ?>