<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class SubmitController extends Controller
{
    /**
     * Base submit view for selecting the type of request the user wants to submit.
     * 
     * @return Response
     */
    public function base()
    {
        $data = [
            'page' => 'Submit Request'
        ];
        
        $data['forms'] = [
            'video' => 'Submit a video',
            'web' => 'Submit a web tool',
            'desktop' => 'Submit a desktop tool',
            'ama.streamer' => 'An AMA as a streamer',
            'ama.business' => 'An AMA as a business',
            'other' => 'Something not listed'
        ];
        
        return view('requests.submit.base', $data);
    }
    
    /**
     * TODO: Fill in these functions.
     */
    public function amaBusiness()
    {
        
    }
    
    public function amaStreamer()
    {
        
    }
    
    public function desktop()
    {
        
    }
    
    public function other()
    {
        
    }
    
    public function video()
    {
        
    }
    
    public function web()
    {
        
    }
}
