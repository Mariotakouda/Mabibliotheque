@extends('layouts.app')
@section('title', 'Détail du livre')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h1 class="text-xl font-bold">{{ $book->title }}</h1>
    <p><strong>Auteur :</strong> {{ $book->author }}</p>
    <p><strong>ISBN :</strong> {{ $book->isbn }}</p>
    
    <p><strong>Publié le :</strong> {{ $book->published_at ? $book->published_at->format('d/m/Y') : '-' }}</p>
    <p><strong>Résumé :</strong> {{ $book->summary }}</p>
    <p><strong>Catégorie :</strong> {{ $book->category->name ?? 'Non catégorisé' }}</p>
    <p><strong>Exemplaires disponibles :</strong> {{ $book->available_copies }} / {{ $book->total_copies }}</p>

    @if($book->cover_path)
        <img src="{{ asset('storage/' . $book->cover_path) }}" alt="Couverture" class="w-40 mt-4">
    @endif
</div>
@endsection
