@extends('layouts.app')
@section('title', 'Modifier un livre')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <p class="eyebrow mb-2">Catalogue</p>
        <h1 class="page-title">Modifier le livre</h1>
    </div>

    <div class="surface surface-pad">
        <form action="{{ route('books.update', $book) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <div class="grid sm:grid-cols-2 gap-5">
                <div class="field">
                    <label class="field-label">Titre</label>
                    <input type="text" name="title" value="{{ old('title', $book->title) }}" class="field-input {{ $errors->has('title') ? 'has-error' : '' }}">
                    @error('title')<p class="field-error">{{ $message }}</p>@enderror
                </div>
                <div class="field">
                    <label class="field-label">Auteur</label>
                    <input type="text" name="author" value="{{ old('author', $book->author) }}" class="field-input {{ $errors->has('author') ? 'has-error' : '' }}">
                    @error('author')<p class="field-error">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="grid sm:grid-cols-2 gap-5">
                <div class="field">
                    <label class="field-label">ISBN</label>
                    <input type="text" name="isbn" value="{{ old('isbn', $book->isbn) }}" class="field-input {{ $errors->has('isbn') ? 'has-error' : '' }}">
                    @error('isbn')<p class="field-error">{{ $message }}</p>@enderror
                </div>
                <div class="field">
                    <label class="field-label">Date de publication</label>
                    <input type="date" name="published_at" value="{{ old('published_at', $book->published_at?->format('Y-m-d')) }}" class="field-input {{ $errors->has('published_at') ? 'has-error' : '' }}">
                    @error('published_at')<p class="field-error">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="field">
                <label class="field-label">Résumé</label>
                <textarea name="summary" rows="4" class="field-input {{ $errors->has('summary') ? 'has-error' : '' }}">{{ old('summary', $book->summary) }}</textarea>
                @error('summary')<p class="field-error">{{ $message }}</p>@enderror
            </div>

            <div class="grid sm:grid-cols-2 gap-5">
                <div class="field">
                    <label class="field-label">Nombre d'exemplaires</label>
                    <input type="number" name="total_copies" value="{{ old('total_copies', $book->total_copies) }}" class="field-input {{ $errors->has('total_copies') ? 'has-error' : '' }}">
                    @error('total_copies')<p class="field-error">{{ $message }}</p>@enderror
                </div>
                <div class="field">
                    <label class="field-label">Catégorie</label>
                    <select name="category_id" class="field-input {{ $errors->has('category_id') ? 'has-error' : '' }}">
                        <option value="">Choisir une catégorie</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $book->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')<p class="field-error">{{ $message }}</p>@enderror
                </div>
            </div>

            @if($book->cover_path)
                <div class="field">
                    <label class="field-label">Couverture actuelle</label>
                    <img src="{{ asset('storage/' . $book->cover_path) }}" alt="Couverture" class="w-24 rounded-lg border border-ink-900/10">
                </div>
            @endif

            <div class="field">
                <label class="field-label">Remplacer la couverture</label>
                <div class="flex items-center gap-3 border border-dashed border-ink-900/20 rounded-lg p-4">
                    <x-icon name="photo" class="w-6 h-6 text-ink-700/40 shrink-0" />
                    <input type="file" name="cover_path" class="text-sm text-ink-700/70 w-full">
                </div>
                @error('cover_path')<p class="field-error">{{ $message }}</p>@enderror
            </div>

            <div class="flex justify-end gap-3 pt-2">
                <a href="{{ route('books.show', $book) }}" class="btn btn-outline">Annuler</a>
                <button type="submit" class="btn btn-accent">
                    <x-icon name="pencil" /> Mettre à jour
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
