<?php

namespace App\Providers;

use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class SuperAdminServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if("superadmin", function () {
            return Auth::check() && Auth::user()->isSuperAdmin();
        });

        Blade::if("admin", function () {
            return Auth::check() && Auth::user()->isAdmin();
        });
    }
}
