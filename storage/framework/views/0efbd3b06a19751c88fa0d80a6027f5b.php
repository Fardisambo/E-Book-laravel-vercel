

<?php $__env->startSection('title', 'Edit Langganan'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-4">
    <a href="<?php echo e(route('admin.subscriptions.index')); ?>" class="text-[#FF2D20] hover:text-red-600 text-sm">← Kembali</a>
    <h1 class="text-2xl font-bold text-white-900 mt-1">Edit Langganan #<?php echo e($subscription->id); ?></h1>
</div>

<?php if($errors->any()): ?>
    <div class="mb-3 p-3 bg-red-100 border border-red-400 text-red-700 rounded-lg text-sm">
        <ul class="list-disc list-inside">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>

<div class="ui-card p-4">
    <form action="<?php echo e(route('admin.subscriptions.update', $subscription->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        
        <div class="mb-3">
            <label for="user_id" class="block text-sm font-medium text-white-700">Pengguna</label>
            <select name="user_id" id="user_id" class="mt-1 w-full border border-white-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF2D20] <?php $__errorArgs = ['user_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                <option value="">-- Pilih Pengguna --</option>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($user->id); ?>" <?php echo e(old('user_id', $subscription->user_id) == $user->id ? 'selected' : ''); ?>><?php echo e($user->name); ?> (<?php echo e($user->email); ?>)</option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <?php $__errorArgs = ['user_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 mb-2">
            <div>
                <label for="plan" class="block text-xs font-medium text-white-700">Paket</label>
                <select name="plan" id="plan" class="mt-1 w-full border border-white-300 rounded-lg px-2 py-1 text-xs focus:outline-none focus:ring-2 focus:ring-[#FF2D20] <?php $__errorArgs = ['plan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                    <option value="">-- Paket --</option>
                    <option value="monthly" <?php echo e(old('plan', $subscription->plan) == 'monthly' ? 'selected' : ''); ?>>Bulanan</option>
                    <option value="yearly" <?php echo e(old('plan', $subscription->plan) == 'yearly' ? 'selected' : ''); ?>>Tahunan</option>
                </select>
                <?php $__errorArgs = ['plan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div>
                <label for="amount" class="block text-xs font-medium text-white-700">Harga</label>
                <input type="number" name="amount" id="amount" min="0" step="0.01" 
                    class="mt-1 w-full border border-white-300 rounded-lg px-2 py-1 text-xs focus:outline-none focus:ring-2 focus:ring-[#FF2D20] <?php $__errorArgs = ['amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    value="<?php echo e(old('amount', $subscription->amount)); ?>" required>
                <?php $__errorArgs = ['amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 mb-2">
            <div>
                <label for="started_at" class="block text-xs font-medium text-white-700">Mulai</label>
                <input type="date" name="started_at" id="started_at" 
                    class="mt-1 w-full border border-white-300 rounded-lg px-2 py-1 text-xs focus:outline-none focus:ring-2 focus:ring-[#FF2D20] <?php $__errorArgs = ['started_at'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    value="<?php echo e(old('started_at', $subscription->started_at?->format('Y-m-d'))); ?>" required>
                <?php $__errorArgs = ['started_at'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div>
                <label for="expires_at" class="block text-xs font-medium text-white-700">Berakhir</label>
                <input type="date" name="expires_at" id="expires_at" 
                    class="mt-1 w-full border border-white-300 rounded-lg px-2 py-1 text-xs focus:outline-none focus:ring-2 focus:ring-[#FF2D20] <?php $__errorArgs = ['expires_at'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    value="<?php echo e(old('expires_at', $subscription->expires_at?->format('Y-m-d'))); ?>" required>
                <?php $__errorArgs = ['expires_at'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        
        <div class="mb-4">
            <label for="status" class="block text-sm font-medium text-white-700">Status</label>
            <select name="status" id="status" class="mt-1 w-full border border-white-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF2D20] <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                <option value="">-- Pilih Status --</option>
                <option value="pending" <?php echo e(old('status', $subscription->status) == 'pending' ? 'selected' : ''); ?>>Tertunda</option>
                <option value="active" <?php echo e(old('status', $subscription->status) == 'active' ? 'selected' : ''); ?>>Aktif</option>
                <option value="expired" <?php echo e(old('status', $subscription->status) == 'expired' ? 'selected' : ''); ?>>Berakhir</option>
                <option value="cancelled" <?php echo e(old('status', $subscription->status) == 'cancelled' ? 'selected' : ''); ?>>Dibatalkan</option>
            </select>
            <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        
        <div class="flex gap-2">
            <button type="submit" class="flex-1 bg-[#FF2D20] text-white px-4 py-2 rounded-lg hover:bg-red-600 transition-colors text-sm">
                Simpan
            </button>
            <a href="<?php echo e(route('admin.subscriptions.index')); ?>" class="flex-1 bg-white-300 text-white-700 px-4 py-2 rounded-lg hover:bg-white-400 transition-colors text-sm text-center">
                Batal
            </a>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\laravel_ebook\resources\views/admin/subscriptions/edit.blade.php ENDPATH**/ ?>