<?php

use Illuminate\Database\Seeder;
use App\Request;
use App\User;
use App\Vote;

class VoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        if ($users->count() > 0) {
            foreach (Request::all() as $request) {
                foreach ($users as $user) {
                    $vote = new Vote;
                    $vote->request_id = $request->id;
                    $vote->user_id = $user->id;
                    $vote->result = mt_rand(0, 1);
                    $vote->save();
                }
            }
        }
    }
}
