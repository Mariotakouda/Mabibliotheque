@extends('layouts.app')
@section('title', 'Détail de l’emprunt')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h1 class="text-xl font-bold mb-2">Emprunt du livre : {{ $borrowing->book->title }}</h1>
    <p><strong>Utilisateur :</strong> {{ $borrowing->user->name }}</p>
    <p><strong>Date d'emprunt :</strong> {{ $borrowing->borrowed_at->format('d/m/Y') }}</p>
    <p><strong>Date de retour :</strong> {{ $borrowing->returned_at ? $borrowing->returned_at->format('d/m/Y') : '-' }}</p>
    <p><strong>Statut :</strong>
        @if($borrowing->returned_at)
            <span class="text-green-600">Rendu</span>
        @else
            <span class="text-red-600">En cours</span>
        @endif
    </p>

    @if(!$borrowing->returned_at)
        <form method="POST" action="{{ route('borrowings.return', $borrowing) }}" class="mt-4">
            @csrf
            <button onclick="return confirm('Marquer ce livre comme rendu ?')" class="bg-green-600 text-white px-4 py-2 rounded">
                Retourner le livre
            </button>
        </form>
    @endif
</div>
@endsection
