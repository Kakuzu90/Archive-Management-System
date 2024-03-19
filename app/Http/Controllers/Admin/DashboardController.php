<?php

namespace App\Http\Controllers\Admin;

use App\Models\Books;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class DashboardController extends Controller
{
    public function __invoke() {
        $data["accepted"] = Books::accepted()->count();
        $data["rejected"] = Books::rejected()->count();
        $data["pending"] = Books::pending()->count();
        $data["faculty"] = User::faculty()->count();
        $data["student"] = User::student()->count();
        $data["admin"] = User::admin()->count();
        $table["pending"] = Books::pending()->latest()->get();
        $table["users"] = User::notVerify()->latest()->get();
        return view("admin.dashboard", compact("data", "table"));
    }
}
