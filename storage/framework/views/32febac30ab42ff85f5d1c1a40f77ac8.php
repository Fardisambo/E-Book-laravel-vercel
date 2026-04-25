

<?php $__env->startSection('title', 'Baca: ' . $book->title); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-6xl mx-auto px-4 py-10">
    <div class="bg-white rounded-lg shadow-lg p-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-900"><?php echo e($book->title); ?></h1>
            <a href="<?php echo e(route('books.show', $book->id)); ?>" class="text-[#FF2D20] hover:underline">← Kembali</a>
        </div>

        <?php if(!$canReadFull): ?>
            <?php if($book->free_pages > 0): ?>
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6 rounded">
                    <p class="text-yellow-800">
                        <strong>Preview Gratis:</strong> Anda dapat membaca <?php echo e($book->free_pages); ?> halaman pertama secara gratis. 
                        Untuk melanjutkan membaca, silakan berlangganan atau beli buku ini.
                    </p>
                </div>
            <?php else: ?>
                <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6 rounded">
                    <p class="text-red-800">
                        <strong>Akses Terbatas:</strong> Untuk membaca buku ini, silakan berlangganan atau beli buku ini.
                    </p>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <?php if($book->file_path): ?>
            <div class="border-2 border-gray-200 rounded-lg p-4">
                <?php if($book->file_type === 'pdf'): ?>
                    <?php if($canReadFull): ?>
                        <iframe 
                            src="<?php echo e(asset('storage/' . $book->file_path)); ?>#page=1" 
                            class="w-full" 
                            style="height: 800px;"
                        ></iframe>
                    <?php else: ?>
                        <div id="pdf-container" class="w-full"></div>
                        
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.8.162/pdf.min.js"></script>
                        <script>
                            pdfjsLib.GlobalWorkerOptions.workerSrc =
                                'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.8.162/pdf.worker.min.js';
                            const pdfUrl = '<?php echo e(asset('storage/' . $book->file_path)); ?>';
                            const maxPages = <?php echo e($book->free_pages ?? 0); ?>;

                            pdfjsLib.getDocument(pdfUrl).promise.then(pdf => {
                                const container = document.getElementById('pdf-container');
                                const limit = Math.min(pdf.numPages, maxPages);
                                for (let i = 1; i <= limit; i++) {
                                    pdf.getPage(i).then(page => {
                                        const viewport = page.getViewport({ scale: 1.5 });
                                        const canvas = document.createElement('canvas');
                                        const ctx = canvas.getContext('2d');
                                        canvas.height = viewport.height;
                                        canvas.width = viewport.width;
                                        container.appendChild(canvas);
                                        page.render({ canvasContext: ctx, viewport: viewport });
                                    });
                                }
                            }).catch(err => {
                                console.error('Failed to load PDF preview', err);
                                container.innerHTML = '<p class="text-red-500">Tidak dapat menampilkan pratinjau.</p>';
                            });
                        </script>
                    <?php endif; ?>
                <?php else: ?>
                    <div class="text-center py-12">
                        <p class="text-gray-600 mb-4">Format file: <?php echo e(strtoupper($book->file_type)); ?></p>
                        <a href="<?php echo e(asset('storage/' . $book->file_path)); ?>" 
                           class="inline-block px-6 py-3 bg-[#FF2D20] text-white rounded-lg hover:bg-red-600 transition-colors"
                           <?php if(!$canReadFull && $book->free_pages): ?> onclick="return confirm('Anda hanya dapat membaca <?php echo e($book->free_pages); ?> halaman pertama. Lanjutkan?')" <?php endif; ?>>
                            Buka File
                        </a>
                    </div>
                <?php endif; ?>
            </div>

            <?php if(!$canReadFull): ?>
                <div class="mt-6 bg-gradient-to-r from-[#FF2D20] to-red-600 rounded-lg p-6 text-white">
                    <h3 class="text-xl font-bold mb-4">Ingin melanjutkan membaca?</h3>
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <p class="mb-2">Berlangganan untuk akses semua buku</p>
                            <a href="<?php echo e(route('subscriptions.index')); ?>" 
                               class="inline-block px-6 py-2 bg-white text-[#FF2D20] rounded-lg hover:bg-gray-100 transition-colors font-medium">
                                Lihat Paket Langganan
                            </a>
                        </div>
                        <div>
                            <p class="mb-2">Beli buku ini untuk akses penuh</p>
                            <form action="<?php echo e(route('books.purchase', $book->id)); ?>" method="POST" class="inline">
                                <?php echo csrf_field(); ?>
                                <button type="submit" 
                                        class="inline-block px-6 py-2 bg-white text-[#FF2D20] rounded-lg hover:bg-gray-100 transition-colors font-medium">
                                    Beli Sekarang (Rp <?php echo e(number_format($book->price, 0, ',', '.')); ?>)
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <div class="text-center py-12">
                <p class="text-gray-600">File buku tidak tersedia.</p>
            </div>
        <?php endif; ?>
    </div>
</div>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\laravel\laravel_ebook\resources\views/books/read.blade.php ENDPATH**/ ?>