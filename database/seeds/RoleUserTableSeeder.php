<?php

use App\RoleUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_user')->truncate();
        // Create Role User
        RoleUser::create([
            'user_id' => 1,
            'role_id' => 1,
        ]);
    }
}
