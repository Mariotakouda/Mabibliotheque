<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Accueil') · CLAC</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        ink: {
                            950: '#0C1220',
                            900: '#121A2E',
                            800: '#1B2540',
                            700: '#26325A',
                            600: '#374472',
                        },
                        brass: {
                            50:  '#FBF4E6',
                            100: '#F4E4C1',
                            300: '#DDB158',
                            500: '#B8872B',
                            600: '#9C7124',
                            700: '#7C5A1D',
                        },
                        paper: '#F4F2ED',
                    },
                    fontFamily: {
                        display: ['"Fraunces"', 'serif'],
                        sans: ['"Inter"', 'sans-serif'],
                    },
                },
            },
        };
    </script>

    <style type="text/tailwindcss">
        @layer base {
            body { @apply bg-paper text-ink-900 font-sans antialiased; }
            h1, h2, h3 { @apply font-display; }
        }

        @layer components {
            /* ---- Layout shell ---- */
            .app-shell { @apply lg:pl-64; }

            .sidebar {
                @apply fixed inset-y-0 left-0 z-40 w-64 bg-ink-900 text-white flex flex-col
                       transform -translate-x-full transition-transform duration-200 ease-out
                       lg:translate-x-0;
            }
            .sidebar.is-open { @apply translate-x-0; }

            .brand-mark {
                @apply flex items-center gap-2.5 px-6 h-20 border-b border-white/10 shrink-0;
            }
            .brand-mark .brand-name { @apply font-display text-lg font-semibold tracking-wide; }
            .brand-mark .brand-tag { @apply text-[11px] text-brass-300 tracking-[0.2em] uppercase; }

            .nav-section { @apply px-4 py-5 space-y-1 overflow-y-auto; }

            .nav-link {
                @apply flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium
                       text-white/65 hover:text-white hover:bg-white/5 transition-colors;
            }
            .nav-link.active { @apply bg-brass-500/15 text-brass-300; }
            .nav-link svg { @apply w-[18px] h-[18px] shrink-0; }

            .sidebar-footer { @apply mt-auto p-4 border-t border-white/10; }

            .topbar {
                @apply lg:hidden fixed top-0 inset-x-0 z-30 h-16 bg-ink-900 text-white
                       flex items-center justify-between px-4 shadow-sm;
            }
            .scrim { @apply fixed inset-0 bg-ink-950/60 z-30 lg:hidden; }

            .page-wrap { @apply px-5 sm:px-8 pt-24 lg:pt-10 pb-16 max-w-6xl mx-auto; }

            /* ---- Typography ---- */
            .page-title { @apply text-2xl sm:text-3xl font-semibold text-ink-900; }
            .page-subtitle { @apply text-sm text-ink-700/70 mt-1; }
            .eyebrow { @apply text-xs font-semibold tracking-[0.14em] uppercase text-brass-600; }

            /* ---- Cards & surfaces ---- */
            .surface { @apply bg-white rounded-2xl border border-ink-900/[0.06] shadow-sm; }
            .surface-pad { @apply p-6 sm:p-8; }
            .auth-surface { @apply bg-white rounded-2xl border border-ink-900/[0.06] shadow-xl p-8 sm:p-10; }

            .stat-card { @apply surface p-5 flex items-start gap-4; }
            .stat-card .stat-icon { @apply w-10 h-10 rounded-xl bg-brass-50 text-brass-600 flex items-center justify-center shrink-0; }
            .stat-card .stat-label { @apply text-xs font-medium text-ink-700/60 uppercase tracking-wide; }
            .stat-card .stat-value { @apply text-2xl font-display font-semibold text-ink-900 mt-0.5; }

            /* ---- Buttons ---- */
            .btn {
                @apply inline-flex items-center justify-center gap-2 rounded-lg px-4 py-2.5
                       text-sm font-semibold transition-colors duration-150 whitespace-nowrap
                       focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2;
            }
            .btn svg { @apply w-4 h-4; }
            .btn-primary { @apply bg-ink-900 text-white hover:bg-ink-800 focus-visible:ring-ink-900; }
            .btn-accent { @apply bg-brass-500 text-white hover:bg-brass-600 focus-visible:ring-brass-500; }
            .btn-outline { @apply bg-white text-ink-900 border border-ink-900/15 hover:bg-ink-900/[0.04] focus-visible:ring-ink-900; }
            .btn-danger { @apply bg-white text-red-700 border border-red-200 hover:bg-red-50 focus-visible:ring-red-500; }
            .btn-ghost { @apply text-ink-700/70 hover:text-ink-900 hover:bg-ink-900/[0.04]; }
            .btn-sm { @apply px-3 py-1.5 text-xs; }
            .btn-block { @apply w-full; }

            /* ---- Icon buttons (table row actions) ---- */
            .icon-action {
                @apply inline-flex items-center justify-center w-8 h-8 rounded-lg text-ink-700/60
                       hover:text-ink-900 hover:bg-ink-900/[0.06] transition-colors;
            }
            .icon-action svg { @apply w-[17px] h-[17px]; }
            .icon-action.danger { @apply hover:text-red-700 hover:bg-red-50; }
            .icon-action.accent { @apply hover:text-brass-600 hover:bg-brass-50; }

            /* ---- Forms ---- */
            .field { @apply space-y-1.5; }
            .field-label { @apply block text-sm font-medium text-ink-800; }
            .field-hint { @apply text-xs text-ink-700/50 mt-1; }
            .field-error { @apply text-xs font-medium text-red-600 mt-1; }
            .field-input {
                @apply w-full rounded-lg border border-ink-900/15 bg-white px-3.5 py-2.5 text-sm text-ink-900
                       placeholder:text-ink-700/35 shadow-sm transition
                       focus:outline-none focus:ring-2 focus:ring-brass-500/40 focus:border-brass-500;
            }
            .field-input.has-error { @apply border-red-400 focus:ring-red-200 focus:border-red-500; }
            .field-with-icon { @apply relative; }
            .field-with-icon svg {
                @apply absolute left-3.5 top-1/2 -translate-y-1/2 w-[18px] h-[18px] text-ink-700/40 pointer-events-none;
            }
            .field-with-icon .field-input { @apply pl-10; }

            /* ---- Tables ---- */
            .table-card { @apply surface overflow-hidden; }
            .table-toolbar { @apply flex flex-wrap items-center justify-between gap-3 p-5 border-b border-ink-900/[0.06]; }
            table.data-table { @apply w-full text-sm; }
            .data-table thead th {
                @apply text-left text-xs font-semibold uppercase tracking-wide text-ink-700/50
                       px-5 py-3 bg-ink-900/[0.02] border-b border-ink-900/[0.06];
            }
            .data-table tbody td { @apply px-5 py-3.5 border-b border-ink-900/[0.05] text-ink-800; }
            .data-table tbody tr:last-child td { @apply border-b-0; }
            .data-table tbody tr { @apply hover:bg-ink-900/[0.015] transition-colors; }
            .table-empty { @apply flex flex-col items-center justify-center gap-3 py-14 text-center; }
            .table-empty svg { @apply w-9 h-9 text-ink-700/25; }
            .table-empty p { @apply text-sm text-ink-700/50; }

            /* ---- Badges ---- */
            .badge { @apply inline-flex items-center gap-1.5 rounded-full px-2.5 py-1 text-xs font-semibold; }
            .badge svg { @apply w-3.5 h-3.5; }
            .badge-success { @apply bg-emerald-50 text-emerald-700; }
            .badge-danger { @apply bg-red-50 text-red-700; }
            .badge-info { @apply bg-blue-50 text-blue-700; }
            .badge-warning { @apply bg-amber-50 text-amber-700; }
            .badge-neutral { @apply bg-ink-900/5 text-ink-700/70; }

            /* ---- Alerts ---- */
            .alert { @apply flex items-start gap-3 rounded-xl px-4 py-3.5 text-sm mb-5; }
            .alert svg { @apply w-5 h-5 shrink-0 mt-0.5; }
            .alert-success { @apply bg-emerald-50 text-emerald-800; }
            .alert-error { @apply bg-red-50 text-red-800; }

            /* ---- Home hero cards ---- */
            .action-card {
                @apply surface p-6 flex flex-col gap-3 hover:-translate-y-0.5 hover:shadow-md
                       transition-all duration-150;
            }
            .action-card .action-icon { @apply w-11 h-11 rounded-xl bg-ink-900 text-brass-300 flex items-center justify-center; }
        }
    </style>
