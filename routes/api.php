<?php

use App\Http\Controllers\Api\DownloadController;
use App\Http\Controllers\Api\LoadReviewController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::as("api.")
->middleware("auth")
->group(function() {

    Route::prefix("admin")->as("admin.")->middleware(Admin::class)->group(function() {
        Route::get("user/search", [SearchController::class, "search"])->name("search");
    });

    Route::get("book/{book}/reviews", LoadReviewController::class)->name("book.reviews");
    Route::get("book/{book}/download", DownloadController::class)->name("book.download");

});