<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Katalog Ebook'); ?></title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="antialiased h-screen overflow-hidden">
    <div class="ui-shell h-full p-4 sm:p-5">
        <div class="flex h-full gap-4">
        <!-- Sidebar -->
        <aside class="hidden md:flex w-72 ui-sidebar flex-col justify-between p-5">
            <div>
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-10 h-10 rounded-xl bg-amber-500 flex items-center justify-center">
                        <i data-lucide="book-open" class="w-5 h-5 text-slate-900"></i>
                    </div>
                    <a href="<?php echo e(route('books.index')); ?>" class="text-xl font-semibold text-white">
                        F-Collection
                    </a>
                </div>

                <nav class="space-y-2 text-sm">
                    <?php if(auth()->guard()->check()): ?>
                        <?php if(auth()->user()->isAuthor()): ?>
                            <a href="<?php echo e(route('author.dashboard')); ?>"
                               class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition <?php echo e(request()->routeIs('author.dashboard') ? 'bg-white/10 text-white' : 'text-slate-400 hover:text-white hover:bg-white/5'); ?>">
                                <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                                <span class="font-medium">Dashboard Petugas</span>
                            </a>
                            <a href="<?php echo e(route('author.books.index')); ?>"
                               class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition <?php echo e(request()->routeIs('author.books.*') ? 'bg-white/10 text-white' : 'text-slate-400 hover:text-white hover:bg-white/5'); ?>">
                                <i data-lucide="book" class="w-5 h-5"></i>
                                <span>Kelola Buku</span>
                            </a>
                            <a href="<?php echo e(route('author.borrows.index')); ?>"
                               class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition <?php echo e(request()->routeIs('author.borrows.*') ? 'bg-white/10 text-white' : 'text-slate-400 hover:text-white hover:bg-white/5'); ?>">
                                <i data-lucide="clipboard-list" class="w-5 h-5"></i>
                                <span>Kelola Peminjaman</span>
                            </a>
                            <a href="<?php echo e(route('books.index')); ?>"
                                class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition text-slate-400 hover:text-white hover:bg-white/5">
                                <i data-lucide="arrow-left" class="w-5 h-5"></i>
                                <span>Kembali ke User</span>
                            </a>
                        <?php else: ?>
                            <a href="<?php echo e(route('books.index')); ?>"
                               class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition <?php echo e(request()->routeIs('books.index') ? 'bg-white/10 text-white' : 'text-slate-400 hover:text-white hover:bg-white/5'); ?>">
                                <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                                <span class="font-medium">Dashboard</span>
                            </a>
                            <a href="<?php echo e(route('books.browse')); ?>"
                               class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition <?php echo e(request()->routeIs('books.browse') ? 'bg-white/10 text-white' : 'text-slate-400 hover:text-white hover:bg-white/5'); ?>">
                                <i data-lucide="library" class="w-5 h-5"></i>
                                <span>Jelajahi Semua Buku</span>
                            </a>
                            <a href="<?php echo e(route('favorites.index')); ?>"
                               class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition <?php echo e(request()->routeIs('favorites.index') ? 'bg-white/10 text-white' : 'text-slate-400 hover:text-white hover:bg-white/5'); ?>">
                                <i data-lucide="heart" class="w-5 h-5"></i>
                                <span>Buku Favorit</span>
                            </a>
                            <a href="<?php echo e(route('orders.paid')); ?>"
                               class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition <?php echo e(request()->routeIs('orders.paid') ? 'bg-white/10 text-white' : 'text-slate-400 hover:text-white hover:bg-white/5'); ?>">
                                <i data-lucide="bookmark" class="w-5 h-5"></i>
                                <span>Pesanan Selesai</span>
                            </a>
                            <a href="<?php echo e(route('orders.unpaid')); ?>"
                               class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition <?php echo e(request()->routeIs('orders.unpaid') ? 'bg-white/10 text-white' : 'text-slate-400 hover:text-white hover:bg-white/5'); ?>">
                                <i data-lucide="history" class="w-5 h-5"></i>
                                <span>Menunggu Pembayaran</span>
                            </a>
                            <a href="<?php echo e(route('borrows.index')); ?>"
                               class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition <?php echo e(request()->routeIs('borrows.*') ? 'bg-white/10 text-white' : 'text-slate-400 hover:text-white hover:bg-white/5'); ?>">
                                <i data-lucide="calendar-check" class="w-5 h-5"></i>
                                <span>Reservasi Pinjam Buku</span>
                            </a>
                            <a href="<?php echo e(route('subscriptions.index')); ?>"
                               class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition <?php echo e(request()->routeIs('subscriptions.*') ? 'bg-white/10 text-white' : 'text-slate-400 hover:text-white hover:bg-white/5'); ?>">
                                <i data-lucide="settings" class="w-5 h-5"></i>
                                <span>Langganan</span>
                            </a>
                        <?php endif; ?>
                        <?php if(auth()->user()->isAdmin()): ?>
                            <a href="<?php echo e(route('admin.dashboard')); ?>"
                               class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition <?php echo e(request()->routeIs('admin.dashboard') ? 'bg-white/10 text-white' : 'text-slate-400 hover:text-white hover:bg-white/5'); ?>">
                                <i data-lucide="shield" class="w-5 h-5"></i>
                                <span>Admin Panel</span>
                            </a>
                        <?php endif; ?>
                    <?php endif; ?>
                </nav>
            </div>

            <?php if(auth()->guard()->check()): ?>
                <div class="ui-panel p-4">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-gray-700 to-gray-900 border border-amber-500/30 flex items-center justify-center">
                            <i data-lucide="user" class="w-5 h-5 text-amber-300"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-white"><?php echo e(auth()->user()->name); ?></p>
                            <p class="text-xs text-slate-400"><?php echo e(auth()->user()->email); ?></p>
                        </div>
                    </div>
                    <div class="flex items-center justify-between mt-2">
                        <form method="POST" action="<?php echo e(route('logout')); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="text-xs text-slate-400 hover:text-white flex items-center gap-1">
                                <i data-lucide="log-out" class="w-4 h-4"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            <?php else: ?>
                <div class="space-y-2">
                    <a href="<?php echo e(route('login')); ?>" class="ui-btn-ghost w-full">
                        Login
                    </a>
                    <a href="<?php echo e(route('register')); ?>" class="ui-btn-primary w-full">
                        Daftar
                    </a>
                </div>
            <?php endif; ?>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto">
            <!-- Header -->
            <header class="ui-topbar sticky top-0 z-20 px-3 sm:px-6 py-3 sm:py-4 mb-4">
                <div class="flex items-center gap-2 sm:gap-4">
                    <div class="flex items-center gap-2 flex-1 w-full max-w-none sm:max-w-2xl">
                    <form action="<?php echo e(route('books.search')); ?>" method="GET" class="relative w-full">
                        <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-500"></i>
                        <input
                            name="q"
                            value="<?php echo e(request('q')); ?>"
                            type="text"
                            placeholder="Cari judul, penulis, atau genre..."
                            class="ui-input rounded-full pl-12"
                        >
                    </form>
                </div>

                <div class="hidden md:flex items-center gap-4 sm:gap-6 ml-4 sm:ml-6">
                    <?php if(auth()->guard()->check()): ?>
                        <button type="button" data-theme-toggle class="ui-btn-ghost">
                            <i data-lucide="sun" class="w-4 h-4"></i>
                            <span data-theme-toggle-label>Mode Terang</span>
                        </button>
                        <div class="relative group">
                            <button class="ui-btn-ghost">
                                <span><?php echo e(auth()->user()->name); ?></span>
                                <i data-lucide="chevron-down" class="w-4 h-4"></i>
                            </button>
                            <div class="absolute right-0 mt-3 w-56 ui-panel py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
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
                        <button type="button" data-theme-toggle class="ui-btn-ghost">
                            <i data-lucide="sun" class="w-4 h-4"></i>
                            <span data-theme-toggle-label>Mode Terang</span>
                        </button>
                        <a href="<?php echo e(route('login')); ?>" class="text-sm text-gray-300 hover:text-amber-300">
                            Login
                        </a>
                        <a href="<?php echo e(route('register')); ?>" class="ui-btn-primary">
                            Daftar
                        </a>
                    <?php endif; ?>
                </div>

                    <button id="mobile-nav-toggle" type="button" class="md:hidden p-2 rounded-xl border border-slate-300/50 dark:border-slate-600/60 bg-white/80 dark:bg-slate-900/80">
                        <i data-lucide="menu" class="w-5 h-5 text-slate-700 dark:text-slate-200"></i>
                    </button>
                </div>

                <div id="mobile-nav-menu" class="md:hidden hidden mt-3 ui-panel p-3 space-y-2">
                    <button type="button" data-theme-toggle class="ui-btn-ghost w-full justify-start">
                        <i data-lucide="sun" class="w-4 h-4"></i>
                        <span data-theme-toggle-label>Mode Terang</span>
                    </button>
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(route('profile.show')); ?>" class="ui-btn-ghost w-full justify-start">Profil Saya</a>
                        <form method="POST" action="<?php echo e(route('logout')); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="ui-btn-ghost w-full justify-start text-red-400">Logout</button>
                        </form>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>" class="ui-btn-ghost w-full justify-start">Login</a>
                        <a href="<?php echo e(route('register')); ?>" class="ui-btn-primary w-full justify-start">Daftar</a>
                    <?php endif; ?>
                </div>
            </header>

            <div class="p-2 pb-24 sm:pb-4 sm:p-4 max-w-7xl mx-auto space-y-4 sm:space-y-6">
                <!-- Flash Messages -->
                <?php if(session('success')): ?>
                    <div class="ui-alert text-emerald-300 flex items-start gap-3">
                        <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-400 mt-0.5"></i>
                        <p><?php echo e(session('success')); ?></p>
                    </div>
                <?php endif; ?>

                <?php if(session('error')): ?>
                    <div class="ui-alert text-red-300 flex items-start gap-3">
                        <i data-lucide="alert-triangle" class="w-5 h-5 text-red-400 mt-0.5"></i>
                        <p><?php echo e(session('error')); ?></p>
                    </div>
                <?php endif; ?>

                <?php if(session('info')): ?>
                    <div class="ui-alert text-blue-300 flex items-start gap-3">
                        <i data-lucide="info" class="w-5 h-5 text-blue-400 mt-0.5"></i>
                        <p><?php echo e(session('info')); ?></p>
                    </div>
                <?php endif; ?>

                <!-- Page Content -->
                <?php echo $__env->yieldContent('content'); ?>

                <footer class="pt-6 pb-2 text-center text-xs text-slate-400">
                    &copy; <?php echo e(date('Y')); ?> F-Colletion E-Library. Dibuat dengan Laravel.
                </footer>
            </div>

            <nav class="md:hidden fixed bottom-3 left-3 right-3 ui-panel px-2 py-1.5 z-30">
                <div class="grid grid-cols-5 gap-1 text-[11px]">
                    <?php if(auth()->guard()->check()): ?>
                        <?php if(auth()->user()->isAuthor()): ?>
                            <a href="<?php echo e(route('author.dashboard')); ?>" class="flex flex-col items-center py-2 rounded-lg <?php echo e(request()->routeIs('author.dashboard') ? 'bg-white/10 text-white' : 'text-slate-400'); ?>">
                                <i data-lucide="layout-dashboard" class="w-4 h-4 mb-1"></i>
                                <span>Dashboard</span>
                            </a>
                            <a href="<?php echo e(route('author.books.index')); ?>" class="flex flex-col items-center py-2 rounded-lg <?php echo e(request()->routeIs('author.books.*') ? 'bg-white/10 text-white' : 'text-slate-400'); ?>">
                                <i data-lucide="book-open" class="w-4 h-4 mb-1"></i>
                                <span>Semua Buku</span>
                            </a>
                            <a href="<?php echo e(route('author.borrows.index')); ?>" class="flex flex-col items-center py-2 rounded-lg <?php echo e(request()->routeIs('author.borrows.*') ? 'bg-white/10 text-white' : 'text-slate-400'); ?>">
                                <i data-lucide="calendar-check" class="w-4 h-4 mb-1"></i>
                                <span>Reservasi</span>
                            </a>
                            <a href="<?php echo e(route('favorites.index')); ?>" class="flex flex-col items-center py-2 rounded-lg <?php echo e(request()->routeIs('favorites.index') ? 'bg-white/10 text-white' : 'text-slate-400'); ?>">
                                <i data-lucide="heart" class="w-4 h-4 mb-1"></i>
                                <span>Favorit</span>
                            </a>
                            <a href="<?php echo e(route('books.index')); ?>" class="flex flex-col items-center py-2 rounded-lg text-slate-400">
                                <i data-lucide="home" class="w-4 h-4 mb-1"></i>
                                <span>User</span>
                            </a>
                        <?php else: ?>
                            <a href="<?php echo e(route('books.index')); ?>" class="flex flex-col items-center py-2 rounded-lg <?php echo e(request()->routeIs('books.index') ? 'bg-white/10 text-white' : 'text-slate-400'); ?>">
                                <i data-lucide="layout-dashboard" class="w-4 h-4 mb-1"></i>
                                <span>Dashboard</span>
                            </a>
                            <a href="<?php echo e(route('books.browse')); ?>" class="flex flex-col items-center py-2 rounded-lg <?php echo e(request()->routeIs('books.browse') ? 'bg-white/10 text-white' : 'text-slate-400'); ?>">
                                <i data-lucide="book-open" class="w-4 h-4 mb-1"></i>
                                <span>Semua Buku</span>
                            </a>
                            <a href="<?php echo e(route('favorites.index')); ?>" class="flex flex-col items-center py-2 rounded-lg <?php echo e(request()->routeIs('favorites.index') ? 'bg-white/10 text-white' : 'text-slate-400'); ?>">
                                <i data-lucide="heart" class="w-4 h-4 mb-1"></i>
                                <span>Favorit</span>
                            </a>
                            <a href="<?php echo e(route('borrows.index')); ?>" class="flex flex-col items-center py-2 rounded-lg <?php echo e(request()->routeIs('borrows.*') ? 'bg-white/10 text-white' : 'text-slate-400'); ?>">
                                <i data-lucide="calendar-check" class="w-4 h-4 mb-1"></i>
                                <span>Reservasi</span>
                            </a>
                            <?php if(auth()->user()->isAdmin()): ?>
                                <a href="<?php echo e(route('admin.dashboard')); ?>" class="flex flex-col items-center py-2 rounded-lg <?php echo e(request()->routeIs('admin.*') ? 'bg-white/10 text-white' : 'text-slate-400'); ?>">
                                    <i data-lucide="shield" class="w-4 h-4 mb-1"></i>
                                    <span>Admin</span>
                                </a>
                            <?php else: ?>
                                <a href="<?php echo e(route('subscriptions.index')); ?>" class="flex flex-col items-center py-2 rounded-lg <?php echo e(request()->routeIs('subscriptions.*') ? 'bg-white/10 text-white' : 'text-slate-400'); ?>">
                                    <i data-lucide="badge-check" class="w-4 h-4 mb-1"></i>
                                    <span>Langganan</span>
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php else: ?>
                        <a href="<?php echo e(route('books.index')); ?>" class="flex flex-col items-center py-2 rounded-lg <?php echo e(request()->routeIs('books.index') ? 'bg-white/10 text-white' : 'text-slate-400'); ?>">
                            <i data-lucide="layout-dashboard" class="w-4 h-4 mb-1"></i>
                            <span>Dashboard</span>
                        </a>
                        <a href="<?php echo e(route('books.browse')); ?>" class="flex flex-col items-center py-2 rounded-lg <?php echo e(request()->routeIs('books.browse') ? 'bg-white/10 text-white' : 'text-slate-400'); ?>">
                            <i data-lucide="book-open" class="w-4 h-4 mb-1"></i>
                            <span>Semua Buku</span>
                        </a>
                        <a href="<?php echo e(route('login')); ?>" class="flex flex-col items-center py-2 rounded-lg text-slate-400">
                            <i data-lucide="log-in" class="w-4 h-4 mb-1"></i>
                            <span>Login</span>
                        </a>
                        <a href="<?php echo e(route('register')); ?>" class="flex flex-col items-center py-2 rounded-lg text-slate-400">
                            <i data-lucide="user-plus" class="w-4 h-4 mb-1"></i>
                            <span>Daftar</span>
                        </a>
                        <button type="button" data-theme-toggle class="flex flex-col items-center py-2 rounded-lg text-slate-400">
                            <i data-lucide="sun" class="w-4 h-4 mb-1"></i>
                            <span data-theme-toggle-label>Tema</span>
                        </button>
                    <?php endif; ?>
                </div>
            </nav>
        </main>
    </div>
    </div>

    <script>
        function applyTheme(mode) {
            const body = document.body;
            const labels = document.querySelectorAll('[data-theme-toggle-label]');
            if (!labels.length) return;

            if (mode === 'light') {
                body.classList.remove('dark-theme');
                labels.forEach((label) => label.textContent = 'Mode Gelap');
            } else {
                body.classList.add('dark-theme');
                labels.forEach((label) => label.textContent = 'Mode Terang');
            }
            localStorage.setItem('site-theme', mode);
            if (window.lucide) {
                lucide.createIcons();
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            const savedTheme = localStorage.getItem('site-theme');
            const toggles = document.querySelectorAll('[data-theme-toggle]');
            const mobileToggle = document.getElementById('mobile-nav-toggle');
            const mobileMenu = document.getElementById('mobile-nav-menu');

            applyTheme(savedTheme === 'dark' ? 'dark' : 'light');

            toggles.forEach((toggle) => {
                toggle.addEventListener('click', function () {
                    const isDark = document.body.classList.contains('dark-theme');
                    applyTheme(isDark ? 'light' : 'dark');
                });
            });

            if (mobileToggle && mobileMenu) {
                mobileToggle.addEventListener('click', function () {
                    mobileMenu.classList.toggle('hidden');
                });
            }
        });
    </script>
</body>
</html>
<?php /**PATH C:\laragon\www\laravel_ebook\resources\views/layouts/app.blade.php ENDPATH**/ ?>