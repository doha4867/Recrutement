<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admins = [
            [
                'nom' => 'Super Admin',
                'prenom' => 'System',
                'email' => 'superadmin@example.com',
                'password' => Hash::make('StrongPassword123!'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ],
            [
                'nom' => 'Admin User',
                'prenom' => 'System1',
                'email' => 'admin@example.com',
                'password' => Hash::make('SecurePassword456!'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ],
            [
                'nom' => 'Secondary Admin',
                'email' => 'admin2@example.com',
                'prenom' => 'System3',
                'password' => Hash::make('AnotherPassword789!'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ],
            // Vous pouvez ajouter autant d'administrateurs que nécessaire
        ];

        foreach ($admins as $admin) {
            User::create($admin);
        }
    }
}