<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityLogController extends Controller
{
    public function __invoke() {
        $query = User::where("role_id", Role::SUPER_ADMIN)->orWhere("id", Auth::id());
        if (Auth::user()->isAdmin()) {
            $query->orWhere("college_id", "!=", Auth::user()->college_id);
        }

        $ids = $query->get()->pluck("id");

        $logs = ActivityLog::whereNotIn("user_id", $ids)->latest()->get();

        return view("admin.audit", compact("logs"));
    }
}
