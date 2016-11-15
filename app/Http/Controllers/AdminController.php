<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\Request as AdRequest;
use App\TwitchRelation;
use App\User;

use App\Http\Requests\RemoveTwitchRequest;
use App\Http\Requests\UpdateApprovalRequest;

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


    /**
     * Updates the approval status for a request.
     *
     * @param  UpdateApprovalRequest $request
     * @return Response
     */
    public function approval(UpdateApprovalRequest $request)
    {
        $approval = intval($request->input('approval'));
        $id = $request->input('id');
        $config = config('requests.approval');

        if (empty($config[$approval])) {
            return redirect()->route('requests.id', $id)->with('message', [
                'type' => 'warning',
                'body' => 'Invalid approval type.'
            ]);
        }

        $ad = AdRequest::find($id);
        $ad->approval_id = $approval;
        $ad->save();

        return redirect()->route('requests.id', $id)->with('message', [
            'type' => 'success',
            'body' => 'Successfully updated the approval status to: <strong>' . $config[$approval]['name'] . '</strong>'
        ]);
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
        $query = AdRequest::orderBy('approval_id', 'asc')->orderBy('updated_at', 'asc');
        $status = $request->input('status', null);
        $options = [];
        $config = config('requests.approval');

        foreach ($config as $id => $approval) {
            $options[$id] = $approval['name'];
        }

        $appId = intval($status);
        if ($status !== null && !empty($config[$appId])) {
            $query = $query->where('approval_id', $appId);
        }

        $data = [
            'requests' => $query->get(),
            'page' => 'Admin &mdash; Requests',
            'approval' => $options,
            'status' => $status
        ];

        return view('admin.requests', $data);
    }

    /**
     * Searches based on type.
     *
     * @param  Request
     * @return Response
     */
    public function search(Request $request)
    {
        $results = null;
        $data = [
            'page' => 'Admin &mdash; Search',
            'search' => null,
            'type' => null,
            'types' => [
                'reddit' => 'Reddit username',
                'request' => 'Request title/name',
                'twitch' => 'Twitch username'
            ]
        ];

        if ($request->exists('search') && $request->exists('type')) {
            $type = $request->input('type');
            $search = strtolower($request->input('search'));
            $data['search'] = $search;
            $data['type'] = $type;

            switch ($type) {
                case 'reddit':
                    $results = User::SearchName($search);
                    break;

                case 'request':
                    $results = AdRequest::SearchName($search);
                    break;

                case 'twitch':
                    $results = TwitchRelation::SearchName($search);
                    break;

                default:
                    $data['message'] = [
                        'type' => 'warning',
                        'body' => 'Invalid request type.'
                    ];

                    $results = null;
                    break;
            }
        }

        $data['results'] = $results;

        return view('admin.search', $data);
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
