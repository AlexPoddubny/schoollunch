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
        // перегляд адмінки
        Gate::define('View_Admin', function ($user){
            return $user->canDo('View_Admin');
        });
        // користувач може бачити посилання на адміністрування на домашній сторінці
        Gate::define('View_Admin_Menu', function ($user){
            return $user->hasRole(['Admin', 'SchoolAdmin', 'Cook']);
        });
        // користувач може бачити посилання на редагування шкільного меню на домашній сторінці
        Gate::define('View_Cook_Menu', function ($user){
            return $user->hasRole('Cook');
        });
        // користувач може бачити посилання на адміністрування школи на адмінпанелі
        Gate::define('View_School_Admin', function ($user){
            return /*$user->hasRole('SchoolAdmin') || */$user->canDo('View_School_Admin');
        });
        // користувач може бачити посилання на адміністрування комбінату харчування на адмінпанелі та домашній сторінці
        Gate::define('View_Cook', function ($user){
            return $user->canDo('View_Cook');
        });
        // адміністрування списку шкіл
        Gate::define('School_Register', function ($user){
            return $user->canDo('School_Register');
        });
        // призначення адміністратора та завпроду школи
        Gate::define('School_Admin_Assign', function ($user){
            return $user->canDo('School_Admin_Assign');
        });
        Gate::define('School_Cook_Assign', function ($user){
            return $user->canDo('School_Cook_Assign');
        });
        
        // редагування даних та створення акаунту користувача
        Gate::define('User_Register', function ($user){
            return $user->canDo('User_Register');
        });
        
    }
}
