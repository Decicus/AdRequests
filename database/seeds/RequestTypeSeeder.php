<?php

use Illuminate\Database\Seeder;
use App\Type;

class RequestTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            1 => 'video',
            2 => 'web',
            3 => 'desktop',
            4 => 'ama.streamer',
            5 => 'ama.business',
            6 => 'other'
        ];
        
        foreach ($types as $id => $name) {
            $type = new Type;
            $type->id = $id;
            $type->name = $name;
            
            $type->save();
        }
    }
}
