<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\DatabaseManager;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\User\UserRepository;

/**
 * RepositoryServiceProvider
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     *
     * @throws \Exception
     */
    public function register()
    {
        $db = $this->app->make(DatabaseManager::class);

        $this->app->singleton(UserRepositoryInterface::class, function () use ($db) {
            return new UserRepository(new User(), $db);
        });
    }
}
