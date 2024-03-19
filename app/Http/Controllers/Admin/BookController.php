<?php

namespace App\Http\Controllers\Admin;

use App\Models\Books;
use App\Rules\UniqueEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Books::latest()->get();
        return view("admin.book", compact("books"));
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
            "user" => "required|numeric",
            "file" => "required|mimes:zip",
            "title" => ["required", new UniqueEntry("books", "title")],
            "book_type" => "required",
            "college" => "required|numeric",
            "published" => "required|date|date_format:Y-m-d",
            "abstract" => "required",
        ]);

        $book = Books::create([
            "user_id" => $request->user,
            "title" => $request->title,
            "slug" => $request->title,
            "book_type" => $request->book_type,
            "college_id" => $request->college,
            "published_at" => $request->publish,
            "abstract" => $request->abstract,
            "book_status" => Books::ACCEPTED,
        ]);

        if ($request->hasFile("file")) {
            $filename = $book->id . ".zip";
            $request->file("file")->store("capstone", $filename, "local");
        }

        $msg = ["New Book Added", $request->title . " has been added to the book data."];

        return redirect()->back()->with("success", $msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Books  $books
     * @return \Illuminate\Http\Response
     */
    public function show(Books $books)
    {
        return $books;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Books  $books
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Books $books)
    {
        $request->validate([
            "user" => "required|numeric",
            "file" => "nullable|mimes:zip",
            "title" => ["required", new UniqueEntry("books", "title", $books->id)],
            "book_type" => "required",
            "college" => "required|numeric",
            "published" => "required|date|date_format:Y-m-d",
            "abstract" => "required",
        ]);

        $books->update([
            "user_id" => $request->user,
            "title" => $request->title,
            "slug" => $request->title,
            "book_type" => $request->book_type,
            "college_id" => $request->college,
            "published_at" => $request->publish,
            "abstract" => $request->abstract,
        ]);

        if ($request->hasFile("file")) {
            $filename = $books->id . ".zip";
            $request->file("file")->store("capstone", $filename, "local");
        }

        $books->wasChanged() && $msg = ["Book Updated", $books->title . " data has been update."];

        return redirect()->back()->with("info", $msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Books  $books
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Books $books)
    {
        $request->validate([
            "password" => "required"
        ]);

        if (!verifyMe($request->password)) {
            return redirect()->back()->withErrors(["verify" => "The password is incorrect, please try again!"]);
        }

        $books->update(["deleted_at" => Carbon::now()]);

        $msg = ["Book Deleted", $books->name . " has been removed to the book data."];
        return redirect()->back()->with("danger", $msg);
    }

    public function review(Books $book) {
        return view("admin.show.review", compact("book"));
    }
}
