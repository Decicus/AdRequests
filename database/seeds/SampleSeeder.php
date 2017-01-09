<?php

use Illuminate\Database\Seeder;

class SampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminSeeder::class);
        $this->call(SampleRequestSeeder::class);
        $this->call(CommentSeeder::class);
        $this->call(VoteSeeder::class);
    }
}
