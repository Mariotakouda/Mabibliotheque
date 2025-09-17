@extends('layouts.app')
@section('title', 'Modifier utilisateur')

@section('content')
<h1 class="text-2xl font-bold mb-4">Modifier utilisateur</h1>

<form action="{{ route('users.update', $user) }}" method="POST">
    @csrf
    @method('PUT')

    <input type="text" name="first_name" value="{{ old('first_name', $user->first_name) }}" class="border p-2 w-full mb-2">
    <input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}" class="border p-2 w-full mb-2">
    <input type="text" name="district" value="{{ old('district', $user->district) }}" class="border p-2 w-full mb-2">
    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="border p-2 w-full mb-2">
    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="border p-2 w-full mb-2">

    <input type="password" name="password" placeholder="Nouveau mot de passe (optionnel)" class="border p-2 w-full mb-2">
    <input type="password" name="password_confirmation" placeholder="Confirmer mot de passe" class="border p-2 w-full mb-2">

    <select name="role" class="border p-2 w-full mb-2">
        <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>Utilisateur</option>
        <option value="librarian" {{ $user->role === 'librarian' ? 'selected' : '' }}>Bibliothécaire</option>
        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
    </select>

    <button class="bg-yellow-600 text-white px-4 py-2 rounded">Mettre à jour</button>
</form>
@endsection
