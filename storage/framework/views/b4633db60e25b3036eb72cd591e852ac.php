

<?php $__env->startSection('title', 'Detail Pesanan'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-6">
    <a href="<?php echo e(route('admin.purchases.index')); ?>" class="text-[#FF2D20] hover:text-red-600">← Kembali</a>
    <h1 class="text-3xl font-bold text-gray-900 mt-2">Detail Pesanan #<?php echo e($purchase->id); ?></h1>
</div>

<?php if(session('success')): ?>
    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Main Content -->
    <div class="lg:col-span-2">
        <!-- Informasi Pesanan -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Informasi Pesanan</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="text-sm font-medium text-gray-500">ID Pesanan</label>
                    <p class="text-lg text-gray-900"><?php echo e($purchase->id); ?></p>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-500">Status</label>
                    <p class="text-lg">
                        <span class="px-3 py-1 rounded-full font-semibold
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
                    </p>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-500">Tanggal Pesanan</label>
                    <p class="text-lg text-gray-900"><?php echo e($purchase->created_at->format('d M Y H:i')); ?></p>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-500">Harga</label>
                    <p class="text-lg font-bold text-gray-900">Rp <?php echo e(number_format($purchase->price, 0, ',', '.')); ?></p>
                </div>
            </div>
        </div>

        <!-- Detail Pembeli dan Buku -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Detail Pembeli & Buku</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="font-semibold text-gray-900 mb-3">Data Pembeli</h3>
                    <p><strong>Nama:</strong> <?php echo e($purchase->user->name); ?></p>
                    <p><strong>Email:</strong> <?php echo e($purchase->user->email); ?></p>
                    <p><strong>Role:</strong> <?php echo e($purchase->user->role); ?></p>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-900 mb-3">Data Buku</h3>
                    <p><strong>Judul:</strong> <?php echo e($purchase->book->title); ?></p>
                    <p><strong>Penulis:</strong> <?php echo e($purchase->book->author ?? '-'); ?></p>
                    <p><strong>Tahun Publikasi:</strong> <?php echo e($purchase->book->publication_year ?? '-'); ?></p>
                </div>
            </div>
        </div>

        <!-- Pembayaran -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-gray-900">Pembayaran</h2>
                <button type="button" onclick="document.getElementById('addPaymentModal').classList.toggle('hidden')" 
                    class="bg-[#FF2D20] text-white px-3 py-1 rounded hover:bg-red-600 transition-colors text-sm">
                    + Tambah Pembayaran
                </button>
            </div>

            <?php if($purchase->payments->count() > 0): ?>
                <div class="space-y-3">
                    <?php $__currentLoopData = $purchase->payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="border border-gray-200 rounded-lg p-4">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="font-semibold text-gray-900"><?php echo e($payment->method); ?></p>
                                <p class="text-sm text-gray-500">
                                    ID Transaksi: <?php echo e($payment->transaction_id ?? '-'); ?>

                                </p>
                                <p class="text-sm text-gray-500">
                                    <?php echo e($payment->created_at->format('d M Y H:i')); ?>

                                </p>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-lg text-gray-900">
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
                                    <?php echo e(ucfirst($payment->status)); ?>

                                </span>
                            </div>
                        </div>
                        
                        <?php if($payment->notes): ?>
                        <p class="text-sm text-gray-600 mt-2"><strong>Catatan:</strong> <?php echo e($payment->notes); ?></p>
                        <?php endif; ?>

                        <?php if($payment->transfer_proof): ?>
                        <div class="mt-3 pt-3 border-t border-gray-200">
                            <p class="text-sm font-semibold text-gray-700 mb-2">Bukti Transfer:</p>
                            <div class="relative inline-block">
                                <img src="<?php echo e(asset('storage/' . $payment->transfer_proof)); ?>" alt="Bukti Transfer" class="max-h-40 rounded border border-gray-200 cursor-pointer" onclick="openImageModal(this.src)">
                                <span class="text-xs text-gray-500 mt-1 block">Klik untuk memperbesar</span>
                            </div>
                        </div>
                        <?php endif; ?>

                        <div class="mt-3 flex gap-2">
                            <form action="<?php echo e(route('admin.purchases.updatePaymentStatus', $purchase->id)); ?>" method="POST" class="inline">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PATCH'); ?>
                                <input type="hidden" name="payment_id" value="<?php echo e($payment->id); ?>">
                                <select name="status" onchange="this.form.submit()" class="text-xs border border-gray-300 rounded px-2 py-1">
                                    <option value="">Ubah Status</option>
                                    <option value="completed" <?php if($payment->status === 'completed'): ?> selected <?php endif; ?>>Selesai</option>
                                    <option value="pending" <?php if($payment->status === 'pending'): ?> selected <?php endif; ?>>Menunggu</option>
                                    <option value="failed" <?php if($payment->status === 'failed'): ?> selected <?php endif; ?>>Gagal</option>
                                    <option value="cancelled" <?php if($payment->status === 'cancelled'): ?> selected <?php endif; ?>>Batal</option>
                                </select>
                            </form>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <p class="text-gray-500 text-center py-4">Belum ada pembayaran</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="lg:col-span-1">
        <!-- Actions -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Aksi</h2>
            
            <div class="space-y-2">
                <a href="<?php echo e(route('admin.purchases.edit', $purchase->id)); ?>" 
                    class="block w-full text-center bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition-colors">
                    Edit Pesanan
                </a>
                <button onclick="if(confirm('Yakin ingin menghapus pesanan ini?')) document.getElementById('deleteForm').submit()" 
                    class="block w-full text-center bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition-colors">
                    Hapus Pesanan
                </button>
            </div>

            <form id="deleteForm" action="<?php echo e(route('admin.purchases.destroy', $purchase->id)); ?>" method="POST" class="hidden">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
            </form>
        </div>

        <!-- Summary -->
        <div class="bg-white rounded-lg shadow p-6 mt-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Ringkasan</h2>
            
            <div class="space-y-3">
                <div class="flex justify-between">
                    <span class="text-gray-600">Harga Buku:</span>
                    <span class="font-semibold text-gray-900">Rp <?php echo e(number_format($purchase->price, 0, ',', '.')); ?></span>
                </div>
                <?php
                    $totalPayments = $purchase->payments->sum('amount');
                    $completedPayments = $purchase->payments->where('status', 'completed')->sum('amount');
                    $remainingAmount = $purchase->price - $completedPayments;
                ?>
                <div class="flex justify-between">
                    <span class="text-gray-600">Pembayaran Selesai:</span>
                    <span class="font-semibold text-green-600">Rp <?php echo e(number_format($completedPayments, 0, ',', '.')); ?></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Total Semua Pembayaran:</span>
                    <span class="font-semibold text-gray-900">Rp <?php echo e(number_format($totalPayments, 0, ',', '.')); ?></span>
                </div>
                <div class="border-t border-gray-200 pt-3 flex justify-between">
                    <span class="text-gray-900 font-bold">Sisa Pembayaran:</span>
                    <span class="font-bold <?php if($remainingAmount <= 0): ?> text-green-600 <?php else: ?> text-red-600 <?php endif; ?>">
                        Rp <?php echo e(number_format(max(0, $remainingAmount), 0, ',', '.')); ?>

                    </span>
                </div>
                <div class="pt-2 border-t border-gray-200 mt-2">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Status Pembayaran:</span>
                        <span class="px-2 py-1 rounded text-xs font-semibold <?php if($remainingAmount <= 0): ?> bg-green-100 text-green-800 <?php else: ?> bg-yellow-100 text-yellow-800 <?php endif; ?>">
                            <?php if($remainingAmount <= 0): ?>
                                Lunas
                            <?php elseif($totalPayments > 0): ?>
                                Sebagian
                            <?php else: ?>
                                Belum Dibayar
                            <?php endif; ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Gambar Transfer Proof -->
<div id="imageModal" class="hidden fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg p-4 max-w-2xl max-h-[90vh] overflow-auto">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold text-gray-900">Bukti Transfer</h3>
            <button onclick="document.getElementById('imageModal').classList.add('hidden')" class="text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
        </div>
        <img id="modalImage" src="" alt="Bukti Transfer" class="w-full rounded">
    </div>
</div>

<script>
function openImageModal(src) {
    document.getElementById('modalImage').src = src;
    document.getElementById('imageModal').classList.remove('hidden');
}

document.getElementById('imageModal').addEventListener('click', function(e) {
    if (e.target === this) {
        this.classList.add('hidden');
    }
});
</script>

<!-- Modal Tambah Pembayaran -->
<div id="addPaymentModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-96">
        <h3 class="text-xl font-bold text-gray-900 mb-4">Tambah Pembayaran</h3>
        
        <form action="<?php echo e(route('admin.purchases.createPayment', $purchase->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Metode Pembayaran</label>
                <input type="text" name="method" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#FF2D20]">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah (Rp)</label>
                <input type="number" name="amount" step="0.01" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#FF2D20]">
            </div>

            <div class="flex gap-2">
                <button type="button" onclick="document.getElementById('addPaymentModal').classList.toggle('hidden')" 
                    class="flex-1 border border-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-50 transition-colors">
                    Batal
                </button>
                <button type="submit" class="flex-1 bg-[#FF2D20] text-white px-4 py-2 rounded hover:bg-red-600 transition-colors">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\laravel\laravel_ebook\resources\views/admin/purchases/show.blade.php ENDPATH**/ ?>