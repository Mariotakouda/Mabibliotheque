@extends('layouts.app')
@section('title', 'Ajouter catégorie')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-cover bg-center" style="background-image: url('/images/background.jpg');">
    <div class="w-full max-w-md bg-white bg-opacity-90 rounded-xl shadow-lg p-6 space-y-6">
        
        <div class="text-center">
            <h1 class="text-2xl font-bold text-gray-800 mb-1">Ajouter une catégorie</h1>
            <p class="text-gray-600 text-sm">Remplissez les informations de la catégorie</p>
        </div>

        
        <form action="{{ route('categories.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-gray-700 font-medium mb-1">Nom de la catégorie</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Nom de la catégorie"
                       class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Description</label>
                <textarea name="description" placeholder="Description"
                          class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                    class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 rounded-lg shadow-md transition duration-200">
                Créer
            </button>
        </form>
    </div>
</div>
@endsection
