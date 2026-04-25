<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $__env->yieldContent('title', 'Admin Panel'); ?> - EbookStore</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;600&display=swap" rel="stylesheet">

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        body {
            font-family: 'Inter', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background-color: #0f0f0f;
            color: #e5e5e5;
        }
        .font-serif {
            font-family: 'Cormorant Garamond', serif;
        }
        .glass-panel {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        .gold-gradient {
            background: linear-gradient(135deg, #d4af37 0%, #f4e5c2 50%, #d4af37 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .sidebar-link {
            position: relative;
            overflow: hidden;
        }
        .sidebar-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 2px;
            background: #d4af37;
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }
        .sidebar-link:hover::before,
        .sidebar-link.active::before {
            transform: scaleY(1);
        }
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>
<body class="antialiased overflow-hidden h-screen">
    <div class="flex h-full bg-gradient-to-br from-[#0f0f0f] via-[#1a1a1a] to-[#0f0f0f]">
        <!-- Sidebar -->
        <aside class="w-64 glass-panel border-r border-white/5 flex flex-col justify-between p-6">
            <div>
                <div class="flex items-center gap-3 mb-10">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-amber-600 to-amber-300 flex items-center justify-center">
                        <i data-lucide="shield" class="w-5 h-5 text-black"></i>
                    </div>
                    <div>
                        <span class="font-serif text-2xl font-semibold gold-gradient">Admin</span>
                        <p class="text-[11px] text-gray-500 uppercase tracking-[0.2em]">E-Library</p>
                    </div>
                </div>

                <nav class="space-y-2 text-sm">
                    <a href="<?php echo e(route('admin.dashboard')); ?>"
                       class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg transition-all
                              <?php echo e(request()->routeIs('admin.dashboard') ? 'bg-white/5 text-amber-200/90 active' : 'text-gray-400 hover:text-amber-200/90 hover:bg-white/5'); ?>">
                        <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                        <span class="font-medium">Dashboard</span>
                    </a>

                    <a href="<?php echo e(route('admin.books.index')); ?>"
                       class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg transition-all
                              <?php echo e(request()->routeIs('admin.books.*') ? 'bg-white/5 text-amber-200/90 active' : 'text-gray-400 hover:text-amber-200/90 hover:bg-white/5'); ?>">
                        <i data-lucide="book-open" class="w-5 h-5"></i>
                        <span>Buku</span>
                    </a>

                    <a href="<?php echo e(route('admin.categories.index')); ?>"
                       class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg transition-all
                              <?php echo e(request()->routeIs('admin.categories.*') ? 'bg-white/5 text-amber-200/90 active' : 'text-gray-400 hover:text-amber-200/90 hover:bg-white/5'); ?>">
                        <i data-lucide="grid-2x2" class="w-5 h-5"></i>
                        <span>Kategori</span>
                    </a>

                    <a href="<?php echo e(route('admin.users.index')); ?>"
                       class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg transition-all
                              <?php echo e(request()->routeIs('admin.users.*') ? 'bg-white/5 text-amber-200/90 active' : 'text-gray-400 hover:text-amber-200/90 hover:bg-white/5'); ?>">
                        <i data-lucide="users" class="w-5 h-5"></i>
                        <span>Users</span>
                    </a>

                    <a href="<?php echo e(route('admin.purchases.index')); ?>"
                       class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg transition-all
                              <?php echo e(request()->routeIs('admin.purchases.*') ? 'bg-white/5 text-amber-200/90 active' : 'text-gray-400 hover:text-amber-200/90 hover:bg-white/5'); ?>">
                        <i data-lucide="shopping-bag" class="w-5 h-5"></i>
                        <span>Pesanan Buku</span>
                    </a>

                    <a href="<?php echo e(route('admin.subscriptions.index')); ?>"
                       class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg transition-all
                              <?php echo e(request()->routeIs('admin.subscriptions.*') ? 'bg-white/5 text-amber-200/90 active' : 'text-gray-400 hover:text-amber-200/90 hover:bg-white/5'); ?>">
                        <i data-lucide="badge-check" class="w-5 h-5"></i>
                        <span>Langganan</span>
                    </a>

                    <a href="<?php echo e(route('admin.payment-methods.index')); ?>"
                       class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg transition-all
                              <?php echo e(request()->routeIs('admin.payment-methods.*') ? 'bg-white/5 text-amber-200/90 active' : 'text-gray-400 hover:text-amber-200/90 hover:bg-white/5'); ?>">
                        <i data-lucide="credit-card" class="w-5 h-5"></i>
                        <span>Metode Pembayaran</span>
                    </a>

                    <a href="<?php echo e(route('books.index')); ?>"
                       class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg transition-all text-gray-400 hover:text-amber-200/90 hover:bg-white/5">
                        <i data-lucide="arrow-left" class="w-5 h-5"></i>
                        <span>Kembali ke User</span>
                    </a>
                </nav>
            </div>

            <div class="mt-6 glass-panel rounded-2xl p-4 border border-amber-500/20">
                <div class="flex items-center justify-between gap-3">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-full bg-gradient-to-br from-gray-700 to-gray-900 border border-amber-500/30 flex items-center justify-center">
                            <i data-lucide="user-cog" class="w-4 h-4 text-amber-300"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400">Login sebagai</p>
                            <p class="text-sm font-medium text-white truncate max-w-[130px]">
                                <?php echo e(auth()->user()->name); ?>

                            </p>
                        </div>
                    </div>
                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="text-xs text-gray-400 hover:text-amber-300 flex items-center gap-1">
                            <i data-lucide="log-out" class="w-4 h-4"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto scrollbar-hide">
            <header class="sticky top-0 z-20 glass-panel border-b border-white/5 px-6 py-4 flex items-center justify-between">
                <div>
                    <p class="text-xs uppercase tracking-[0.25em] text-gray-500 mb-1">Admin Panel</p>
                    <h1 class="font-serif text-xl text-white"><?php echo $__env->yieldContent('title', 'Dashboard'); ?></h1>
                </div>
                <div class="flex items-center gap-3 text-xs text-gray-400">
                    <span class="hidden sm:inline-flex items-center gap-1">
                        <i data-lucide="shield-check" class="w-4 h-4 text-emerald-400"></i>
                        Akses terautentikasi
                    </span>
                    <span class="w-px h-6 bg-white/10 hidden sm:block"></span>
                    <span class="text-[11px] uppercase tracking-[0.2em] text-gray-500">
                        <?php echo e(now()->format('d M Y')); ?>

                    </span>
                </div>
            </header>

            <div class="p-6 sm:p-8 space-y-4 sm:space-y-6">
                <?php if(session('success')): ?>
                    <div class="glass-panel rounded-xl border border-emerald-500/30 px-4 py-3 text-sm text-emerald-200 flex items-start gap-3">
                        <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-400 mt-0.5"></i>
                        <p><?php echo e(session('success')); ?></p>
                    </div>
                <?php endif; ?>

                <?php if(session('error')): ?>
                    <div class="glass-panel rounded-xl border border-red-500/30 px-4 py-3 text-sm text-red-200 flex items-start gap-3">
                        <i data-lucide="alert-triangle" class="w-5 h-5 text-red-400 mt-0.5"></i>
                        <p><?php echo e(session('error')); ?></p>
                    </div>
                <?php endif; ?>

                <?php echo $__env->yieldContent('content'); ?>

                <footer class="pt-6 pb-2 text-center text-[11px] text-gray-500">
                    &copy; <?php echo e(date('Y')); ?> EbookStore Admin. Semua hak cipta dilindungi.
                </footer>
            </div>
        </main>
    </div>

    <script>
        if (window.lucide) {
            lucide.createIcons();
        }
    </script>
</body>
</html>
<?php /**PATH C:\laragon\www\laravel\laravel_ebook\resources\views/layouts/admin.blade.php ENDPATH**/ ?>