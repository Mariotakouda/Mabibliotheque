@extends('layouts.app')
@section('title', 'Nouvel emprunt')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded-xl shadow">
    <h1 class="text-2xl font-bold mb-4">Nouvel emprunt</h1>

    <form method="POST" action="{{ route('borrowings.store') }}">
        @csrf

        
        <div class="mb-4">
            <label class="block font-semibold mb-1">Utilisateur</label>
            <select name="user_id" class="w-full border rounded-lg p-2">
                <option value="">Sélectionner un utilisateur</option>
                @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                @endforeach
            </select>
            @error('user_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        
        <div class="mb-4">
            <label class="block font-semibold mb-1">Livre</label>
            <select name="book_id" class="w-full border rounded-lg p-2">
                <option value="">Sélectionner un livre</option>
                @foreach($books as $book)
                    <option value="{{ $book->id }}">{{ $book->title }}</option>
                @endforeach
            </select>
            @error('book_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        
        <div class="mb-4">
            <label class="block font-semibold mb-1">Date d’emprunt</label>
            <input type="date" name="borrowed_at" value="{{ old('borrowed_at', now()->toDateString()) }}" class="w-full border rounded-lg p-2">
        </div>

        
        <div class="flex justify-end space-x-2">
            <a href="{{ route('borrowings.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">Annuler</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Enregistrer</button>
        </div>
    </form>
</div>
@endsection
