<?php

namespace Begin\Providers;

use Illuminate\Support\ServiceProvider;
use Begin\Repositories\UserRepositoryInterface;
use Begin\Repositories\Eloquent\UserRepository;
use Begin\Repositories\TaskRepositoryInterface;
use Begin\Repositories\Eloquent\TaskRepository;

class RepositoryServiceProvider extends ServiceProvider
{
     /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);

        $this->app->bind(TaskRepositoryInterface::class, TaskRepository::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [UserRepositoryInterface::class, TaskRepositoryInterface::class];
    }
}
