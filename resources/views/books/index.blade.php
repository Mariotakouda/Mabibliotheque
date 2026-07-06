@extends('layouts.app')
@section('title', 'Livres')

@section('content')
<h1 class="text-2xl font-bold mb-4 text-white">Liste des livres</h1>

<div class="flex flex-wrap items-center justify-between gap-3 mb-4">
    @if(auth()->user()->isStaff())
        <a href="{{ route('books.create') }}" class="bg-blue-600 text-white px-3 py-2 rounded">+ Ajouter</a>
    @else
        <span></span>
    @endif

    <form method="GET" action="{{ route('books.index') }}" class="flex flex-wrap gap-2">
        <input type="text" name="q" value="{{ $search }}" placeholder="Titre, auteur, ISBN..."
               class="border rounded p-2">
        <select name="category_id" class="border rounded p-2">
            <option value="">Toutes les catégories</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ (string) $categoryId === (string) $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        <button class="bg-gray-700 text-white px-3 py-2 rounded">Filtrer</button>
        @if($search || $categoryId)
            <a href="{{ route('books.index') }}" class="text-gray-600 self-center underline text-sm">Réinitialiser</a>
        @endif
    </form>
</div>

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
    @forelse($books as $book)
        <tr class="border-b">
            <td class="p-2">{{ $book->title }}</td>
            <td>{{ $book->author }}</td>
            <td>{{ $book->category->name ?? 'Non catégorisé' }}</td>
            <td>
                <span class="{{ $book->available_copies > 0 ? 'text-green-600' : 'text-red-600' }} font-semibold">
                    {{ $book->available_copies }}
                </span> / {{ $book->total_copies }}
            </td>
            <td>
                <a href="{{ route('books.show', $book) }}" class="text-blue-600">Voir</a>
                @if(auth()->user()->isStaff())
                    | <a href="{{ route('books.edit', $book) }}" class="text-yellow-600">Modifier</a> |
                    <form method="POST" action="{{ route('books.destroy', $book) }}" class="inline">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Supprimer ce livre ?')" class="text-red-600">Supprimer</button>
                    </form>
                @endif
            </td>
        </tr>
    @empty
        <tr><td colspan="5" class="text-center p-4 text-gray-400">Aucun livre trouvé.</td></tr>
    @endforelse
    </tbody>
</table>

<div class="mt-4">
    {{ $books->links() }}
</div>
@endsection
