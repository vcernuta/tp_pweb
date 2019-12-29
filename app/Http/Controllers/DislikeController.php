<?php

namespace App\Http\Controllers;

use App\Dislike;
use App\Like;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DislikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(int $id)
    {
        $dislike = new Dislike();
        $dislike->game_id = $id;
        $dislike->user_id = Auth::user()->id;
        $dislike->timestamps = false;
        $dislike->save();

        return redirect()->route('games.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dislike  $dislike
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dislike $dislike)
    {
        //
    }
}
