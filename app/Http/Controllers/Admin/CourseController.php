<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use App\Models\College;
use App\Rules\UniqueEntry;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::latest()->get();
        $colleges = College::latest()->get();
        return view("admin.course", compact("courses", "colleges"));
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
            "name" => ["required", new UniqueEntry("courses", "name")],
            "college" => "required|numeric"
        ]);

        Course::create([
            "name" => $request->name, 
            "slug" => $request->name,
            "college_id" => $request->college,
        ]);

        $msg = ["New Course Added", $request->name . " has been added to the course data."];
        $this->audit(ActivityLog::ADD, $msg[1]);

        return redirect()->back()->with("success", $msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $program
     * @return \Illuminate\Http\Response
     */
    public function show(Course $program)
    {
        return $program;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $program
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $program)
    {
        $request->validate([
            "name" => ["required", new UniqueEntry("courses", "name", $program->id)],
            "college" => "required|numeric"
        ]);

        $program->update([
            "name" => $request->name, 
            "slug" => $request->name,
            "college_id" => $request->college,
        ]);

        if ($program->wasChanged()) {
            $msg = ["Course Updated", $request->name . " data has been updated."];
            $this->audit(ActivityLog::EDIT, $msg[1]);
            return redirect()->back()->with("info", $msg);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $program
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Course $program)
    {
        $request->validate([
            "password" => "required"
        ]);

        if (!verifyMe($request->password)) {
            return redirect()->back()->withErrors(["verify" => "The password is incorrect, please try again!"]);
        }

        $program->update(["deleted_at" => Carbon::now()]);
        $msg = ["Course Deleted", $program->name . " has been removed to the course data."];
        $this->audit(ActivityLog::DELETE, $msg[1]);
        return redirect()->back()->with("danger", $msg);
    }
}
