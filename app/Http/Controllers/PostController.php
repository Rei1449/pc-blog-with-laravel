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
        $input = $request['post'];
        $post->fill($input); // この行にセミコロンがなかったため、エラーが発生します。
        if ($request->has('image_delete')) {
            //dd($post);
            $post->image_path = null;
        }
        if ($request->hasFile('image')) {
            dd($post);
            $image_path = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
            // 新しい画像のURLを直接モデルの属性に代入
            $post->image_path = $image_path;
        }
        // 画像の更新情報を反映させるためにfill()メソッドを使用しない
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
        $posts = Post::with('user') // ユーザー情報をロードする例（必要に応じて変更してください）
            ->withCount('likedBy')
            ->having('liked_by_count', '>=', 1)
            ->orderByRaw('liked_by_count DESC') // いいねの数に基づいて降順で並び替える
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
