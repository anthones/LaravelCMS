<?php

use App\Post;
use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $post = new Post;
        $post->user_id = 2;
        $post->title = "My first title!";
        $post->body = "This is sample text for the body of my first post. It is completely random yet legible so that anyone can understand it.";
        $post->save();

        $post = new Post;
        $post->user_id = 2;
        $post->title = "My second title!";
        $post->body = "This is sample text for the body of my second post. It is also completely random yet legible so that anyone can understand it.";
        $post->save();

    }
}
