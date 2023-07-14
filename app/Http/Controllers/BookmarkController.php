<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function store($postId) {
        $user = \Auth::user();
        if (!$user->is_bookmark($postId)) {
            $user->bookmarks()->attach($postId);
        }
        return back();
    }
    public function destroy($postId) {
        $user = \Auth::user();
        if ($user->is_bookmark($postId)) {
            $user->bookmarks()->detach($postId);
        }
        return back();
    }
}
