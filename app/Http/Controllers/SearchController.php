<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $posts = Post::where('title', 'like', "%{$keyword}%")
            ->orWhereHas('user', function ($query) use ($keyword) {
                $query->where('university_name', 'like', "%{$keyword}%");
            })
            ->paginate(10);
        $posts->appends(['keyword' => $keyword])->links();
        return view('posts.search', compact('posts'));
    }
}
