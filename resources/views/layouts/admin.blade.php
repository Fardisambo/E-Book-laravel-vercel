<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Panel') - EbookStore</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="admin-layout antialiased overflow-hidden h-screen">
    <div class="ui-shell h-full p-2 sm:p-4">
    <div class="flex h-full gap-3 sm:gap-4">
        <!-- Sidebar -->
        <aside class="hidden md:flex w-72 ui-sidebar flex-col justify-between p-5">
            <div>
                <div class="flex items-center gap-3 mb-10">
                    <div class="w-10 h-10 rounded-xl bg-amber-500 flex items-center justify-center">
                        <i data-lucide="shield" class="w-5 h-5 text-black"></i>
                    </div>
                    <div class="text-white">
                        <span class="text-xl font-semibold">Admin</span>
                        <p class="text-[11px] text-gray-500 uppercase tracking-[0.2em]">E-Library</p>
                    </div>
                </div>

                <nav class="space-y-2 text-sm">
                    <a href="{{ route('admin.dashboard') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition {{ request()->routeIs('admin.dashboard') ? 'bg-white/10 text-white' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                        <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                        <span class="font-medium">Dashboard</span>
                    </a>

                    <a href="{{ route('admin.books.index') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition {{ request()->routeIs('admin.books.*') ? 'bg-white/10 text-white' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                        <i data-lucide="book-open" class="w-5 h-5"></i>
                        <span>Buku</span>
                    </a>

                    <a href="{{ route('admin.borrows.index') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition {{ request()->routeIs('admin.borrows.*') ? 'bg-white/10 text-white' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                        <i data-lucide="book-open" class="w-5 h-5"></i>
                        <span>Pinjaman Buku</span>
                    </a>

                    <a href="{{ route('admin.categories.index') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition {{ request()->routeIs('admin.categories.*') ? 'bg-white/10 text-white' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                        <i data-lucide="grid-2x2" class="w-5 h-5"></i>
                        <span>Kategori</span>
                    </a>

                    <a href="{{ route('admin.users.index') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition {{ request()->routeIs('admin.users.*') ? 'bg-white/10 text-white' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                        <i data-lucide="users" class="w-5 h-5"></i>
                        <span>Users</span>
                    </a>

                    <a href="{{ route('admin.purchases.index') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition {{ request()->routeIs('admin.purchases.*') ? 'bg-white/10 text-white' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                        <i data-lucide="shopping-bag" class="w-5 h-5"></i>
                        <span>Pesanan Buku</span>
                    </a>

                    <a href="{{ route('admin.subscriptions.index') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition {{ request()->routeIs('admin.subscriptions.*') ? 'bg-white/10 text-white' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                        <i data-lucide="badge-check" class="w-5 h-5"></i>
                        <span>Langganan</span>
                    </a>

                    <a href="{{ route('admin.payment-methods.index') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition {{ request()->routeIs('admin.payment-methods.*') ? 'bg-white/10 text-white' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                        <i data-lucide="credit-card" class="w-5 h-5"></i>
                        <span>Metode Pembayaran</span>
                    </a>

                    <a href="{{ route('books.index') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition text-slate-400 hover:text-white hover:bg-white/5">
                        <i data-lucide="arrow-left" class="w-5 h-5"></i>
                        <span>Kembali ke User</span>
                    </a>
                </nav>
            </div>

            <div class="mt-6 ui-panel p-4">
                <div class="flex items-center justify-between gap-3">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-full bg-gradient-to-br from-gray-700 to-gray-900 border border-amber-500/30 flex items-center justify-center">
                            <i data-lucide="user-cog" class="w-4 h-4 text-amber-300"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400">Login sebagai</p>
                            <p class="text-sm font-medium text-white truncate max-w-[130px]">
                                {{ auth()->user()->name }}
                            </p>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-xs text-slate-400 hover:text-white flex items-center gap-1">
                            <i data-lucide="log-out" class="w-4 h-4"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Mobile Sidebar -->
        <div id="admin-mobile-overlay" class="md:hidden hidden fixed inset-0 z-40 bg-black/40"></div>
        <aside id="admin-mobile-sidebar" class="md:hidden fixed left-0 top-0 bottom-0 z-50 w-72 max-w-[88vw] ui-sidebar p-5 flex flex-col justify-between -translate-x-full transition-transform duration-200">
            <div>
                <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-amber-500 flex items-center justify-center">
                            <i data-lucide="shield" class="w-5 h-5 text-black"></i>
                        </div>
                        <div class="text-white">
                            <span class="text-xl font-semibold">Admin</span>
                            <p class="text-[11px] text-gray-500 uppercase tracking-[0.2em]">E-Library</p>
                        </div>
                    </div>
                    <button id="admin-mobile-close" type="button" class="p-2 rounded-lg hover:bg-white/10 text-slate-300">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </div>
                <nav class="space-y-2 text-sm">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition {{ request()->routeIs('admin.dashboard') ? 'bg-white/10 text-white' : 'text-slate-400' }}">
                        <i data-lucide="layout-dashboard" class="w-4 h-4"></i><span>Dashboard</span>
                    </a>
                    <a href="{{ route('admin.books.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition {{ request()->routeIs('admin.books.*') ? 'bg-white/10 text-white' : 'text-slate-400' }}">
                        <i data-lucide="book-open" class="w-4 h-4"></i><span>Buku</span>
                    </a>
                    <a href="{{ route('admin.borrows.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition {{ request()->routeIs('admin.borrows.*') ? 'bg-white/10 text-white' : 'text-slate-400' }}">
                        <i data-lucide="calendar-check" class="w-4 h-4"></i><span>Pinjaman Buku</span>
                    </a>
                    <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition {{ request()->routeIs('admin.categories.*') ? 'bg-white/10 text-white' : 'text-slate-400' }}">
                        <i data-lucide="grid-2x2" class="w-4 h-4"></i><span>Kategori</span>
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition {{ request()->routeIs('admin.users.*') ? 'bg-white/10 text-white' : 'text-slate-400' }}">
                        <i data-lucide="users" class="w-4 h-4"></i><span>Users</span>
                    </a>
                    <a href="{{ route('admin.purchases.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition {{ request()->routeIs('admin.purchases.*') ? 'bg-white/10 text-white' : 'text-slate-400' }}">
                        <i data-lucide="shopping-bag" class="w-4 h-4"></i><span>Pesanan Buku</span>
                    </a>
                    <a href="{{ route('admin.subscriptions.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition {{ request()->routeIs('admin.subscriptions.*') ? 'bg-white/10 text-white' : 'text-slate-400' }}">
                        <i data-lucide="badge-check" class="w-4 h-4"></i><span>Langganan</span>
                    </a>
                    <a href="{{ route('admin.payment-methods.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition {{ request()->routeIs('admin.payment-methods.*') ? 'bg-white/10 text-white' : 'text-slate-400' }}">
                        <i data-lucide="credit-card" class="w-4 h-4"></i><span>Metode Pembayaran</span>
                    </a>
                    <a href="{{ route('books.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition text-slate-400">
                        <i data-lucide="arrow-left" class="w-4 h-4"></i><span>Kembali ke User</span>
                    </a>
                </nav>
            </div>
                <div class="ui-panel p-3 space-y-2">
                    <p class="text-[11px] uppercase tracking-[0.18em] text-slate-500 px-2">Akses cepat</p>
                    <a href="{{ route('admin.categories.index') }}" class="ui-btn-ghost w-full justify-start {{ request()->routeIs('admin.categories.*') ? 'bg-white/10' : '' }}">
                        <i data-lucide="grid-2x2" class="w-4 h-4"></i>
                        Kategori
                    </a>
                    <a href="{{ route('admin.purchases.index') }}" class="ui-btn-ghost w-full justify-start {{ request()->routeIs('admin.purchases.*') ? 'bg-white/10' : '' }}">
                        <i data-lucide="shopping-bag" class="w-4 h-4"></i>
                        Pesanan Buku
                    </a>
                    <a href="{{ route('admin.subscriptions.index') }}" class="ui-btn-ghost w-full justify-start {{ request()->routeIs('admin.subscriptions.*') ? 'bg-white/10' : '' }}">
                        <i data-lucide="badge-check" class="w-4 h-4"></i>
                        Langganan
                    </a>
                    <a href="{{ route('admin.payment-methods.index') }}" class="ui-btn-ghost w-full justify-start {{ request()->routeIs('admin.payment-methods.*') ? 'bg-white/10' : '' }}">
                        <i data-lucide="credit-card" class="w-4 h-4"></i>
                        Metode Pembayaran
                    </a>
                <button type="button" data-theme-toggle class="ui-btn-ghost w-full justify-start">
                    <i data-lucide="sun" class="w-4 h-4"></i>
                    <span data-theme-toggle-label>Mode Terang</span>
                </button>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="ui-btn-ghost w-full justify-start text-red-400">Logout</button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto">
            <header class="ui-topbar sticky top-0 z-20 px-3 sm:px-6 py-3 sm:py-4 flex items-center justify-between mb-4">
                <div>
                    <div class="flex items-center gap-2">
                        <button id="admin-mobile-open" type="button" class="md:hidden p-2 rounded-lg border border-slate-300/40 dark:border-slate-600/50">
                            <i data-lucide="menu" class="w-5 h-5 text-slate-700 dark:text-slate-200"></i>
                        </button>
                        <p class="text-xs uppercase tracking-[0.25em] text-gray-500 mb-1">Admin Panel</p>
                    </div>
                    <h1 class="text-lg sm:text-xl font-semibold text-white">@yield('title', 'Dashboard')</h1>
                </div>
                <div class="flex items-center gap-3 text-xs text-gray-400">
                    <span class="hidden sm:inline-flex items-center gap-1">
                        <i data-lucide="shield-check" class="w-4 h-4 text-emerald-400"></i>
                        Akses terautentikasi
                    </span>
                    <span class="w-px h-6 bg-white/10 hidden sm:block"></span>
                    <span class="text-[11px] uppercase tracking-[0.2em] text-gray-500">
                        {{ now()->format('d M Y') }}
                    </span>
                    <button type="button" data-theme-toggle class="ui-btn-ghost hidden sm:inline-flex">
                        <i data-lucide="sun" class="w-4 h-4"></i>
                        <span data-theme-toggle-label>Mode Terang</span>
                    </button>
                </div>
            </header>

            <div class="p-2 pb-24 sm:pb-4 sm:p-4 space-y-4 sm:space-y-6">
                @if(session('success'))
                    <div class="ui-alert text-emerald-300 flex items-start gap-3">
                        <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-400 mt-0.5"></i>
                        <p>{{ session('success') }}</p>
                    </div>
                @endif

                @if(session('error'))
                    <div class="ui-alert text-red-300 flex items-start gap-3">
                        <i data-lucide="alert-triangle" class="w-5 h-5 text-red-400 mt-0.5"></i>
                        <p>{{ session('error') }}</p>
                    </div>
                @endif

                @yield('content')

                <footer class="pt-6 pb-2 text-center text-[11px] text-slate-400">
                    &copy; {{ date('Y') }} EbookStore Admin. Semua hak cipta dilindungi.
                </footer>
            </div>

            <nav class="md:hidden fixed bottom-3 left-3 right-3 ui-panel px-2 py-1.5 z-30">
                <div class="grid grid-cols-5 gap-1 text-[11px]">
                    <a href="{{ route('admin.dashboard') }}" class="flex flex-col items-center py-2 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-white/10 text-white' : 'text-slate-400' }}">
                        <i data-lucide="layout-dashboard" class="w-4 h-4 mb-1"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('admin.books.index') }}" class="flex flex-col items-center py-2 rounded-lg {{ request()->routeIs('admin.books.*') ? 'bg-white/10 text-white' : 'text-slate-400' }}">
                        <i data-lucide="book-open" class="w-4 h-4 mb-1"></i>
                        <span>Buku</span>
                    </a>
                    <a href="{{ route('admin.borrows.index') }}" class="flex flex-col items-center py-2 rounded-lg {{ request()->routeIs('admin.borrows.*') ? 'bg-white/10 text-white' : 'text-slate-400' }}">
                        <i data-lucide="calendar-check" class="w-4 h-4 mb-1"></i>
                        <span>Pinjaman</span>
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="flex flex-col items-center py-2 rounded-lg {{ request()->routeIs('admin.users.*') ? 'bg-white/10 text-white' : 'text-slate-400' }}">
                        <i data-lucide="users" class="w-4 h-4 mb-1"></i>
                        <span>Users</span>
                    </a>
                    <button type="button" data-theme-toggle class="flex flex-col items-center py-2 rounded-lg text-slate-400">
                        <i data-lucide="sun" class="w-4 h-4 mb-1"></i>
                        <span data-theme-toggle-label>Tema</span>
                    </button>
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
            const openBtn = document.getElementById('admin-mobile-open');
            const closeBtn = document.getElementById('admin-mobile-close');
            const overlay = document.getElementById('admin-mobile-overlay');
            const sidebar = document.getElementById('admin-mobile-sidebar');

            applyTheme(savedTheme === 'dark' ? 'dark' : 'light');

            toggles.forEach((toggle) => {
                toggle.addEventListener('click', function () {
                    const isDark = document.body.classList.contains('dark-theme');
                    applyTheme(isDark ? 'light' : 'dark');
                });
            });

            const closeSidebar = () => {
                if (!overlay || !sidebar) return;
                overlay.classList.add('hidden');
                sidebar.classList.add('-translate-x-full');
            };

            const openSidebar = () => {
                if (!overlay || !sidebar) return;
                overlay.classList.remove('hidden');
                sidebar.classList.remove('-translate-x-full');
            };

            if (openBtn) openBtn.addEventListener('click', openSidebar);
            if (closeBtn) closeBtn.addEventListener('click', closeSidebar);
            if (overlay) overlay.addEventListener('click', closeSidebar);

            window.addEventListener('resize', function () {
                if (window.innerWidth >= 768) {
                    closeSidebar();
                }
            });
        });
    </script>
</body>
</html>
