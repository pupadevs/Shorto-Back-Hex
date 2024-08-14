<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Source\Role\Domain\Entity\Role;
use Source\Role\Domain\ValueObjects\RoleName;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
     $admin =   Role::createRole(new RoleName('admin'));
       $user= Role::createRole(new RoleName('user'));

       $roles = [
        ['id' => $admin->getRoleID(), 'name' => $admin->getRoleName()],
        ['id' => $user->getRoleID(), 'name' => $admin->getRoleName()],
    ];

    // Insertar datos en la base de datos principal
    DB::connection('mysql')->table('roles')->insert($roles);

    // Insertar datos en la base de datos secundaria
    DB::connection('mysql_read')->table('roles')->insert($roles);


    }
    
}
