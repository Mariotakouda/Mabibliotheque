@extends('layouts.app')
@section('title', 'Ajouter un livre')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-cover bg-center" style="background-image: url('/images/background.jpg');">
    <div class="w-full max-w-md bg-white bg-opacity-90 rounded-xl shadow-lg p-6 space-y-6">
        
        <div class="text-center">
            <h1 class="text-2xl font-bold text-gray-800 mb-1">Ajouter un livre</h1>
            <p class="text-gray-600 text-sm">Remplissez les informations du livre</p>
        </div>

        
        <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label class="block text-gray-700 font-medium mb-1">Titre</label>
                <input type="text" name="title" value="{{ old('title') }}" placeholder="Titre"
                       class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Auteur</label>
                <input type="text" name="author" value="{{ old('author') }}" placeholder="Auteur"
                       class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                @error('author')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">ISBN</label>
                <input type="text" name="isbn" value="{{ old('isbn') }}" placeholder="ISBN"
                       class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                @error('isbn')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Date de publication</label>
                <input type="date" name="published_at" value="{{ old('published_at') }}"
                       class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                @error('published_at')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Résumé</label>
                <textarea name="summary" placeholder="Résumé"
                          class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">{{ old('summary') }}</textarea>
                @error('summary')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Nombre d'exemplaires</label>
                <input type="number" name="total_copies" value="{{ old('total_copies') }}" placeholder="Nombre d'exemplaires"
                       class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                @error('total_copies')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Catégorie</label>
                <select name="category_id"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                    <option value="">Choisir une catégorie</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Couverture</label>
                <input type="file" name="cover_path"
                       class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                @error('cover_path')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg shadow-md transition duration-200">
                Créer
            </button>
        </form>
    </div>
</div>
@endsection
