<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Socialite;
use Auth;
use App\User;

class RedditAuthController extends Controller
{
    /**
     * Redirects the user to the Reddit authentication page.
     *
     * @return Response
     */
    public function redirectToAuth()
    {
        return Socialite::with('reddit')->scopes(['identity'])->redirect();
    }

    /**
     * Handles the redirect back from Reddit's authentication
     *
     * @return Response
     */
    public function callback()
    {
        try {
            $user = Socialite::with('reddit')->user();
        } catch (Exception $e) {
            // TODO: Redirect with message
            return redirect()->route('home');
        }

        $name = $user->nickname;
        $auth = User::firstOrCreate([
            'id' => $user->id,
            'name' => strtolower($name),
            'nickname' => $name,
            'provider' => 'reddit'
        ]);

        Auth::login($auth, true);
        // TODO: Redirect with message
        return redirect()->route('home');
    }

    /**
     * Allows the user to logout.
     *
     * @return Response
     */
    public function logout()
    {
        Auth::logout();
        // TODO: Redirect with message
        return redirect()->route('home');
    }
}
