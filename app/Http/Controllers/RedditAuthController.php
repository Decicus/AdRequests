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
            return redirect()->route('home')->with('message', [
                'type' => 'danger',
                'body' => 'There was an error authenticating with Reddit. Try again later.'
            ]);
        }

        $name = $user->nickname;
        $auth = User::firstOrCreate([
            'id' => $user->id,
            'name' => strtolower($name),
            'nickname' => $name
        ]);

        Auth::login($auth, true);
        return redirect()->route('home')->with('message', [
            'type' => 'success',
            'body' => 'You have successfully logged in!'
        ]);
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
