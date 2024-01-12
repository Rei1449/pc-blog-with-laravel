<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Cloudinary;

class PostController extends Controller
{
    
    public function home(Post $post)
    {
        return view('home')->with(['posts' => $post->getPaginateBylimit()]);
    }
    
    public function try(Post $post)
    {
        return view('try')->with(['posts' => $post->getPaginateBylimit(12)]);
    }
    
    public function show(Post $post)
    {
        $user = Auth::user();
        $comments = $post->comments;
        return view('posts.show',compact('post', 'comments', 'user'));
    }
    
    public function create(Post $post)
    {
        $user = Auth::user();
        return view('posts.create', compact('user'));
    }
    
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,JPEG,PNG,JPG|max:5100',
        ]);
        $input = $request['post'];
        if ($request->hasFile('image')) {
            $image_path = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
            $input += ['image_path' => $image_path];
        };
        $post->fill($input)->save();
        return redirect('/posts/' . $post->id);
    }
    
    public function edit(Post $post)
    {
        $user = Auth::user();
        return view('posts.edit',compact('post', 'user'));
    }
    
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg|max:5100',
        ]);
        $input = $request['post'];
        $post->fill($input); 
        if ($request->has('image_delete')) {
            $post->image_path = null;
        }
        if ($request->hasFile('image')) {
            $image_path = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
            
            $post->image_path = $image_path;
        }
        $post->save();
        return redirect('/posts/' . $post->id);
    }
    
    public function delete(Post $post)
    {
        $post->delete();
        return redirect('/');
    }
    
    public function like_posts()
    {
        $posts = \Auth::user()->likes()->orderBy('created_at', 'desc')->paginate(10);
        $data = [
            'posts' => $posts,
        ];
        return view('posts.likes', $data);
    }

    public function bookmark_posts()
    {
        $posts = \Auth::user()->bookmarks()->orderBy('created_at', 'desc')->paginate(10);
        $data = [
            'posts' => $posts,
        ];
        return view('posts.bookmarks', $data);
    }
    
    public function ranking()
    {
        $posts = Post::with('user')
            ->withCount('likedBy')
            ->orderByDesc('liked_by_count') // いいねの数に基づいて降順で並び替える
            ->paginate(10);
    
        return view('posts.ranking', compact('posts'));
    }

    public function submitted_posts()
    {
        $posts = \Auth::user()->posts()->orderBy('created_at', 'desc')->paginate(10);
        $data = [
            'posts' => $posts,
        ];
        return view('posts.submitted', $data);
    }

}
