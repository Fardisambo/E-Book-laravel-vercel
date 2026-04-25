<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Katalog Ebook'); ?></title>

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
                        <?php if(auth()->check()): ?>
                            <?php if(auth()->user()->isAdmin()): ?>
                                <!-- Tampilkan menu admin -->
                            <?php elseif(auth()->user()->isAuthor()): ?>
                                <!-- Tampilkan menu author -->
                            <?php endif; ?>
                        <?php endif; ?>
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
        body.author-layout .bg-white {
            background-color: rgba(255, 255, 255, 0.05) !important;
        }
        body.author-layout .bg-gray-50,
        body.author-layout .bg-gray-100,
        body.author-layout .bg-gray-200,
        body.author-layout .bg-gray-300 {
            background-color: rgba(255, 255, 255, 0.06) !important;
        }
        body.author-layout .border-gray-200,
        body.author-layout .border-gray-300,
        body.author-layout .border-gray-400 {
            border-color: rgba(255, 255, 255, 0.12) !important;
        }
        body.author-layout .text-black,
        body.author-layout .text-gray-900 {
            color: #f8fafc !important;
        }
        body.author-layout .text-gray-700,
        body.author-layout .text-gray-600,
        body.author-layout .text-gray-500 {
            color: #cbd5e1 !important;
        }
        body.author-layout .hover\:bg-gray-50:hover {
            background-color: rgba(255, 255, 255, 0.08) !important;
        }
    </style>
