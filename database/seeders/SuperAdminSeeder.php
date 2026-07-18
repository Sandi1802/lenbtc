<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        // Super Admin
        User::updateOrCreate(
            ['email' => 'superadmin@len.co.id'],
            [
                'name'     => 'Super Admin',
                'email'    => 'superadmin@len.co.id',
                'password' => Hash::make('LenBTC@2024'),
                'role'     => 'super_admin',
            ]
        );

        // Admin
        User::updateOrCreate(
            ['email' => 'admin@len.co.id'],
            [
                'name'     => 'Admin LEN',
                'email'    => 'admin@len.co.id',
                'password' => Hash::make('LenBTC@2024'),
                'role'     => 'admin',
            ]
        );

        // Viewer
        User::updateOrCreate(
            ['email' => 'viewer@len.co.id'],
            [
                'name'     => 'Viewer LEN',
                'email'    => 'viewer@len.co.id',
                'password' => Hash::make('LenBTC@2024'),
                'role'     => 'viewer',
            ]
        );
    }
}
