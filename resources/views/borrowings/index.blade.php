@extends('layouts.app')
@section('title', 'Liste des emprunts')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Liste des emprunts</h1>

    <a href="{{ route('borrowings.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">
        + Nouvel emprunt
    </a>

    <table class="w-full bg-white shadow rounded">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-2">Utilisateur</th>
                <th>Livre</th>
                <th>Date emprunt</th>
                <th>Date retour prévue</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            @forelse($borrowings as $borrowing)
                <tr class="border-b">
                    <td class="p-2">{{ $borrowing->user->first_name }} {{ $borrowing->user->last_name }}</td>
                    <td>{{ $borrowing->book->title }}</td>
                    <td>{{ \Carbon\Carbon::parse($borrowing->borrowed_at)->format('d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($borrowing->due_at)->format('d/m/Y') }}</td>
                    <td>
                        @if($borrowing->status === 'borrowed')
                            <span class="text-blue-600">En cours</span>
                        @elseif($borrowing->status === 'returned')
                            <span class="text-green-600">Rendu</span>
                        @else
                            <span class="text-red-600">En retard</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center p-2">Aucun emprunt trouvé.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
