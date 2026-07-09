@extends('layouts.app')
@section('title', 'Modifier utilisateur')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <p class="eyebrow mb-2">Administration</p>
        <h1 class="page-title">Modifier utilisateur</h1>
    </div>

    <div class="surface surface-pad">
        <form action="{{ route('users.update', $user) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <div class="grid sm:grid-cols-2 gap-5">
                <div class="field">
                    <label class="field-label">Prénom</label>
                    <input type="text" name="first_name" value="{{ old('first_name', $user->first_name) }}" class="field-input {{ $errors->has('first_name') ? 'has-error' : '' }}">
                    @error('first_name')<p class="field-error">{{ $message }}</p>@enderror
                </div>
                <div class="field">
                    <label class="field-label">Nom</label>
                    <input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}" class="field-input {{ $errors->has('last_name') ? 'has-error' : '' }}">
                    @error('last_name')<p class="field-error">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="grid sm:grid-cols-2 gap-5">
                <div class="field">
                    <label class="field-label">Quartier</label>
                    <input type="text" name="district" value="{{ old('district', $user->district) }}" class="field-input {{ $errors->has('district') ? 'has-error' : '' }}">
                    @error('district')<p class="field-error">{{ $message }}</p>@enderror
                </div>
                <div class="field">
                    <label class="field-label">Téléphone</label>
                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="field-input {{ $errors->has('phone') ? 'has-error' : '' }}">
                    @error('phone')<p class="field-error">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="field">
                <label class="field-label">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="field-input {{ $errors->has('email') ? 'has-error' : '' }}">
                @error('email')<p class="field-error">{{ $message }}</p>@enderror
            </div>

            <div class="grid sm:grid-cols-2 gap-5">
                <div class="field">
                    <label class="field-label">Nouveau mot de passe <span class="text-ink-700/40 font-normal">(optionnel)</span></label>
                    <input type="password" name="password" placeholder="••••••••" class="field-input {{ $errors->has('password') ? 'has-error' : '' }}">
                    @error('password')<p class="field-error">{{ $message }}</p>@enderror
                </div>
                <div class="field">
                    <label class="field-label">Confirmer mot de passe</label>
                    <input type="password" name="password_confirmation" placeholder="••••••••" class="field-input">
                </div>
            </div>

            <div class="field">
                <label class="field-label">Rôle</label>
                <select name="role" class="field-input">
                    <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>Utilisateur</option>
                    <option value="librarian" {{ $user->role === 'librarian' ? 'selected' : '' }}>Bibliothécaire</option>
                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            <div class="flex justify-end gap-3 pt-2">
                <a href="{{ route('users.show', $user) }}" class="btn btn-outline">Annuler</a>
                <button type="submit" class="btn btn-accent">
                    <x-icon name="pencil" /> Mettre à jour
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
