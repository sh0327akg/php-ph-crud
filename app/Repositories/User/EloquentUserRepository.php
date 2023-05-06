<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class EloquentUserRepository implements UserRepositoryInterface
{
    public function getUserWithRanking()
    {
        return User::select([
            'users.id',
            'users.name',
            DB::raw('SUM((SELECT COUNT(*) FROM likes WHERE likes.post_id = posts.id) + posts.satisfaction) as total_score')
        ])
            ->join('posts', 'users.id', '=', 'posts.user_id')
            ->groupBy('users.id', 'users.name')
            ->orderBy('total_score', 'desc')
            ->paginate(20);
    }
}
