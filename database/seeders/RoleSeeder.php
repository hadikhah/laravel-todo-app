<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            ['name' => 'view-user', "guard_name" => "web"],
            ['name' => 'create-user', "guard_name" => "web"],
            ['name' => 'update-user', "guard_name" => "web"],
            ['name' => 'delete-user', "guard_name" => "web"],
            ['name' => 'restore-user', "guard_name" => "web"],
            ['name' => 'hard-delete-user', "guard_name" => "web"],

            ['name' => 'view-role', "guard_name" => "web"],
            ['name' => 'create-role', "guard_name" => "web"],
            ['name' => 'update-role', "guard_name" => "web"],
            ['name' => 'delete-role', "guard_name" => "web"],

            ['name' => 'view-permission', "guard_name" => "web"],
            ['name' => 'create-permission', "guard_name" => "web"],
            ['name' => 'update-permission', "guard_name" => "web"],
            ['name' => 'delete-permission', "guard_name" => "web"],
        ];


        Permission::query()->insert($permissions);
        $admin = Role::create(["name" => "admin", "guard_name" => "web"]);
        $admin->givePermissionTo(Permission::all());
    }
}
