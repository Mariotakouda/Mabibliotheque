@extends('layouts.app')
@section('title', 'Modifier catégorie')

@section('content')
<h1 class="text-2xl font-bold mb-4">Modifier catégorie</h1>

<form action="{{ route('categories.update', $category) }}" method="POST">
    @csrf
    @method('PUT')

    <input type="text" name="name" value="{{ old('name', $category->name) }}" class="border p-2 w-full mb-2">
    <textarea name="description" class="border p-2 w-full mb-2">{{ old('description', $category->description) }}</textarea>

    <button class="bg-yellow-600 text-white px-4 py-2 rounded">Mettre à jour</button>
</form>
@endsection
