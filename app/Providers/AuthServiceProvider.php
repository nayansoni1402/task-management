<?php

namespace App\Providers;
use App\Models\Task;
use App\Models\Document;
use App\Policies\TaskPolicy;
use App\Policies\DocumentPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */

     protected $policies = [
        Task::class => TaskPolicy::class,
        Document::class => DocumentPolicy::class,
    ];
    
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
