@extends('layouts.app')
@section('title', 'Tableau de bord')

@section('content')

<div class="mb-8">
    <p class="eyebrow mb-2">Vue d'ensemble</p>
    <h1 class="page-title">Tableau de bord</h1>
</div>

@if(auth()->user()->isStaff())
    <div class="grid grid-cols-2 lg:grid-cols-6 gap-4 mb-8">
        <div class="stat-card">
            <div class="stat-icon"><x-icon name="users" class="w-5 h-5" /></div>
            <div>
                <div class="stat-label">Utilisateurs</div>
                <div class="stat-value">{{ $stats['users'] }}</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><x-icon name="tag" class="w-5 h-5" /></div>
            <div>
                <div class="stat-label">Catégories</div>
                <div class="stat-value">{{ $stats['categories'] }}</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><x-icon name="book" class="w-5 h-5" /></div>
            <div>
                <div class="stat-label">Livres</div>
                <div class="stat-value">{{ $stats['books'] }}</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><x-icon name="swap" class="w-5 h-5" /></div>
            <div>
                <div class="stat-label">En cours</div>
                <div class="stat-value text-blue-600">{{ $stats['active_borrowings'] }}</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><x-icon name="alert-triangle" class="w-5 h-5" /></div>
            <div>
                <div class="stat-label">En retard</div>
                <div class="stat-value text-red-600">{{ $stats['overdue_borrowings'] }}</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><x-icon name="check-circle" class="w-5 h-5" /></div>
            <div>
                <div class="stat-label">Exemplaires dispo.</div>
                <div class="stat-value">{{ $stats['available_copies'] }} <span class="text-ink-700/40 text-base font-sans">/ {{ $stats['total_copies'] }}</span></div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="surface surface-pad">
            <h2 class="flex items-center gap-2 text-lg font-semibold text-ink-900 mb-4">
                <x-icon name="trending-up" class="w-5 h-5 text-brass-600" /> Livres les plus empruntés
            </h2>
            @forelse($topBooks as $entry)
                <div class="flex justify-between items-center border-b border-ink-900/[0.06] py-2.5 last:border-b-0">
                    <span class="text-sm text-ink-800">{{ $entry->book->title ?? 'Livre supprimé' }}</span>
                    <span class="badge badge-neutral">{{ $entry->total }}</span>
                </div>
            @empty
                <div class="table-empty py-8">
                    <x-icon name="book" />
                    <p>Aucun emprunt pour le moment.</p>
                </div>
            @endforelse
        </div>

        <div class="surface surface-pad">
            <h2 class="flex items-center gap-2 text-lg font-semibold text-ink-900 mb-4">
                <x-icon name="clock" class="w-5 h-5 text-brass-600" /> Activité récente
            </h2>
            @forelse($recentBorrowings as $b)
                <div class="flex justify-between items-center border-b border-ink-900/[0.06] py-2.5 text-sm last:border-b-0">
                    <span class="text-ink-800">{{ $b->user->fullName() }} — {{ $b->book->title ?? 'Livre supprimé' }}</span>
                    <span class="text-ink-700/40 text-xs shrink-0 ml-3">{{ $b->created_at->diffForHumans() }}</span>
                </div>
            @empty
                <div class="table-empty py-8">
                    <x-icon name="clock" />
                    <p>Aucune activité récente.</p>
                </div>
            @endforelse
        </div>
    </div>
@else
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
        <div class="stat-card">
            <div class="stat-icon"><x-icon name="swap" class="w-5 h-5" /></div>
            <div>
                <div class="stat-label">Mes emprunts en cours</div>
                <div class="stat-value text-blue-600">{{ $stats['my_active'] }}</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><x-icon name="alert-triangle" class="w-5 h-5" /></div>
            <div>
                <div class="stat-label">En retard</div>
                <div class="stat-value text-red-600">{{ $stats['my_overdue'] }}</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><x-icon name="book" class="w-5 h-5" /></div>
            <div>
                <div class="stat-label">Total emprunté</div>
                <div class="stat-value">{{ $stats['my_total'] }}</div>
            </div>
        </div>
    </div>

    <div class="table-card">
        <div class="table-toolbar">
            <h2 class="text-lg font-semibold text-ink-900">Mes emprunts</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Livre</th>
                        <th>Emprunté le</th>
                        <th>À rendre avant le</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($myBorrowings as $b)
                        <tr>
                            <td class="font-medium text-ink-900">{{ $b->book->title ?? 'Livre supprimé' }}</td>
                            <td>{{ $b->borrowed_at->format('d/m/Y') }}</td>
                            <td>{{ $b->due_at->format('d/m/Y') }}</td>
                            <td>
                                @if($b->status === 'returned')
                                    <span class="badge badge-success"><x-icon name="check-circle" /> Rendu</span>
                                @elseif($b->isOverdue())
                                    <span class="badge badge-danger"><x-icon name="alert-triangle" /> En retard</span>
                                @else
                                    <span class="badge badge-info"><x-icon name="clock" /> En cours</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">
                                <div class="table-empty">
                                    <x-icon name="book" />
                                    <p>Vous n'avez encore aucun emprunt.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endif
@endsection
