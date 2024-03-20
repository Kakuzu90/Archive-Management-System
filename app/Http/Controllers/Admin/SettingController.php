<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index() {
        $settings = Setting::latest()->get();
        return view("admin.setting", compact("settings"));
    }

    public function update(Request $request) {
        $request->validate([
            "about" => "required",
            "terms" => "required"
        ]);

        $about = Setting::about()->first();
        $terms = Setting::terms()->first();

        $about->update([
            "context" => $request->about,
        ]);

        $terms->update([
            "context" => $request->terms
        ]);

        $msg = ["Setting Changed", "You have successfully change the settings data."];
        $this->audit(ActivityLog::EDIT, "Update system settings");

        return redirect()->back()->with("info", $msg);
    }
}
