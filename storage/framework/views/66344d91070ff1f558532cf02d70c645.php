

<?php $__env->startSection('title', 'Langganan'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
    <div>
        <h1 class="text-3xl font-bold text-white-900">Langganan</h1>
        <p class="text-sm text-white-600 mt-1">Kelola langganan pengguna, filter dan ubah halaman per daftar.</p>
    </div>
    <div class="flex gap-3 mt-4 md:mt-0">
        <a href="<?php echo e(route('admin.subscriptions.create')); ?>" class="bg-[#FF2D20] text-white px-4 py-2 rounded-lg hover:bg-red-600 transition-colors">
            + Langganan Baru
        </a>
    </div>
</div>

<div class="ui-card p-3 sm:p-4 mb-6">
    <h2 class="text-lg font-semibold text-white-900 mb-1">Pengaturan Paket Langganan</h2>
    <p class="text-xs text-white-600 mb-3">Atur harga dan deskripsi paket yang ditampilkan ke user.</p>
    <form method="POST" action="<?php echo e(route('admin.subscriptions.updatePlans')); ?>" class="grid grid-cols-1 gap-2 lg:grid-cols-2 lg:gap-4">
        <?php echo csrf_field(); ?>
        <?php
            $monthly = $plans->firstWhere('plan', 'monthly');
            $yearly = $plans->firstWhere('plan', 'yearly');
        ?>
        <div class="ui-card p-3">
            <h3 class="font-semibold text-white-900 mb-2 text-base">Paket Bulanan</h3>
            <label class="block text-xs text-white-600 mb-1">Harga</label>
            <input type="number" min="0" step="0.01" name="plans[monthly][price]" value="<?php echo e(old('plans.monthly.price', $monthly->price ?? 50000)); ?>" class="ui-input mb-2 px-2 py-1 text-xs" required>
            <label class="block text-xs text-white-600 mb-1">Deskripsi</label>
            <textarea name="plans[monthly][description]" rows="2" class="ui-textarea px-2 py-1 text-xs"><?php echo e(old('plans.monthly.description', $monthly->description ?? '')); ?></textarea>
        </div>
        <div class="ui-card p-3">
            <h3 class="font-semibold text-white-900 mb-2 text-base">Paket Tahunan</h3>
            <label class="block text-xs text-white-600 mb-1">Harga</label>
            <input type="number" min="0" step="0.01" name="plans[yearly][price]" value="<?php echo e(old('plans.yearly.price', $yearly->price ?? 500000)); ?>" class="ui-input mb-2 px-2 py-1 text-xs" required>
            <label class="block text-xs text-white-600 mb-1">Deskripsi</label>
            <textarea name="plans[yearly][description]" rows="2" class="ui-textarea px-2 py-1 text-xs"><?php echo e(old('plans.yearly.description', $yearly->description ?? '')); ?></textarea>
        </div>
        <div class="lg:col-span-2">
            <button type="submit" class="ui-btn-primary w-full py-2 text-xs">Simpan Pengaturan Paket</button>
        </div>
    </form>
</div>


<form method="GET" class="mb-6 grid grid-cols-1 md:grid-cols-4 gap-4">
    <div>
        <input type="text" name="user" value="<?php echo e(request('user')); ?>" placeholder="Cari nama pengguna..."
               class="w-full border border-white-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#FF2D20]" />
    </div>
    <div>
        <select name="status" class="w-full border border-white-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#FF2D20]">
            <option value="">-- Semua Status --</option>
            <option value="pending" <?php echo e(request('status') == 'pending' ? 'selected' : ''); ?>>Tertunda</option>
            <option value="active" <?php echo e(request('status') == 'active' ? 'selected' : ''); ?>>Aktif</option>
            <option value="expired" <?php echo e(request('status') == 'expired' ? 'selected' : ''); ?>>Berakhir</option>
            <option value="cancelled" <?php echo e(request('status') == 'cancelled' ? 'selected' : ''); ?>>Dibatalkan</option>
        </select>
    </div>
    <div>
        <select name="per_page" class="w-full border border-white-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#FF2D20]">
            <option value="10" <?php echo e(request('per_page')==10 ? 'selected' : ''); ?>>10 per halaman</option>
            <option value="20" <?php echo e(request('per_page')==20 ? 'selected' : ''); ?>>20 per halaman</option>
            <option value="50" <?php echo e(request('per_page')==50 ? 'selected' : ''); ?>>50 per halaman</option>
            <option value="100" <?php echo e(request('per_page')==100 ? 'selected' : ''); ?>>100 per halaman</option>
        </select>
    </div>
    <div class="flex items-center">
        <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
            Terapkan
        </button>
    </div>
</form>

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
    <table class="min-w-full divide-y divide-white-200">
        <thead class="bg-white-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-white-500 uppercase tracking-wider">ID</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-white-500 uppercase tracking-wider">Pengguna</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-white-500 uppercase tracking-wider">Paket</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-white-500 uppercase tracking-wider">Harga</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-white-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-white-500 uppercase tracking-wider">Mulai</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-white-500 uppercase tracking-wider">Berakhir</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-white-500 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-white-200">
            <?php $__empty_1 = true; $__currentLoopData = $subscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-white-900">#<?php echo e($subscription->id); ?></div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-white-900"><?php echo e($subscription->user->name); ?></div>
                    <div class="text-xs text-white-500"><?php echo e($subscription->user->email); ?></div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-white-900"><?php echo e($subscription->plan === 'monthly' ? 'Bulanan' : 'Tahunan'); ?></div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-white-900">Rp <?php echo e(number_format($subscription->amount, 0, ',', '.')); ?></div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                        <?php if($subscription->status === 'active'): ?>
                            bg-green-100 text-green-800
                        <?php elseif($subscription->status === 'pending'): ?>
                            bg-yellow-100 text-yellow-800
                        <?php elseif($subscription->status === 'expired'): ?>
                            bg-white-100 text-white-800
                        <?php elseif($subscription->status === 'cancelled'): ?>
                            bg-red-100 text-red-800
                        <?php endif; ?>
                    ">
                        <?php if($subscription->status === 'active'): ?>
                            Aktif
                        <?php elseif($subscription->status === 'pending'): ?>
                            Tertunda
                        <?php elseif($subscription->status === 'expired'): ?>
                            Berakhir
                        <?php elseif($subscription->status === 'cancelled'): ?>
                            Dibatalkan
                        <?php endif; ?>
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-white-900"><?php echo e($subscription->started_at?->format('d M Y') ?? '-'); ?></div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-white-900"><?php echo e($subscription->expires_at?->format('d M Y') ?? '-'); ?></div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <a href="<?php echo e(route('admin.subscriptions.show', $subscription->id)); ?>" class="text-[#FF2D20] hover:text-red-600 mr-3">Lihat</a>
                    <a href="<?php echo e(route('admin.subscriptions.edit', $subscription->id)); ?>" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                    <form action="<?php echo e(route('admin.subscriptions.destroy', $subscription->id)); ?>" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="8" class="px-6 py-4 text-center text-white-500">Tidak ada data</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="mt-6">
    <?php echo e($subscriptions->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\laravel_ebook\resources\views/admin/subscriptions/index.blade.php ENDPATH**/ ?>