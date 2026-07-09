@extends('layouts.app')
@section('title', 'Ajouter utilisateur')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <p class="eyebrow mb-2">Administration</p>
        <h1 class="page-title">Ajouter un utilisateur</h1>
        <p class="page-subtitle">Remplissez les informations de l'utilisateur.</p>
    </div>

    <div class="surface surface-pad">
        <form action="{{ route('users.store') }}" method="POST" class="space-y-5">
            @csrf

            <div class="grid sm:grid-cols-2 gap-5">
                <div class="field">
                    <label class="field-label">Prénom</label>
                    <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="Prénom"
                           class="field-input {{ $errors->has('first_name') ? 'has-error' : '' }}">
                    @error('first_name')<p class="field-error">{{ $message }}</p>@enderror
                </div>
                <div class="field">
                    <label class="field-label">Nom</label>
                    <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Nom"
                           class="field-input {{ $errors->has('last_name') ? 'has-error' : '' }}">
                    @error('last_name')<p class="field-error">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="grid sm:grid-cols-2 gap-5">
                <div class="field">
                    <label class="field-label">Quartier</label>
                    <input type="text" name="district" value="{{ old('district') }}" placeholder="Quartier"
                           class="field-input {{ $errors->has('district') ? 'has-error' : '' }}">
                    @error('district')<p class="field-error">{{ $message }}</p>@enderror
                </div>
                <div class="field">
                    <label class="field-label">Téléphone</label>
                    <div class="field-with-icon">
                        <x-icon name="phone" />
                        <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Téléphone"
                               class="field-input {{ $errors->has('phone') ? 'has-error' : '' }}">
                    </div>
                    @error('phone')<p class="field-error">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="field">
                <label class="field-label">Email</label>
                <div class="field-with-icon">
                    <x-icon name="mail" />
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="vous@exemple.com"
                           class="field-input {{ $errors->has('email') ? 'has-error' : '' }}">
                </div>
                @error('email')<p class="field-error">{{ $message }}</p>@enderror
            </div>

            <div class="grid sm:grid-cols-2 gap-5">
                <div class="field">
                    <label class="field-label">Mot de passe</label>
                    <div class="field-with-icon">
                        <x-icon name="lock" />
                        <input type="password" name="password" placeholder="••••••••"
                               class="field-input {{ $errors->has('password') ? 'has-error' : '' }}">
                    </div>
                    @error('password')<p class="field-error">{{ $message }}</p>@enderror
                </div>
                <div class="field">
                    <label class="field-label">Confirmer mot de passe</label>
                    <div class="field-with-icon">
                        <x-icon name="lock" />
                        <input type="password" name="password_confirmation" placeholder="••••••••" class="field-input">
                    </div>
                </div>
            </div>

            <div class="field">
                <label class="field-label">Rôle</label>
                <select name="role" class="field-input {{ $errors->has('role') ? 'has-error' : '' }}">
                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Utilisateur</option>
                    <option value="librarian" {{ old('role') == 'librarian' ? 'selected' : '' }}>Bibliothécaire</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
                @error('role')<p class="field-error">{{ $message }}</p>@enderror
            </div>

            <div class="flex justify-end gap-3 pt-2">
                <a href="{{ route('users.index') }}" class="btn btn-outline">Annuler</a>
                <button type="submit" class="btn btn-accent">
                    <x-icon name="check-circle" /> Créer
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
