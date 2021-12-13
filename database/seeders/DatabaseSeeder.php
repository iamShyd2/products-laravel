<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Models\LaundryItem;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Role::create(["name" => "Super Admin"]);

        $manager = Role::create(["name" => "Manager"]);
        $staff = Role::create(["name" => "Staff"]);

        $resources = [
          "jobs",
          "customers"
        ];

        $actions = [
          "view",
          "store",
          "show",
          "update"
        ];

        foreach ($resources as $key => $resource) {
          foreach ($actions as $key => $action) {
            $permission = $action . " " . $resource;
            Permission::create(['name' => "{$permission}"]);
            $staff->givePermissionTo("{$permission}");
            $manager->givePermissionTo("{$permission}");
          }
          $permission = "destroy {$resource}";
          Permission::create(['name' => "{$permission}"]);
          $manager->givePermissionTo("{$permission}");
        }

        foreach ($actions as $key => $action) {
          $permission = "{$action} users";
          Permission::create(['name' => "{$permission}"]);
          $manager->givePermissionTo("{$permission}");
        }

        $user = User::create([
          "name" => "Admin",
          "email" => "admin@gmail.com",
          "password" => Hash::make(config("app.password")),
          "address" => "",
          "branch_id" => 0
        ]);

        $user->assignRole("Super Admin");
    }
}
