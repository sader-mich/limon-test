<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'Administrador']);
        $producerManager = Role::create(['name' => 'Administrador de productores']);
        $operador = Role::create(['name' => 'Operador']);
        $guess = Role::create(['name' => 'Invitado']);

        $producerManager->givePermissionTo([
            'crear_productor',
            'editar_productor',
            'crear_registro',
            'editar_registro'
        ]);

        $operador->givePermissionTo([
            'trazabilidad'
        ]);

        $guess->givePermissionTo([
            'show'
        ]);
    }
}
