@extends('layouts.app')
@section('title', 'Modifier emprunt')

@section('content')
<h1 class="text-2xl font-bold mb-4">Modifier l’emprunt</h1>

<form action="{{ route('borrowings.update', $borrowing) }}" method="POST">
    @csrf
    @method('PUT')

    <label class="block mb-2">Utilisateur :</label>
    <select name="user_id" class="border p-2 w-full mb-2">
        @foreach($users as $user)
            <option value="{{ $user->id }}" {{ $borrowing->user_id == $user->id ? 'selected' : '' }}>
                {{ $user->name }}
            </option>
        @endforeach
    </select>

    <label class="block mb-2">Livre :</label>
    <select name="book_id" class="border p-2 w-full mb-2">
        @foreach($books as $book)
            <option value="{{ $book->id }}" {{ $borrowing->book_id == $book->id ? 'selected' : '' }}>
                {{ $book->title }} ({{ $book->available_copies }} disponibles)
            </option>
        @endforeach
    </select>

    <label class="block mb-2">Date d'emprunt :</label>
    <input type="date" name="borrowed_at" value="{{ old('borrowed_at', $borrowing->borrowed_at->format('Y-m-d')) }}" class="border p-2 w-full mb-2">

    <label class="block mb-2">Date de retour :</label>
    <input type="date" name="returned_at" value="{{ old('returned_at', $borrowing->returned_at?->format('Y-m-d')) }}" class="border p-2 w-full mb-2">

    <button class="bg-yellow-600 text-white px-4 py-2 rounded">Mettre à jour</button>
</form>
@endsection
