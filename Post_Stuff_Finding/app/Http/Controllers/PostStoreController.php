<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;


class PostStoreController extends Controller
{
    //
    public function storeNewPost(Request $request){
        $incomingFields=$request->validate([
            'name'=>"required",
            'email'=>"required",
            'phonenumber'=>"required",
            'address'=>"required",
            'description'=>"required",
            'status'=>"required",
        ]);
        $newPost=Post::create($incomingFields);
    }

    public function search($id){
        return Post::where ('id','like','%'.$id)->get();
    }
    public function lastvalue(){
        return Post::latest()->get();
    }
}
