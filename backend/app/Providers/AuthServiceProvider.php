<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        #User Policies
        Gate::define('view_any_user', 'App\Policies\UserPolicy@viewAny');
        Gate::define('view_user', 'App\Policies\UserPolicy@view');
        Gate::define('create_user', 'App\Policies\UserPolicy@create');
        Gate::define('update_user', 'App\Policies\UserPolicy@update');
        Gate::define('delete_user', 'App\Policies\UserPolicy@delete');
        Gate::define('change_level', 'App\Policies\UserPolicy@changeLevel');

        #AccessLog Policies
        Gate::define('view_any_log', 'App\Policies\AccessLogPolicy@viewAny');
        Gate::define('view_log', 'App\Policies\AccessLogPolicy@view');
        Gate::define('create_log', 'App\Policies\AccessLogPolicy@create');
        Gate::define('update_log', 'App\Policies\AccessLogPolicy@update');
        Gate::define('delete_log', 'App\Policies\AccessLogPolicy@delete');
    }
}
