<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Thread;
use App\Reply;

class RepliesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param $channelId
     * @param Thread $thread
     * @return void
     */
    public function store(Request $request, $channelId, Thread $thread)
    {
        $request->validate([
            'body' => 'required'
        ]);

        $thread->addReply([
            'body' => $request->body,
            'user_id' => auth()->id(),
        ]);

        return redirect($thread->path())->with([
            'aviso' => 'Sua resposta foi salva.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reply $reply)
    {
        if ($reply->user_id != auth()->id()) {
            return response([], 403);
        }

        $reply->delete();

        return back();
    }
}
