@extends('layouts.app')
@section('title', 'Livres')

@section('content')

<div class="flex flex-wrap items-center justify-between gap-4 mb-6">
    <div>
        <p class="eyebrow mb-2">Catalogue</p>
        <h1 class="page-title">Livres</h1>
    </div>
    @if(auth()->user()->isStaff())
        <a href="{{ route('books.create') }}" class="btn btn-primary">
            <x-icon name="plus" /> Ajouter un livre
        </a>
    @endif
</div>

<form method="GET" action="{{ route('books.index') }}" class="flex flex-wrap gap-3 mb-6">
    <div class="field-with-icon flex-1 min-w-[220px]">
        <x-icon name="search" />
        <input type="text" name="q" value="{{ $search }}" placeholder="Titre, auteur, ISBN..."
               class="field-input">
    </div>
    <select name="category_id" class="field-input w-auto">
        <option value="">Toutes les catégories</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ (string) $categoryId === (string) $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    <button class="btn btn-outline">
        <x-icon name="filter" /> Filtrer
    </button>
    @if($search || $categoryId)
        <a href="{{ route('books.index') }}" class="btn btn-ghost">
            <x-icon name="undo" /> Réinitialiser
        </a>
    @endif
</form>

<div class="table-card">
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Catégorie</th>
                    <th>Disponibles</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
            @forelse($books as $book)
                <tr>
                    <td class="font-medium text-ink-900">{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>
                        <span class="badge badge-neutral"><x-icon name="tag" /> {{ $book->category->name ?? 'Non catégorisé' }}</span>
                    </td>
                    <td>
                        <span class="{{ $book->available_copies > 0 ? 'text-emerald-600' : 'text-red-600' }} font-semibold">
                            {{ $book->available_copies }}
                        </span>
                        <span class="text-ink-700/40">/ {{ $book->total_copies }}</span>
                    </td>
                    <td>
                        <div class="flex justify-end gap-1">
                            <a href="{{ route('books.show', $book) }}" class="icon-action" title="Voir">
                                <x-icon name="eye" />
                            </a>
                            @if(auth()->user()->isStaff())
                                <a href="{{ route('books.edit', $book) }}" class="icon-action accent" title="Modifier">
                                    <x-icon name="pencil" />
                                </a>
                                <form method="POST" action="{{ route('books.destroy', $book) }}">
                                    @csrf @method('DELETE')
                                    <button onclick="return confirm('Supprimer ce livre ?')" class="icon-action danger" title="Supprimer">
                                        <x-icon name="trash" />
                                    </button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">
                        <div class="table-empty">
                            <x-icon name="book" />
                            <p>Aucun livre trouvé.</p>
                        </div>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-5">
    {{ $books->links() }}
</div>
@endsection
