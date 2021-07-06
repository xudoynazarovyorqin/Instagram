<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Comment;
use App\Models\Follow;
use App\Models\User;
use App\Models\Post;
use App\Models\Like;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        // dd($request);
        $follower = Follow::where('follower_id', auth()->user()->id)->get();
        $following = Follow::where('following_id',auth()->user()->id)->get();
        $posts = Post::all();   
        return view('home',compact('posts','follower','following'));
    }

    public function info( )
    {
        return view('addinfo');
    }


    public function infoPost(Request $request)
    {   
        $profiles = Profile::all();
        $count = 0;
        if(count($profiles) == 0){
            Profile::create([
                'fname' => $request->fname,
                'lname' => $request->lname,
                'photo'=>$request->photo,
                'user_id'=>$request->id
            ]);
            return redirect()->route('home');
        }
        foreach($profiles as $profile){
            if($request->id == $profile->user_id){
                Profile::where('user_id',$request->id)->update([
                    'fname' => $request->fname,
                    'lname' => $request->lname,
                    'photo'=>$request->photo,
                ]);
            }if($request->id != $profile->user_id){
                $count = 1;
            }
        }
        if($count == 1){
            Profile::create([
                'fname' => $request->fname,
                'lname' => $request->lname,
                'photo'=>$request->photo,
                'user_id'=>$request->id
            ]);
        }
        return redirect()->route('home');
    }

    public function addPost()
    {
        return view('addPost');
    }

    public function addPostP(Request $request)
    {
        Post::create([
            'photo' => $request->photo,
            'description' =>$request->desc,
            'user_id' => $request->id 
        ]);
        return redirect()->route('home');
    }
    public function Post(Request $request,$id)
    {
        $post =Post::where('id',$id)->first();
        $comments =Comment::where('post_id', $id)->get();
        return view('Post',compact('post','comments'));
    }

    public function Comment(Request $request)
    {
        Comment::create([
            'post_id'=>$request->post_id,
            'user_id'=>$request->user_id,
            'comment'=>$request->comment
        ]);
        
        $post =Post::where('id',$request->post_id)->first();
        $comments =Comment::where('post_id', $request->post_id)->get();
        // return view('Post',compact('post','comments'));
        return redirect('/post/'.$request->post_id)->with(['post'=>$post, 'comments'=>$comments]);
    }

    public function Profile($id)
    {
        // $icon = 0;
        $follower = Follow::where('follower_id', $id)->get();
        $following = Follow::where('following_id', $id)->get();
        $user = User::where('id',$id)->first();
        return view('profile',compact('user','follower','following'));
    }

    public function Follow(Request $request)
    {
        $icon = 0;
        $follower = Follow::where('follower_id', $request->follower)->get();
        $following = Follow::where('following_id', $request->following)->get();
        foreach($follower as $flwer){
            if($flwer->following_id == $request->following){
                $icon = 1;
                Follow::where('following_id',$request->following)->delete();
                $user = User::where('id',$request->following)->first();
        return redirect('/profile/'.$request->following)->with(['follower'=>$follower, 'following'=>$following,'user'=>$user]);
        // return view('profile',compact('user','follower','following'));
            }
        }
        Follow::create([
            'follower_id'=>$request->follower,
            'following_id'=>$request->following
        ]);
        $user = User::where('id',$request->following)->first();
        // return view('profile',compact('user','follower','following'));
        
        return redirect('/profile/'.$request->following);
    }
    public function Like($id)
    {
        $likes = Like::all();
        if(count($likes) == 0){
            Like::create([
                'user_id' => auth()->user()->id,
                'post_id' => $id
            ]);
            $posts = Post::all();
            return redirect('/')->with(['posts'=>$posts]);
        }else{
            foreach($likes as $like){
                if( $like->post_id == $id && $like->user_id == auth()->user()->id){
                    $posts = Post::all();
                    return redirect('/')->with(['posts'=>$posts]);
                }else{
                    Like::create([
                        'user_id' => auth()->user()->id,
                        'post_id' => $id
                    ]);
                    $posts = Post::all();
                    return redirect('/')->with(['posts'=>$posts]);
                }
            }
           
        }
        
    }
}
