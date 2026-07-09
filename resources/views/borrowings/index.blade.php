@extends('layouts.app')
@section('title', 'Emprunts')

@section('content')

<div class="flex flex-wrap items-center justify-between gap-4 mb-6">
    <div>
        <p class="eyebrow mb-2">Circulation</p>
        <h1 class="page-title">{{ auth()->user()->isStaff() ? 'Liste des emprunts' : 'Mes emprunts' }}</h1>
    </div>
    @if(auth()->user()->isStaff())
        <a href="{{ route('borrowings.create') }}" class="btn btn-primary">
            <x-icon name="plus" /> Nouvel emprunt
        </a>
    @endif
</div>

<form method="GET" class="flex gap-3 mb-6">
    <select name="status" class="field-input w-auto" onchange="this.form.submit()">
        <option value="">Tous les statuts</option>
        <option value="borrowed" {{ request('status') === 'borrowed' ? 'selected' : '' }}>En cours</option>
        <option value="late" {{ request('status') === 'late' ? 'selected' : '' }}>En retard</option>
        <option value="returned" {{ request('status') === 'returned' ? 'selected' : '' }}>Rendus</option>
    </select>
</form>

<div class="table-card">
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead>
                <tr>
                    @if(auth()->user()->isStaff())
                        <th>Utilisateur</th>
                    @endif
                    <th>Livre</th>
                    <th>Date emprunt</th>
                    <th>Date retour prévue</th>
                    <th>Statut</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($borrowings as $borrowing)
                    <tr>
                        @if(auth()->user()->isStaff())
                            <td class="font-medium text-ink-900">{{ $borrowing->user->fullName() }}</td>
                        @endif
                        <td>{{ $borrowing->book->title ?? 'Livre supprimé' }}</td>
                        <td>{{ $borrowing->borrowed_at->format('d/m/Y') }}</td>
                        <td>{{ $borrowing->due_at->format('d/m/Y') }}</td>
                        <td>
                            @if($borrowing->status === 'returned')
                                <span class="badge badge-success"><x-icon name="check-circle" /> Rendu</span>
                            @elseif($borrowing->isOverdue() || $borrowing->status === 'late')
                                <span class="badge badge-danger"><x-icon name="alert-triangle" /> En retard</span>
                            @else
                                <span class="badge badge-info"><x-icon name="clock" /> En cours</span>
                            @endif
                        </td>
                        <td>
                            <div class="flex justify-end gap-1">
                                <a href="{{ route('borrowings.show', $borrowing) }}" class="icon-action" title="Voir">
                                    <x-icon name="eye" />
                                </a>
                                @if(auth()->user()->isStaff() && !$borrowing->returned_at)
                                    <form method="POST" action="{{ route('borrowings.return', $borrowing) }}">
                                        @csrf
                                        <button onclick="return confirm('Marquer ce livre comme rendu ?')" class="icon-action accent" title="Marquer comme rendu">
                                            <x-icon name="check-circle" />
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <div class="table-empty">
                                <x-icon name="swap" />
                                <p>Aucun emprunt trouvé.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-5">
    {{ $borrowings->links() }}
</div>
@endsection
