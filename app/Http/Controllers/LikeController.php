<?php

namespace App\Http\Controllers;

use App\Like;
use App\Models\Game;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
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
    public function store($id)
    {
        $like = new Like();
        $like->game_id = $id;
        $like->user_id = Auth::user()->id;
        $like->timestamps = false;
        $like->save();

        return redirect()->route('games.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Like  $like
     * @return Response
     */
    public function destroy(Like $like)
    {
        //
    }
}
