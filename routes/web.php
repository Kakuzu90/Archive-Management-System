<?php

use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\CollegeController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FacultyController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BookController as ControllersBookController;
use App\Http\Controllers\Faculty\HomeController;
use App\Http\Controllers\Faculty\ProfileController as FacultyProfileController;
use App\Http\Controllers\Student\HomeController as StudentHomeController;
use App\Http\Controllers\Student\ProfileController as StudentProfileController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\CreateBook;
use App\Http\Middleware\Faculty;
use App\Http\Middleware\Student;
use App\Http\Middleware\SuperAdmin;
use App\Http\Middleware\VerifiedOnly;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware("guest")
->controller(AuthController::class)
->group(function () {

    Route::get("/", "index")->name("index");
    Route::get("login", "loginIndex")->name("login");
    Route::get("register-student", "registerV1")->name("register.student");
    Route::get("register-faculty", "registerV2")->name("register.faculty");

    Route::post("login", "login")->name("login");
    Route::post("register-student", "submitV1")->name("register.student");
    Route::post("register-faculty", "submitV2")->name("register.faculty");

});

Route::middleware("auth")
->group(function () {

    Route::middleware(Admin::class)
        ->prefix("administrator")
        ->as("admin.")
        ->group(function () {

            Route::get("/", function() {
                return redirect()->route("admin.dashboard");
            });

            Route::get("logout", [AuthController::class, "logout"])->name("logout");
            Route::get("dashboard", DashboardController::class)->name("dashboard");

            Route::middleware(SuperAdmin::class)->group(function() {
                Route::apiResource("colleges", CollegeController::class);
                Route::apiResource("courses", CourseController::class);
                Route::apiResource("admins", AdminController::class);
                Route::get("settings", [SettingController::class, "index"])->name("settings.index");
                Route::put("settings/store", [SettingController::class, "update"])->name("settings.store");
            });

            Route::controller(ProfileController::class)->group(function() {
                Route::get("my-profile", "index")->name("profile.index");
                Route::put("my-profile/general", "general")->name("profile.general");
                Route::patch("my-profile/password", "password")->name("profile.password");
                Route::get("my-activity-log", "logs")->name("profile.logs");
            });
            
            Route::get("books/{book}/review", [BookController::class,"review"])->name("books.review");
            Route::resource("books", BookController::class);
            Route::apiResource("faculty", FacultyController::class);
            Route::apiResource("students", StudentController::class);
            Route::get("activity-logs", ActivityLogController::class)->name("activity.index");

    });

    Route::middleware(Student::class)
        ->prefix("student")
        ->as("student.")
        ->group(function () {

            Route::get("/", function() {
                return redirect()->route("student.home");
            });

            Route::get("logout", [AuthController::class, "logout"])->name("logout");

            Route::middleware(VerifiedOnly::class)->controller(StudentHomeController::class)->group(function() {
                Route::get("home", "index")->name("home");
                Route::get("book/{pdf:slug}", "book")->name("book");
                Route::post("book/{pdf:slug}/store", "store")->name("book.store");
            });

            Route::controller(StudentProfileController::class)
                ->prefix("my-profile")->as("profile.")
                ->group(function() {

                    Route::get("/", "index")->name("index");
                    Route::put("general", "general")->name("general");
                    Route::patch("password", "password")->name("password");

            });

            Route::middleware(CreateBook::class)->resource("my-books", ControllersBookController::class)->except(["index", "destroy"]);

    });

    Route::middleware(Faculty::class)
        ->prefix("faculty")
        ->as("faculty.")
        ->group(function () {

            Route::get("/", function() {
                return redirect()->route("faculty.home");
            });

            Route::get("logout", [AuthController::class, "logout"])->name("logout");

            Route::middleware(VerifiedOnly::class)->controller(HomeController::class)->group(function() {
                Route::get("home", "index")->name("home");
                Route::get("book/{pdf:slug}", "book")->name("book");
                Route::post("book/{pdf:slug}/store", "store")->name("book.store");
            });

            Route::controller(FacultyProfileController::class)
                ->prefix("my-profile")->as("profile.")
                ->group(function() {

                    Route::get("/", "index")->name("index");
                    Route::put("general", "general")->name("general");
                    Route::patch("password", "password")->name("password");

            });


            Route::resource("my-books", ControllersBookController::class)->except(["index", "destroy"]);
    });

});


Route::fallback(function() {
    abort(404);
});