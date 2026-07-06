<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /** Max failed attempts before we lock the account, regardless of IP-based throttling. */
    private const MAX_ATTEMPTS = 5;

    /** Lockout duration in minutes once MAX_ATTEMPTS is reached. */
    private const LOCKOUT_MINUTES = 15;

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        // Per-IP + per-email throttling (protects against distributed brute force too).
        $throttleKey = strtolower($credentials['email']).'|'.$request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, self::MAX_ATTEMPTS)) {
            $seconds = RateLimiter::availableIn($throttleKey);

            throw ValidationException::withMessages([
                'email' => "Trop de tentatives. Réessayez dans {$seconds} secondes.",
            ]);
        }

        $user = User::where('email', $credentials['email'])->first();

        // Account-level lockout (independent of the IP throttle above).
        if ($user && $user->locked_until && $user->locked_until->isFuture()) {
            $minutes = now()->diffInMinutes($user->locked_until) + 1;

            throw ValidationException::withMessages([
                'email' => "Ce compte est temporairement verrouillé. Réessayez dans {$minutes} minute(s).",
            ]);
        }

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            RateLimiter::clear($throttleKey);

            $user->forceFill([
                'failed_login_attempts' => 0,
                'locked_until'          => null,
                'last_login_at'         => now(),
            ])->save();

            // Prevent session fixation.
            $request->session()->regenerate();

            return redirect()->intended(route('home'))->with('success', 'Connexion réussie');
        }

        RateLimiter::hit($throttleKey, self::LOCKOUT_MINUTES * 60);

        if ($user) {
            $attempts = $user->failed_login_attempts + 1;
            $update = ['failed_login_attempts' => $attempts];

            if ($attempts >= self::MAX_ATTEMPTS) {
                $update['locked_until'] = now()->addMinutes(self::LOCKOUT_MINUTES);
                $update['failed_login_attempts'] = 0;
            }

            $user->forceFill($update)->save();
        }

        return back()->withErrors([
            'email' => 'Email ou mot de passe incorrect.',
        ])->onlyInput('email');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name'  => ['required', 'string', 'max:255'],
            'email'      => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'   => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()],
        ]);
        // NOTE: 'role' is intentionally NOT accepted from the request here.
        // Every self-registered account is a plain "user". Only an existing
        // admin (via the Users management screen) can grant elevated roles.

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'role'       => 'user',
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('home')->with('success', 'Bienvenue ' . $user->first_name . ' 🎉');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Déconnexion réussie 👋');
    }
}
