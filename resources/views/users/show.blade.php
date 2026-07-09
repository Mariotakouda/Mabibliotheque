@extends('layouts.app')
@section('title', 'Détail utilisateur')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-6 flex items-center justify-between gap-4">
        <div>
            <p class="eyebrow mb-2">Administration</p>
            <h1 class="page-title">{{ $user->first_name }} {{ $user->last_name }}</h1>
        </div>
        <a href="{{ route('users.index') }}" class="btn btn-ghost">Retour</a>
    </div>

    <div class="surface surface-pad mb-6 space-y-3">
        <div class="flex items-center gap-2 text-sm text-ink-700/70">
            <x-icon name="mail" class="w-4 h-4" /> {{ $user->email }}
        </div>
        <div class="flex items-center gap-2 text-sm text-ink-700/70">
            <x-icon name="phone" class="w-4 h-4" /> {{ $user->phone ?: '—' }}
        </div>
        <div class="flex items-center gap-2 text-sm text-ink-700/70">
            <x-icon name="identification" class="w-4 h-4" /> {{ $user->district ?: '—' }}
        </div>
        <div class="pt-1">
            <span class="badge {{ $user->role === 'admin' ? 'badge-warning' : ($user->role === 'librarian' ? 'badge-info' : 'badge-neutral') }}">
                {{ ucfirst($user->role) }}
            </span>
        </div>
    </div>

    <div class="table-card">
        <div class="table-toolbar">
            <h2 class="text-lg font-semibold text-ink-900">Ses emprunts</h2>
        </div>
        @if($user->borrowings->count() > 0)
            <div class="overflow-x-auto">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Livre</th>
                            <th>Date emprunt</th>
                            <th>Date retour</th>
                            <th>Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($user->borrowings as $borrowing)
                        <tr>
                            <td class="font-medium text-ink-900">{{ $borrowing->book->title }}</td>
                            <td>{{ $borrowing->borrowed_at->format('d/m/Y') }}</td>
                            <td>{{ $borrowing->returned_at ? $borrowing->returned_at->format('d/m/Y') : '-' }}</td>
                            <td>
                                @if($borrowing->status === 'returned')
                                    <span class="badge badge-success"><x-icon name="check-circle" /> Rendu</span>
                                @elseif($borrowing->status === 'late')
                                    <span class="badge badge-warning"><x-icon name="alert-triangle" /> En retard</span>
                                @else
                                    <span class="badge badge-info"><x-icon name="clock" /> En cours</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="table-empty">
                <x-icon name="swap" />
                <p>Aucun emprunt trouvé.</p>
            </div>
        @endif
    </div>
</div>
@endsection
