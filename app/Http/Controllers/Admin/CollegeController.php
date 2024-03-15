<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\College;
use App\Rules\UniqueEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CollegeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colleges = College::latest()->get();
        return view("admin.college", compact("colleges"));
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
            "name" => ["required", new UniqueEntry("colleges", "name")]
        ]);

        College::create(["name" => $request->name, "slug" => $request->name]);

        $msg = ["New College Added", $request->name . " has been added to the college data."];

        return redirect()->back()->with("success", $msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\College  $college
     * @return \Illuminate\Http\Response
     */
    public function show(College $college)
    {
        return $college;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\College  $college
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, College $college)
    {
        $request->validate([
            "name" => ["required", new UniqueEntry("colleges", "name", $college->id)]
        ]);

        $college->update(["name" => $request->name, "slug" => $request->name]);

        $college->wasChanged() && $msg = ["College Updated", $request->name . " data has been update."];

        return redirect()->back()->with("info", $msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\College  $college
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, College $college)
    {
        $request->validate([
            "password" => "required"
        ]);

        if (!verifyMe($request->password)) {
            return redirect()->back()->withErrors(["verify" => "The password is incorrect, please try again!"]);
        }

        $college->update(["deleted_at" => Carbon::now()]);

        $msg = ["College Deleted", $college->name . " has been removed to the college data."];
        return redirect()->back()->with("danger", $msg);
    }
}
