<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Tag;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class GameController extends Controller
{
    /**
     * GameController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('games.index', [
            'games' => Game::orderBy('id', 'desc')->get(),
            'tags' => Tag::orderBy('created_at', 'desc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $tags = Tag::all();
        return view('games.create', [
            'tags' => $tags
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse|Redirector
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'release_date' => 'required',
            'min_age' => 'required',
            'min_max_player' => 'required',
            'min_max_duration' => 'required',
            'description' => 'required',
        ]);

        $tags = $request->tags;
        $tagsValues = [];
        if($tags != null) {
            foreach ($tags as $k => $v) {
                array_push($tagsValues, $v);
            }
        }

        $tagsToCreate = $request->add_tags;
        $listTags = explode(",", $tagsToCreate);

        $game = new Game();
        $game->name = $request->name;
        $game->release_date = $request->release_date;
        $game->min_age = $request->min_age;
        $game->min_max_player = $request->min_max_player;
        $game->min_max_duration = $request->min_max_duration;
        $game->description = $request->description;
        $game->save();

        foreach ($listTags as $t) {
            $tag = new Tag();
            $tag->label = $t;
            $tag->save();

            DB::table('tags_games')->insert([
                'tag_id' => $tag->id,
                'game_id' => $game->id
            ]);
        }

        foreach ($tagsValues as $t) {
            DB::table('tags_games')->insert([
                'tag_id' => DB::table('tags')->where('label', $t)->value('id'),
                'game_id' => $game->id
            ]);
        }

        return redirect()->route('games.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param int $id
     * @return Factory|View
     */
    public function show(Request $request, $id)
    {
        $game = Game::findOrFail($id);

        $tags = $game->tags()->get();
        $comments = $game->comments()->get();
        $likes = $game->likes()->count();
        $dislikes = $game->dislikes()->count();

        return view('games.show', [
            'game' => $game,
            'tags' => $tags,
            'comments' => $comments,
            'likes' => $likes,
            'dislikes' => $dislikes
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Factory|View
     */
    public function edit($id)
    {
        if(Auth::user()->is_admin != 1) return back();
        $game = Game::findOrFail($id);
        $tags = $game->tags()->get();

        return view('games.edit', [
            'game' => $game,
            'tags' => $tags
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse|Redirector
     * @throws ValidationException
     */
    public function update(Request $request, $id)
    {
        $game = Game::findOrFail($id);

        $this->validate($request, [
            'name' => 'required',
            'release_date' => 'required',
            'min_max_duration' => 'required',
            'description' => 'required'
        ]);

        $game->name = $request->name;
        $game->release_date = $request->release_date;
        $game->min_max_duration = $request->min_max_duration;
        $game->description = $request->description;
        $game->save();

        return redirect()->route('games.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $game = Game::findOrFail($id);
        $game->delete();

        return redirect()->route('games.index');
    }

}
