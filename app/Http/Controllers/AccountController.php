<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\User;

class AccountController extends Controller
{
    public function settings()
    {
        $user = Auth::user();
        $data = [
            'page' => 'Account Settings',
            'twitch' => $user->twitch
        ];
                
        return view('account.settings', $data);
    }
}
