<?php

use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\CollegeController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FacultyController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Faculty\HomeController;
use App\Http\Controllers\Student\HomeController as StudentHomeController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\Faculty;
use App\Http\Middleware\Student;
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
            Route::apiResource("colleges", CollegeController::class);
            Route::apiResource("courses", CourseController::class);
            Route::get("books/{book}/review", [BookController::class,"review"])->name("books.review");
            Route::apiResource("books", BookController::class);
            Route::apiResource("admins", AdminController::class);
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
            Route::get("home", [StudentHomeController::class,"index"])->name("home");
            Route::get("book/{book}", [StudentHomeController::class,"book"])->name("book");

    });

    Route::middleware(Faculty::class)
        ->prefix("faculty")
        ->as("faculty.")
        ->group(function () {

            Route::get("/", function() {
                return redirect()->route("faculty.home");
            });

            Route::get("logout", [AuthController::class, "logout"])->name("logout");
            Route::get("home", [HomeController::class,"index"])->name("home");


    });

});