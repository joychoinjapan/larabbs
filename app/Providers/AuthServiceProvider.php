<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Laravel\Horizon\Horizon;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
		 \App\Models\Topic::class => \App\Policies\TopicPolicy::class,
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::guessPolicyNamesUsing(function ($modelClass){
            return 'App\Policies\\'.class_basename($modelClass).'Policy';

        });

        //是否是站长
        Horizon::auth(function ($request){
            return Auth::user()->hasRole('Founder');
        });
    }
}
