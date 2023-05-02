<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminant\support\Auth;
use Illuminant\support\Hash;
use App\Models\User;
use Carbon\Carbon;
use App\Users;
use Illuminate\Support\Str;


class PostController extends Controller
{
    public function index()
    {
        //
    }


    public function store(Request $request)
    {
        $incomingFields=$request->validate([
            'name'=>"required_if:type,individual",
            'username'=>"required_if:type,individual",
            'email'=>"required_if:type,individual",
            'password'=>"required",
            'position'=>"required",
            'api_token'=>str::random(100),
        ]);
        $newUser=User::create($incomingFields);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $POST=Post::find($id);
        $POST->update($request->all());
        return $POST;
    }


    public function updatePostman(Request $request, string $id)
    {
        $USER=User::find($id);
        $USER->update($request->all());
        return $USER;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Post::destroy(($id));
    }

    public function destroyPostman(string $id)
    {
        return User::destroy(($id));
    }

//    public function login(Request $request){
//        $request->validate([
//            'email'=>'required',
//            'password'=>'required|string'
//        ]);
//
//        $credentials = request(['email','password']);
//
//        if(\Illuminate\Support\Facades\Auth::attempt($credentials)){
//            return response()->json(['message'=>'unauthorized'],401);
//        }
//
//        $user = $request->user();
//        $tokenResult = $user->createToken('Personal Access Token');
//        $token = $tokenResult -> token;
//        $token->expires_at = Carbon::now()->addWeeks(1);
//        $token->save();
//
//
//        return response()->json(['data'=>[
//            'user' =>Auth::user(),
//            'access_token'=>$tokenResult->access_token,
//            'token_type'  =>'Bearer',
//            'expires_at'  =>Carbon::parse($tokenResult->token->expires_at)->toDateTimeString()
//        ]]);
//    }
}
