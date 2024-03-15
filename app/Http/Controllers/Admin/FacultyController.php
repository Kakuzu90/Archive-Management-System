<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use App\Rules\UniqueEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faculties = User::faculty()->latest()->get();
        return view("admin.faculty", compact("faculties"));
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
        ]);

        $user = User::create([
            "first_name" => $request->first_name,
            "middle_name" => $request->middle_name,
            "last_name" => $request->last_name,
            "username" => $request->username,
            "password" => $request->password,
            "college_id" => $request->college,
            "role_id" => Role::FACULTY,
            "verified_at" => Carbon::now(),
        ]);

        $msg = ["New Faculty Added", $user->fullname . " has been added to the faculty data."];

        return redirect()->back()->with("success", $msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $faculty
     * @return \Illuminate\Http\Response
     */
    public function show(User $faculty)
    {
        return $faculty;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $faculty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $faculty)
    {
        $request->validate([
            "first_name" => "required",
            "middle_name" => "required",
            "last_name" => "required",
            "username" => ["required", new UniqueEntry("users", "username", $faculty->id)],
            "password" => "required|confirmed",
            "college" => "required|numeric",
        ]);

        $update = [
            "first_name" => $request->first_name,
            "middle_name" => $request->middle_name,
            "last_name" => $request->last_name,
            "username" => $request->username,
            "college_id" => $request->college,
        ];

        if ($request->filled("password")) {
            $update["password"] = $request->password;
        }

        $faculty->update($update);

        $faculty->wasChanged() && $msg = ["Faculty Updated", $faculty->fullname . " data has been update."];

        return redirect()->back()->with("info", $msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $faculty
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $faculty)
    {
        $request->validate([
            "password" => "required"
        ]);

        if (!verifyMe($request->password)) {
            return redirect()->back()->withErrors(["verify" => "The password is incorrect, please try again!"]);
        }

        $faculty->update(["deleted_at" => Carbon::now()]);

        $msg = ["Faculty Deleted", $faculty->name . " has been removed to the faculty data."];
        return redirect()->back()->with("danger", $msg);
    }
}
