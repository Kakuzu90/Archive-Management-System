<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use App\Rules\UniqueEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Models\ActivityLog;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = User::admin()->latest()->get();
        return view("admin.admin", compact("admins"));
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
            "avatar" => "required|numeric",
        ]);

        $user = User::create([
            "first_name" => $request->first_name,
            "middle_name" => $request->middle_name,
            "last_name" => $request->last_name,
            "username" => $request->username,
            "password" => $request->password,
            "college_id" => $request->college,
            "role_id" => Role::ADMIN,
            "verified_at" => Carbon::now(),
            "avatar" => $request->avatar,
        ]);

        $msg = ["New Admin Added", $user->fullname . " has been added to the admin data."];
        $this->audit(ActivityLog::ADD, $msg[1]);

        return redirect()->back()->with("success", $msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(User $admin)
    {
        return $admin;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $admin)
    {
        $request->validate([
            "first_name" => "required",
            "middle_name" => "required",
            "last_name" => "required",
            "username" => ["required", new UniqueEntry("users", "username", $admin->id)],
            "password" => "nullable|confirmed",
            "college" => "required|numeric",
            "avatar" => "required|numeric",
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

        if ($request->filled("status") && !$admin->verified_at) {
            $update["verified_at"] = Carbon::now();
        }

        if (!$request->filled("status") && $admin->verified_at) {
            $update["verified_at"] = null;
        }

        $admin->update($update);

        if ($admin->wasChanged()) {
            $msg = ["Admin Updated", $admin->fullname . " data has been updated."];
            $this->audit(ActivityLog::EDIT, $msg[1]);
            return redirect()->back()->with("info", $msg);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $admin)
    {
        $request->validate([
            "password" => "required"
        ]);

        if (!verifyMe($request->password)) {
            return redirect()->back()->withErrors(["verify" => "The password is incorrect, please try again!"]);
        }

        $admin->update(["deleted_at" => Carbon::now()]);
        $msg = ["Admin Deleted", $admin->name . " has been removed to the admin data."];
        $this->audit(ActivityLog::DELETE, $msg[1]);
        return redirect()->back()->with("danger", $msg);
    }
}
