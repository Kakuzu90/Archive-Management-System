<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function __invoke() {
        $logs = ActivityLog::excludeSuperAdmin()->latest()->get();
        return view("admin.audit", compact("logs"));
    }
}
