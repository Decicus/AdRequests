<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\SubmitDesktopToolRequest;

use Auth;
use App\User;

class SubmitController extends Controller
{
    /**
     * Base submit view for selecting the type of request the user wants to submit.
     * 
     * @return Response
     */
    public function base(Request $request, $type = null)
    {
        $data = [];
        $page = 'Submit Request';
        
        $data['forms'] = [
            'video' => [
                'text' => 'Submit a video',
                'twitch' => true
            ],
            'web' => [
                'text' => 'Submit a web tool',
                'twitch' => true
            ],
            'desktop' => [
                'text' => 'Submit a desktop tool',
                'twitch' => true
            ],
            'ama.streamer' => [
                'text' => 'An AMA as a streamer',
                'twitch' => true
            ],
            'ama.business' => [
                'text' => 'An AMA as a business',
                'twitch' => false
            ],
            'other' => [
                'text' => 'Something not listed',
                'twitch' => false
            ]
        ];
        
        if (!empty($type) && !empty($data['forms'][$type])) {
            $data['type'] = 'requests.forms.' . $type;
            $page = $data['forms'][$type]['text'];
        }
        
        $data['page'] = $page;
        
        return view('requests.submit.base', $data);
    }
    
    private function store($body, $type = null)
    {
        
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
    
    public function desktop(SubmitDesktopToolRequest $request)
    {
        // TODO: Handle saving of data
        return 'Success!';
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
