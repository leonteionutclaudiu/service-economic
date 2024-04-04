<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Adaugă roluri și permisiuni
        $this->createRolesAndPermissions();

        // Asignează roluri utilizatorilor
        $this->assignRolesToUsers();
    }

    private function createRolesAndPermissions()
    {
        // Adaugă roluri
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        // Adaugă permisiuni
        $manageUsersPermission = Permission::create(['name' => 'manage_users']);
        $manageProgramariPermission = Permission::create(['name' => 'manage_programari']);

        // Asociază permisiunile cu rolurile
        $adminRole->syncPermissions([$manageUsersPermission, $manageProgramariPermission]);
    }

    private function assignRolesToUsers()
    {
        // Asignează roluri utilizatorilor
        $adminUser = User::create([
            'name' => 'Admin',
            'email' => 'office@serviceeconomic.ro',
            'password' => bcrypt('Parola123'),
        ]);
        $adminUser->assignRole('admin');
    }
}
