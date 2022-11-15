<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Choice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $p = $request->only([
            'gkey',
            'id_user',
            'country',
        ]);
        if (!empty($p['gkey']) and !empty($p['id_user']) and !empty($p['country'])) {
            extract($p);
            $exist = DB::table('choices')->select('*')->where('gkey', $gkey)->where('id_user', $id_user)->get();
            if (count($exist) > 0) {
                return response()->json(json_res(false, "le joueur a déja rejoint", [
                    "game" => DB::table('choices')->select('*')->where('gkey', $gkey)->get()[0]
                ], 200));
            } else {
                $game = new Choice();
                $game->gkey = $gkey;
                $game->id_user = $id_user;
                $game->country = $country;
                $game->save();

                return response()->json(json_res(true, "Choix effectué", [
                    "choice" => DB::table('choices')->select('*')->where('gkey', $gkey)->get()[0]
                ], 201));
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Choice  $choice
     * @return \Illuminate\Http\Response
     */
    public function showJoinner(String $gkey)
    {

        if (!empty($gkey)) {
            $exist = DB::table('choices')->select('*')->where('gkey', $gkey)->get();
            if (count($exist) > 0) {
                return response()->json(json_res(true, "Partie débutée", [
                    "choices" => DB::table('choices')->select('id_user')->where('gkey', $gkey)->get()
                ], 200));
            } else {
                return response()->json(json_res(false, "Aucun joinner", [], 200));
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Choice  $choice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Choice $choice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Choice  $choice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Choice $choice)
    {
        //
    }
}
