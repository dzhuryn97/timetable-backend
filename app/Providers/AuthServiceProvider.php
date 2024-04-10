<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Http\Auth\JsonLoginGuard;
use Auth;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Auth::extend('json_login', function ($app, $name, array $config) {
            return new JsonLoginGuard(Auth::createUserProvider($config['provider']), $app->request);
        });
    }
}
