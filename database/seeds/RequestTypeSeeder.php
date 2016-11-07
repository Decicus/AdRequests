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
            1 => ['video', 'A video'],
            2 => ['web', 'A web tool'],
            3 => ['desktop', 'A desktop tool'],
            4 => ['ama.streamer', 'AMA as a streamer'],
            5 => ['ama.business', 'AMA as a business'],
            6 => ['other', 'Other']
        ];
        
        foreach ($types as $id => $data) {
            $type = new Type;
            $type->id = $id;
            $type->name = $data[0];
            $type->full_title = $data[1];
            
            $type->save();
        }
    }
}
