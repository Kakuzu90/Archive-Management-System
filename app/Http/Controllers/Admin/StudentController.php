<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use App\Rules\UniqueEntry;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$students = User::student()->latest()->get();
		return view("admin.student", compact("students"));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
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
			"date_valid" => "required|date|date_format:Y-m-d"
		]);

		$user = User::create([
			"first_name" => $request->first_name,
			"middle_name" => $request->middle_name,
			"last_name" => $request->last_name,
			"username" => $request->username,
			"password" => $request->password,
			"year_level" => $request->year,
			"college_id" => $request->college,
			"role_id" => Role::STUDENT,
			"verified_at" => Carbon::now(),
			"avatar" => $request->avatar,
			"verified_till_at" => $request->date_valid
		]);

		$msg = ["New Student Added", $user->fullname . " has been added to the student data."];
		$this->audit(ActivityLog::ADD, $msg[1]);
		return redirect()->back()->with("success", $msg);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function show(User $student)
	{
		return $student;
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\User  $student
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, User $student)
	{
		$request->validate([
			"first_name" => "required",
			"middle_name" => "required",
			"last_name" => "required",
			"username" => ["required", new UniqueEntry("users", "username", $student->id)],
			"password" => "nullable|confirmed",
			"college" => "required|numeric",
			"year" => "required",
			"avatar" => "required|numeric",
			"date_valid" => "required|date|date_format:Y-m-d"
		]);

		$update = [
			"first_name" => $request->first_name,
			"middle_name" => $request->middle_name,
			"last_name" => $request->last_name,
			"username" => $request->username,
			"year_level" => $request->year,
			"college_id" => $request->college,
			"verified_till_at" => $request->date_valid
		];

		if ($request->filled("password")) {
			$update["password"] = $request->password;
		}

		if ($request->filled("status") && !$student->verified_at) {
			$update["verified_at"] = Carbon::now();
		}

		if (!$request->filled("status") && $student->verified_at) {
			$update["verified_at"] = null;
		}

		$student->update($update);

		if ($student->wasChanged()) {
			$msg = ["Student Updated", $student->fullname . " data has been updated."];
			$this->audit(ActivityLog::EDIT, $msg[1]);
			return redirect()->back()->with("info", $msg);
		}

		return redirect()->back();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\User  $student
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Request $request, User $student)
	{
		$request->validate([
			"password" => "required"
		]);

		if (!verifyMe($request->password)) {
			return redirect()->back()->withErrors(["verify" => "The password is incorrect, please try again!"]);
		}

		$student->update(["deleted_at" => Carbon::now()]);
		$msg = ["Student Deleted", $student->name . " has been removed to the student data."];
		$this->audit(ActivityLog::DELETE, $msg[1]);
		return redirect()->back()->with("danger", $msg);
	}
}
