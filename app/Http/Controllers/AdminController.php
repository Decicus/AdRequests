<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\Request as AdRequest;
use App\TwitchRelation;
use App\User;

use App\Http\Requests\RemoveTwitchRequest;

class AdminController extends Controller
{
    /**
     * The base admin page
     *
     * @return Response
     */
    public function base()
    {
        // TODO
        return redirect()->route('admin.requests');
    }


    public function approval(UpdateApprovalRequest $request, $id = null)
    {
        $approval = intval($request->input('approval'));
        $config = config('requests.approval');

        if (empty($config[$approval])) {
            // return redirect()->route('requests.id', )
        }
    }

    /**
     * The view for listing and managing helpers.
     *
     * @param  Request $request
     * @return Response
     */
    public function helpers(Request $request)
    {
        $helpers = User::where('helper', true)->get();

        return view('admin.helpers', [
            'helpers' => $helpers,
            'page' => 'Admin &mdash; Helpers'
        ]);
    }

    /**
     * Loads requests for admins.
     *
     * @param  Request $request
     * @return Response
     */
    public function requests(Request $request)
    {
        $ads = AdRequest::orderBy('approval_id', 'asc')->orderBy('updated_at', 'asc')->get();
        $data = [
            'requests' => $ads,
            'page' => 'Admin &mdash; Requests'
        ];

        return view('admin.requests', $data);
    }

    /**
     * Removes the Twitch connection for a specified user.
     *
     * @param  RemoveTwitchRequest $request
     * @return Response
     */
    public function removeTwitch(RemoveTwitchRequest $request)
    {
        $id = $request->input('id');
        $relation = TwitchRelation::find($id);
        $relation->delete();

        return redirect()->route('admin.twitch')->with('message', [
            'type' => 'success',
            'body' => 'Successfully removed the Twitch connection for ' . $relation->user->nickname
        ]);
    }

    /**
     * The view for removing the Twitch connection for a specified user.
     *
     * @param  Request $request
     * @return Response
     */
    public function twitch(Request $request)
    {
        $data = [
            'page' => 'Admin &mdash; Remove Twitch connections',
            'relations' => TwitchRelation::all()
        ];

        return view('admin.twitch', $data);
    }
}
