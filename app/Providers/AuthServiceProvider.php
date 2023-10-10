<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Modules;
use App\Models\User;
use App\Models\Groups;
use App\Models\Post;
use App\Policies\PostPolicy;
use App\Policies\UserPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Post::class=>PostPolicy::class,
        User::class=>UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        /**
         * users.view  
         * 1. Lấy danh sách module
         * 
         */
        $modulesList = Modules::all();
        if ($modulesList->count() > 0) {
            foreach ($modulesList as $module) {
                Gate::define($module->name, function (User $user) use ($module){
                    $roleJson = $user->group->permissions;
                    if (!empty($roleJson)) {
                        $roleArr = json_decode($roleJson, true);
                        $check = isRole($roleArr,$module->name);
                        return $check;
                    } 
                    return false;
                });
                Gate::define($module->name.'.edit', function (User $user) use ($module){
                    $roleJson = $user->group->permissions;
                    if (!empty($roleJson)) {
                        $roleArr = json_decode($roleJson, true);
                        $check = isRole($roleArr,$module->name,'edit');
                        return $check;
                    } 
                    return false;
                });
                Gate::define($module->name.'.delete', function (User $user) use ($module){
                    $roleJson = $user->group->permissions;
                    if (!empty($roleJson)) {
                        $roleArr = json_decode($roleJson, true);
                        $check = isRole($roleArr,$module->name,'delete');
                        return $check;
                    } 
                    return false;
                });
            }
        }
    }
}
