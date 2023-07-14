<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    
    public function home(Post $post)
    {
        return view('home')->with(['posts' => $post->getPaginateBylimit()]);
    }
    
    public function show(Post $post)
    {
        $comments = $post->comments;
        return view('posts.show',compact('post', 'comments'));
    }
    
    public function create(Post $post)
    {
        $user = Auth::user();
        return view('posts.create', compact('user'));
    }
    
    public function store(Request $request, Post $post)
    {
        $input = $request['post'];
        $post->fill($input)->save();
        return redirect('/posts/' . $post->id);
    }
    
    public function bookmark_posts()
    {
        $posts = \Auth::user()->bookmarks()->orderBy('created_at', 'desc')->paginate(10);
        $data = [
            'posts' => $posts,
        ];
        return view('posts.bookmarks', $data);
    }
}
