<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\PollRepositoryInterface;
use App\Repositories\Implementations\PollRepository;
use App\Repositories\Interfaces\VoteRepositoryInterface;
use App\Repositories\Implementations\VoteRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(PollRepositoryInterface::class, PollRepository::class);
        $this->app->bind(VoteRepositoryInterface::class, VoteRepository::class);
    }
}
