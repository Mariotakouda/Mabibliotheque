@extends('layouts.app')
@section('title', 'Utilisateurs')

@section('content')
<h1 class="text-2xl font-bold mb-4 text-white">Liste des utilisateurs</h1>

<div class="flex flex-wrap items-center justify-between gap-3 mb-4">
    <a href="{{ route('users.create') }}" class="bg-blue-600 text-white px-3 py-2 rounded">+ Ajouter</a>

    <form method="GET" action="{{ route('users.index') }}" class="flex gap-2">
        <input type="text" name="q" value="{{ $search }}" placeholder="Rechercher (nom, email)..."
               class="border rounded p-2">
        <button class="bg-gray-700 text-white px-3 py-2 rounded">Rechercher</button>
    </form>
</div>

<table class="w-full mt-4 bg-white shadow rounded">
    <thead class="bg-gray-200">
        <tr>
            <th class="p-2">Nom</th>
            <th>Email</th>
            <th>Téléphone</th>
            <th>Rôle</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    @forelse($users as $user)
        <tr class="border-b">
            <td class="p-2">{{ $user->first_name }} {{ $user->last_name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->phone }}</td>
            <td>{{ ucfirst($user->role) }}</td>
            <td>
                <a href="{{ route('users.show', $user) }}" class="text-blue-600">Voir</a> |
                <a href="{{ route('users.edit', $user) }}" class="text-yellow-600">Modifier</a> |
                @if($user->id !== auth()->id())
                    <form method="POST" action="{{ route('users.destroy', $user) }}" class="inline">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Supprimer cet utilisateur ?')" class="text-red-600">Supprimer</button>
                    </form>
                @else
                    <span class="text-gray-400">(vous)</span>
                @endif
            </td>
        </tr>
    @empty
        <tr><td colspan="5" class="text-center p-4 text-gray-400">Aucun utilisateur trouvé.</td></tr>
    @endforelse
    </tbody>
</table>

<div class="mt-4">
    {{ $users->links() }}
</div>
@endsection
