

<?php $__env->startSection('title', 'Buku'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex flex-col gap-6">
    <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
        <div>
            <h1 class="text-2xl sm:text-3xl font-semibold text-white">Buku</h1>
            <p class="mt-2 text-sm text-gray-400">Kelola daftar buku, status publikasi, dan informasi lengkap buku.</p>
        </div>
        <a href="<?php echo e(route('admin.books.create')); ?>" class="ui-btn-primary">+ Tambah Buku</a>
    </div>

    <div class="ui-card rounded-[28px] border border-white/10 overflow-hidden shadow-2xl">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-white/10">
                <thead class="bg-white/5 text-left text-xs uppercase tracking-[0.16em] text-gray-400">
                    <tr>
                        <th class="px-6 py-4">Cover</th>
                        <th class="px-6 py-4">Judul</th>
                        <th class="px-6 py-4">Penulis</th>
                        <th class="px-6 py-4">Harga</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10">
                    <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="hover:bg-white/5 transition-colors">
                        <td class="px-6 py-4 align-top">
                            <?php if($book->cover_url): ?>
                                <?php if(str_starts_with($book->cover_url, 'http')): ?>
                                    <img src="<?php echo e($book->cover_url); ?>" alt="<?php echo e($book->title); ?>" class="w-12 h-16 rounded-xl object-cover border border-white/10">
                                <?php else: ?>
                                    <img src="<?php echo e(asset('storage/' . $book->cover_url)); ?>" alt="<?php echo e($book->title); ?>" class="w-12 h-16 rounded-xl object-cover border border-white/10">
                                <?php endif; ?>
                            <?php else: ?>
                                <img src="https://placehold.co/48x68?text=No+Cover" alt="<?php echo e($book->title); ?>" class="w-12 h-16 rounded-xl object-cover border border-white/10">
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4 align-top">
                            <div class="text-sm font-semibold text-white"><?php echo e($book->title); ?></div>
                            <div class="mt-1 text-xs text-gray-500"><?php echo e($book->categories->pluck('name')->join(', ')); ?></div>
                        </td>
                        <td class="px-6 py-4 align-top">
                            <div class="text-sm text-gray-200"><?php echo e($book->author); ?></div>
                        </td>
                        <td class="px-6 py-4 align-top">
                            <div class="text-sm text-white">Rp<?php echo e(number_format($book->price, 0, ',', '.')); ?></div>
                        </td>
                        <td class="px-6 py-4 align-top">
                            <?php if($book->is_published): ?>
                                <span class="inline-flex items-center rounded-full bg-emerald-500/10 px-3 py-1 text-xs font-semibold text-emerald-200">Published</span>
                            <?php else: ?>
                                <span class="inline-flex items-center rounded-full bg-white/10 px-3 py-1 text-xs font-semibold text-gray-300">Draft</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4 align-top text-right text-sm font-medium">
                            <a href="<?php echo e(route('admin.books.edit', $book->id)); ?>" class="inline-flex items-center gap-2 text-amber-300 hover:text-amber-100">Edit</a>
                            <form action="<?php echo e(route('admin.books.destroy', $book->id)); ?>" method="POST" class="inline">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="ml-4 text-red-400 hover:text-red-200" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-white/10">
            <?php echo e($books->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\laravel_ebook\resources\views/admin/books/index.blade.php ENDPATH**/ ?>