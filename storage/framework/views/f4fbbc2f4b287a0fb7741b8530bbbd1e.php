

<?php $__env->startSection('title', 'Detail Langganan'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-6">
    <a href="<?php echo e(route('admin.subscriptions.index')); ?>" class="text-[#FF2D20] hover:text-red-600">← Kembali</a>
    <h1 class="text-3xl font-bold text-white-900 mt-2">Detail Langganan #<?php echo e($subscription->id); ?></h1>
</div>

<?php if(session('success')): ?>
    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Main Content -->
    <div class="lg:col-span-2">
        <!-- Informasi Langganan -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <h2 class="text-xl font-bold text-white-900 mb-4">Informasi Langganan</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="text-sm font-medium text-white-500">ID</label>
                    <p class="text-lg text-white-900"><?php echo e($subscription->id); ?></p>
                </div>
                <div>
                    <label class="text-sm font-medium text-white-500">Status</label>
                    <p class="text-lg">
                        <span class="px-3 py-1 rounded-full font-semibold
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
                    </p>
                </div>
                <div>
                    <label class="text-sm font-medium text-white-500">Paket</label>
                    <p class="text-lg text-white-900"><?php echo e($subscription->plan === 'monthly' ? 'Bulanan' : 'Tahunan'); ?></p>
                </div>
                <div>
                    <label class="text-sm font-medium text-white-500">Harga</label>
                    <p class="text-lg font-bold text-white-900">Rp <?php echo e(number_format($subscription->amount, 0, ',', '.')); ?></p>
                </div>
                <div>
                    <label class="text-sm font-medium text-white-500">Mulai</label>
                    <p class="text-lg text-white-900"><?php echo e($subscription->started_at?->format('d M Y') ?? '-'); ?></p>
                </div>
                <div>
                    <label class="text-sm font-medium text-white-500">Berakhir</label>
                    <p class="text-lg text-white-900"><?php echo e($subscription->expires_at?->format('d M Y') ?? '-'); ?></p>
                </div>
            </div>
        </div>

        <!-- Data Pengguna -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <h2 class="text-xl font-bold text-white-900 mb-4">Data Pengguna</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="text-sm font-medium text-white-500">Nama</label>
                    <p class="text-lg text-white-900"><?php echo e($subscription->user->name); ?></p>
                </div>
                <div>
                    <label class="text-sm font-medium text-white-500">Email</label>
                    <p class="text-lg text-white-900"><?php echo e($subscription->user->email); ?></p>
                </div>
                <div>
                    <label class="text-sm font-medium text-white-500">Role</label>
                    <p class="text-lg text-white-900"><?php echo e($subscription->user->role); ?></p>
                </div>
                <div>
                    <label class="text-sm font-medium text-white-500">Bergabung Sejak</label>
                    <p class="text-lg text-white-900"><?php echo e($subscription->user->created_at->format('d M Y')); ?></p>
                </div>
            </div>
        </div>

        <!-- Pembayaran -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-white-900 mb-4">Pembayaran</h2>

            <?php if($subscription->payments->count() > 0): ?>
                <div class="space-y-3">
                    <?php $__currentLoopData = $subscription->payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="border border-white-200 rounded-lg p-4">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="font-semibold text-white-900"><?php echo e($payment->method); ?></p>
                                <p class="text-sm text-white-500">
                                    ID Transaksi: <?php echo e($payment->transaction_id ?? '-'); ?>

                                </p>
                                <p class="text-sm text-white-500">
                                    <?php echo e($payment->created_at->format('d M Y H:i')); ?>

                                </p>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-lg text-white-900">
                                    Rp <?php echo e(number_format($payment->amount, 0, ',', '.')); ?>

                                </p>
                                <span class="text-xs px-2 py-1 rounded
                                    <?php if($payment->status === 'completed'): ?>
                                        bg-green-100 text-green-800
                                    <?php elseif($payment->status === 'pending'): ?>
                                        bg-yellow-100 text-yellow-800
                                    <?php else: ?>
                                        bg-red-100 text-red-800
                                    <?php endif; ?>
                                ">
                                    <?php if($payment->status === 'completed'): ?>
                                        Selesai
                                    <?php elseif($payment->status === 'pending'): ?>
                                        Tertunda
                                    <?php else: ?>
                                        Gagal
                                    <?php endif; ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <p class="text-white-500">Belum ada pembayaran</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Sidebar -->
    <div>
        <!-- Aksi -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <h2 class="text-xl font-bold text-white-900 mb-4">Aksi</h2>
            
            <div class="flex flex-col gap-3">
                <a href="<?php echo e(route('admin.subscriptions.edit', $subscription->id)); ?>" class="bg-[#FF2D20] text-white px-4 py-2 rounded-lg hover:bg-red-600 transition-colors text-center">
                    Edit
                </a>
                
                <form action="<?php echo e(route('admin.subscriptions.destroy', $subscription->id)); ?>" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="w-full bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors">
                        Hapus
                    </button>
                </form>
            </div>
        </div>

        <!-- Ubah Status -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-white-900 mb-4">Ubah Status</h2>
            
            <form action="<?php echo e(route('admin.subscriptions.updateStatus', $subscription->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PATCH'); ?>
                
                <div class="mb-4">
                    <select name="status" class="w-full border border-white-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#FF2D20]" required>
                        <option value="pending" <?php echo e($subscription->status === 'pending' ? 'selected' : ''); ?>>Tertunda</option>
                        <option value="active" <?php echo e($subscription->status === 'active' ? 'selected' : ''); ?>>Aktif</option>
                        <option value="expired" <?php echo e($subscription->status === 'expired' ? 'selected' : ''); ?>>Berakhir</option>
                        <option value="cancelled" <?php echo e($subscription->status === 'cancelled' ? 'selected' : ''); ?>>Dibatalkan</option>
                    </select>
                </div>
                
                <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                    Perbarui Status
                </button>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\laravel_ebook\resources\views/admin/subscriptions/show.blade.php ENDPATH**/ ?>