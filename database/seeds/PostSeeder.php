<?php

use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
           'title' => 'First post',
            'content' => str_random(100),
            'user_id' => 1
        ]);
        DB::table('posts')->insert([
            'title' => 'Second post',
            'content' => str_random(100),
            'user_id' => 1
        ]);
        DB::table('posts')->insert([
            'title' => 'Third post',
            'content' => str_random(100),
            'user_id' => 2
        ]);
        DB::table('posts')->insert([
            'title' => 'Fourth post',
            'content' => str_random(100),
            'user_id' => 2
        ]);
    }
}
