<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
            "password" => "required"
        ]);

        if (!verifyMe($request->password)) {
            return redirect()->back()->withErrors(["verify" => "The password is incorrect, please try again!"]);
        }

        $settings = Setting::latest()->get();
        foreach($settings as $setting) {
            if ($request->filled($setting->id)) {
                $model = Setting::where("id", $setting->id)->first();
                $model->update([
                    "context" => $request->input($setting->id)
                ]);
            }
        }

        $msg = ["Setting Changed", "You have successfully change the settings data."];

        return redirect()->back()->with("info", $msg);
    }
}
