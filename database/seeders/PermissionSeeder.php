<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'crear_rol',
            'editar_rol',
            'eliminar_rol',
            'crear_usuario',
            'editar_usuario',
            'eliminar_usuario',
            'crear_productor',
            'editar_productor',
            'eliminar_productor',
            'crear_registro',
            'editar_registro',
            'eliminar_registro',
            'productor',
            'trazabilidad',
            'show'
        ];

        // Looping and Inserting Array's Permissions into Permission Table
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
