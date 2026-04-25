

<?php $__env->startSection('title', 'Tambah Buku'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-5xl mx-auto space-y-6">
    <div class="glass-panel rounded-[28px] border border-white/10 p-8 shadow-2xl">
        <div class="flex flex-col gap-2">
            <h1 class="text-3xl font-semibold text-white">Tambah Buku</h1>
            <p class="text-sm text-gray-400">Tambahkan buku baru ke koleksi admin. Isi semua informasi dan unggah file untuk buku ini.</p>
        </div>
    </div>

    <?php if($errors->any()): ?>
        <div class="glass-panel rounded-[28px] border border-red-500/20 bg-red-500/10 p-5 text-sm text-red-100">
            <div class="font-semibold mb-2">Terjadi kesalahan:</div>
            <ul class="list-disc list-inside space-y-1">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('admin.books.store')); ?>" method="POST" enctype="multipart/form-data" class="glass-panel rounded-[32px] border border-white/10 p-8 shadow-2xl">
        <?php echo csrf_field(); ?>
        <div class="grid gap-6 md:grid-cols-2">
            <div class="md:col-span-2">
                <label for="title" class="block text-sm font-medium text-gray-300 mb-2">Judul *</label>
                <input type="text" name="title" id="title" required
                    class="w-full rounded-3xl bg-white/5 border border-white/10 px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-amber-400"
                    value="<?php echo e(old('title')); ?>">
                <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-400 text-sm mt-2"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label for="author" class="block text-sm font-medium text-gray-300 mb-2">Penulis *</label>
                <input type="text" name="author" id="author" required
                    class="w-full rounded-3xl bg-white/5 border border-white/10 px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-amber-400"
                    value="<?php echo e(old('author')); ?>">
                <?php $__errorArgs = ['author'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-400 text-sm mt-2"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label for="isbn" class="block text-sm font-medium text-gray-300 mb-2">ISBN</label>
                <input type="text" name="isbn" id="isbn"
                    class="w-full rounded-3xl bg-white/5 border border-white/10 px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-amber-400"
                    value="<?php echo e(old('isbn')); ?>">
                <?php $__errorArgs = ['isbn'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-400 text-sm mt-2"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label for="published_year" class="block text-sm font-medium text-gray-300 mb-2">Tahun Terbit</label>
                <input type="number" name="published_year" id="published_year"
                    class="w-full rounded-3xl bg-white/5 border border-white/10 px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-amber-400"
                    value="<?php echo e(old('published_year')); ?>">
                <?php $__errorArgs = ['published_year'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-400 text-sm mt-2"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label for="publisher" class="block text-sm font-medium text-gray-300 mb-2">Penerbit</label>
                <input type="text" name="publisher" id="publisher"
                    class="w-full rounded-3xl bg-white/5 border border-white/10 px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-amber-400"
                    value="<?php echo e(old('publisher')); ?>">
                <?php $__errorArgs = ['publisher'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-400 text-sm mt-2"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label for="total_pages" class="block text-sm font-medium text-gray-300 mb-2">Total Halaman</label>
                <input type="number" name="total_pages" id="total_pages"
                    class="w-full rounded-3xl bg-white/5 border border-white/10 px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-amber-400"
                    value="<?php echo e(old('total_pages')); ?>">
                <?php $__errorArgs = ['total_pages'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-400 text-sm mt-2"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label for="free_pages" class="block text-sm font-medium text-gray-300 mb-2">Halaman Gratis</label>
                <input type="number" name="free_pages" id="free_pages" value="<?php echo e(old('free_pages', 10)); ?>"
                    class="w-full rounded-3xl bg-white/5 border border-white/10 px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-amber-400">
                <?php $__errorArgs = ['free_pages'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-400 text-sm mt-2"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label for="price" class="block text-sm font-medium text-gray-300 mb-2">Harga (Rp)</label>
                <input type="number" name="price" id="price" step="0.01" value="<?php echo e(old('price', 0)); ?>"
                    class="w-full rounded-3xl bg-white/5 border border-white/10 px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-amber-400">
                <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-400 text-sm mt-2"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label for="language" class="block text-sm font-medium text-gray-300 mb-2">Bahasa</label>
                <select name="language" id="language"
                    class="w-full rounded-3xl bg-white/5 border border-white/10 px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-amber-400">
                    <option value="">-- Pilih Bahasa --</option>
                    <option value="id" <?php echo e(old('language') == 'id' ? 'selected' : ''); ?>>Indonesia</option>
                    <option value="en" <?php echo e(old('language') == 'en' ? 'selected' : ''); ?>>English</option>
                    <option value="ms" <?php echo e(old('language') == 'ms' ? 'selected' : ''); ?>>Malay</option>
                </select>
                <?php $__errorArgs = ['language'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-400 text-sm mt-2"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="md:col-span-2">
                <label for="description" class="block text-sm font-medium text-gray-300 mb-2">Deskripsi</label>
                <textarea name="description" id="description" rows="4"
                    class="w-full rounded-3xl bg-white/5 border border-white/10 px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-amber-400"><?php echo e(old('description')); ?></textarea>
                <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-400 text-sm mt-2"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label for="categories" class="block text-sm font-medium text-gray-300 mb-2">Kategori</label>
                <select name="categories[]" id="categories" multiple
                    class="w-full rounded-3xl bg-white/5 border border-white/10 px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-amber-400">
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($category->id); ?>" <?php echo e(in_array($category->id, old('categories', [])) ? 'selected' : ''); ?>><?php echo e($category->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['categories'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-400 text-sm mt-2"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label for="cover" class="block text-sm font-medium text-gray-300 mb-2">Cover (Max: 2MB, Format: JPEG/PNG)</label>
                <input type="file" name="cover" id="cover" accept="image/*"
                    class="w-full rounded-3xl bg-white/5 border border-white/10 px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-amber-400">
                <?php $__errorArgs = ['cover'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-400 text-sm mt-2"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label for="file" class="block text-sm font-medium text-gray-300 mb-2">File Buku (Max: 10MB, Format: PDF/EPUB) *</label>
                <input type="file" name="file" id="file" accept=".pdf,.epub"
                    class="w-full rounded-3xl bg-white/5 border border-white/10 px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-amber-400">
                <?php $__errorArgs = ['file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-400 text-sm mt-2"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="md:col-span-2 flex flex-wrap gap-4 items-center">
                <label class="inline-flex items-center gap-2 text-gray-300">
                    <input type="checkbox" name="is_featured" value="1" class="h-4 w-4 rounded border-white/10 bg-white/5 text-amber-400 focus:ring-amber-400" <?php echo e(old('is_featured') ? 'checked' : ''); ?>>
                    Featured
                </label>
                <label class="inline-flex items-center gap-2 text-gray-300">
                    <input type="checkbox" name="is_published" value="1" class="h-4 w-4 rounded border-white/10 bg-white/5 text-amber-400 focus:ring-amber-400" <?php echo e(old('is_published', true) ? 'checked' : ''); ?>>
                    Published
                </label>
            </div>
        </div>

        <div class="mt-8 flex flex-wrap gap-4">
            <button type="submit" class="inline-flex items-center justify-center rounded-full bg-amber-400 px-6 py-3 text-sm font-semibold text-black hover:bg-amber-300 transition">Simpan Buku</button>
            <a href="<?php echo e(route('admin.books.index')); ?>" class="inline-flex items-center justify-center rounded-full border border-white/10 px-6 py-3 text-sm text-gray-300 hover:bg-white/5 transition">Batal</a>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\laravel\laravel_ebook\resources\views/admin/books/create.blade.php ENDPATH**/ ?>