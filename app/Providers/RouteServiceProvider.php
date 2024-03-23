<?php

namespace App\Providers;

use App\Models\Books;
use App\Models\Role;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));
        });

        Route::bind("book", function($value) {
            if (!Auth::user()->isSuperAdmin()) {
                return Books::where("id", $value)
                        ->where("college_id", Auth::user()->college_id)
                        ->firstOrFail();
            }
            return Books::findOrFail($value);
        });

        Route::bind("pdf", function($value) {
            if (!Auth::user()->isSuperAdmin()) {
                return Books::where("slug", $value)
                        ->where("college_id", Auth::user()->college_id)
                        ->firstOrFail();
            }
            return Books::where("slug", $value)->firstOrFail();
        });

        Route::bind("faculty", function($value) {
            if (Auth::user()->isAdmin()) {
                return User::where("id", $value)
                        ->where("role_id", Role::FACULTY)
                        ->where("college_id", Auth::user()->college_id)
                        ->firstOrFail();
            }
            return User::findOrFail($value);
        });

        Route::bind("student", function($value) {
            if (Auth::user()->isAdmin()) {
                return User::where("id", $value)
                        ->where("role_id", Role::STUDENT)
                        ->where("college_id", Auth::user()->college_id)
                        ->firstOrFail();
            }
            return User::findOrFail($value);
        });

        Route::bind("my_book", function($value) {
            return Books::where("user_id", Auth::id())->where("slug", $value)->firstOrFail();
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
