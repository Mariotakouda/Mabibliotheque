@extends('layouts.app')
@section('title', 'Mon profil')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded-xl shadow">
    <h1 class="text-2xl font-bold mb-1">Mon profil</h1>
    <p class="text-gray-500 text-sm mb-4">Rôle actuel : <span class="font-semibold">{{ ucfirst($user->role) }}</span></p>

    <form method="POST" action="{{ route('profile.update') }}" class="space-y-4">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-2 gap-3">
            <div>
                <label class="block text-gray-700 font-medium mb-1">Prénom</label>
                <input type="text" name="first_name" value="{{ old('first_name', $user->first_name) }}" class="border p-2 w-full rounded-lg">
                @error('first_name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-1">Nom</label>
                <input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}" class="border p-2 w-full rounded-lg">
                @error('last_name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Quartier</label>
            <input type="text" name="district" value="{{ old('district', $user->district) }}" class="border p-2 w-full rounded-lg">
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Téléphone</label>
            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="border p-2 w-full rounded-lg">
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="border p-2 w-full rounded-lg">
            @error('email')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <hr class="my-4">
        <p class="text-gray-500 text-sm">Laissez les champs ci-dessous vides pour conserver votre mot de passe actuel.</p>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Mot de passe actuel</label>
            <input type="password" name="current_password" placeholder="Requis pour changer le mot de passe" class="border p-2 w-full rounded-lg">
            @error('current_password')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Nouveau mot de passe</label>
            <input type="password" name="password" class="border p-2 w-full rounded-lg">
            @error('password')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Confirmer le nouveau mot de passe</label>
            <input type="password" name="password_confirmation" class="border p-2 w-full rounded-lg">
        </div>

        <button class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg w-full transition">
            Enregistrer
        </button>
    </form>
</div>
@endsection
