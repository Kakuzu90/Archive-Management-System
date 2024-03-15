<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use App\Models\College;
use App\Rules\UniqueEntry;
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

        return redirect()->back()->with("success", $msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        return $course;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        $request->validate([
            "name" => ["required", new UniqueEntry("courses", "name", $course->id)],
            "college" => "required|numeric"
        ]);

        $course->update([
            "name" => $request->name, 
            "slug" => $request->name,
            "college_id" => $request->college,
        ]);

        $course->wasChanged() && $msg = ["Course Updated", $request->name . " data has been update."];

        return redirect()->back()->with("info", $msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Course $course)
    {
        $request->validate([
            "password" => "required"
        ]);

        if (!verifyMe($request->password)) {
            return redirect()->back()->withErrors(["verify" => "The password is incorrect, please try again!"]);
        }

        $course->update(["deleted_at" => Carbon::now()]);

        $msg = ["Course Deleted", $course->name . " has been removed to the course data."];
        return redirect()->back()->with("danger", $msg);
    }
}
