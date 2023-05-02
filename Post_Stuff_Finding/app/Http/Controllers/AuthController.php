<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use mysql_xdevapi\Exception;

class AuthController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'name'=>'required|string',
            'username'=>'required|string',
            'email'=>'required|string',
            'password'=>'required|string|min:6'
        ]);
//        $user = new User([
//            'name'  =>$request->name,
//            'username'  =>$request->username,
//            'email'  =>$request->email,
//            'password'  => Hash::make($request->password)
//        ]);

      //  $user->save();


        $newUser=User::create([
            'name'  =>$request->name,
            'username'  =>$request->username,
            'email'  =>$request->email,
            'password'  => Hash::make($request->password),
            'api_token'=>str::random(100),
        ]);
        return response()->json(['message'=> 'User Has Been Registerd'],200);
   }
        public function login(Request $request){
                $request->validate([
                    'email'=>'required',
                    'password'=>'required|string',
                ]);



            $users = User::where('email', $request->email)->first();
            if (empty($users)) {
                return response()->json(['message'=>'unauthorized'],401);
            }
            else {
//                $user = $request->user();
                  $tokenResult = $users->update(['api_token' => Str::random(100)]);
                //$user->createToken('Personal Access Token')
//                $token = $tokenResult -> token;
//                $token->expires_at = Carbon::now()->addWeeks(1);
//                $token->save();


                return response()->json(['data'=>[
                    'user' =>$users,
                    //'access_token'=>$tokenResult->access_token,
                    'token_type'  =>'Bearer',
                   // 'expires_at'  =>Carbon::parse($tokenResult->token->expires_at)->toDateTimeString()
                ]]);
            }
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    public function AllPostMans(){
        return user::latest()->get();
    }

    public function searchPostman($id){
        return user::where ('id','like','%'.$id)->get();
    }

    public function searchPostmanName($name){
        return user::where ('name','like','%'.$name)->get();
    }
}
