<?php

use App\Models\Role;
use App\Models\User;
use App\Models\Books;
use App\Models\Course;
use App\Models\College;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;

if (!function_exists("isActive")) {
    function isActive(string $uri): bool {
        $string = explode("|", $uri);
        return in_array(request()->route()->getName(), $string);
    }
}

if (!function_exists("verifyMe")) {
    function verifyMe(string $password) {
        return password_verify($password, Auth::user()->password);
    }
}

if (!function_exists("smartRoute")) {
    function smartRoute(User $user) {
        return $user->role_id === Role::FACULTY 
            ? route("admin.faculty.index")
            : route("admin.students.index");
    }
}

if (!function_exists("getBooks")) {
    function getBooks() {
        return Books::accepted()->latest()->get();
    }
}

if (!function_exists("getColleges")) {
    function getColleges() {
        return College::latest()->get();
    }
}

if (!function_exists("getCourses")) {
    function getCourses() {
        if (!Auth::user()->isSuperAdmin()) {
            return Course::where("college_id", Auth::user()->college_id)->latest()->get();
        }
        return Course::latest()->get();
    }
}

if (!function_exists("changeRoute")) {
    function changeRoute(string $uri, $params = null) {
        $role = strtolower(Auth::user()->role->name);
        if (Auth::user()->isFaculty()) {
            $replace = str_replace("student", $role, $uri);
            return route($replace, $params);
        }
        return route($uri, $params);
    }
}

if (!function_exists("getTerms")) {
    function getTerms() {
        return Setting::terms()->first();
    }
}

if (!function_exists("getAbout")) {
    function getAbout() {
        return Setting::about()->first();
    }
}