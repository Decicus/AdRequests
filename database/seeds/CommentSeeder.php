<?php

use Illuminate\Database\Seeder;
use App\Comment;
use App\Request;
use App\User;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $text = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. In molestie lacus eu tempor vestibulum. Duis accumsan elit eget iaculis consequat. Etiam scelerisque nibh eu ipsum tincidunt egestas.";

        foreach (Request::all() as $request) {
            for ($i = 0; $i < 4; $i++) {
                $user = User::inRandomOrder()->first();
                $comment = new Comment;
                $comment->request_id = $request->id;
                $comment->user_id = $user->id;
                $comment->comment = $text;
                $comment->save();
            }
        }
    }
}
