<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert([
            ['user_id' => 4, 'post_id'=> 8, 'content'=> "Comment One content "],
            ['user_id' => 4, 'post_id'=> 9, 'content'=> "Comment Two content "],
            ['user_id' => 4, 'post_id'=> 10, 'content'=> "Comment Three content "],
            ['user_id' => 7, 'post_id'=> 12, 'content'=> "Comment One majmun content "],
            ['user_id' => 7, 'post_id'=> 14, 'content'=> "Comment Two  majmun content "]
        ]);
    }
}
