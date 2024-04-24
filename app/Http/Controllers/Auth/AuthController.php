<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\College;
use App\Models\Role;
use App\Models\Setting;
use App\Models\User;
use App\Rules\UniqueEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
	public function index()
	{
		$setting = Setting::about()->get();
		return view("welcome", compact("setting"));
	}

	public function loginIndex()
	{
		return view("auth.login");
	}

	public function login(Request $request)
	{
		$request->validate([
			"username" => "required",
			"password" => "required",
		]);

		if (Auth::attempt(["username" => $request->username, "password" => $request->password], $request->remember)) {
			$this->audit(ActivityLog::LOGIN, "Login Success");
			if (in_array(Auth::user()->role_id, [Role::ADMIN, Role::SUPER_ADMIN])) {
				if (!Auth::user()->verified_at) {
					Auth::logout();
					return redirect()->back()->withInput()
						->withErrors(["login_failed" => "Pending account, please contact your administrator!"]);
				}
				return redirect()->route("admin.dashboard")->withStatus("welcome");
			}
			if (Auth::user()->role_id === Role::STUDENT) {
				return redirect()->route("student.home")->withStatus("welcome");
			}
			if (Auth::user()->role_id === Role::FACULTY) {
				return redirect()->route("faculty.home")->withStatus("welcome");
			}
		}

		return redirect()->back()->withInput()
			->withErrors(["login_failed" => "The credentials provided does not exist in our database."]);
	}

	public function registerV1(Request $request)
	{
		$colleges = College::latest()->get();
		return view("auth.student", compact("colleges"));
	}

	public function registerV2(Request $request)
	{
		$colleges = College::latest()->get();
		return view("auth.faculty", compact("colleges"));
	}

	public function submitV1(Request $request)
	{
		$request->validate([
			"first_name" => "required",
			"middle_name" => "required",
			"last_name" => "required",
			"username" => ["required", new UniqueEntry("users", "username")],
			"password" => "required|confirmed",
			"college" => "required|numeric",
			"year" => "required",
			"avatar" => "required|numeric",
		]);

		$user = User::create([
			"first_name" => $request->first_name,
			"middle_name" => $request->middle_name,
			"last_name" => $request->last_name,
			"username" => $request->username,
			"password" => $request->password,
			"college_id" => $request->college,
			"year_level" => $request->year,
			"role_id" => Role::STUDENT,
			"avatar" => $request->avatar,
		]);

		$this->audit(ActivityLog::ADD, "Registered", $user->id);
		$msg = ["Register Complete", "Welcome to the platform " . $user->fullname . ", please wait till the administrator to verify your account."];

		return redirect()->route("login")->with("success", $msg);
	}

	public function submitV2(Request $request)
	{
		$request->validate([
			"first_name" => "required",
			"middle_name" => "required",
			"last_name" => "required",
			"username" => ["required", new UniqueEntry("users", "username")],
			"password" => "required|confirmed",
			"college" => "required|numeric",
			"avatar" => "required|numeric",
		]);

		$user = User::create([
			"first_name" => $request->first_name,
			"middle_name" => $request->middle_name,
			"last_name" => $request->last_name,
			"username" => $request->username,
			"password" => $request->password,
			"college_id" => $request->college,
			"role_id" => Role::FACULTY,
			"avatar" => $request->avatar,
		]);

		$this->audit(ActivityLog::ADD, "Registered", $user->id);
		$msg = ["Register Complete", "Welcome to the platform " . $user->fullname . ", please wait till the administrator to verify your account."];

		return redirect()->route("login")->with("success", $msg);
	}

	public function logout()
	{
		$this->audit(ActivityLog::LOGOUT, "Logout Success");
		Auth::logout();
		return redirect()->route("login")->withErrors(["logout" => "You have successfully logout to the platform."]);
	}
}
