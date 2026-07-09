@extends('layouts.app')
@section('title', 'Ajouter un livre')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <p class="eyebrow mb-2">Catalogue</p>
        <h1 class="page-title">Ajouter un livre</h1>
        <p class="page-subtitle">Remplissez les informations du livre.</p>
    </div>

    <div class="surface surface-pad">
        <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div class="grid sm:grid-cols-2 gap-5">
                <div class="field">
                    <label class="field-label">Titre</label>
                    <input type="text" name="title" value="{{ old('title') }}" placeholder="Titre"
                           class="field-input {{ $errors->has('title') ? 'has-error' : '' }}">
                    @error('title')<p class="field-error">{{ $message }}</p>@enderror
                </div>

                <div class="field">
                    <label class="field-label">Auteur</label>
                    <input type="text" name="author" value="{{ old('author') }}" placeholder="Auteur"
                           class="field-input {{ $errors->has('author') ? 'has-error' : '' }}">
                    @error('author')<p class="field-error">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="grid sm:grid-cols-2 gap-5">
                <div class="field">
                    <label class="field-label">ISBN</label>
                    <div class="field-with-icon">
                        <x-icon name="identification" />
                        <input type="text" name="isbn" value="{{ old('isbn') }}" placeholder="978-2-..."
                               class="field-input {{ $errors->has('isbn') ? 'has-error' : '' }}">
                    </div>
                    @error('isbn')<p class="field-error">{{ $message }}</p>@enderror
                </div>

                <div class="field">
                    <label class="field-label">Date de publication</label>
                    <div class="field-with-icon">
                        <x-icon name="calendar" />
                        <input type="date" name="published_at" value="{{ old('published_at') }}"
                               class="field-input {{ $errors->has('published_at') ? 'has-error' : '' }}">
                    </div>
                    @error('published_at')<p class="field-error">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="field">
                <label class="field-label">Résumé</label>
                <textarea name="summary" rows="4" placeholder="Résumé du livre"
                          class="field-input {{ $errors->has('summary') ? 'has-error' : '' }}">{{ old('summary') }}</textarea>
                @error('summary')<p class="field-error">{{ $message }}</p>@enderror
            </div>

            <div class="grid sm:grid-cols-2 gap-5">
                <div class="field">
                    <label class="field-label">Nombre d'exemplaires</label>
                    <div class="field-with-icon">
                        <x-icon name="hashtag" />
                        <input type="number" name="total_copies" value="{{ old('total_copies') }}" placeholder="0"
                               class="field-input {{ $errors->has('total_copies') ? 'has-error' : '' }}">
                    </div>
                    @error('total_copies')<p class="field-error">{{ $message }}</p>@enderror
                </div>

                <div class="field">
                    <label class="field-label">Catégorie</label>
                    <select name="category_id" class="field-input {{ $errors->has('category_id') ? 'has-error' : '' }}">
                        <option value="">Choisir une catégorie</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')<p class="field-error">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="field">
                <label class="field-label">Couverture</label>
                <div class="flex items-center gap-3 border border-dashed border-ink-900/20 rounded-lg p-4">
                    <x-icon name="photo" class="w-6 h-6 text-ink-700/40 shrink-0" />
                    <input type="file" name="cover_path" class="text-sm text-ink-700/70 w-full">
                </div>
                @error('cover_path')<p class="field-error">{{ $message }}</p>@enderror
            </div>

            <div class="flex justify-end gap-3 pt-2">
                <a href="{{ route('books.index') }}" class="btn btn-outline">Annuler</a>
                <button type="submit" class="btn btn-primary">
                    <x-icon name="check-circle" /> Créer
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
