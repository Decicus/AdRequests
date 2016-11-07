<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\SubmitDesktopToolRequest;

use Auth;
use App\User;
use App\Request as AdRequest;

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
            $data['fields'] = config('requests.fields.' . $type);
            $page = $data['forms'][$type]['text'];
        }
        
        $data['page'] = $page;
        
        return view('requests.submit.base', $data);
    }
    
    /**
     * Stores the Request
     * 
     * @param  array   $body  The request body.
     * @param  array   $data  Array of view data
     * @param  integer $type  The request type.
     * @param  array   $comp  What values to extract from the body.
     * @return Response
     */
    private function store($body, $data, $type = 6, $comp = [])
    {
        $compare = array_fill_keys($comp, '');
        $body = json_encode(array_intersect_key($body, $compare));
        $request = new AdRequest([
            'type_id' => $type,
            'body' => $body
        ]);
        $request->user_id = Auth::user()->id;
        $request->save();
        
        $data['request'] = $request;
        $data['compare'] = $compare;
        $data['message'] = [
            'type' => 'success',
            'body' => 'Your request was successfully submitted! You can see the result of it below.'
        ];
        return view('requests.results', $data);
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
    
    /**
     * Submit an ad request based on the 'A desktop tool' type.
     * 
     * @param  SubmitDesktopToolRequest $request
     * @return Response
     */
    public function desktop(SubmitDesktopToolRequest $request)
    {
        $compare = [
            'name', 'url', 'description', 'user_data', 'api', 'api_data', 'api_scopes',
            'api_scopes_description', 'tos', 'tos_url', 'open_source', 'open_source_url', 'beta', 'beta_description'
        ];
        
        $data = [
            'page' => 'A desktop tool',
            'fields' => config('requests.fields.desktop')
        ];
        
        return $this->store($request->all(), $data, 3, $compare);
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
