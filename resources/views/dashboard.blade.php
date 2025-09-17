@extends('layouts.app')
@section('title', 'Tableau de bord')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-4 gap-6">


    <div class="bg-white shadow rounded p-6 text-center">
        <h2 class="text-xl font-bold mb-2"> Utilisateurs</h2>
        <p class="text-3xl font-semibold">{{ \App\Models\User::count() }}</p>
        <a href="{{ route('users.index') }}" class="text-blue-600 mt-2 inline-block">Voir</a>
    </div>

    
    <div class="bg-white shadow rounded p-6 text-center">
        <h2 class="text-xl font-bold mb-2">Catégories</h2>
        <p class="text-3xl font-semibold">{{ \App\Models\Category::count() }}</p>
        <a href="{{ route('categories.index') }}" class="text-blue-600 mt-2 inline-block">Voir</a>
    </div>

    
    <div class="bg-white shadow rounded p-6 text-center">
        <h2 class="text-xl font-bold mb-2">Livres</h2>
        <p class="text-3xl font-semibold">{{ \App\Models\Book::count() }}</p>
        <a href="{{ route('books.index') }}" class="text-blue-600 mt-2 inline-block">Voir</a>
    </div>

    
    <div class="bg-white shadow rounded p-6 text-center">
        <h2 class="text-xl font-bold mb-2">Emprunts en cours</h2>
        <p class="text-3xl font-semibold">
            {{ \App\Models\Borrowing::whereNull('returned_at')->count() }}
        </p>
        <a href="{{ route('borrowings.index') }}" class="text-blue-600 mt-2 inline-block">Voir</a>
    </div>

</div>
@endsection
