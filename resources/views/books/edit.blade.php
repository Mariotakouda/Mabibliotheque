@extends('layouts.app')
@section('title', 'Modifier un livre')

@section('content')
<h1 class="text-2xl font-bold mb-4">Modifier le livre</h1>

<form action="{{ route('books.update', $book) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <input type="text" name="title" value="{{ old('title', $book->title) }}" class="border p-2 w-full mb-2">
    <input type="text" name="author" value="{{ old('author', $book->author) }}" class="border p-2 w-full mb-2">
    <input type="text" name="isbn" value="{{ old('isbn', $book->isbn) }}" class="border p-2 w-full mb-2">
    <input type="date" name="published_at" value="{{ old('published_at', $book->published_at?->format('Y-m-d')) }}" class="border p-2 w-full mb-2">
    <textarea name="summary" class="border p-2 w-full mb-2">{{ old('summary', $book->summary) }}</textarea>
    <input type="number" name="total_copies" value="{{ old('total_copies', $book->total_copies) }}" class="border p-2 w-full mb-2">

    <select name="category_id" class="border p-2 w-full mb-2">
        <option value="">Choisir une catégorie</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ $book->category_id == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    @if($book->cover_path)
        <p class="mb-2">Couverture actuelle :</p>
        <img src="{{ asset('storage/' . $book->cover_path) }}" alt="Couverture" class="w-32 mb-2">
    @endif
    <input type="file" name="cover_path" class="border p-2 w-full mb-2">

    <button class="bg-yellow-600 text-white px-4 py-2 rounded">Mettre à jour</button>
</form>
@endsection
