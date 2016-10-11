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
        return view('general.home', [
            'page' => 'Home'
        ]);
    }
}
