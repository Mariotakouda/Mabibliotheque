@extends('layouts.app')
@section('title', 'Utilisateurs')

@section('content')

<div class="flex flex-wrap items-center justify-between gap-4 mb-6">
    <div>
        <p class="eyebrow mb-2">Administration</p>
        <h1 class="page-title">Utilisateurs</h1>
    </div>
    <a href="{{ route('users.create') }}" class="btn btn-primary">
        <x-icon name="plus" /> Ajouter
    </a>
</div>

<form method="GET" action="{{ route('users.index') }}" class="flex gap-3 mb-6">
    <div class="field-with-icon flex-1 max-w-sm">
        <x-icon name="search" />
        <input type="text" name="q" value="{{ $search }}" placeholder="Rechercher (nom, email)..." class="field-input">
    </div>
    <button class="btn btn-outline">
        <x-icon name="search" /> Rechercher
    </button>
</form>

<div class="table-card">
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Rôle</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
            @forelse($users as $user)
                <tr>
                    <td class="font-medium text-ink-900">{{ $user->first_name }} {{ $user->last_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone ?: '—' }}</td>
                    <td>
                        <span class="badge {{ $user->role === 'admin' ? 'badge-warning' : ($user->role === 'librarian' ? 'badge-info' : 'badge-neutral') }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>
                    <td>
                        <div class="flex justify-end gap-1 items-center">
                            <a href="{{ route('users.show', $user) }}" class="icon-action" title="Voir">
                                <x-icon name="eye" />
                            </a>
                            <a href="{{ route('users.edit', $user) }}" class="icon-action accent" title="Modifier">
                                <x-icon name="pencil" />
                            </a>
                            @if($user->id !== auth()->id())
                                <form method="POST" action="{{ route('users.destroy', $user) }}">
                                    @csrf @method('DELETE')
                                    <button onclick="return confirm('Supprimer cet utilisateur ?')" class="icon-action danger" title="Supprimer">
                                        <x-icon name="trash" />
                                    </button>
                                </form>
                            @else
                                <span class="text-ink-700/30 text-xs px-1">(vous)</span>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">
                        <div class="table-empty">
                            <x-icon name="users" />
                            <p>Aucun utilisateur trouvé.</p>
                        </div>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-5">
    {{ $users->links() }}
</div>
@endsection
