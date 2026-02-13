<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Crea el usuario administrador inicial.
     * Ejecutar: php artisan db:seed --class=AdminUserSeeder
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'desarrollo@capazero.es'],
            [
                'name'      => 'Admin',
                'last_name' => 'Implantex',
                'email'     => 'desarrollo@capazero.es',
                'password'  => Hash::make('capazero2022'), // ⚠️ Cambiar en producción
                'role'      => 'admin',
                'phone'     => null,
            ]
        );
    }
}
