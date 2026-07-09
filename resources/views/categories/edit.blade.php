@extends('layouts.app')
@section('title', 'Modifier catégorie')

@section('content')
<div class="max-w-lg mx-auto">
    <div class="mb-6">
        <p class="eyebrow mb-2">Catalogue</p>
        <h1 class="page-title">Modifier catégorie</h1>
    </div>

    <div class="surface surface-pad">
        <form action="{{ route('categories.update', $category) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <div class="field">
                <label class="field-label">Nom de la catégorie</label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}" class="field-input {{ $errors->has('name') ? 'has-error' : '' }}">
                @error('name')<p class="field-error">{{ $message }}</p>@enderror
            </div>

            <div class="field">
                <label class="field-label">Description</label>
                <textarea name="description" rows="4" class="field-input {{ $errors->has('description') ? 'has-error' : '' }}">{{ old('description', $category->description) }}</textarea>
                @error('description')<p class="field-error">{{ $message }}</p>@enderror
            </div>

            <div class="flex justify-end gap-3 pt-2">
                <a href="{{ route('categories.show', $category) }}" class="btn btn-outline">Annuler</a>
                <button type="submit" class="btn btn-accent">
                    <x-icon name="pencil" /> Mettre à jour
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
