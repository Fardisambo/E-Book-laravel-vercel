

<?php $__env->startSection('title', 'Pesanan Buku'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Pesanan Buku</h1>
    <div class="flex gap-3">
        <a href="<?php echo e(route('admin.purchases.create')); ?>" class="bg-[#FF2D20] text-white px-4 py-2 rounded-lg hover:bg-red-600 transition-colors">
            + Pesanan Baru
        </a>
    </div>
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

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pembeli</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Buku</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pembayaran</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            <?php $__currentLoopData = $purchases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $purchase): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900">#<?php echo e($purchase->id); ?></div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900"><?php echo e($purchase->user->name); ?></div>
                    <div class="text-xs text-gray-500"><?php echo e($purchase->user->email); ?></div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900"><?php echo e($purchase->book->title); ?></div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900">Rp <?php echo e(number_format($purchase->price, 0, ',', '.')); ?></div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                        <?php if($purchase->status === 'completed'): ?>
                            bg-green-100 text-green-800
                        <?php elseif($purchase->status === 'pending'): ?>
                            bg-yellow-100 text-yellow-800
                        <?php elseif($purchase->status === 'failed'): ?>
                            bg-red-100 text-red-800
                        <?php elseif($purchase->status === 'cancelled'): ?>
                            bg-gray-100 text-gray-800
                        <?php endif; ?>
                    ">
                        <?php echo e(ucfirst($purchase->status)); ?>

                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <?php if($purchase->payments()->count() > 0): ?>
                        <div class="text-xs">
                            <?php $__currentLoopData = $purchase->payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span class="inline-block px-2 py-1 rounded
                                    <?php if($payment->status === 'completed'): ?>
                                        bg-green-100 text-green-800
                                    <?php elseif($payment->status === 'pending'): ?>
                                        bg-yellow-100 text-yellow-800
                                    <?php else: ?>
                                        bg-red-100 text-red-800
                                    <?php endif; ?>
                                ">
                                    <?php echo e($payment->method); ?>

                                </span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php else: ?>
                        <span class="text-xs text-gray-500">Belum ada</span>
                    <?php endif; ?>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-500"><?php echo e($purchase->created_at->format('d M Y')); ?></div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <a href="<?php echo e(route('admin.purchases.show', $purchase->id)); ?>" class="text-[#FF2D20] hover:text-red-600 mr-4">Lihat</a>
                    <a href="<?php echo e(route('admin.purchases.edit', $purchase->id)); ?>" class="text-blue-600 hover:text-blue-800 mr-4">Edit</a>
                    <form action="<?php echo e(route('admin.purchases.destroy', $purchase->id)); ?>" method="POST" class="inline">
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
        <?php if($purchases instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator): ?>
            <?php echo e($purchases->links()); ?>

        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\laravel\laravel_ebook\resources\views/admin/purchases/index.blade.php ENDPATH**/ ?>