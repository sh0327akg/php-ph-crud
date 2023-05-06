<?php

namespace App\Repositories\Post;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class EloquentPostRepository implements PostRepositoryInterface
{
    protected $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function getAll()
    {
        return $this->post->orderBy('created_at', 'desc')->paginate(9);
    }

    public function getWithSearch(string $search)
    {
        return $this->post
            ->where('title', 'like', "%{$search}%")
            ->orWhere('body', 'like', "%{$search}%")
            ->orWhere('genre', 'like', "%{$search}%")
            ->orderBy('created_at', 'desc')
            ->paginate(9);
    }

    public function getById(int $id)
    {
        return $this->post->findOrFail($id);
    }

    public function create(array $data)
    {
        if (isset($data['image'])) {
            $path = Storage::disk('s3')->putFile('image', $data['image']);
            $data['image'] = Storage::disk('s3')->url($path);
        }

        return $this->post->create($data);
    }

    public function update(Post $post, array $data)
    {
        if (isset($data['image'])) {
            $path = Storage::disk('s3')->putFile('image', $data['image']);
            $data['image'] = Storage::disk('s3')->url($path);
        }

        return $post->update($data);
    }

    public function delete(Post $post)
    {
        return $post->delete();
    }
}

