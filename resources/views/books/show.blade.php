@extends('layouts.app')
@section('title', 'Détail du livre')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-6 flex items-center justify-between gap-4">
        <div>
            <p class="eyebrow mb-2">Catalogue</p>
            <h1 class="page-title">{{ $book->title }}</h1>
        </div>
        <a href="{{ route('books.index') }}" class="btn btn-ghost">Retour</a>
    </div>

    <div class="surface surface-pad">
        <div class="flex flex-col sm:flex-row gap-6">
            <div class="shrink-0">
                @if($book->cover_path)
                    <img src="{{ asset('storage/' . $book->cover_path) }}" alt="Couverture de {{ $book->title }}"
                         class="w-32 h-44 object-cover rounded-lg border border-ink-900/10">
                @else
                    <div class="w-32 h-44 rounded-lg bg-ink-900/5 flex items-center justify-center text-ink-700/25">
                        <x-icon name="book" class="w-9 h-9" />
                    </div>
                @endif
            </div>

            <div class="flex-1 space-y-3">
                <div class="flex items-center gap-2 text-sm text-ink-700/70">
                    <x-icon name="users" class="w-4 h-4" />
                    <span>{{ $book->author }}</span>
                </div>
                <div class="flex items-center gap-2 text-sm text-ink-700/70">
                    <x-icon name="identification" class="w-4 h-4" />
                    <span>{{ $book->isbn ?: '—' }}</span>
                </div>
                <div class="flex items-center gap-2 text-sm text-ink-700/70">
                    <x-icon name="calendar" class="w-4 h-4" />
                    <span>{{ $book->published_at ? $book->published_at->format('d/m/Y') : 'Date inconnue' }}</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="badge badge-neutral"><x-icon name="tag" /> {{ $book->category->name ?? 'Non catégorisé' }}</span>
                    <span class="badge {{ $book->available_copies > 0 ? 'badge-success' : 'badge-danger' }}">
                        <x-icon name="check-circle" /> {{ $book->available_copies }} / {{ $book->total_copies }} disponibles
                    </span>
                </div>

                @if($book->summary)
                    <div class="pt-3 border-t border-ink-900/[0.06]">
                        <p class="field-label mb-1.5">Résumé</p>
                        <p class="text-sm text-ink-700/80 leading-relaxed">{{ $book->summary }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
