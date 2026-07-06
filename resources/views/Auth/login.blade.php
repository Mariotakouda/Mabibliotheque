@extends('layouts.app')
@section('title', 'Connexion')

@section('content')
<div class="min-h-screen flex items-center justify-center">

    <div class="absolute inset-0 bg-black opacity-20"></div>

    <div class="relative w-full max-w-sm bg-white rounded-2xl shadow-xl p-8 space-y-6 z-10">

        <div class="text-center">
            <h1 class="text-3xl font-extrabold text-gray-800 mb-2">Connexion</h1>
            <p class="text-gray-600 text-sm">Connectez-vous pour accéder à votre compte</p>
        </div>

        <form method="POST" action="{{ route('login.attempt') }}" class="space-y-5">
            @csrf
            <div>
                <label for="email" class="block text-gray-700 font-medium mb-1">Email</label>
                <input id="email" type="email" name="email" placeholder="Email" value="{{ old('email') }}"
                       class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-blue-500 focus:outline-none shadow-sm transition duration-200"
                       required autofocus>
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-gray-700 font-medium mb-1">Mot de passe</label>
                <input id="password" type="password" name="password" placeholder="Mot de passe"
                       class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-blue-500 focus:outline-none shadow-sm transition duration-200"
                       required>
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center">
                <input id="remember" type="checkbox" name="remember" class="mr-2">
                <label for="remember" class="text-gray-600 text-sm">Se souvenir de moi</label>
            </div>

            <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-xl shadow-lg transition duration-200 transform hover:scale-105">
                Se connecter
            </button>
        </form>

        <p class="text-center text-gray-600 text-sm mt-4">
            Pas encore de compte ?
            <a href="{{ route('register') }}" class="text-blue-700 font-medium underline">S'inscrire</a>
        </p>
    </div>
</div>
@endsection
