<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;

class GeneralController extends Controller
{
    /**
     * The homepage view
     *
     * @return Response
     */
    public function home()
    {
        // TODO: Create the homepage view.
        if (Auth::check()) {
            dd(Auth::user());
        }
        return 'Hello, world';
    }
}
