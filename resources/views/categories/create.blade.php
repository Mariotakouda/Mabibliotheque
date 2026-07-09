@extends('layouts.app')
@section('title', 'Ajouter catégorie')

@section('content')
<div class="max-w-lg mx-auto">
    <div class="mb-6">
        <p class="eyebrow mb-2">Catalogue</p>
        <h1 class="page-title">Ajouter une catégorie</h1>
        <p class="page-subtitle">Remplissez les informations de la catégorie.</p>
    </div>

    <div class="surface surface-pad">
        <form action="{{ route('categories.store') }}" method="POST" class="space-y-5">
            @csrf

            <div class="field">
                <label class="field-label">Nom de la catégorie</label>
                <div class="field-with-icon">
                    <x-icon name="tag" />
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Ex : Science-fiction"
                           class="field-input {{ $errors->has('name') ? 'has-error' : '' }}">
                </div>
                @error('name')<p class="field-error">{{ $message }}</p>@enderror
            </div>

            <div class="field">
                <label class="field-label">Description</label>
                <textarea name="description" rows="4" placeholder="Description de la catégorie"
                          class="field-input {{ $errors->has('description') ? 'has-error' : '' }}">{{ old('description') }}</textarea>
                @error('description')<p class="field-error">{{ $message }}</p>@enderror
            </div>

            <div class="flex justify-end gap-3 pt-2">
                <a href="{{ route('categories.index') }}" class="btn btn-outline">Annuler</a>
                <button type="submit" class="btn btn-accent">
                    <x-icon name="check-circle" /> Créer
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
