@extends('layouts.app')
@section('title', 'Catégories')

@section('content')
<h1 class="text-2xl font-bold mb-4 text-white">Liste des catégories</h1>

@if(auth()->user()->isStaff())
    <a href="{{ route('categories.create') }}" class="bg-blue-600 text-white px-3 py-2 rounded">+ Ajouter</a>
@endif

<table class="w-full mt-4 bg-white shadow rounded">
    <thead class="bg-gray-200">
        <tr>
            <th class="p-2">Nom</th>
            <th>Description</th>
            <th>Livres</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    @forelse($categories as $category)
        <tr class="border-b">
            <td class="p-2">{{ $category->name }}</td>
            <td>{{ $category->description }}</td>
            <td>{{ $category->books_count }}</td>
            <td>
                <a href="{{ route('categories.show', $category) }}" class="text-blue-600">Voir</a>
                @if(auth()->user()->isStaff())
                    | <a href="{{ route('categories.edit', $category) }}" class="text-yellow-600">Modifier</a> |
                    <form method="POST" action="{{ route('categories.destroy', $category) }}" class="inline">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Supprimer cette catégorie ?')" class="text-red-600">Supprimer</button>
                    </form>
                @endif
            </td>
        </tr>
    @empty
        <tr><td colspan="4" class="text-center p-4 text-gray-400">Aucune catégorie trouvée.</td></tr>
    @endforelse
    </tbody>
</table>

<div class="mt-4">
    {{ $categories->links() }}
</div>
@endsection
