<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function comment(Post $post)
    {
        $user = Auth::user();
        return view('posts.comment',compact('user','post'));
    }
    
    public function store(Request $request, Comment $comment)
    {
        $input = $request['comment'];
        $comment->fill($input)->save();
        return redirect()->route('posts.show', ['post' => $comment->post_id]);
    }
}
