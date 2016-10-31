<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Socialite;
use Auth;
use App\User;
use App\TwitchRelation;

class TwitchAuthController extends Controller
{
    /**
     * Redirects the user to the Twitch authentication page.
     *
     * @return Response
     */
    public function redirectToAuth()
    {
        $user = Auth::user();
        
        if (empty($user->twitch()->first())) {
            return Socialite::with('twitch')->scopes(['user_read'])->stateless()->redirect();
        }
        
        // TODO: Redirect with message that account already connected.
        return redirect()->route('home');
    }

    /**
     * Handles the redirect back from Twitch's authentication
     *
     * @return Response
     */
    public function callback()
    {
        try {
            $user = Socialite::with('twitch')->stateless()->user();
        } catch (Exception $e) {
            // TODO: Redirect with message
            return redirect()->route('home');
        }
        
        TwitchRelation::create([
            'id' => $user->id,
            'name' => $user->name,
            'nickname' => $user->nickname,
            'user_id' => Auth::user()->id
        ]);
        
        // TODO: Return message
        return redirect()->route('home');
    }
    
    public function disconnect()
    {
        
    }
}
