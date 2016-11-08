<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\Request as AdRequest;

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
        return redirect()->route('home')->with('message', [
            'type' => 'info',
            'body' => 'Nothing here yet.'
        ]);
    }

    /**
     * Loads available requests.
     *
     * @return Response
     */
    public function requests()
    {
        $ads = AdRequest::all();
    }
}
