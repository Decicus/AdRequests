<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\SubmitCommentRequest;
use App\Comment;
use Auth;

class CommentController extends Controller
{
    /**
     * Adds a comment assigned to an AdRequest.
     *
     * @param SubmitCommentRequest $request
     * @return Response
     */
    public function add(SubmitCommentRequest $request)
    {
        $comment = new Comment;
        $comment->request_id = $request->input('request_id');
        $comment->user_id = Auth::user()->id;
        $comment->comment = $request->input('comment');
        $comment->public = $request->input('public');
        $comment->save();

        return redirect()->route('requests.id', $request->input('request_id'))->with('message', [
            'type' => 'success',
            'body' => 'Your comment has been posted!'
        ]);
    }
}
