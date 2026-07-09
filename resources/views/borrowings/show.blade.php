@extends('layouts.app')
@section('title', "Détail de l'emprunt")

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6 flex items-center justify-between gap-4">
        <div>
            <p class="eyebrow mb-2">Circulation</p>
            <h1 class="page-title">{{ $borrowing->book->title ?? 'Livre supprimé' }}</h1>
        </div>
        <a href="{{ route('borrowings.index') }}" class="btn btn-ghost">Retour</a>
    </div>

    <div class="surface surface-pad space-y-4">
        <div class="flex items-center gap-2 text-sm text-ink-700/70">
            <x-icon name="users" class="w-4 h-4" /> {{ $borrowing->user->fullName() }}
        </div>
        <div class="flex items-center gap-2 text-sm text-ink-700/70">
            <x-icon name="calendar" class="w-4 h-4" /> Emprunté le {{ $borrowing->borrowed_at->format('d/m/Y') }}
        </div>
        <div class="flex items-center gap-2 text-sm text-ink-700/70">
            <x-icon name="clock" class="w-4 h-4" /> À rendre avant le {{ $borrowing->due_at->format('d/m/Y') }}
        </div>
        <div class="flex items-center gap-2 text-sm text-ink-700/70">
            <x-icon name="check-circle" class="w-4 h-4" />
            Retour effectif : {{ $borrowing->returned_at ? $borrowing->returned_at->format('d/m/Y') : 'Pas encore rendu' }}
        </div>

        <div class="pt-2">
            @if($borrowing->status === 'returned')
                <span class="badge badge-success"><x-icon name="check-circle" /> Rendu</span>
            @elseif($borrowing->isOverdue() || $borrowing->status === 'late')
                <span class="badge badge-danger"><x-icon name="alert-triangle" /> En retard</span>
            @else
                <span class="badge badge-info"><x-icon name="clock" /> En cours</span>
            @endif
        </div>

        @if($borrowing->penalty_amount > 0)
            <div class="rounded-lg bg-red-50 text-red-700 text-sm px-4 py-3 flex items-center gap-2">
                <x-icon name="alert-triangle" class="w-4 h-4" />
                Pénalité : <span class="font-semibold">{{ $borrowing->penalty_amount }}</span>
            </div>
        @endif

        @if(auth()->user()->isStaff() && !$borrowing->returned_at)
            <form method="POST" action="{{ route('borrowings.return', $borrowing) }}" class="pt-2">
                @csrf
                <button onclick="return confirm('Marquer ce livre comme rendu ?')" class="btn btn-accent">
                    <x-icon name="check-circle" /> Retourner le livre
                </button>
            </form>
        @endif
    </div>
</div>
@endsection
