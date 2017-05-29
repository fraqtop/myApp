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
            'content' => str_random(250),
            'user_id' => 1,
            'created_at' => '2016-01-21 02:23:24'
        ]);
        DB::table('posts')->insert([
            'title' => 'Second post',
            'content' => str_random(250),
            'user_id' => 1,
            'created_at' => '2017-02-24 13:13:24'
        ]);
        DB::table('posts')->insert([
            'title' => 'Third post',
            'content' => str_random(250),
            'user_id' => 2,
            'created_at' => '2016-12-12 12:12:24'
        ]);
        DB::table('posts')->insert([
            'title' => 'Fourth post',
            'content' => str_random(250),
            'user_id' => 2,
            'created_at' => '2017-01-29 09:30:56'
        ]);
    }
}
