<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store($postId) {
        $user = \Auth::user();
        if (!$user->is_like($postId)) {
            $user->likes()->attach($postId);
        }
        return back();
    }
    public function destroy($postId) {
        $user = \Auth::user();
        if ($user->is_like($postId)) {
            $user->likes()->detach($postId);
        }
        return back();
    }
}
