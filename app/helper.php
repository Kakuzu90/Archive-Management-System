<?php

use App\Models\Books;
use App\Models\College;
use App\Models\Role;
use App\Models\User;
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
        return Books::where("college_id", Auth::user()->college_id)->latest()->get();
    }
}

if (!function_exists("getColleges")) {
    function getColleges() {
        return College::latest()->get();
    }
}