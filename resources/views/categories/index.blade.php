@extends('layouts.app')
@section('title', 'Catégories')

@section('content')

<div class="flex flex-wrap items-center justify-between gap-4 mb-6">
    <div>
        <p class="eyebrow mb-2">Catalogue</p>
        <h1 class="page-title">Catégories</h1>
    </div>
    @if(auth()->user()->isStaff())
        <a href="{{ route('categories.create') }}" class="btn btn-primary">
            <x-icon name="plus" /> Ajouter
        </a>
    @endif
</div>

<div class="table-card">
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Livres</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
            @forelse($categories as $category)
                <tr>
                    <td class="font-medium text-ink-900">
                        <span class="inline-flex items-center gap-2">
                            <x-icon name="tag" class="w-4 h-4 text-brass-600" /> {{ $category->name }}
                        </span>
                    </td>
                    <td class="text-ink-700/70">{{ $category->description ?: '—' }}</td>
                    <td><span class="badge badge-neutral">{{ $category->books_count }}</span></td>
                    <td>
                        <div class="flex justify-end gap-1">
                            <a href="{{ route('categories.show', $category) }}" class="icon-action" title="Voir">
                                <x-icon name="eye" />
                            </a>
                            @if(auth()->user()->isStaff())
                                <a href="{{ route('categories.edit', $category) }}" class="icon-action accent" title="Modifier">
                                    <x-icon name="pencil" />
                                </a>
                                <form method="POST" action="{{ route('categories.destroy', $category) }}">
                                    @csrf @method('DELETE')
                                    <button onclick="return confirm('Supprimer cette catégorie ?')" class="icon-action danger" title="Supprimer">
                                        <x-icon name="trash" />
                                    </button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">
                        <div class="table-empty">
                            <x-icon name="tag" />
                            <p>Aucune catégorie trouvée.</p>
                        </div>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-5">
    {{ $categories->links() }}
</div>
@endsection
