<?php

namespace App\Providers;

use App\Permission;
use App\School;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
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
        /*
        $perms = Permission::all();
        foreach ($perms as $perm) {
            $name = $perm->name;
            Gate::define($name, function ($user) use ($name) {
                return $user->canDo($name);
            });
        }
        */
        Gate::define('View_Admin', function ($user){
            return $user->canDo('View_Admin');
        });
        Gate::define('View_Admin_Menu', function ($user){
            return $user->hasRole(['Admin', 'School_Admin', 'Cook']);
        });
        Gate::define('View_Cook_Menu', function ($user){
            return $user->hasRole(['Cook']);
        });
        Gate::define('View_School_Admin', function ($user, School $school = null){
            return $user->hasRole('Admin')
                || $school && ($user->canDo('View_School_Admin') && $user->school->id == $school->id);
        });
        Gate::define('View_Cook', function ($user, School $school = null){
            return $user->hasRole('Admin')
                || $school && ($user->canDo('View_Cook') && $user->cook->id == $school->id);
        });
        
    }
}
