<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Post;

use Auth;

class PostController extends Controller
{
    public function postUpdate(Request $request){
        $id=$request['id'];
        $post=Post::where('id', $id)->first();
        $post->title=$request['title'];
        $post->slug=$request['title'];
        $post->content=$request['content'];
        $post->user_id=Auth::User()->id;
        $post->update();
        return redirect()->route('posts')->with('info', 'The selected post have been updated.');
    }
    public function getEditPost($post){
        $user=Auth::User();
        $posts = Post::where('slug', $post)->first();
        if(($user->hasRole('Administrator')) || ($user->id==$posts->user_id)) {
            return view('posts.edit')->with(['post' => $posts]);
        }else{
            return redirect()->back()->with('err', 'You no have permission to edit this posts.');
        }
    }
    public function deletePost(Request $request){
        $user=Auth::User();
        $id=$request['id'];
        $post=Post::where('id', $id)->first();
        if(($user->hasRole('Administrator')) || ($user->id==$post->user_id)){
            $post->delete();
            return redirect()->back()->with('info', 'The selected post have been deleted.');
        }else{
            return redirect()->back()->with('err','You no have permission to delete this post.');
        }


    }
    public function getUserPosts($user){
        $users=User::where('name', $user)->first();
        $user_id=$users->id;
        $posts=Post::where('user_id',$user_id )->OrderBy('id', 'desc')->paginate("5");
        return view ('posts.contents')->with(['posts'=>$posts]);
    }
    public function getPosts(){
        $posts=Post::OrderBy('id', 'desc')->paginate("5");
        return view ('posts.contents')->with(['posts'=>$posts]);
    }
    public function getNewPost(){
        return view ('posts.new-post');
    }
    public function postNewPost(Request $request){
        $this->validate($request,[
           'title'=>'required',
           'content'=>'required'
        ]);
        $post=new Post();
        $post->title=$request['title'];
        $post->slug=$request['title'];
        $post->content=$request['content'];
        $post->user_id=Auth::User()->id;
        $post->save();
        return redirect()->back()->with('info',"The new post have been published.");
    }
}
