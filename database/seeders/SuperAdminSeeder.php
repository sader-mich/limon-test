<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creating Super Admin User
        $superAdmin = User::create([
            'name' => 'Alondra Zarco',
            'username' => 'master',
            'email' => 'master@sader.com',
            'password' => Hash::make('master134')
        ]);
        $superAdmin->assignRole('Administrador');

        $superAdmin = User::create([
            'name' => 'Paulina Cervantes',
            'email' => 'admin@example.com',
            'username' => 'admin',
            'password' => Hash::make('admin12345')
        ]);
        $superAdmin->assignRole('Administrador');

        $superAdmin = User::create([
            'name' => 'Fernando Terán',
            'email' => 'fteran@sader.com',
            'username' => 'fteran',
            'password' => Hash::make('fteran1346')
        ]);
        $superAdmin->assignRole('Administrador');

        // Creating Producer Manager User
        $producerManager = User::create([
            'name' => 'Administrador de productores',
            'username' => 'productor',
            'email' => 'Productor@sader.com',
            'password' => Hash::make('master134')
        ]);
        $producerManager->assignRole('Administrador de productores');

        // Creating User
        $operador = User::create([
            'name' => 'Operador',
            'username' => 'operador',
            'email' => 'operador@sader.com',
            'password' => Hash::make('master134')
        ]);
        $operador->assignRole('Operador');

        // Creating Guess User
        $operador = User::create([
            'name' => 'Invitado',
            'username' => 'invitado',
            'email' => 'invitado@sader.com',
            'password' => Hash::make('master134')
        ]);
        $operador->assignRole('Invitado');
    }
}
