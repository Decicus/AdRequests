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
        
        return redirect()->route('account.settings')->with('message', [
            'type' => 'warning',
            'body' => 'You have already connected a Twitch account to this user. Disconnect your current one before attempting to connect a new one.'
        ]);
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
            return redirect()->route('account.settings')->with('message', [
                'type' => 'danger',
                'body' => 'There was an error authenticating with Twitch. Try again later.'
            ]);
        }
        
        TwitchRelation::create([
            'id' => $user->id,
            'name' => $user->name,
            'nickname' => $user->nickname,
            'user_id' => Auth::user()->id
        ]);
        
        return redirect()->route('account.settings')->with('message', [
            'type' => 'success',
            'body' => 'You successfully connected your Twitch account.'
        ]);
    }
    
    /**
     * Allows the user to disconnect their Twitch account from their user.
     * 
     * @return Response
     */
    public function disconnect()
    {
        $relation = Auth::user()->twitch;
        if (empty($relation)) {
            return redirect()->route('account.settings')->with('message', [
                'type' => 'danger',
                'body' => 'No Twitch account associated with this account.'
            ]);
        }
        
        $relation->delete();
        
        return redirect()->route('account.settings')->with('message', [
            'type' => 'success',
            'body' => 'You successfully disconnected your Twitch account.'
        ]);
    }
}
