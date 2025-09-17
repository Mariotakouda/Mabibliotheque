@extends('layouts.app')
@section('title', 'Utilisateurs')

@section('content')
<h1 class="text-2xl font-bold mb-4 text-white">Liste des utilisateurs</h1>

<a href="{{ route('users.create') }}" class="bg-blue-600 text-white px-3 py-2 rounded">+ Ajouter</a>

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
    @foreach($users as $user)
        <tr class="border-b">
            <td class="p-2">{{ $user->first_name }} {{ $user->last_name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->phone }}</td>
            <td>{{ ucfirst($user->role) }}</td>
            <td>
                <a href="{{ route('users.show', $user) }}" class="text-blue-600">Voir</a> |
                <a href="{{ route('users.edit', $user) }}" class="text-yellow-600">Modifier</a> |
                <form method="POST" action="{{ route('users.destroy', $user) }}" class="inline">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('Supprimer cet utilisateur ?')" class="text-red-600">Supprimer</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
