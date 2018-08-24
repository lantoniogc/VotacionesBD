<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = Role::create([
            'name'        => 'User',
            'slug'        => 'user',
            'permissions' => json_encode([
                'show-views' => true,
            ]),
        ]);

        $admin = Role::create([
            'name'        => 'Admin',
            'slug'        => 'admin',
            'permissions' => json_encode([
                'super-admin' => true,
            ]),
        ]);
    }
}
