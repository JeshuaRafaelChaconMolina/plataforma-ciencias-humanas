<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = ['administrador', 'docente', 'investigador', 'alumno'];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role, 'guard_name' => 'web']);
        }

        // Permisos base por modulo. Se amplia por seccion en fases 2-4.
        $modules = [
            'usuarios', 'articulos', 'libros', 'revistas', 'sitios_web',
            'cursos', 'diplomados', 'talleres', 'categorias', 'archivos', 'configuracion',
        ];
        $actions = ['ver', 'crear', 'editar', 'eliminar'];

        $permissions = [];
        foreach ($modules as $module) {
            foreach ($actions as $action) {
                $permissions[] = "{$action}_{$module}";
            }
        }

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // El administrador tiene todos los permisos.
        $admin = Role::findByName('administrador');
        $admin->syncPermissions(Permission::all());

        // Docente e investigador: ver + crear/editar contenido academico (sin usuarios ni configuracion).
        $contentModules = ['articulos', 'libros', 'revistas', 'sitios_web', 'cursos', 'diplomados', 'talleres'];
        $docentePermissions = collect($contentModules)
            ->flatMap(fn ($m) => ["ver_{$m}", "crear_{$m}", "editar_{$m}"])
            ->all();

        Role::findByName('docente')->syncPermissions($docentePermissions);
        Role::findByName('investigador')->syncPermissions($docentePermissions);

        // Alumno: solo lectura de su dashboard (sin permisos administrativos).
        Role::findByName('alumno')->syncPermissions([]);
    }
}