</head>
<body>

    <!-- Mobile top bar -->
    <div class="topbar">
        <a href="{{ route('home') }}" class="flex items-center gap-2">
            <x-icon name="library" class="w-5 h-5 text-brass-400" />
            <span class="font-display font-semibold tracking-wide">CLAC</span>
        </a>
        <button id="menu-toggle" class="w-9 h-9 flex items-center justify-center rounded-lg hover:bg-white/10">
            <x-icon name="menu" class="w-5 h-5" />
        </button>
    </div>

    <div id="scrim" class="scrim hidden"></div>

    <!-- Sidebar -->
    <aside id="sidebar" class="sidebar">
        <div class="brand-mark">
            <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                <x-icon name="library" class="w-6 h-6 text-brass-400" />
                <div>
                    <div class="brand-name">CLAC</div>
                    <div class="brand-tag">Bibliothèque</div>
                </div>
            </a>
            <button id="menu-close" class="lg:hidden ml-auto w-8 h-8 flex items-center justify-center rounded-lg hover:bg-white/10">
                <x-icon name="close" class="w-4 h-4" />
            </button>
        </div>

        <nav class="nav-section">
            <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                <x-icon name="home" /> Accueil
            </a>

            @auth
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <x-icon name="grid" /> Tableau de bord
                </a>
                <a href="{{ route('books.index') }}" class="nav-link {{ request()->routeIs('books.*') ? 'active' : '' }}">
                    <x-icon name="book" /> Livres
                </a>
                <a href="{{ route('categories.index') }}" class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                    <x-icon name="tag" /> Catégories
                </a>
                <a href="{{ route('borrowings.index') }}" class="nav-link {{ request()->routeIs('borrowings.*') ? 'active' : '' }}">
                    <x-icon name="swap" /> {{ auth()->user()->isStaff() ? 'Emprunts' : 'Mes emprunts' }}
                </a>
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                        <x-icon name="users" /> Utilisateurs
                    </a>
                @endif
            @endauth

            @guest
                <a href="{{ route('login') }}" class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}">
                    <x-icon name="login" /> Connexion
                </a>
                <a href="{{ route('register') }}" class="nav-link {{ request()->routeIs('register') ? 'active' : '' }}">
                    <x-icon name="user-plus" /> Inscription
                </a>
            @endguest
        </nav>

        @auth
            <div class="sidebar-footer">
                <a href="{{ route('profile.edit') }}" class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                    <x-icon name="user-circle" /> {{ auth()->user()->first_name }}
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-link w-full text-left">
                        <x-icon name="logout" /> Déconnexion
                    </button>
                </form>
            </div>
        @endauth
    </aside>

    <div class="app-shell">
        <main class="page-wrap">
            @if(session('success'))
                <div class="alert alert-success">
                    <x-icon name="check-circle" />
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-error">
                    <x-icon name="alert-triangle" />
                    <div>
                        <ul class="space-y-0.5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const scrim = document.getElementById('scrim');

        function openMenu() {
            sidebar.classList.add('is-open');
            scrim.classList.remove('hidden');
        }
        function closeMenu() {
            sidebar.classList.remove('is-open');
            scrim.classList.add('hidden');
        }

        document.getElementById('menu-toggle')?.addEventListener('click', openMenu);
        document.getElementById('menu-close')?.addEventListener('click', closeMenu);
        scrim.addEventListener('click', closeMenu);
    </script>
</body>
</html>
