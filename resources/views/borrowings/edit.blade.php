@extends('layouts.app')
@section('title', 'Modifier emprunt')

@section('content')
<div class="max-w-lg mx-auto">
    <div class="mb-6">
        <p class="eyebrow mb-2">Circulation</p>
        <h1 class="page-title">Modifier l'emprunt</h1>
    </div>

    <div class="surface surface-pad">
        <div class="flex flex-col gap-1 mb-5 pb-5 border-b border-ink-900/[0.06] text-sm">
            <span class="flex items-center gap-2 text-ink-700/70"><x-icon name="users" class="w-4 h-4" /> {{ $borrowing->user->fullName() }}</span>
            <span class="flex items-center gap-2 text-ink-700/70"><x-icon name="book" class="w-4 h-4" /> {{ $borrowing->book->title ?? 'Livre supprimé' }}</span>
        </div>

        <form action="{{ route('borrowings.update', $borrowing) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <div class="field">
                <label class="field-label">Date d'emprunt</label>
                <input type="date" name="borrowed_at" value="{{ old('borrowed_at', $borrowing->borrowed_at->format('Y-m-d')) }}" class="field-input {{ $errors->has('borrowed_at') ? 'has-error' : '' }}">
                @error('borrowed_at')<p class="field-error">{{ $message }}</p>@enderror
            </div>

            <div class="field">
                <label class="field-label">Date de retour prévue</label>
                <input type="date" name="due_at" value="{{ old('due_at', $borrowing->due_at->format('Y-m-d')) }}" class="field-input {{ $errors->has('due_at') ? 'has-error' : '' }}">
                @error('due_at')<p class="field-error">{{ $message }}</p>@enderror
            </div>

            <div class="flex justify-end gap-3 pt-2">
                <a href="{{ route('borrowings.show', $borrowing) }}" class="btn btn-outline">Annuler</a>
                <button type="submit" class="btn btn-accent btn-block sm:w-auto">
                    <x-icon name="pencil" /> Mettre à jour
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
