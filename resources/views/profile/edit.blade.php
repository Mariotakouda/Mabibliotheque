@extends('layouts.app')
@section('title', 'Mon profil')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <p class="eyebrow mb-2">Compte</p>
        <h1 class="page-title">Mon profil</h1>
        <p class="page-subtitle">Rôle actuel : <span class="font-semibold text-ink-900">{{ ucfirst($user->role) }}</span></p>
    </div>

    <div class="surface surface-pad">
        <form method="POST" action="{{ route('profile.update') }}" class="space-y-5">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-2 gap-4">
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

            <div class="field">
                <label class="field-label">Quartier</label>
                <input type="text" name="district" value="{{ old('district', $user->district) }}" class="field-input">
            </div>

            <div class="field">
                <label class="field-label">Téléphone</label>
                <div class="field-with-icon">
                    <x-icon name="phone" />
                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="field-input">
                </div>
            </div>

            <div class="field">
                <label class="field-label">Email</label>
                <div class="field-with-icon">
                    <x-icon name="mail" />
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="field-input {{ $errors->has('email') ? 'has-error' : '' }}">
                </div>
                @error('email')<p class="field-error">{{ $message }}</p>@enderror
            </div>

            <div class="pt-4 border-t border-ink-900/[0.06]">
                <p class="flex items-center gap-2 text-xs text-ink-700/50 mb-4">
                    <x-icon name="info" class="w-4 h-4" />
                    Laissez les champs ci-dessous vides pour conserver votre mot de passe actuel.
                </p>

                <div class="field mb-4">
                    <label class="field-label">Mot de passe actuel</label>
                    <div class="field-with-icon">
                        <x-icon name="lock" />
                        <input type="password" name="current_password" placeholder="Requis pour changer le mot de passe" class="field-input {{ $errors->has('current_password') ? 'has-error' : '' }}">
                    </div>
                    @error('current_password')<p class="field-error">{{ $message }}</p>@enderror
                </div>

                <div class="grid sm:grid-cols-2 gap-4">
                    <div class="field">
                        <label class="field-label">Nouveau mot de passe</label>
                        <input type="password" name="password" class="field-input {{ $errors->has('password') ? 'has-error' : '' }}">
                        @error('password')<p class="field-error">{{ $message }}</p>@enderror
                    </div>
                    <div class="field">
                        <label class="field-label">Confirmer le mot de passe</label>
                        <input type="password" name="password_confirmation" class="field-input">
                    </div>
                </div>
            </div>

            <button class="btn btn-primary btn-block">
                <x-icon name="check-circle" /> Enregistrer
            </button>
        </form>
    </div>
</div>
@endsection
