<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\SubmitDesktopToolRequest;
use App\Http\Requests\SubmitAmaBusinessRequest;
use App\Http\Requests\SubmitAmaStreamerRequest;
use App\Http\Requests\SubmitOtherRequest;
use App\Http\Requests\SubmitVideoRequest;

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
            if ($data['forms'][$type]['twitch'] && empty(Auth::user()->twitch)) {
                return redirect()->route('requests.submit.base')->with('message', [
                    'type' => 'danger',
                    'body' => 'Please connect your Twitch account in the <a href="' . route('account.settings') . '">account settings</a> before submitting this type of request.'
                ]);
            }
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
     * @param  integer $type  The request type.
     * @param  array   $comp  What values to extract from the body.
     * @return Response
     */
    private function store($body, $type = 6, $comp = [])
    {
        $compare = array_fill_keys($comp, '');
        $body = array_intersect_key($body, $compare);
        $request = AdRequest::add($type, $body);
        $request->user_id = Auth::user()->id;
        $request->save();

        return redirect()->route('requests.id', $request->id)->with('message', [
            'type' => 'success',
            'body' => 'Your request was successfully submitted! You can see the result of it below.'
        ]);
    }

    /**
     * Submit an ad request based on the 'AMA as a business' type.
     *
     * @param  SubmitAmaBusinessRequest $request
     * @return Response
     */
    public function amaBusiness(SubmitAmaBusinessRequest $request)
    {
        $compare = array_keys(config('requests.fields.ama.business'));
        return $this->store($request->all(), 5, $compare);
    }

    /**
     * Submit an ad request based on the 'AMA as a streamer' type.
     *
     * @param  SubmitAmaStreamerRequest $request
     * @return Response
     */
    public function amaStreamer(SubmitAmaStreamerRequest $request)
    {
        $compare = array_keys(config('requests.fields.ama.streamer'));
        $body = [
            'name' => Auth::user()->twitch->name
        ];
        $requestBody = $request->all();

        // Make sure the 'name' value isn't overridden on merge
        unset($requestBody['name']);
        // Merge so that the 'name' value is first and
        // will be displayed first in the 'results' view.
        $body = array_merge($body, $requestBody);
        return $this->store($body, 4, $compare);
    }

    /**
     * Submit an ad request based on the 'A desktop tool' type.
     *
     * @param  SubmitDesktopToolRequest $request
     * @return Response
     */
    public function desktop(SubmitDesktopToolRequest $request)
    {
        $compare = array_keys(config('requests.fields.desktop'));
        return $this->store($request->all(), 3, $compare);
    }

    /**
     * Submit an ad request based on the 'other' type.
     *
     * @param  SubmitOtherRequest $request
     * @return Response
     */
    public function other(SubmitOtherRequest $request)
    {
        $compare = array_keys(config('requests.fields.other'));
        return $this->store($request->all(), 6, $compare);
    }

    /**
     * Submit an ad request based on the 'video' type.
     *
     * @param  SubmitVideoRequest $request
     * @return Response
     */
    public function video(SubmitVideoRequest $request)
    {
        $compare = array_keys(config('requests.fields.video'));
        return $this->store($request->all(), 1, $compare);
    }

    /**
     * Submit an ad request based on the 'web' type.
     * Utilizes the SubmitDesktopToolRequest validation.
     *
     * @param  SubmitDesktopToolRequest $request
     * @return Response
     */
    public function web(SubmitDesktopToolRequest $request)
    {
        $compare = array_keys(config('requests.fields.web'));
        return $this->store($request->all(), 2, $compare);
    }
}
