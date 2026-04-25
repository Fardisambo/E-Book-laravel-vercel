

<?php $__env->startSection('title', 'Edit Buku'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4 text-white">Edit Buku</h1>
    <div class="glass-panel rounded-3xl border border-white/10 shadow-xl p-6">
        <form action="<?php echo e(route('author.books.update', $book->id)); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-300 mb-2">Judul Buku *</label>
                    <input type="text" name="title" value="<?php echo e(old('title', $book->title)); ?>" required
                        class="w-full rounded-2xl bg-white/5 border border-white/10 text-gray-200 px-4 py-3 focus:outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-500/20">
                    <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-red-400 text-sm mt-2"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-2">Penulis *</label>
                    <input type="text" name="author" value="<?php echo e(old('author', $book->author)); ?>" required
                        class="w-full rounded-2xl bg-white/5 border border-white/10 text-gray-200 px-4 py-3 focus:outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-500/20">
                    <?php $__errorArgs = ['author'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-red-400 text-sm mt-2"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-2">ISBN</label>
                    <input type="text" name="isbn" value="<?php echo e(old('isbn', $book->isbn)); ?>"
                        class="w-full rounded-2xl bg-white/5 border border-white/10 text-gray-200 px-4 py-3 focus:outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-500/20">
                    <?php $__errorArgs = ['isbn'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-red-400 text-sm mt-2"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-2">Tahun Terbit</label>
                    <input type="number" name="published_year" value="<?php echo e(old('published_year', $book->published_year)); ?>"
                        class="w-full rounded-2xl bg-white/5 border border-white/10 text-gray-200 px-4 py-3 focus:outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-500/20">
                    <?php $__errorArgs = ['published_year'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-red-400 text-sm mt-2"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-2">Penerbit</label>
                    <input type="text" name="publisher" value="<?php echo e(old('publisher', $book->publisher)); ?>"
                        class="w-full rounded-2xl bg-white/5 border border-white/10 text-gray-200 px-4 py-3 focus:outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-500/20">
                    <?php $__errorArgs = ['publisher'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-red-400 text-sm mt-2"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-2">Bahasa</label>
                    <select name="language"
                        class="w-full rounded-2xl bg-white/5 border border-white/10 text-gray-200 px-4 py-3 focus:outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-500/20">
                        <option value="id" <?php echo e(old('language', $book->language) == 'id' ? 'selected' : ''); ?>>Indonesia</option>
                        <option value="en" <?php echo e(old('language', $book->language) == 'en' ? 'selected' : ''); ?>>English</option>
                        <option value="ms" <?php echo e(old('language', $book->language) == 'ms' ? 'selected' : ''); ?>>Malay</option>
                    </select>
                    <?php $__errorArgs = ['language'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-red-400 text-sm mt-2"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-2">Total Halaman</label>
                    <input type="number" name="total_pages" value="<?php echo e(old('total_pages', $book->total_pages)); ?>"
                        class="w-full rounded-2xl bg-white/5 border border-white/10 text-gray-200 px-4 py-3 focus:outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-500/20">
                    <?php $__errorArgs = ['total_pages'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-red-400 text-sm mt-2"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-2">Halaman Gratis</label>
                    <input type="number" name="free_pages" value="<?php echo e(old('free_pages', $book->free_pages ?? 10)); ?>"
                        class="w-full rounded-2xl bg-white/5 border border-white/10 text-gray-200 px-4 py-3 focus:outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-500/20">
                    <?php $__errorArgs = ['free_pages'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-red-400 text-sm mt-2"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-300 mb-2">Deskripsi</label>
                    <textarea name="description" rows="4"
                        class="w-full rounded-2xl bg-white/5 border border-white/10 text-gray-200 px-4 py-3 focus:outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-500/20"><?php echo e(old('description', $book->description)); ?></textarea>
                    <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-red-400 text-sm mt-2"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-300 mb-2">Kategori</label>
                    <select name="categories[]" multiple
                        class="w-full rounded-2xl bg-white/5 border border-white/10 text-gray-200 px-4 py-3 focus:outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-500/20">
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($category->id); ?>"
                                <?php echo e(in_array($category->id, old('categories', $book->categories->pluck('id')->toArray())) ? 'selected' : ''); ?>><?php echo e($category->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['categories'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-red-400 text-sm mt-2"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-2">Cover (JPEG, PNG, JPG, GIF)</label>
                    <?php if($book->cover_url): ?>
                        <div class="mb-3">
                            <img src="<?php echo e(asset('storage/' . $book->cover_url)); ?>" alt="Cover saat ini" class="w-32 h-44 object-cover rounded-lg border border-white/10">
                            <p class="text-xs text-gray-400 mt-2">Cover saat ini</p>
                        </div>
                    <?php endif; ?>
                    <input type="file" name="cover" accept="image/*"
                        class="w-full rounded-2xl bg-white/5 border border-white/10 text-gray-200 px-4 py-3 focus:outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-500/20">
                    <?php $__errorArgs = ['cover'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-red-400 text-sm mt-2"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-2">Harga (Rp)</label>
                    <input type="number" name="price" step="0.01" value="<?php echo e(old('price', $book->price ?? 0)); ?>"
                        class="w-full rounded-2xl bg-white/5 border border-white/10 text-gray-200 px-4 py-3 focus:outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-500/20">
                    <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-red-400 text-sm mt-2"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-2">File Buku (PDF/EPUB)</label>
                    <?php if($book->file_path): ?>
                        <p class="text-xs text-gray-400 mb-2">File saat ini: <strong><?php echo e(basename($book->file_path)); ?></strong></p>
                    <?php endif; ?>
                    <input type="file" name="file" accept=".pdf,.epub"
                        class="w-full rounded-2xl bg-white/5 border border-white/10 text-gray-200 px-4 py-3 focus:outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-500/20">
                    <?php $__errorArgs = ['file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-red-400 text-sm mt-2"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="md:col-span-2 flex flex-wrap gap-3 items-center">
                    <label class="flex items-center gap-2 text-gray-300">
                        <input type="checkbox" name="is_featured" value="1" <?php echo e(old('is_featured', $book->is_featured) ? 'checked' : ''); ?> class="rounded border-white/20 text-amber-500 focus:ring-amber-500">
                        Featured
                    </label>
                    <label class="flex items-center gap-2 text-gray-300">
                        <input type="checkbox" name="is_published" value="1" <?php echo e(old('is_published', $book->is_published) ? 'checked' : ''); ?> class="rounded border-white/20 text-amber-500 focus:ring-amber-500">
                        Published
                    </label>
                </div>
            </div>

            <div class="mt-6 flex flex-wrap gap-3">
                <button type="submit" class="inline-flex items-center justify-center px-5 py-3 rounded-full bg-amber-600 text-slate-900 font-semibold hover:bg-amber-500 transition">Simpan</button>
                <a href="<?php echo e(route('author.books.index')); ?>" class="inline-flex items-center justify-center px-5 py-3 rounded-full bg-white/10 text-gray-200 border border-white/10 hover:bg-white/15 transition">Kembali</a>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\laravel\laravel_ebook\resources\views/author/books/edit.blade.php ENDPATH**/ ?>