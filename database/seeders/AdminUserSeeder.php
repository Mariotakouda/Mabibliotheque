<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $email = env('ADMIN_SEED_EMAIL', 'admin@admin.com');
        $password = env('ADMIN_SEED_PASSWORD', 'ChangeMe123!');

        User::updateOrCreate(
            ['email' => $email],
            [
                'first_name' => 'Admin',
                'last_name'  => 'Principal',
                'password'   => Hash::make($password),
                'role'       => 'admin',
            ]
        );

        $this->command?->warn("Compte admin créé : {$email} / {$password} — changez ce mot de passe immédiatement en production (variables ADMIN_SEED_EMAIL / ADMIN_SEED_PASSWORD).");
    }
}
