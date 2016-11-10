<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\Request as AdRequest;
use App\User;

class AdminController extends Controller
{
    /**
     * The base admin page
     *
     * @return Response
     */
    public function base()
    {
        // TODO
        return redirect()->route('admin.requests');
    }

    /**
     * The view for listing and managing helpers.
     *
     * @param  Request $request
     * @return Response
     */
    public function helpers(Request $request)
    {
        $helpers = User::where('helper', true)->get();

        return view('admin.helpers', [
            'helpers' => $helpers,
            'page' => 'Admin &mdash; Helpers'
        ]);
    }

    /**
     * Loads requests for admins.
     *
     * @param  Request $request
     * @return Response
     */
    public function requests(Request $request)
    {
        $ads = AdRequest::orderBy('approval_id', 'asc')->orderBy('updated_at', 'asc')->get();
        $data = [
            'requests' => $ads,
            'page' => 'Admin &mdash; Requests'
        ];

        return view('admin.requests', $data);
    }
}
