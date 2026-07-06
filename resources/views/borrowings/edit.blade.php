@extends('layouts.app')
@section('title', 'Modifier emprunt')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded-xl shadow">
    <h1 class="text-2xl font-bold mb-4">Modifier l'emprunt</h1>

    <p class="mb-2"><strong>Utilisateur :</strong> {{ $borrowing->user->fullName() }}</p>
    <p class="mb-4"><strong>Livre :</strong> {{ $borrowing->book->title ?? 'Livre supprimé' }}</p>

    <form action="{{ route('borrowings.update', $borrowing) }}" method="POST">
        @csrf
        @method('PUT')

        <label class="block font-semibold mb-1">Date d'emprunt :</label>
        <input type="date" name="borrowed_at" value="{{ old('borrowed_at', $borrowing->borrowed_at->format('Y-m-d')) }}" class="border p-2 w-full mb-3 rounded-lg">
        @error('borrowed_at')<p class="text-red-500 text-sm mb-2">{{ $message }}</p>@enderror

        <label class="block font-semibold mb-1">Date de retour prévue :</label>
        <input type="date" name="due_at" value="{{ old('due_at', $borrowing->due_at->format('Y-m-d')) }}" class="border p-2 w-full mb-3 rounded-lg">
        @error('due_at')<p class="text-red-500 text-sm mb-2">{{ $message }}</p>@enderror

        <button class="bg-yellow-600 text-white px-4 py-2 rounded w-full">Mettre à jour</button>
    </form>
</div>
@endsection
