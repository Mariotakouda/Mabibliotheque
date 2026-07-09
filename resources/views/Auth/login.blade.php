@extends('layouts.app')
@section('title', 'Connexion')

@section('content')
<div class="min-h-[75vh] flex items-center justify-center">
    <div class="w-full max-w-sm">

        <div class="text-center mb-8">
            <div class="w-12 h-12 rounded-xl bg-ink-900 text-brass-300 flex items-center justify-center mx-auto mb-4">
                <x-icon name="library" class="w-6 h-6" />
            </div>
            <h1 class="page-title">Connexion</h1>
            <p class="page-subtitle">Connectez-vous pour accéder à votre compte</p>
        </div>

        <div class="auth-surface">
            <form method="POST" action="{{ route('login.attempt') }}" class="space-y-5">
                @csrf

                <div class="field">
                    <label for="email" class="field-label">Email</label>
                    <div class="field-with-icon">
                        <x-icon name="mail" />
                        <input id="email" type="email" name="email" placeholder="vous@exemple.com" value="{{ old('email') }}"
                               class="field-input {{ $errors->has('email') ? 'has-error' : '' }}"
                               required autofocus>
                    </div>
                    @error('email')<p class="field-error">{{ $message }}</p>@enderror
                </div>

                <div class="field">
                    <label for="password" class="field-label">Mot de passe</label>
                    <div class="field-with-icon">
                        <x-icon name="lock" />
                        <input id="password" type="password" name="password" placeholder="••••••••"
                               class="field-input {{ $errors->has('password') ? 'has-error' : '' }}"
                               required>
                    </div>
                    @error('password')<p class="field-error">{{ $message }}</p>@enderror
                </div>

                <div class="flex items-center">
                    <input id="remember" type="checkbox" name="remember" class="mr-2 rounded border-ink-900/20 text-ink-900 focus:ring-brass-500">
                    <label for="remember" class="text-ink-700/70 text-sm">Se souvenir de moi</label>
                </div>

                <button type="submit" class="btn btn-primary btn-block">
                    <x-icon name="login" /> Se connecter
                </button>
            </form>
        </div>

        <p class="text-center text-ink-700/60 text-sm mt-6">
            Pas encore de compte ?
            <a href="{{ route('register') }}" class="text-ink-900 font-semibold hover:text-brass-600">S'inscrire</a>
        </p>
    </div>
</div>
@endsection
