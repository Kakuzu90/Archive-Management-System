<?php

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