<?php

namespace App\Http\Controllers\Admin;

use App\Rules\UniqueEntry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
	public function index()
	{
		$user = Auth::user();
		return view("admin.profile", compact("user"));
	}

	public function general(Request $request)
	{
		$request->validate([
			"first_name" => "required",
			"last_name" => "required",
			"username" => ["required", new UniqueEntry("users", "username", Auth::id())],
			"password" => "required"
		]);

		if (!verifyMe($request->password)) {
			return redirect()->back()->withErrors(["verify" => "The password is incorrect, please try again!"]);
		}

		$user = User::where("id", Auth::id())->first();

		$update = [
			"first_name" => $request->first_name,
			"middle_name" => $request->middle_name,
			"last_name" => $request->last_name,
			"username" => $request->username,
		];


		if ($request->filled("college") && !$user->isSuperAdmin()) {
			$update["college_id"] = $request->college;
		}

		if ($request->filled("avatar")) {
			$update["avatar"] = $request->avatar;
		}

		$user->update($update);

		if ($user->wasChanged(['college_id'])) {
			$user->update([
				"verified_till_at" => NULL,
				"verified_at" => NULL,
			]);
		}

		if ($user->wasChanged()) {
			$msg = ["Account Updated", "You have successfully updated your account."];
			$this->audit(ActivityLog::EDIT, "Update personal information");
			return redirect()->back()->with("success", $msg);
		}

		return redirect()->back();
	}

	public function password(Request $request)
	{
		$request->validate([
			"password" => "required|confirmed",
			"old" => "required"
		]);

		if (!verifyMe($request->old)) {
			return redirect()->back()->withErrors(["verify" => "The password is incorrect, please try again!"]);
		}

		$user = User::where("id", Auth::id())->first();
		$user->update(["password" => $request->password]);
		$this->audit(ActivityLog::EDIT, "Update password");
		$msg = ["Password Updated", "You have successfully updated your password."];

		return redirect()->back()->with("success", $msg);
	}

	public function logs()
	{
		$logs = ActivityLog::where("user_id", Auth::id())->latest()->get();

		return view("admin.activity", compact("logs"));
	}
}
