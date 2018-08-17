<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class ApiController extends Controller
{
    public function getPosts(){
        $posts=Post::OrderBy('id', 'desc')->with('user')->paginate('5');
        return response()->json(['posts'=>$posts]);
    }
    public function getPost($slug){
        $post=Post::where('slug', $slug)->with('user')->first();
        return response()->json(['post'=> $post]);
    }
    public function getSearch($q){
        $posts=Post::OrderBy('id', 'desc')->where('title', 'LIKE', '%'. $q .'%')->orWhere('content', 'LIKE', '%'.$q.'%')
            ->orWhere('created_at', 'LIKE', '%'.$q.'%')->with('user')->paginate("5");
        return response()->json(['posts'=>$posts]);
    }
}
