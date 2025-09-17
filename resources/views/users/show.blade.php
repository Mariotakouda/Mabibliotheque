@extends('layouts.app')
@section('title', 'Détail utilisateur')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h1 class="text-xl font-bold">{{ $user->first_name }} {{ $user->last_name }}</h1>
    <p><strong>Email :</strong> {{ $user->email }}</p>
    <p><strong>Téléphone :</strong> {{ $user->phone }}</p>
    <p><strong>Quartier :</strong> {{ $user->district }}</p>
    <p><strong>Rôle :</strong> {{ ucfirst($user->role) }}</p>
</div>


<div class="mt-6">
    <h2 class="text-lg font-semibold mb-2">Ses emprunts :</h2>
    <table class="w-full bg-white shadow rounded">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-2">Livre</th>
                <th>Date emprunt</th>
                <th>Date retour</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
        @forelse($user->borrowings as $borrowing)
            <tr class="border-b">
                <td class="p-2">{{ $borrowing->book->title }}</td>
                <td>{{ $borrowing->borrowed_at->format('d/m/Y') }}</td>
                <td>{{ $borrowing->returned_at ? $borrowing->returned_at->format('d/m/Y') : '-' }}</td>
                <td>
                    @if($borrowing->status === 'returned')
                        <span class="text-green-600">Rendu</span>
                    @elseif($borrowing->status === 'late')
                        <span class="text-orange-600">En retard</span>
                    @else
                        <span class="text-red-600">En cours</span>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center p-2">Aucun emprunt trouvé.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
