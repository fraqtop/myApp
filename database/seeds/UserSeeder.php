<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'fraqtop',
            'email' => 'fraqtop@gmail.com',
            'password' => 'qweqweqwe'
        ]);
        DB::table('users')->insert([
            'name' => 'bodo',
            'email' => 'bodo@gmail.com',
            'password' => 'asdasdasd'
        ]);
    }
}
