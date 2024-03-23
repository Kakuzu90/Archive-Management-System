<?php

namespace App\Http\Controllers\Student;

use App\Models\User;
use App\Rules\UniqueEntry;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index() {
        $user = Auth::user();
        return view("user.profile", compact("user"));
    }

    public function general(Request $request) {
        $request->validate([
            "first_name" => "required",
            "middle_name" => "required",
            "last_name" => "required",
            "college" => "required|numeric",
            "year" => "required",
            "username" => ["required", new UniqueEntry("users", "username", Auth::id())],
            "password" => "required",
            "avatar" => "required",
        ]);

        if (!verifyMe($request->password)) {
            return redirect()->back()->withErrors(["verify" => "The password is incorrect, please try again!"]);
        }

        $user = User::where("id", Auth::id())->first();

        $old = $user->college_id;

        $update = [
            "first_name" => $request->first_name,
            "middle_name" => $request->middle_name,
            "last_name" => $request->last_name,
            "username" => $request->username,
            "college_id" => $request->college,
            "year_level" => $request->year,
            "avatar" => $request->avatar
        ];

        if ($old != $request->college) {
            $update["verified_at"] = null;
        }

        $user->update($update);

        if ($user->wasChanged()) {
            $msg = ["Account Updated", "You have successfully updated your account."];
            $this->audit(ActivityLog::EDIT, "Update personal information");
            return redirect()->back()->with("success", $msg);
        }

        return redirect()->back();
    }

    public function password(Request $request) {
        $request->validate([
            "password" => "required|confirmed",
            "old" => "required"
        ]);

        if (!verifyMe($request->old)) {
            return redirect()->back()->withErrors(["verify" => "The password is incorrect, please try again!"]);
        }

        $user = User::where("id", Auth::id())->first();
        $user->update(["password" => $request->password]);
        $this->audit(ActivityLog::EDIT,"Update password");
        $msg = ["Password Updated", "You have successfully updated your password."];

        return redirect()->back()->with("success", $msg);
    }
}
