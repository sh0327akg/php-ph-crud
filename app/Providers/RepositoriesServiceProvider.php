<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Post\EloquentPostRepository;
use App\Repositories\Post\PostRepositoryInterface;
use App\Repositories\User\EloquentUserRepository;
use App\Repositories\User\UserRepositoryInterface;
use App\Models\User;
use App\Models\Post;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            PostRepositoryInterface::class,
            function () {
                return new EloquentPostRepository(new Post());
            }
        );

        $this->app->bind(
            UserRepositoryInterface::class,
            function () {
                return new EloquentUserRepository(new User());
            }
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
