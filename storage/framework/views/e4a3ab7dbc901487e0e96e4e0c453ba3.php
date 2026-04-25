

<?php $__env->startSection('title', 'Pembayaran'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto px-4 py-8 space-y-6">
    <div class="glass-panel rounded-3xl border border-white/10 p-6 sm:p-8">
        <?php $selectedMethod = $payment->paymentMethod ?? $payment->authorPaymentMethod; ?>
        <div class="flex items-center justify-between gap-3 mb-6">
            <div>
                <h1 class="font-serif text-2xl sm:text-3xl text-white flex items-center gap-2">
                    <i data-lucide="receipt" class="w-6 h-6 text-amber-300"></i>
                    Detail Pembayaran
                </h1>
                <p class="text-xs sm:text-sm text-gray-400 mt-1">
                    Informasi lengkap transaksi dan status pesanan Anda.
                </p>
            </div>
            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-[11px] font-semibold
                <?php if($payment->status === 'completed'): ?>
                    bg-emerald-500/15 text-emerald-200 border border-emerald-500/40
                <?php elseif($payment->status === 'failed'): ?>
                    bg-red-500/15 text-red-200 border border-red-500/40
                <?php else: ?>
                    bg-amber-500/15 text-amber-200 border border-amber-500/40
                <?php endif; ?>">
                <i data-lucide="circle-dot" class="w-3 h-3"></i>
                <?php echo e(ucfirst($payment->status)); ?>

            </span>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            <!-- Detail Pembayaran -->
            <div>
                <h2 class="font-serif text-lg text-white mb-3">Informasi Pembayaran</h2>
                <div class="space-y-4 glass-panel rounded-2xl border border-white/10 p-4 text-sm text-gray-200">
                    <div>
                        <p class="text-[11px] text-gray-400 mb-1 uppercase tracking-[0.15em]">Transaction ID</p>
                        <p class="font-mono font-medium text-gray-100 break-all"><?php echo e($payment->transaction_id); ?></p>
                    </div>
                    
                    <div class="border-t border-white/10 pt-3">
                        <p class="text-[11px] text-gray-400 mb-1 uppercase tracking-[0.15em]">Status Pembayaran</p>
                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-[11px] font-semibold
                            <?php if($payment->status === 'completed'): ?>
                                bg-emerald-500/15 text-emerald-200 border border-emerald-500/40
                            <?php elseif($payment->status === 'failed'): ?>
                                bg-red-500/15 text-red-200 border border-red-500/40
                            <?php else: ?>
                                bg-amber-500/15 text-amber-200 border border-amber-500/40
                            <?php endif; ?>">
                            <i data-lucide="circle" class="w-3 h-3"></i>
                            <?php echo e(ucfirst($payment->status)); ?>

                        </span>
                    </div>

                    <div class="border-t border-white/10 pt-3">
                        <p class="text-[11px] text-gray-400 mb-1 uppercase tracking-[0.15em]">Metode Pembayaran</p>
                        <div class="flex items-center gap-2 text-sm">
                            <span class="font-medium text-gray-100"><?php echo e($payment->method); ?></span>
                            <?php if($selectedMethod): ?>
                                <span class="inline-block px-2 py-1 text-[11px] font-semibold rounded
                                    <?php if($selectedMethod->type === 'bank'): ?>
                                        bg-blue-100 text-blue-800
                                    <?php elseif($selectedMethod->type === 'e-wallet'): ?>
                                        bg-purple-100 text-purple-800
                                    <?php elseif($selectedMethod->type === 'qris'): ?>
                                        bg-emerald-100 text-emerald-800
                                    <?php elseif($selectedMethod->type === 'cash'): ?>
                                        bg-green-100 text-green-800
                                    <?php else: ?>
                                        bg-gray-100 text-gray-800
                                    <?php endif; ?>
                                ">
                                    <?php echo e(ucfirst(str_replace('-', ' ', $selectedMethod->type))); ?>

                                </span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <?php if($selectedMethod && ($selectedMethod->account_number || ($selectedMethod->account_holder ?? $selectedMethod->account_name))): ?>
                    <div class="border-t border-white/10 pt-3">
                        <p class="text-[11px] text-gray-400 mb-2 uppercase tracking-[0.15em]">Rekening / Akun Tujuan</p>
                        <div class="p-3 bg-black/30 border border-white/10 rounded-xl space-y-1">
                            <?php if($selectedMethod->account_number): ?>
                            <div class="flex justify-between items-center gap-2">
                                <span class="text-xs text-gray-300">
                                    <?php if($selectedMethod->type === 'bank'): ?>
                                        No. Rekening
                                    <?php elseif($selectedMethod->type === 'e-wallet'): ?>
                                        No. Telepon / ID Akun
                                    <?php else: ?>
                                        No. Rekening / Akun
                                    <?php endif; ?>
                                </span>
                                <span class="font-mono font-semibold text-gray-100 text-sm"><?php echo e($selectedMethod->account_number); ?></span>
                            </div>
                            <?php endif; ?>
                            <?php if(($selectedMethod->account_holder ?? $selectedMethod->account_name)): ?>
                            <div class="flex justify-between items-center gap-2">
                                <span class="text-xs text-gray-300">Atas Nama</span>
                                <span class="font-semibold text-gray-100 text-xs"><?php echo e($selectedMethod->account_holder ?? $selectedMethod->account_name); ?></span>
                            </div>
                            <?php endif; ?>
                            <?php if($selectedMethod->description): ?>
                            <p class="text-[11px] text-gray-400 mt-2 pt-2 border-t border-white/5"><?php echo e($selectedMethod->description); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <div class="border-t border-white/10 pt-3">
                        <p class="text-[11px] text-gray-400 mb-1 uppercase tracking-[0.15em]">Jumlah</p>
                        <p class="text-2xl font-semibold text-amber-300">Rp <?php echo e(number_format($payment->amount, 0, ',', '.')); ?></p>
                    </div>

                    <?php if($payment->paid_at): ?>
                    <div class="border-t border-white/10 pt-3">
                        <p class="text-[11px] text-gray-400 mb-1 uppercase tracking-[0.15em]">Waktu Pembayaran</p>
                        <p class="text-sm font-medium text-gray-100"><?php echo e($payment->paid_at->format('d M Y H:i')); ?></p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Informasi Produk -->
            <div>
                <h2 class="font-serif text-lg text-white mb-3">Informasi Pembelian</h2>
                <div class="space-y-4 glass-panel rounded-2xl border border-white/10 p-4 text-sm text-gray-200">
                    <?php if(isset($purchase)): ?>
                        <div>
                            <p class="text-[11px] text-gray-400 mb-1 uppercase tracking-[0.15em]">Jenis Pesanan</p>
                            <p class="font-medium text-gray-100">Pembelian Buku</p>
                        </div>
                        
                        <div class="border-t border-white/10 pt-3">
                            <p class="text-[11px] text-gray-400 mb-1 uppercase tracking-[0.15em]">Judul Buku</p>
                            <p class="font-semibold text-gray-100"><?php echo e($purchase->book->title); ?></p>
                        </div>

                        <?php if($purchase->book->author): ?>
                        <div>
                            <p class="text-[11px] text-gray-400 mb-1 uppercase tracking-[0.15em]">Penulis</p>
                            <p class="font-medium text-gray-100"><?php echo e($purchase->book->author); ?></p>
                        </div>
                        <?php endif; ?>

                        <div class="border-t border-white/10 pt-3">
                            <p class="text-[11px] text-gray-400 mb-1 uppercase tracking-[0.15em]">Harga Buku</p>
                            <p class="font-medium text-gray-100">Rp <?php echo e(number_format($purchase->price, 0, ',', '.')); ?></p>
                        </div>

                        <div class="border-t border-white/10 pt-3">
                            <p class="text-[11px] text-gray-400 mb-1 uppercase tracking-[0.15em]">Status Pesanan</p>
                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-[11px] font-semibold
                                <?php if($purchase->status === 'completed'): ?>
                                    bg-emerald-500/15 text-emerald-200 border border-emerald-500/40
                                <?php elseif($purchase->status === 'pending'): ?>
                                    bg-amber-500/15 text-amber-200 border border-amber-500/40
                                <?php else: ?>
                                    bg-red-500/15 text-red-200 border border-red-500/40
                                <?php endif; ?>
                            ">
                                <?php echo e(ucfirst($purchase->status)); ?>

                            </span>
                        </div>

                        <?php if($purchase->status === 'completed'): ?>
                        <div class="border-t border-white/10 pt-3">
                            <a href="<?php echo e(route('books.read', $purchase->book->id)); ?>" class="inline-flex items-center gap-2 bg-gradient-to-r from-amber-600 to-amber-500 text-black px-4 py-2 rounded-full hover:shadow-lg hover:shadow-amber-500/25 transition-colors text-sm font-medium">
                                <i data-lucide="book-open" class="w-4 h-4"></i>
                                Baca Buku Sekarang
                            </a>
                        </div>
                        <?php endif; ?>

                    <?php elseif(isset($subscription)): ?>
                        <div>
                            <p class="text-[11px] text-gray-400 mb-1 uppercase tracking-[0.15em]">Jenis Pesanan</p>
                            <p class="font-medium text-gray-100">Langganan Premium</p>
                        </div>
                        
                        <div class="border-t border-white/10 pt-3">
                            <p class="text-[11px] text-gray-400 mb-1 uppercase tracking-[0.15em]">Paket</p>
                            <p class="font-semibold text-gray-100">
                                <?php echo e(ucfirst($subscription->plan)); ?> 
                                <?php if($subscription->plan === 'monthly'): ?>
                                    (1 Bulan)
                                <?php else: ?>
                                    (1 Tahun)
                                <?php endif; ?>
                            </p>
                        </div>

                        <div class="border-t border-white/10 pt-3">
                            <p class="text-[11px] text-gray-400 mb-1 uppercase tracking-[0.15em]">Harga Langganan</p>
                            <p class="font-medium text-gray-100">Rp <?php echo e(number_format($subscription->amount, 0, ',', '.')); ?></p>
                        </div>

                        <div class="border-t border-white/10 pt-3">
                            <p class="text-[11px] text-gray-400 mb-1 uppercase tracking-[0.15em]">Status Langganan</p>
                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-[11px] font-semibold
                                <?php if($subscription->status === 'active'): ?>
                                    bg-emerald-500/15 text-emerald-200 border border-emerald-500/40
                                <?php elseif($subscription->status === 'pending'): ?>
                                    bg-amber-500/15 text-amber-200 border border-amber-500/40
                                <?php else: ?>
                                    bg-red-500/15 text-red-200 border border-red-500/40
                                <?php endif; ?>
                            ">
                                <?php echo e(ucfirst($subscription->status)); ?>

                            </span>
                        </div>

                        <?php if($subscription->expires_at && $subscription->status === 'active'): ?>
                        <div class="border-t border-white/10 pt-3">
                            <p class="text-[11px] text-gray-400 mb-1 uppercase tracking-[0.15em]">Berlaku Sampai</p>
                            <p class="font-medium text-gray-100"><?php echo e($subscription->expires_at->format('d M Y')); ?></p>
                        </div>
                        <?php endif; ?>
                    <?php else: ?>
                        <div class="flex flex-col items-center justify-center py-6 text-center text-xs text-gray-400">
                            <p>Detail pesanan tidak tersedia.</p>
                            <p class="mt-1">Jika ini kesalahan, hubungi customer service.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <?php if($selectedMethod && $selectedMethod->type === 'qris' && $payment->status === 'pending'): ?>
        <!-- QRIS: Tampilkan kode QR sesuai jumlah pembayaran -->
        <div class="mt-6 glass-panel rounded-2xl border border-emerald-500/30 p-5">
            <h3 class="text-sm sm:text-base font-semibold text-white mb-1 flex items-center gap-2">
                <span class="text-lg">📱</span> Bayar dengan QRIS
            </h3>
            <p class="text-xs text-gray-400 mb-4">
                Scan QR code dengan aplikasi e-wallet (GoPay, OVO, Dana, dll.) atau mobile banking untuk membayar.
            </p>
            <div class="flex flex-col sm:flex-row items-start gap-5">
                <div class="flex-shrink-0 p-3 bg-black/40 rounded-xl border border-white/10">
                    <img src="<?php echo e(route('payments.qrcode', $payment)); ?>" alt="QRIS" width="220" height="220" class="w-[220px] h-[220px] block" />
                </div>
                <div class="space-y-2 text-sm text-gray-200">
                    <div>
                        <p class="text-[11px] text-gray-400 mb-1 uppercase tracking-[0.15em]">Jumlah yang harus dibayar</p>
                        <p class="text-xl font-semibold text-amber-300">Rp <?php echo e(number_format($payment->amount, 0, ',', '.')); ?></p>
                    </div>
                    <p class="text-[11px] text-gray-500 mt-1">
                        Transaction: <?php echo e($payment->transaction_id); ?>

                    </p>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Upload Bukti Pembayaran -->
        <?php if($payment->status === 'pending'): ?>
        <div class="mt-6 glass-panel rounded-2xl border border-blue-500/30 p-5">
            <h3 class="text-sm sm:text-base font-semibold text-white mb-1 flex items-center gap-2">
                <i data-lucide="upload" class="w-5 h-5 text-blue-300"></i>
                Upload Bukti Pembayaran
            </h3>
            <p class="text-xs text-gray-400 mb-4">
                <?php if($payment->transfer_proof): ?>
                    Anda sudah mengunggah bukti pembayaran. Anda dapat menggantinya dengan bukti pembayaran yang baru.
                <?php else: ?>
                    Unggah bukti transfer atau screenshot pembayaran Anda untuk mempercepat proses konfirmasi.
                <?php endif; ?>
            </p>
            
            <!-- Display existing transfer proof -->
            <?php if($payment->transfer_proof): ?>
            <div class="mb-4 pb-4 border-b border-white/10">
                <p class="text-[11px] text-gray-400 mb-2 uppercase tracking-[0.15em]">Bukti Pembayaran Saat Ini</p>
                <div class="p-3 bg-black/30 border border-white/10 rounded-xl overflow-hidden">
                    <img src="<?php echo e(asset('storage/' . $payment->transfer_proof)); ?>" alt="Bukti Pembayaran" class="max-h-48 object-contain rounded" />
                </div>
            </div>
            <?php endif; ?>

            <form action="<?php echo e(route('payments.upload-proof', $payment->id)); ?>" method="POST" enctype="multipart/form-data" class="space-y-3">
                <?php echo csrf_field(); ?>
                <div class="space-y-2">
                    <label for="transfer_proof" class="block text-sm font-medium text-gray-200">
                        Pilih Gambar Bukti Pembayaran
                    </label>
                    <div class="relative">
                        <input 
                            type="file" 
                            name="transfer_proof" 
                            id="transfer_proof" 
                            accept="image/*"
                            class="hidden"
                            required
                        />
                        <label for="transfer_proof" class="flex items-center justify-center gap-2 px-4 py-3 border-2 border-dashed border-blue-500/40 rounded-xl bg-blue-500/5 hover:bg-blue-500/10 cursor-pointer transition-colors text-sm text-gray-300">
                            <i data-lucide="image" class="w-5 h-5"></i>
                            <span id="file-name">Klik untuk memilih gambar atau drag & drop</span>
                        </label>
                    </div>
                    <p class="text-[11px] text-gray-500">
                        Format: JPEG, PNG, JPG, GIF | Ukuran maksimal: 5MB
                    </p>
                    <?php $__errorArgs = ['transfer_proof'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-[11px] text-red-400"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <button type="submit" class="w-full inline-flex items-center justify-center gap-2 bg-gradient-to-r from-blue-600 to-blue-500 text-white px-4 py-2.5 rounded-full hover:shadow-lg hover:shadow-blue-500/25 transition-colors text-sm font-medium">
                    <i data-lucide="upload" class="w-4 h-4"></i>
                    Upload Bukti Pembayaran
                </button>
            </form>

            <script>
                const fileInput = document.getElementById('transfer_proof');
                const fileName = document.getElementById('file-name');
                const dropZone = fileInput.parentElement.parentElement;

                fileInput.addEventListener('change', function(e) {
                    if (this.files && this.files[0]) {
                        fileName.textContent = this.files[0].name;
                    }
                });

                // Drag & drop
                ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                    dropZone.addEventListener(eventName, preventDefaults, false);
                });

                function preventDefaults(e) {
                    e.preventDefault();
                    e.stopPropagation();
                }

                ['dragenter', 'dragover'].forEach(eventName => {
                    dropZone.addEventListener(eventName, () => {
                        dropZone.classList.add('bg-blue-500/20', 'border-blue-500');
                    }, false);
                });

                ['dragleave', 'drop'].forEach(eventName => {
                    dropZone.addEventListener(eventName, () => {
                        dropZone.classList.remove('bg-blue-500/20', 'border-blue-500');
                    }, false);
                });

                dropZone.addEventListener('drop', handleDrop, false);

                function handleDrop(e) {
                    const dt = e.dataTransfer;
                    const files = dt.files;
                    fileInput.files = files;
                    
                    if (files && files[0]) {
                        fileName.textContent = files[0].name;
                    }
                }
            </script>
        </div>
        <?php endif; ?>

        <!-- Status Message -->
        <div class="mt-6">
            <?php if($payment->status === 'pending'): ?>
                <div class="glass-panel rounded-2xl border border-amber-500/40 p-4 text-xs text-amber-100 space-y-2">
                    <p class="font-semibold flex items-center gap-2 text-amber-200">
                        <span>⏳</span> Pembayaran Menunggu Konfirmasi
                    </p>
                    <p>
                        Pembayaran Anda telah dicatat. Admin akan segera mengkonfirmasi pembayaran Anda. 
                        Status akan berubah menjadi "Completed" setelah konfirmasi.
                    </p>
                    <p class="text-[11px] text-amber-200/80">
                        <strong>Catatan:</strong> Biasanya konfirmasi dilakukan dalam 1-24 jam.
                    </p>
                </div>
            <?php elseif($payment->status === 'completed'): ?>
                <div class="glass-panel rounded-2xl border border-emerald-500/40 p-4 text-xs text-emerald-100 space-y-2">
                    <p class="font-semibold flex items-center gap-2 text-emerald-200">
                        <span>✅</span> Pembayaran Berhasil
                    </p>
                    <p>
                        Terima kasih! Pembayaran Anda telah berhasil dikonfirmasi. 
                        <?php if(isset($purchase)): ?>
                            Anda sekarang dapat membaca buku yang Anda beli.
                        <?php elseif(isset($subscription)): ?>
                            Langganan premium Anda sudah aktif.
                        <?php endif; ?>
                    </p>
                </div>
            <?php elseif($payment->status === 'failed'): ?>
                <div class="glass-panel rounded-2xl border border-red-500/40 p-4 text-xs text-red-100 space-y-2">
                    <p class="font-semibold flex items-center gap-2 text-red-200">
                        <span>❌</span> Pembayaran Gagal
                    </p>
                    <p>
                        Pembayaran Anda gagal diproses. Silakan hubungi customer service kami untuk bantuan.
                    </p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Action Buttons -->
        <div class="mt-6 pt-4 border-t border-white/10 flex flex-wrap gap-3">
            <a href="<?php echo e(route('books.index')); ?>" class="inline-flex items-center gap-2 border border-white/15 text-xs sm:text-sm text-gray-100 px-4 py-2.5 rounded-full hover:bg-white/5 transition-colors font-medium">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Kembali ke Home
            </a>
            <?php if(isset($purchase)): ?>
                <a href="<?php echo e(route('books.show', $purchase->book->id)); ?>" class="inline-flex items-center gap-2 border border-white/15 text-xs sm:text-sm text-gray-100 px-4 py-2.5 rounded-full hover:bg-white/5 transition-colors font-medium">
                    <i data-lucide="book-open" class="w-4 h-4"></i>
                    Lihat Detail Buku
                </a>
            <?php elseif(isset($subscription)): ?>
                <a href="<?php echo e(route('subscriptions.index')); ?>" class="inline-flex items-center gap-2 border border-white/15 text-xs sm:text-sm text-gray-100 px-4 py-2.5 rounded-full hover:bg-white/5 transition-colors font-medium">
                    <i data-lucide="badge-check" class="w-4 h-4"></i>
                    Lihat Langganan Saya
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\laravel\laravel_ebook\resources\views/payments/show.blade.php ENDPATH**/ ?>