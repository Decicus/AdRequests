<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Type;
class ApiController extends Controller
{
    /**
     * Returns approval types.
     *
     * @param  Request $request
     * @return Response
     */
    public function approvalTypes(Request $request)
    {
        return config('requests.approval');
    }

    /**
     * Returns request types.
     *
     * @param  Request $request
     * @return Response
     */
    public function requestTypes(Request $request)
    {
        return Type::all();
    }
}
