<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $user = auth()->user();

        if($search){
            $posts = Post::where('title', 'like', "%{$search}%")
                ->orWhere('body','like',"%{$search}%")
                ->orWhere('genre','like',"%{$search}%")
                ->orderBy('created_at', 'desc')->paginate(9)
                ->appends(['search' => $search]);
        }else{
            $posts = Post::orderBy('created_at', 'desc')->paginate(9);
        }
        
        return view('post.index', compact('posts', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $inputs = $request->validated();
        $post = new Post();
        $post->title = $inputs['title'];
        $post->body = $inputs['body'];
        $post->genre = $inputs['genre'];
        $post->satisfaction = $inputs['satisfaction'];
        $post->user_id = auth()->user()->id;
        if ($request->file('image')){
            //s3アップロード開始
            $image = $request->file('image');
            // バケットの`image`フォルダへアップロード
            $path = Storage::disk('s3')->putFile('image', $image);
            // アップロードした画像のフルパスを取得
            $post->image = Storage::disk('s3')->url($path);
        }
        $post->save();
        return redirect()->route('post.index')->with('message', '投稿を作成しました');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post)
    {
        $inputs = $request->validated();
        $post->title = $inputs['title'];
        $post->body = $inputs['body'];
        $post->genre = $inputs['genre'];
        $post->satisfaction = $inputs['satisfaction'];
        if ($request->file('image')){
            //s3アップロード開始
            $image = $request->file('image');
            // バケットの`image`フォルダへアップロード
            $path = Storage::disk('s3')->putFile('image', $image);
            // アップロードした画像のフルパスを取得
            $post->image = Storage::disk('s3')->url($path);
        }

        $post->save();
        return redirect()->route('post.show',$post)->with('message', '投稿を更新しました');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('post.index')->with('message','投稿を削除しました');
    }
}
