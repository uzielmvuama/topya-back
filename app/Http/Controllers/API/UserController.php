<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
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
        $p = $request->only([
            'email',
            'name',
            'mdp',
        ]);
        // dump($p);
        if (!empty($p['email']) and !empty($p['name'] and !empty($p['mdp']))) {
            extract($p);
            $exist = DB::table('users')->select('*')->where('password', $mdp)->where('email', $email)->where('name', $name)->get();
            if (count($exist) > 0) {
                return response()->json(json_res(true, "L'utilisateur existe déjà", [
                    "user" => DB::table('users')->select('*')->where('password', $mdp)->where('email', $email)->where('name', $name)->get()[0]
                ], 200));
            } else {
                $usr = new User();
                $usr->name = $name;
                $usr->email = $email;
                $usr->password = $mdp;
                $usr->save();
                return response()->json(json_res(true, "inscription reussie", [
                    "user" =>DB::table('users')->select('*')->where('password', $mdp)->where('email', $email)->where('name', $name)->get()[0]
                ], 200));
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }
    public function userLogin(Request $request)
    {
        $p = $request->only([
            'username',
            'mdp',
        ]);
        // dump($p);
        if (!empty($p['username']) and !empty($p['mdp'])) {
            extract($p);
            $exist = DB::table('users')->select('*')->where('password', $mdp)->where('email', $username)->orWhere('name', $username)->get();
            if (count($exist) > 0) {
                return response()->json(json_res(true, "connexion reussie", [
                    "user" => DB::table('users')->select('*')->where('email', $username)->orWhere('name', $username)->where('password', $mdp)->get()[0]
                ], 200));
            } else {
                return response()->json(json_res(false, "L'utilisateur n'existe pas", [], 400));
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        dd($user);
    }
}
