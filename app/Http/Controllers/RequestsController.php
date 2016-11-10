<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\Request as AdRequest;

class RequestsController extends Controller
{
    /**
     * View for displaying the user's requests.
     *
     * @return Response
     */
    public function base()
    {
        $requests = Auth::user()->requests;
        $data = [
            'page' => 'My Requests',
            'requests' => $requests
        ];

        return view('requests.base', $data);
    }

    public function id(Request $request, $id = null)
    {
        $ad = AdRequest::find($id);
        $user = Auth::user();

        if (empty($ad) || $user->cant('view', $ad)) {
            return redirect()->route('requests.base')->with('message', [
                'type' => 'warning',
                'body' => 'Invalid request ID specified.'
            ]);
        }

        $data = [
            'request' => $ad,
            'fields' => config('requests.fields.' . $ad->type->name),
            'page' => 'Request ID: ' . $request->id
        ];

        return view('requests.results', $data);
    }
}
