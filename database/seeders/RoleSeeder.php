<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Crear permisos
        Permission::create(['name' => 'ver tareas']);
        Permission::create(['name' => 'crear tareas']);
        Permission::create(['name' => 'editar tareas']);
        Permission::create(['name' => 'borrar tareas']);

        // Permisos de usuarios
        Permission::create(['name' => 'ver usuarios']);
        Permission::create(['name' => 'crear usuarios']);
        Permission::create(['name' => 'editar usuarios']);
        Permission::create(['name' => 'borrar usuarios']);
        Permission::create(['name' => 'asignar roles']);

        // Crear roles
        $admin = Role::create(['name' => 'admin']);
        $empleado = Role::create(['name' => 'empleado']);

        // Asignar permisos
        $admin->givePermissionTo(Permission::all());
        $empleado->givePermissionTo(['ver tareas']);

    }
}
