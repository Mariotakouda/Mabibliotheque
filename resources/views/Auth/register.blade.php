@extends('layouts.app')
@section('title', 'Inscription')

@section('content')
<div class="min-h-[75vh] flex items-center justify-center py-6">
    <div class="w-full max-w-md">

        <div class="text-center mb-8">
            <div class="w-12 h-12 rounded-xl bg-ink-900 text-brass-300 flex items-center justify-center mx-auto mb-4">
                <x-icon name="user-plus" class="w-6 h-6" />
            </div>
            <h1 class="page-title">Créer un compte</h1>
            <p class="page-subtitle">Les nouveaux comptes sont créés avec le rôle « utilisateur ».</p>
        </div>

        <div class="auth-surface">
            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <div class="grid grid-cols-2 gap-3">
                    <div class="field">
                        <label class="field-label">Prénom</label>
                        <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="Prénom"
                               class="field-input {{ $errors->has('first_name') ? 'has-error' : '' }}" required>
                        @error('first_name')<p class="field-error">{{ $message }}</p>@enderror
                    </div>
                    <div class="field">
                        <label class="field-label">Nom</label>
                        <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Nom"
                               class="field-input {{ $errors->has('last_name') ? 'has-error' : '' }}" required>
                        @error('last_name')<p class="field-error">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="field">
                    <label class="field-label">Email</label>
                    <div class="field-with-icon">
                        <x-icon name="mail" />
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="vous@exemple.com"
                               class="field-input {{ $errors->has('email') ? 'has-error' : '' }}" required>
                    </div>
                    @error('email')<p class="field-error">{{ $message }}</p>@enderror
                </div>

                <div class="field">
                    <label class="field-label">Mot de passe</label>
                    <div class="field-with-icon">
                        <x-icon name="lock" />
                        <input type="password" name="password" placeholder="••••••••"
                               class="field-input {{ $errors->has('password') ? 'has-error' : '' }}" required>
                    </div>
                    <p class="field-hint">Au moins 8 caractères, avec majuscule, minuscule et chiffre.</p>
                    @error('password')<p class="field-error">{{ $message }}</p>@enderror
                </div>

                <div class="field">
                    <label class="field-label">Confirmer le mot de passe</label>
                    <div class="field-with-icon">
                        <x-icon name="lock" />
                        <input type="password" name="password_confirmation" placeholder="••••••••"
                               class="field-input" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-accent btn-block">
                    <x-icon name="user-plus" /> S'inscrire
                </button>
            </form>
        </div>

        <p class="text-center text-ink-700/60 text-sm mt-6">
            Déjà un compte ?
            <a href="{{ route('login') }}" class="text-ink-900 font-semibold hover:text-brass-600">Se connecter</a>
        </p>
    </div>
</div>
@endsection
