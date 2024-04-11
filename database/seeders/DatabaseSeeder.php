<?php

namespace Database\Seeders;

use HasRoles;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        $r1 = Role::create(['name' => 'admin']);
        $r2 = Role::create(['name' => 'manager']);
        $r3 = Role::create(['name' => 'staff']);
        $user1 = User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('12345678')
        ]);
        $user1->assignRole($r1);
        $user2 = User::create([
            'name' => 'Manager',
            'email' => 'manager@test.com',
            'password' => Hash::make('12345678')
        ]);
        $user2->assignRole($r2);
        $user3 = User::create([
            'name' => 'Staff',
            'email' => 'staff@test.com',
            'password' => Hash::make('12345678')
        ]);
        $user3->assignRole($r3);
    }
}
