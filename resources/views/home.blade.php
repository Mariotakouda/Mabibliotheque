@extends('layouts.app')
@section('title', 'Accueil')

@section('content')
<div class="max-w-6xl mx-auto px-4">
    
    <div class="text-center mb-10">
        <h1 class="text-4xl font-extrabold text-white">BIENVENUE! A CLAC</h1>
        <p class="text-white mt-2">Gérez facilement vos livres, catégories, emprunts et utilisateurs</p>
    </div>

    @auth
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

            <a href="{{ route('books.index') }}"
               class="bg-white p-6 rounded-2xl shadow-md hover:shadow-xl transition transform hover:-translate-y-1 text-center">
                <h2 class="text-lg font-semibold">LIVRES</h2>
                <p class="text-gray-500 text-sm">Parcourir le catalogue</p>
            </a>

            <a href="{{ route('categories.index') }}"
               class="bg-white p-6 rounded-2xl shadow-md hover:shadow-xl transition transform hover:-translate-y-1 text-center">
                <h2 class="text-lg font-semibold">CATEGORIES</h2>
                <p class="text-gray-500 text-sm">Classer vos livres</p>
            </a>

            <a href="{{ route('borrowings.index') }}"
               class="bg-white p-6 rounded-2xl shadow-md hover:shadow-xl transition transform hover:-translate-y-1 text-center">
                <h2 class="text-lg font-semibold">EMPRUNTS</h2>
                <p class="text-gray-500 text-sm">{{ auth()->user()->isStaff() ? 'Suivre emprunts & retours' : 'Voir mes emprunts' }}</p>
            </a>

            @if(auth()->user()->isAdmin())
                <a href="{{ route('users.index') }}"
                   class="bg-white p-6 rounded-2xl shadow-md hover:shadow-xl transition transform hover:-translate-y-1 text-center">
                    <h2 class="text-lg font-semibold">UTILISATEURS</h2>
                    <p class="text-gray-500 text-sm">Gérer les utilisateurs</p>
                </a>
            @else
                <a href="{{ route('dashboard') }}"
                   class="bg-white p-6 rounded-2xl shadow-md hover:shadow-xl transition transform hover:-translate-y-1 text-center">
                    <h2 class="text-lg font-semibold">TABLEAU DE BORD</h2>
                    <p class="text-gray-500 text-sm">Voir mon activité</p>
                </a>
            @endif
        </div>
    @endauth

    @guest
        <div class="text-center mt-12">
            <p class="text-lg text-gray-600 mb-4">Bienvenue invité </p>
            <div class="flex justify-center space-x-4">
                <a href="{{ route('login') }}" 
                   class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl shadow-md transition">
                   Se connecter
                </a>
                <a href="{{ route('register') }}" 
                   class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-xl shadow-md transition">
                   S'inscrire
                </a>
            </div>
        </div>
    @endguest
</div>
@endsection
