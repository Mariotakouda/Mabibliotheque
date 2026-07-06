<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();

        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name'  => ['required', 'string', 'max:255'],
            'district'   => ['nullable', 'string', 'max:255'],
            'phone'      => ['nullable', 'string', 'max:30'],
            'email'      => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
        ]);

        // Changing the password requires the current password (prevents
        // session/CSRF-hijack style takeovers from silently changing it)
        // and is fully optional.
        if ($request->filled('password')) {
            $request->validate([
                'current_password' => ['required', 'current_password'],
                'password'         => ['confirmed', Password::min(8)->mixedCase()->numbers()],
            ]);

            $data['password'] = Hash::make($request->password);
        }

        // Note: role is deliberately never accepted here — users can never
        // self-promote through their own profile form.
        $user->update($data);

        return back()->with('success', 'Profil mis à jour avec succès.');
    }
}
