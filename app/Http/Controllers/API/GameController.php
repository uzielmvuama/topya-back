<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $content = json_encode(str_replace(' ','',$request->getContent()));
        // dd($content);
        $p = $request->only([
            'gkey',
            'id_user',
            'hand',
            'finished'
        ]);
        if (!empty($p['gkey']) and !empty($p['id_user'])) {
            extract($p);
            $exist = DB::table('games')->select('*')->where('gkey', $gkey)->get();
            if (count($exist) > 0) {
                return response()->json(json_res(false, "la partie existe deja", [
                    "game" => DB::table('games')->select('*')->where('gkey', $gkey)->get()[0]
                ], 200));
            } else {
                $game = new Game();
                $game->gkey = $gkey;
                $game->id_user = $id_user;
                $game->save();
                return response()->json(json_res(true, "insertion reussie", [
                    "game" => DB::table('games')->select('*')->where('gkey', $gkey)->get()[0]
                ], 201));
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function show(Game $game)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Game $game)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game)
    {
        //
    }
}
