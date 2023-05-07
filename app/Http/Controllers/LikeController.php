<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class LikeController extends Controller
{
    public function store($postId)
    {
        $user = \Auth::user();
        if (!$user->is_like($postId)) {
            $user->likes_posts()->attach($postId);
        }
        return Response::json(['result' => 'success']);
    }

    public function destroy($postId)
    {
        $user = \Auth::user();
        if ($user->is_like($postId)) {
            $user->likes_posts()->detach($postId);
        }
        return response()->json(['result' => 'success']);
    }
}
