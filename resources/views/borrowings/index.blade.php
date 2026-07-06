@extends('layouts.app')
@section('title', 'Emprunts')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <div class="flex flex-wrap items-center justify-between gap-3 mb-4">
        <h1 class="text-2xl font-bold">{{ auth()->user()->isStaff() ? 'Liste des emprunts' : 'Mes emprunts' }}</h1>

        @if(auth()->user()->isStaff())
            <a href="{{ route('borrowings.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">
                + Nouvel emprunt
            </a>
        @endif
    </div>

    <form method="GET" class="flex gap-2 mb-4">
        <select name="status" class="border rounded p-2" onchange="this.form.submit()">
            <option value="">Tous les statuts</option>
            <option value="borrowed" {{ request('status') === 'borrowed' ? 'selected' : '' }}>En cours</option>
            <option value="late" {{ request('status') === 'late' ? 'selected' : '' }}>En retard</option>
            <option value="returned" {{ request('status') === 'returned' ? 'selected' : '' }}>Rendus</option>
        </select>
    </form>

    <table class="w-full bg-white shadow rounded">
        <thead class="bg-gray-200">
            <tr>
                @if(auth()->user()->isStaff())
                    <th class="p-2">Utilisateur</th>
                @endif
                <th>Livre</th>
                <th>Date emprunt</th>
                <th>Date retour prévue</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($borrowings as $borrowing)
                <tr class="border-b">
                    @if(auth()->user()->isStaff())
                        <td class="p-2">{{ $borrowing->user->fullName() }}</td>
                    @endif
                    <td>{{ $borrowing->book->title ?? 'Livre supprimé' }}</td>
                    <td>{{ $borrowing->borrowed_at->format('d/m/Y') }}</td>
                    <td>{{ $borrowing->due_at->format('d/m/Y') }}</td>
                    <td>
                        @if($borrowing->status === 'returned')
                            <span class="text-green-600">Rendu</span>
                        @elseif($borrowing->isOverdue() || $borrowing->status === 'late')
                            <span class="text-red-600">En retard</span>
                        @else
                            <span class="text-blue-600">En cours</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('borrowings.show', $borrowing) }}" class="text-blue-600">Voir</a>
                        @if(auth()->user()->isStaff() && !$borrowing->returned_at)
                            |
                            <form method="POST" action="{{ route('borrowings.return', $borrowing) }}" class="inline">
                                @csrf
                                <button onclick="return confirm('Marquer ce livre comme rendu ?')" class="text-green-600">Retourner</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center p-2">Aucun emprunt trouvé.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $borrowings->links() }}
    </div>
</div>
@endsection
