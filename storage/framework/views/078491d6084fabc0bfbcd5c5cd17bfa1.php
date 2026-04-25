

<?php $__env->startSection('title', 'Metode Pembayaran Saya'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-5xl mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Metode Pembayaran Saya</h1>
    <div class="mb-4">
        <a href="<?php echo e(route('author.payment-methods.create')); ?>" class="px-4 py-2 rounded-lg bg-amber-600 text-white font-semibold hover:bg-amber-700 transition">Tambah Metode</a>
    </div>
    <?php if(session('success')): ?>
        <div class="glass-panel rounded-xl border border-emerald-500/30 px-4 py-3 text-sm text-emerald-200 flex items-start gap-3 mb-4">
            <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-400 mt-0.5"></i>
            <p><?php echo e(session('success')); ?></p>
        </div>
    <?php endif; ?>
    <div class="glass-panel rounded-xl p-0 border border-white/10 overflow-x-auto">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-white/10">
                <tr>
                    <th class="px-6 py-3 font-semibold text-gray-200">Nama</th>
                    <th class="px-6 py-3 font-semibold text-gray-200">No. Rekening/ID</th>
                    <th class="px-6 py-3 font-semibold text-gray-200">Atas Nama</th>
                    <th class="px-6 py-3 font-semibold text-gray-200">Jenis</th>
                    <th class="px-6 py-3 font-semibold text-gray-200">Status</th>
                    <th class="px-6 py-3 font-semibold text-gray-200">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $methods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="border-b border-white/5 hover:bg-white/5 transition">
                    <td class="px-6 py-3"><?php echo e($method->name); ?></td>
                    <td class="px-6 py-3"><?php echo e($method->account_number); ?></td>
                    <td class="px-6 py-3"><?php echo e($method->account_name); ?></td>
                    <td class="px-6 py-3"><?php echo e($method->type); ?></td>
                    <td class="px-6 py-3">
                        <span class="inline-block px-2 py-1 rounded text-xs <?php echo e($method->is_active ? 'bg-emerald-700 text-emerald-100' : 'bg-gray-700 text-gray-300'); ?>">
                            <?php echo e($method->is_active ? 'Aktif' : 'Nonaktif'); ?>

                        </span>
                    </td>
                    <td class="px-6 py-3 space-x-2">
                        <a href="<?php echo e(route('author.payment-methods.edit', $method->id)); ?>" class="px-3 py-1 rounded bg-amber-500 text-slate-900 font-semibold hover:bg-amber-600 transition">Edit</a>
                        <form action="<?php echo e(route('author.payment-methods.destroy', $method->id)); ?>" method="POST" class="inline">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="px-3 py-1 rounded bg-red-600 text-white font-semibold hover:bg-red-700 transition" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="6" class="text-center text-gray-400 py-8">Belum ada metode pembayaran.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\laravel\laravel_ebook\resources\views/author/payment_methods/index.blade.php ENDPATH**/ ?>