<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vote;
use Auth;

class VoteController extends Controller
{
    /**
     * Submits the vote for the request.
     *
     * @param  Request $request
     * @return Response
     */
    public function submit(Request $request)
    {
        $user = Auth::user();
        $id = $request->input('request_id');
        $result = intval($request->input('result'));
        $data = [
            'success' => true,
            'message' => 'Vote for request ' . $id . ' has been updated.',
        ];

        $oldVote = Vote::where(['request_id' => $id, 'user_id' => $user->id])->first();
        if (!empty($oldVote)) {
            $oldVote->delete();
        }

        if (empty($oldVote) || $oldVote->result !== $result) {
            $vote = new Vote;
            $vote->request_id = $id;
            $vote->user_id = $user->id;
            $vote->result = $result;
            $vote->save();

            $data['vote'] = $vote;
        }

        return $data;
    }

    /**
     * Returns a JSON output of the votes for the specified request.
     *
     * @param  Request $request
     * @param  string  $id
     * @return Response
     */
    public function votes(Request $request, $id = null)
    {
        return Vote::where(['request_id' => $id])->get();
    }
}
