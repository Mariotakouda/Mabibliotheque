@extends('layouts.app')
@section('title', 'Accueil')

@section('content')

<div class="mb-10">
    <p class="eyebrow mb-3">Centre Local d'Accès à la Culture</p>
    <h1 class="page-title text-3xl sm:text-4xl">Bienvenue sur CLAC</h1>
    <p class="page-subtitle text-base max-w-xl">Gérez facilement vos livres, catégories, emprunts et utilisateurs depuis un seul endroit.</p>
</div>

@auth
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

        <a href="{{ route('books.index') }}" class="action-card">
            <div class="action-icon"><x-icon name="book" /></div>
            <div>
                <h2 class="font-display font-semibold text-lg text-ink-900">Livres</h2>
                <p class="text-ink-700/60 text-sm mt-0.5">Parcourir le catalogue</p>
            </div>
        </a>

        <a href="{{ route('categories.index') }}" class="action-card">
            <div class="action-icon"><x-icon name="tag" /></div>
            <div>
                <h2 class="font-display font-semibold text-lg text-ink-900">Catégories</h2>
                <p class="text-ink-700/60 text-sm mt-0.5">Classer vos livres</p>
            </div>
        </a>

        <a href="{{ route('borrowings.index') }}" class="action-card">
            <div class="action-icon"><x-icon name="swap" /></div>
            <div>
                <h2 class="font-display font-semibold text-lg text-ink-900">Emprunts</h2>
                <p class="text-ink-700/60 text-sm mt-0.5">{{ auth()->user()->isStaff() ? 'Suivre emprunts & retours' : 'Voir mes emprunts' }}</p>
            </div>
        </a>

        @if(auth()->user()->isAdmin())
            <a href="{{ route('users.index') }}" class="action-card">
                <div class="action-icon"><x-icon name="users" /></div>
                <div>
                    <h2 class="font-display font-semibold text-lg text-ink-900">Utilisateurs</h2>
                    <p class="text-ink-700/60 text-sm mt-0.5">Gérer les utilisateurs</p>
                </div>
            </a>
        @else
            <a href="{{ route('dashboard') }}" class="action-card">
                <div class="action-icon"><x-icon name="grid" /></div>
                <div>
                    <h2 class="font-display font-semibold text-lg text-ink-900">Tableau de bord</h2>
                    <p class="text-ink-700/60 text-sm mt-0.5">Voir mon activité</p>
                </div>
            </a>
        @endif
    </div>
@endauth

@guest
    <div class="surface-pad surface max-w-md mt-4">
        <div class="action-icon mb-4"><x-icon name="library" /></div>
        <h2 class="font-display text-xl font-semibold text-ink-900 mb-1">Accès invité</h2>
        <p class="text-ink-700/60 text-sm mb-6">Connectez-vous ou créez un compte pour accéder au catalogue et à vos emprunts.</p>
        <div class="flex gap-3">
            <a href="{{ route('login') }}" class="btn btn-primary">
                <x-icon name="login" /> Se connecter
            </a>
            <a href="{{ route('register') }}" class="btn btn-outline">
                <x-icon name="user-plus" /> S'inscrire
            </a>
        </div>
    </div>
@endguest

@endsection
