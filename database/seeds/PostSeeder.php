<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            ['user_id' => 4, 'title'=> "Post One", 'content'=> "Post One content "],
            ['user_id' => 4, 'title'=> "Post Two", 'content'=> "Post Two content "],
            ['user_id' => 4, 'title'=> "Post Three", 'content'=> "Post Three content "]
        ]);
    }
}
