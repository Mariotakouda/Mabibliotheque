@extends('layouts.app')
@section('title', 'Inscription')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Créer un compte</h1>

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <input type="text" name="name" placeholder="Nom complet" class="border p-2 w-full mb-2" required>
        <input type="email" name="email" placeholder="Email" class="border p-2 w-full mb-2" required>
        <input type="password" name="password" placeholder="Mot de passe" class="border p-2 w-full mb-2" required>
        <input type="password" name="password_confirmation" placeholder="Confirmer mot de passe" class="border p-2 w-full mb-2" required>

        <button class="bg-green-600 text-white px-4 py-2 rounded w-full">S'inscrire</button>
    </form>
</div>
@endsection