</head>
<body class="<?php echo e(auth()->check() && auth()->user()->isAuthor() ? 'author-layout ' : ''); ?>antialiased overflow-hidden h-screen">
    <div class="flex h-full bg-gradient-to-br from-[#0f0f0f] via-[#1a1a1a] to-[#0f0f0f]">
        <!-- Sidebar -->
        <aside class="hidden md:flex w-64 glass-panel border-r border-white/5 flex-col justify-between p-6">
            <div>
                <div class="flex items-center gap-3 mb-10">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-amber-600 to-amber-300 flex items-center justify-center">
                        <i data-lucide="book-open" class="w-5 h-5 text-black"></i>
                    </div>
                    <a href="<?php echo e(route('books.index')); ?>" class="font-serif text-2xl font-semibold gold-gradient">
                        F-Collection
                    </a>
                </div>

                <nav class="space-y-2 text-sm">
                    <?php if(auth()->guard()->check()): ?>
                        <?php if(auth()->user()->isAuthor()): ?>
                            <a href="<?php echo e(route('author.dashboard')); ?>"
                               class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg transition-all <?php echo e(request()->routeIs('author.dashboard') ? 'bg-white/5 text-amber-200/90 active' : 'text-gray-400 hover:text-amber-200/90 hover:bg-white/5'); ?>">
                                <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                                <span class="font-medium">Dashboard Petugas</span>
                            </a>
                            <a href="<?php echo e(route('author.books.index')); ?>"
                               class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg transition-all <?php echo e(request()->routeIs('author.books.*') ? 'bg-white/5 text-amber-200/90 active' : 'text-gray-400 hover:text-amber-200/90 hover:bg-white/5'); ?>">
                                <i data-lucide="book" class="w-5 h-5"></i>
                                <span>Kelola Buku</span>
                            </a>
                            <a href="<?php echo e(route('author.borrows.index')); ?>"
                               class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg transition-all <?php echo e(request()->routeIs('author.borrows.*') ? 'bg-white/5 text-amber-200/90 active' : 'text-gray-400 hover:text-amber-200/90 hover:bg-white/5'); ?>">
                                <i data-lucide="clipboard-list" class="w-5 h-5"></i>
                                <span>Kelola Peminjaman</span>
                            </a>
                            <a href="<?php echo e(route('books.index')); ?>"
                                class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg transition-all text-gray-400 hover:text-amber-200/90 hover:bg-white/5">
                                <i data-lucide="arrow-left" class="w-5 h-5"></i>
                                <span>Kembali ke User</span>
                            </a>
                        <?php else: ?>
                            <a href="<?php echo e(route('books.index')); ?>"
                               class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg transition-all <?php echo e(request()->routeIs('books.index') ? 'bg-white/5 text-amber-200/90 active' : 'text-gray-400 hover:text-amber-200/90 hover:bg-white/5'); ?>">
                                <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                                <span class="font-medium">Dashboard</span>
                            </a>
                            <a href="<?php echo e(route('books.browse')); ?>"
                               class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg transition-all <?php echo e(request()->routeIs('books.browse') ? 'bg-white/5 text-amber-200/90 active' : 'text-gray-400 hover:text-amber-200/90 hover:bg-white/5'); ?>">
                                <i data-lucide="library" class="w-5 h-5"></i>
                                <span>Jelajahi Semua Buku</span>
                            </a>
                            <a href="<?php echo e(route('favorites.index')); ?>"
                               class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg transition-all <?php echo e(request()->routeIs('favorites.index') ? 'bg-white/5 text-amber-200/90 active' : 'text-gray-400 hover:text-amber-200/90 hover:bg-white/5'); ?>">
                                <i data-lucide="heart" class="w-5 h-5"></i>
                                <span>Buku Favorit</span>
                            </a>
                            <a href="<?php echo e(route('orders.paid')); ?>"
                               class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg transition-all <?php echo e(request()->routeIs('orders.paid') ? 'bg-white/5 text-amber-200/90 active' : 'text-gray-400 hover:text-amber-200/90 hover:bg-white/5'); ?>">
                                <i data-lucide="bookmark" class="w-5 h-5"></i>
                                <span>Pesanan Selesai</span>
                            </a>
                            <a href="<?php echo e(route('orders.unpaid')); ?>"
                               class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg transition-all <?php echo e(request()->routeIs('orders.unpaid') ? 'bg-white/5 text-amber-200/90 active' : 'text-gray-400 hover:text-amber-200/90 hover:bg-white/5'); ?>">
                                <i data-lucide="history" class="w-5 h-5"></i>
                                <span>Menunggu Pembayaran</span>
                            </a>
                            <a href="<?php echo e(route('borrows.index')); ?>"
                               class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg transition-all <?php echo e(request()->routeIs('borrows.*') ? 'bg-white/5 text-amber-200/90 active' : 'text-gray-400 hover:text-amber-200/90 hover:bg-white/5'); ?>">
                                <i data-lucide="calendar-check" class="w-5 h-5"></i>
                                <span>Reservasi Pinjam Buku</span>
                            </a>
                            <a href="<?php echo e(route('subscriptions.index')); ?>"
                               class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg transition-all <?php echo e(request()->routeIs('subscriptions.*') ? 'bg-white/5 text-amber-200/90 active' : 'text-gray-400 hover:text-amber-200/90 hover:bg-white/5'); ?>">
                                <i data-lucide="settings" class="w-5 h-5"></i>
                                <span>Langganan</span>
                            </a>
                        <?php endif; ?>
                        <?php if(auth()->user()->isAdmin()): ?>
                            <a href="<?php echo e(route('admin.dashboard')); ?>"
                               class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg transition-all <?php echo e(request()->routeIs('admin.dashboard') ? 'bg-white/5 text-amber-200/90 active' : 'text-gray-400 hover:text-amber-200/90 hover:bg-white/5'); ?>">
                                <i data-lucide="shield" class="w-5 h-5"></i>
                                <span>Admin Panel</span>
                            </a>
                        <?php endif; ?>
                    <?php endif; ?>
                </nav>
            </div>

            <?php if(auth()->guard()->check()): ?>
                <div class="glass-panel rounded-2xl p-4 border border-amber-500/20">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-gray-700 to-gray-900 border border-amber-500/30 flex items-center justify-center">
                            <i data-lucide="user" class="w-5 h-5 text-amber-300"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-white"><?php echo e(auth()->user()->name); ?></p>
                            <p class="text-xs text-gray-500"><?php echo e(auth()->user()->email); ?></p>
                        </div>
                    </div>
                    <div class="flex items-center justify-between mt-2">
                        <form method="POST" action="<?php echo e(route('logout')); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="text-xs text-gray-400 hover:text-amber-300 flex items-center gap-1">
                                <i data-lucide="log-out" class="w-4 h-4"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            <?php else: ?>
                <div class="space-y-2">
                    <a href="<?php echo e(route('login')); ?>" class="block w-full text-center px-4 py-2 rounded-full bg-white/5 text-gray-200 text-sm hover:bg-white/10">
                        Login
                    </a>
                    <a href="<?php echo e(route('register')); ?>" class="block w-full text-center px-4 py-2 rounded-full bg-gradient-to-r from-amber-600 to-amber-500 text-black text-sm font-medium hover:shadow-lg hover:shadow-amber-500/25">
                        Daftar
                    </a>
                </div>
            <?php endif; ?>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto scrollbar-hide">
            <!-- Header -->
            <header class="sticky top-0 z-20 glass-panel border-b border-white/5 px-4 sm:px-8 py-4 flex items-center justify-between">
                <div class="flex items-center gap-4 flex-1 max-w-2xl">
                    <form action="<?php echo e(route('books.search')); ?>" method="GET" class="relative w-full">
                        <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-500"></i>
                        <input
                            name="q"
                            value="<?php echo e(request('q')); ?>"
                            type="text"
                            placeholder="Cari judul, penulis, atau genre..."
                            class="w-full bg-black/20 border border-white/10 rounded-full py-2.5 pl-12 pr-4 text-sm focus:outline-none focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/50 transition-all placeholder-gray-600 text-gray-300"
                        >
                    </form>
                </div>

                <div class="flex items-center gap-4 sm:gap-6 ml-4 sm:ml-6">
                    <?php if(auth()->guard()->check()): ?>
                        <div class="relative group">
                            <button class="flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/5 hover:bg-white/10 text-sm text-gray-200">
                                <span><?php echo e(auth()->user()->name); ?></span>
                                <i data-lucide="chevron-down" class="w-4 h-4"></i>
                            </button>
                            <div class="absolute right-0 mt-3 w-56 glass-panel rounded-xl border border-white/10 py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                                <a href="<?php echo e(route('profile.show')); ?>" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-200 hover:bg-white/5">
                                    <i data-lucide="user" class="w-4 h-4"></i>
                                    Profil Saya
                                </a>
                                <a href="<?php echo e(route('favorites.index')); ?>" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-200 hover:bg-white/5">
                                    <i data-lucide="heart" class="w-4 h-4"></i>
                                    Buku Favorit
                                </a>
                                <a href="<?php echo e(route('orders.unpaid')); ?>" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-200 hover:bg-white/5">
                                    <i data-lucide="clock" class="w-4 h-4"></i>
                                    Pesanan Belum Dibayar
                                </a>
                                <a href="<?php echo e(route('orders.paid')); ?>" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-200 hover:bg-white/5">
                                    <i data-lucide="check-circle" class="w-4 h-4"></i>
                                    Pesanan Selesai
                                </a>
                                <a href="<?php echo e(route('borrows.index')); ?>" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-200 hover:bg-white/5">
                                    <i data-lucide="calendar-check" class="w-4 h-4"></i>
                                    Reservasi Pinjam Buku
                                </a>
                                <hr class="my-2 border-white/10">
                                <form method="POST" action="<?php echo e(route('logout')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="w-full flex items-center gap-2 px-4 py-2 text-sm text-red-300 hover:bg-white/5">
                                        <i data-lucide="log-out" class="w-4 h-4"></i>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>" class="text-sm text-gray-300 hover:text-amber-300">
                            Login
                        </a>
                        <a href="<?php echo e(route('register')); ?>" class="px-4 py-2 rounded-full bg-gradient-to-r from-amber-600 to-amber-500 text-black text-sm font-medium hover:shadow-lg hover:shadow-amber-500/25">
                            Daftar
                        </a>
                    <?php endif; ?>
                    <button class="md:hidden p-2 hover:bg-white/5 rounded-full">
                        <i data-lucide="menu" class="w-5 h-5 text-gray-400"></i>
                    </button>
                </div>
            </header>

            <div class="p-4 sm:p-8 max-w-7xl mx-auto space-y-4 sm:space-y-8">
                <!-- Flash Messages -->
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

                <?php if(session('info')): ?>
                    <div class="glass-panel rounded-xl border border-blue-500/30 px-4 py-3 text-sm text-blue-200 flex items-start gap-3">
                        <i data-lucide="info" class="w-5 h-5 text-blue-400 mt-0.5"></i>
                        <p><?php echo e(session('info')); ?></p>
                    </div>
                <?php endif; ?>

                <!-- Page Content -->
                <?php echo $__env->yieldContent('content'); ?>

                <footer class="pt-8 pb-4 text-center text-xs text-gray-500">
                    &copy; <?php echo e(date('Y')); ?> F-Colletion E-Library. Dibuat dengan Laravel.
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
<?php /**PATH D:\laragon\www\laravel\laravel_ebook\resources\views/layouts/app.blade.php ENDPATH**/ ?>