<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * CommentController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);

        $comment = new Comment();
        $comment->author = Auth::user()->name;
        $comment->title = $request->title;
        $comment->body = $request->body;
        $comment->game_id = $request->game_id;
        $comment->save();

        return redirect()->route('games.show', $request->game_id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Comment $comment
     * @return void
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id)
    {
        $comment = Comment::findOrFail($id);
        $game_id = $comment->game_id;
        $comment->delete();

        return redirect()->route('games.show', $game_id);
    }
}
