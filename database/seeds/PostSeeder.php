<?php

use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private $fakeMessage = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
Duis aute irure dolor in reprehenderit 
in voluptate velit esse cillum dolore eu fugiat nulla pariatur.";
    public function run()
    {
        DB::table('posts')->insert([
           'title' => 'First post',
            'content' => $this->fakeMessage,
            'user_id' => 1,
            'created_at' => '2016-01-21 02:23:24'
        ]);
        DB::table('posts')->insert([
            'title' => 'Second post',
            'content' => $this->fakeMessage,
            'user_id' => 1,
            'created_at' => '2016-02-24 13:13:24'
        ]);
        DB::table('posts')->insert([
            'title' => 'Third post',
            'content' => $this->fakeMessage,
            'user_id' => 2,
            'created_at' => '2017-01-01 12:12:24'
        ]);
        DB::table('posts')->insert([
            'title' => 'Fourth post',
            'content' => $this->fakeMessage,
            'user_id' => 2,
            'created_at' => '2017-01-29 09:30:56'
        ]);
        DB::table('posts')->insert([
            'title' => 'Fifth post',
            'content' => $this->fakeMessage,
            'user_id' => 1,
            'created_at' => '2018-02-05 09:30:56'
        ]);
        DB::table('posts')->insert([
            'title' => 'Sixth post',
            'content' => $this->fakeMessage,
            'user_id' => 1,
            'created_at' => '2018-03-26 09:30:56'
        ]);
    }
}
