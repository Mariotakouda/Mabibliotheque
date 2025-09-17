@extends('layouts.app')
@section('title', 'Livres')

@section('content')
<h1 class="text-2xl font-bold mb-4 text-white">Liste des livres</h1>

<a href="{{ route('books.create') }}" class="bg-blue-600 text-white px-3 py-2 rounded">+ Ajouter</a>

<table class="w-full mt-4 bg-white shadow rounded">
    <thead class="bg-gray-200">
        <tr>
            <th class="p-2">Titre</th>
            <th>Auteur</th>
            <th>Catégorie</th>
            <th>Disponibles</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach($books as $book)
        <tr class="border-b">
            <td class="p-2">{{ $book->title }}</td>
            <td>{{ $book->author }}</td>
            <td>{{ $book->category->name ?? 'Non catégorisé' }}</td>
            <td>{{ $book->available_copies }} / {{ $book->total_copies }}</td>
            <td>
                <a href="{{ route('books.show', $book) }}" class="text-blue-600">Voir</a> |
                <a href="{{ route('books.edit', $book) }}" class="text-yellow-600">Modifier</a> |
                <form method="POST" action="{{ route('books.destroy', $book) }}" class="inline">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('Supprimer ce livre ?')" class="text-red-600">Supprimer</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
