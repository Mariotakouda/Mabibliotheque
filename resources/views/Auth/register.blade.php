@extends('layouts.app')
@section('title', 'Inscription')

@section('content')
<div class="min-h-screen flex items-center justify-center">
    <div class="absolute inset-0 bg-black opacity-20"></div>

    <div class="relative w-full max-w-md bg-white rounded-2xl shadow-xl p-8 space-y-6 z-10">
        <div class="text-center">
            <h1 class="text-2xl font-bold text-gray-800 mb-1">Créer un compte</h1>
            <p class="text-gray-600 text-sm">Les nouveaux comptes sont créés avec le rôle "utilisateur".</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="Prénom"
                           class="border border-gray-300 rounded-lg p-2 w-full" required>
                    @error('first_name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Nom"
                           class="border border-gray-300 rounded-lg p-2 w-full" required>
                    @error('last_name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            <div>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Email"
                       class="border border-gray-300 rounded-lg p-2 w-full" required>
                @error('email')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <input type="password" name="password" placeholder="Mot de passe"
                       class="border border-gray-300 rounded-lg p-2 w-full" required>
                <p class="text-gray-400 text-xs mt-1">Au moins 8 caractères, avec majuscule, minuscule et chiffre.</p>
                @error('password')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <input type="password" name="password_confirmation" placeholder="Confirmer le mot de passe"
                       class="border border-gray-300 rounded-lg p-2 w-full" required>
            </div>

            <button class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded-lg w-full transition">
                S'inscrire
            </button>
        </form>

        <p class="text-center text-gray-600 text-sm">
            Déjà un compte ?
            <a href="{{ route('login') }}" class="text-blue-700 font-medium underline">Se connecter</a>
        </p>
    </div>
</div>
@endsection
