<?php

use App\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('roles')->truncate();
        // Create Roles
        $roles = [
            [
                'name'  =>  'Admin',
            ],
            [
                'name'  =>  'Gymie',
            ],
            [
                'name'  =>  'Manager',
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
