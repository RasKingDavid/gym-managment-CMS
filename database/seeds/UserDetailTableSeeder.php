<?php

use App\UserDetail;
use Illuminate\Database\Seeder;

class UserDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserDetail::create([
            'user_id' => '1',
            'image' => '',
        ]);
    }
}
