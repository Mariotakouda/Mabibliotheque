@extends('layouts.app')
@section('title', 'Détail catégorie')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h1 class="text-xl font-bold">{{ $category->name }}</h1>
    <p><strong>Description :</strong> {{ $category->description }}</p>
</div>

@if($category->books->count() > 0)
    <h2 class="text-lg font-semibold mt-4">Livres dans cette catégorie :</h2>
    <ul class="list-disc ml-6">
        @foreach($category->books as $book)
            <li>{{ $book->title }} - {{ $book->author }}</li>
        @endforeach
    </ul>
@else
    <p class="mt-4 text-gray-500">Aucun livre dans cette catégorie.</p>
@endif
@endsection
