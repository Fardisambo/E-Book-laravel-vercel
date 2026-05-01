

<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div>
    <h1 class="text-3xl font-bold text-white-900 mb-8">Dashboard</h1>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="ui-card p-6">
            <div class="flex items-center">
                <div class="p-3 bg-blue-100 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-white-600">Total Buku</p>
                    <p class="text-2xl font-semibold text-white-900"><?php echo e(number_format($stats['total_books'])); ?></p>
                </div>
            </div>
        </div>

        <div class="ui-card p-6">
            <div class="flex items-center">
                <div class="p-3 bg-green-100 rounded-lg">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-white-600">Total Users</p>
                    <p class="text-2xl font-semibold text-white-900"><?php echo e(number_format($stats['total_users'])); ?></p>
                </div>
            </div>
        </div>

        <div class="ui-card p-6">
            <div class="flex items-center">
                <div class="p-3 bg-purple-100 rounded-lg">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-white-600">Total Revenue</p>
                    <p class="text-2xl font-semibold text-white-900">Rp <?php echo e(number_format($stats['total_revenue'], 0, ',', '.')); ?></p>
                </div>
            </div>
        </div>

        <div class="ui-card p-6">
            <div class="flex items-center">
                <div class="p-3 bg-yellow-100 rounded-lg">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-white-600">Pending Payments</p>
                    <p class="text-2xl font-semibold text-white-900"><?php echo e(number_format($stats['pending_payments'])); ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Data -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="ui-card">
            <div class="p-6 border-b border-black-200">
                <h2 class="text-lg font-semibold text-white-900">Buku Terbaru</h2>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <?php $__currentLoopData = $recentBooks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="flex items-center space-x-4">
                        <img src="<?php echo e($book->cover_url ? asset('storage/' . $book->cover_url) : 'https://placehold.co/60x80?text=No+Cover'); ?>" 
                             alt="<?php echo e($book->title); ?>" class="w-12 h-16 object-cover rounded">
                        <div class="flex-1">
                            <h3 class="font-medium text-white-900"><?php echo e($book->title); ?></h3>
                            <p class="text-sm text-white-500"><?php echo e($book->author); ?></p>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>

        <div class="ui-card">
            <div class="p-6 border-b border-white-200">
                <h2 class="text-lg font-semibold text-white-900">Users Terbaru</h2>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <?php $__currentLoopData = $recentUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="font-medium text-white-900"><?php echo e($user->name); ?></h3>
                            <p class="text-sm text-white-500"><?php echo e($user->email); ?></p>
                        </div>
                        <span class="text-xs px-2 py-1 bg-white-100 text-white-600 rounded"><?php echo e($user->role); ?></span>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\laravel_ebook\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>