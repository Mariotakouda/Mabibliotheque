<nav class="bg-gray-800 p-4 text-white flex justify-between">
    <div>
        <a href="{{ route('dashboard') }}" class="mr-4">Dashboard</a>
        <a href="{{ route('users.index') }}" class="mr-4">Utilisateurs</a>
        <a href="{{ route('categories.index') }}" class="mr-4">Catégories</a>
        <a href="{{ route('books.index') }}" class="mr-4">Livres</a>
        <a href="{{ route('borrowings.index') }}" class="mr-4">Emprunts</a>
    </div>

    <div>
        @auth
            <span class="mr-2"> {{ Auth::user()->name }}</span>
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button class="bg-red-600 px-3 py-1 rounded">Déconnexion</button>
            </form>
        @endauth
    </div>
</nav>
