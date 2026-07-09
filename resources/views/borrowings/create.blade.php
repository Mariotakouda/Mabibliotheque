@extends('layouts.app')
@section('title', 'Nouvel emprunt')

@section('content')
<div class="max-w-lg mx-auto">
    <div class="mb-6">
        <p class="eyebrow mb-2">Circulation</p>
        <h1 class="page-title">Nouvel emprunt</h1>
    </div>

    <div class="surface surface-pad">
        <form method="POST" action="{{ route('borrowings.store') }}" class="space-y-5">
            @csrf

            <div class="field">
                <label class="field-label">Utilisateur</label>
                <div class="field-with-icon">
                    <x-icon name="users" />
                    <select name="user_id" class="field-input {{ $errors->has('user_id') ? 'has-error' : '' }}">
                        <option value="">Sélectionner un utilisateur</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('user_id')<p class="field-error">{{ $message }}</p>@enderror
            </div>

            <div class="field">
                <label class="field-label">Livre <span class="text-ink-700/40 font-normal">(disponibles uniquement)</span></label>
                <div class="field-with-icon">
                    <x-icon name="book" />
                    <select name="book_id" class="field-input {{ $errors->has('book_id') ? 'has-error' : '' }}">
                        <option value="">Sélectionner un livre</option>
                        @foreach($books as $book)
                            <option value="{{ $book->id }}">{{ $book->title }} ({{ $book->available_copies }} dispo.)</option>
                        @endforeach
                    </select>
                </div>
                @error('book_id')<p class="field-error">{{ $message }}</p>@enderror
            </div>

            <div class="field">
                <label class="field-label">Date d'emprunt</label>
                <div class="field-with-icon">
                    <x-icon name="calendar" />
                    <input type="date" name="borrowed_at" value="{{ old('borrowed_at', now()->toDateString()) }}" class="field-input">
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-2">
                <a href="{{ route('borrowings.index') }}" class="btn btn-outline">Annuler</a>
                <button type="submit" class="btn btn-primary">
                    <x-icon name="check-circle" /> Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
