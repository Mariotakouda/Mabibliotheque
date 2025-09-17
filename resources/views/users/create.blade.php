@extends('layouts.app')
@section('title', 'Ajouter utilisateur')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-cover bg-center" style="background-image: url('/images/background.jpg');">
    <div class="w-full max-w-md bg-white bg-opacity-90 rounded-xl shadow-lg p-6 space-y-6">
        <!-- Titre -->
        <div class="text-center">
            <h1 class="text-2xl font-bold text-gray-800 mb-1">Ajouter un utilisateur</h1>
            <p class="text-gray-600 text-sm">Remplissez les informations de l'utilisateur</p>
        </div>

        <!-- Formulaire -->
        <form action="{{ route('users.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-gray-700 font-medium mb-1">Prénom</label>
                <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="Prénom"
                       class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                @error('first_name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Nom</label>
                <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Nom"
                       class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                @error('last_name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Quartier</label>
                <input type="text" name="district" value="{{ old('district') }}" placeholder="Quartier"
                       class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                @error('district')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Téléphone</label>
                <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Téléphone"
                       class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                @error('phone')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Email"
                       class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Mot de passe</label>
                <input type="password" name="password" placeholder="Mot de passe"
                       class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Confirmer mot de passe</label>
                <input type="password" name="password_confirmation" placeholder="Confirmer mot de passe"
                       class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Rôle</label>
                <select name="role" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Utilisateur</option>
                    <option value="librarian" {{ old('role') == 'librarian' ? 'selected' : '' }}>Bibliothécaire</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
                @error('role')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                    class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 rounded-lg shadow-md transition duration-200">
                Créer
            </button>
        </form>
    </div>
</div>
@endsection
