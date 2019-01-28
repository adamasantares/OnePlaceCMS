<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::collection('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@mail.ru',
            'password' => bcrypt('admin'),
            'created_at' => Carbon::now(),
        ]);
    }
}
