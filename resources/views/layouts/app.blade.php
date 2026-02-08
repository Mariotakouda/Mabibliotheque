<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Bibliothèque')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-900">

    <style>
        body {
            background-image: url('https://cdn-s-www.ledauphine.com/images/12DC2CBA-87F9-4CA8-99C8-DD6B3CA25CF9/NW_raw/une-bibliotheque-installee-dans-le-bar-est-a-disposition-du-public-1757438536.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 10vh;
            position: relative;
        }
    </style>


    <nav class="bg-green-600 p-4 text-white fixed top-0 left-0 w-full z-50 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
        
            <a href="{{ route('home') }}" class="font-bold text-lg">MABIBLIOTHEQUE</a>

            
            <button id="menu-toggle" class="md:hidden focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            
            <div id="menu" class="hidden md:flex md:items-center space-x-4">
                @auth
                    <a href="{{ route('books.index') }}" class="hover:underline">Livres</a>
                    <a href="{{ route('categories.index') }}" class="hover:underline">Catégories</a>
                    <a href="{{ route('users.index') }}" class="hover:underline">Utilisateurs</a>
                    <a href="{{ route('borrowings.index') }}" class="hover:underline">Emprunts</a>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-red-500 px-3 py-1 rounded">Déconnexion</button>
                    </form>
                @endauth

                @guest
                    <a href="{{ route('login') }}" class="hover:underline">Connexion</a>
                    <a href="{{ route('register') }}" class="hover:underline">Inscription</a>
                @endguest
            </div>
        </div>

        
        <div id="mobile-menu" class="md:hidden hidden mt-2 space-y-2">
            @auth
                <a href="{{ route('books.index') }}" class="block px-2 py-1 hover:bg-blue-500 rounded">Livres</a>
                <a href="{{ route('categories.index') }}" class="block px-2 py-1 hover:bg-blue-500 rounded">Catégories</a>
                <a href="{{ route('users.index') }}" class="block px-2 py-1 hover:bg-blue-500 rounded">Utilisateurs</a>
                <a href="{{ route('borrowings.index') }}" class="block px-2 py-1 hover:bg-blue-500 rounded">Emprunts</a>
                <form action="{{ route('logout') }}" method="POST" class="px-2 py-1">
                    @csrf
                    <button type="submit" class="w-full bg-red-500 px-3 py-1 rounded">Déconnexion</button>
                </form>
            @endauth

            @guest
                <a href="{{ route('login') }}" class="block px-2 py-1 hover:bg-blue-500 rounded">Connexion</a>
                <a href="{{ route('register') }}" class="block px-2 py-1 hover:bg-blue-500 rounded">Inscription</a>
            @endguest
        </div>
    </nav>

    
    <main class="p-6 pt-24">
        @yield('content')
    </main>

    
    <script>
        document.getElementById('menu-toggle').addEventListener('click', function () {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>

</body>
</html>
