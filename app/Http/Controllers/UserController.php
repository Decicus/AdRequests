<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Auth;

class UserController extends Controller
{
    /**
     * Retrieve user information about the currently authenticated user.
     *
     * @param  Request $request
     * @return Response
     */
    public function me(Request $request)
    {
        return Auth::user();
    }

    /**
     * Retrieves all the requests the user has voted on.
     * Optional: Specify the request_id in the request to retrieve their vote
     * for one specific request.
     *
     * @param  Request $request
     * @return Response
     */
    public function votes(Request $request)
    {
        $reqId = $request->input('request_id', null);
        $votes = Auth::user()->votes();

        if (!empty($reqId)) {
            $votes = $votes->where(['request_id' => $reqId]);
        }

        return [
            'success' => true,
            'votes' => $votes->get()
        ];
    }

    /**
     * Retrieves user information based on the username.
     *
     * @param  Request $request
     * @param  string $user
     * @return Response
     */
    public function user(Request $request, $user = null)
    {
        $user = User::where('name', $user)->first();
        if (empty($user)) {
            return redirect()->route('home')->with('message', [
                'type' => 'warning',
                'body' => 'Invalid username specified.'
            ]);
        }

        $data = [
            'approval' => config('requests.approval'),
            'page' => 'User: ' . $user->nickname,
            'user' => $user
        ];

        return view('users.user', $data);
    }
}
