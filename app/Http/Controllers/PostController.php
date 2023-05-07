<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Repositories\Post\PostRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    protected $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $user = auth()->user();

        if ($search) {
            $posts = $this->postRepository->getWithSearch($search);
        } else {
            $posts = $this->postRepository->getAll();
        }

        return view('post.index', compact('posts', 'user'));
    }

    public function create()
    {
        return view('post.create');
    }

    public function store(PostRequest $request)
    {
        $inputs = $request->validated();
        $inputs['user_id'] = auth()->user()->id;

        if ($request->file('image')) {
            $inputs['image'] = $request->file('image');
        }

        $this->postRepository->create($inputs);

        return redirect()->route('post.index')->with('message', '投稿を作成しました');
    }

    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        return view('post.edit', compact('post'));
    }

    public function update(PostRequest $request, Post $post)
    {
        $inputs = $request->validated();

        if ($request->file('image')) {
            $inputs['image'] = $request->file('image');
        }

        $this->postRepository->update($post, $inputs);

        return redirect()->route('post.show', $post)->with('message', '投稿を更新しました');
    }

    public function destroy(Post $post)
    {   
        $this->authorize('delete', $post);
        $this->postRepository->delete($post);

        return redirect()->route('post.index')->with('message', '投稿を削除しました');
    }
}
