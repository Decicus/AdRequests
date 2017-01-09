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
