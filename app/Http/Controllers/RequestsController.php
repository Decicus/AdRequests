<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\Request as AdRequest;
use App\TwitchRelation;
use App\Helpers\Http;
use App\User;

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

        // Pretend the request ID does not exist for those who should not be able to access it.
        if (empty($ad) || $user->cant('view', $ad)) {
            return redirect()->route('requests.base')->with('message', [
                'type' => 'warning',
                'body' => 'Invalid request ID specified.'
            ]);
        }

        $data = [
            'request' => $ad,
            'fields' => config('requests.fields.' . $ad->type->name),
            'page' => 'Request ID: ' . $request->id,
            'user' => $user
        ];

        return view('requests.results', $data);
    }

    /**
     * Returns requests based on the specified Reddit user ID.
     *
     * @param  Request $request
     * @param  string  $id      Reddit user ID
     * @return Response
     */
    public function redditUser(Request $request, $id = null)
    {
        if (empty($id)) {
            return Http::json([
                'message' => 'Reddit user ID has to be specified.',
            ], 400);
        }

        $user = User::where('id', $id)->first();

        if (empty($user)) {
            return Http::json([
                'message' => 'No Reddit user with that user ID was found.',
            ], 404);
        }

        $user = $user;
        $requests = $user
                    ->requests()
                    ->with(['comments', 'user', 'votes.user.twitch'])
                    ->get();

        return Http::json(['requests' => $requests]);
    }

    /**
     * Returns requests based on the specified Twitch user ID.
     *
     * @param  Request $request
     * @param  string  $id      Twitch user ID
     * @return Response
     */
    public function twitchUser(Request $request, $id = null)
    {
        if (empty($id)) {
            return Http::json([
                'message' => 'Twitch user ID has to be specified.',
            ], 400);
        }

        $user = TwitchRelation::where('id', $id)->first();

        if (empty($user)) {
            return Http::json([
                'message' => 'No connected Twitch user with that user ID was found.',
            ], 404);
        }

        $user = $user->user;
        return $this->redditUser($request, $user->id);
    }
}
