<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\Request as AdRequest;

class HelperController extends Controller
{
    /**
     * Loads requests for helpers.
     *
     * @param  Request $request
     * @return Response
     */
    public function requests(Request $request)
    {
        $ads = AdRequest::orderBy('approval_id', 'asc')->orderBy('updated_at', 'asc')->get();
        $data = [
            'requests' => $ads,
            'page' => 'Helper &mdash; Requests'
        ];

        return view('admin.requests', $data);
    }
}