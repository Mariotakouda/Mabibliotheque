@extends('layouts.app')
@section('title', 'Tableau de bord')

@section('content')

@if(auth()->user()->isStaff())
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-8">
        <div class="bg-white shadow rounded p-4 text-center">
            <h2 class="text-sm text-gray-500 mb-1">Utilisateurs</h2>
            <p class="text-2xl font-bold">{{ $stats['users'] }}</p>
        </div>
        <div class="bg-white shadow rounded p-4 text-center">
            <h2 class="text-sm text-gray-500 mb-1">Catégories</h2>
            <p class="text-2xl font-bold">{{ $stats['categories'] }}</p>
        </div>
        <div class="bg-white shadow rounded p-4 text-center">
            <h2 class="text-sm text-gray-500 mb-1">Livres</h2>
            <p class="text-2xl font-bold">{{ $stats['books'] }}</p>
        </div>
        <div class="bg-white shadow rounded p-4 text-center">
            <h2 class="text-sm text-gray-500 mb-1">Emprunts en cours</h2>
            <p class="text-2xl font-bold text-blue-600">{{ $stats['active_borrowings'] }}</p>
        </div>
        <div class="bg-white shadow rounded p-4 text-center">
            <h2 class="text-sm text-gray-500 mb-1">En retard</h2>
            <p class="text-2xl font-bold text-red-600">{{ $stats['overdue_borrowings'] }}</p>
        </div>
        <div class="bg-white shadow rounded p-4 text-center">
            <h2 class="text-sm text-gray-500 mb-1">Exemplaires dispo.</h2>
            <p class="text-2xl font-bold">{{ $stats['available_copies'] }} / {{ $stats['total_copies'] }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white shadow rounded p-6">
            <h2 class="text-lg font-semibold mb-3">📚 Livres les plus empruntés</h2>
            @forelse($topBooks as $entry)
                <div class="flex justify-between border-b py-2">
                    <span>{{ $entry->book->title ?? 'Livre supprimé' }}</span>
                    <span class="font-semibold">{{ $entry->total }}</span>
                </div>
            @empty
                <p class="text-gray-400">Aucun emprunt pour le moment.</p>
            @endforelse
        </div>

        <div class="bg-white shadow rounded p-6">
            <h2 class="text-lg font-semibold mb-3">🕒 Activité récente</h2>
            @forelse($recentBorrowings as $b)
                <div class="flex justify-between border-b py-2 text-sm">
                    <span>{{ $b->user->fullName() }} — {{ $b->book->title ?? 'Livre supprimé' }}</span>
                    <span class="text-gray-400">{{ $b->created_at->diffForHumans() }}</span>
                </div>
            @empty
                <p class="text-gray-400">Aucune activité récente.</p>
            @endforelse
        </div>
    </div>
@else
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white shadow rounded p-6 text-center">
            <h2 class="text-sm text-gray-500 mb-1">Mes emprunts en cours</h2>
            <p class="text-3xl font-bold text-blue-600">{{ $stats['my_active'] }}</p>
        </div>
        <div class="bg-white shadow rounded p-6 text-center">
            <h2 class="text-sm text-gray-500 mb-1">En retard</h2>
            <p class="text-3xl font-bold text-red-600">{{ $stats['my_overdue'] }}</p>
        </div>
        <div class="bg-white shadow rounded p-6 text-center">
            <h2 class="text-sm text-gray-500 mb-1">Total emprunté</h2>
            <p class="text-3xl font-bold">{{ $stats['my_total'] }}</p>
        </div>
    </div>

    <div class="bg-white shadow rounded p-6">
        <h2 class="text-lg font-semibold mb-3">Mes emprunts</h2>
        <table class="w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 text-left">Livre</th>
                    <th class="text-left">Emprunté le</th>
                    <th class="text-left">À rendre avant le</th>
                    <th class="text-left">Statut</th>
                </tr>
            </thead>
            <tbody>
                @forelse($myBorrowings as $b)
                    <tr class="border-b">
                        <td class="p-2">{{ $b->book->title ?? 'Livre supprimé' }}</td>
                        <td>{{ $b->borrowed_at->format('d/m/Y') }}</td>
                        <td>{{ $b->due_at->format('d/m/Y') }}</td>
                        <td>
                            @if($b->status === 'returned')
                                <span class="text-green-600">Rendu</span>
                            @elseif($b->isOverdue())
                                <span class="text-red-600">En retard</span>
                            @else
                                <span class="text-blue-600">En cours</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center p-4 text-gray-400">Vous n'avez encore aucun emprunt.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endif
@endsection
