@extends('layouts.app')
@section('title', 'Détail catégorie')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-6 flex items-center justify-between gap-4">
        <div>
            <p class="eyebrow mb-2">Catalogue</p>
            <h1 class="page-title flex items-center gap-2.5">
                <x-icon name="tag" class="w-6 h-6 text-brass-600" /> {{ $category->name }}
            </h1>
        </div>
        <a href="{{ route('categories.index') }}" class="btn btn-ghost">Retour</a>
    </div>

    <div class="surface surface-pad mb-6">
        <p class="field-label mb-1.5">Description</p>
        <p class="text-sm text-ink-700/80 leading-relaxed">{{ $category->description ?: 'Aucune description.' }}</p>
    </div>

    <div class="table-card">
        <div class="table-toolbar">
            <h2 class="text-lg font-semibold text-ink-900">Livres dans cette catégorie</h2>
        </div>
        @if($category->books->count() > 0)
            <div class="overflow-x-auto">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Auteur</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($category->books as $book)
                            <tr>
                                <td class="font-medium text-ink-900">{{ $book->title }}</td>
                                <td>{{ $book->author }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="table-empty">
                <x-icon name="book" />
                <p>Aucun livre dans cette catégorie.</p>
            </div>
        @endif
    </div>
</div>
@endsection
