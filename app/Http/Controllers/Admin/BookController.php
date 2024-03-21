<?php

namespace App\Http\Controllers\Admin;

use App\Models\Books;
use App\Rules\UniqueEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->isAdmin()) {
            $books = Books::where("college_id", Auth::user()->college_id)->latest()->get();
        }else {
            $books = Books::latest()->get();
        }
        return view("admin.book.index", compact("books"));
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
            "authors" => "required",
            "file" => "required|mimes:pdf",
            "title" => ["required", new UniqueEntry("books", "title")],
            "book_type" => "required",
            "course" => "required|numeric",
            "published" => "required|date|date_format:Y-m-d",
            "abstract" => "required",
        ]);

        $decodeAuthors = json_decode($request->authors, true);
        $decodeBook = json_decode($request->book_type, true);
        $valueAuthors = array_column($decodeAuthors, "value");
        $valueBook = array_column($decodeBook, "value");
        $implodeAuthors = implode(",", $valueAuthors);
        $implodeBook = implode(",", $valueBook);

        $book = Books::create([
            "user_id" => $request->user,
            "title" => $request->title,
            "slug" => $request->title,
            "authors" => $implodeAuthors,
            "book_type" => $implodeBook,
            "college_id" => Auth::user()->isAdmin() ? Auth::user()->college_id : $request->college,
            "course_id" => $request->course,
            "published_at" => $request->published,
            "abstract" => $request->abstract,
            "book_status" => Books::ACCEPTED,
            "uploaded_by" => Auth::user()->role_id,
        ]);

        if ($request->hasFile("file")) {
            $filename = $book->id . ".pdf";
            $request->file("file")->storeAs("capstone", $filename, "local");
        }

        $msg = ["New Book Added", $request->title . " has been added to the book data."];
        $this->audit(ActivityLog::ADD, $msg[1]);

        return redirect()->back()->with("success", $msg);
    }

    public function create() {
        return view("admin.book.create");
    }

    public function edit(Books $book) {
        return view("admin.book.edit", compact("book"));
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
     * @param  \App\Models\Books  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Books $book)
    {
        $request->validate([
            "user" => "required|numeric",
            "authors" => "required",
            "file" => "nullable|mimes:pdf",
            "title" => ["required", new UniqueEntry("books", "title", $book->id)],
            "book_type" => "required",
            "course" => "required|numeric",
            "published" => "required|date|date_format:Y-m-d",
            "abstract" => "required",
            "status" => "required|numeric"
        ]);

        $decodeAuthors = json_decode($request->authors, true);
        $decodeBook = json_decode($request->book_type, true);
        $valueAuthors = array_column($decodeAuthors, "value");
        $valueBook = array_column($decodeBook, "value");
        $implodeAuthors = implode(",", $valueAuthors);
        $implodeBook = implode(",", $valueBook);

        $book->update([
            "user_id" => $request->user,
            "title" => $request->title,
            "slug" => $request->title,
            "authors" => $implodeAuthors,
            "book_type" => $implodeBook,
            "college_id" => Auth::user()->isAdmin() ? Auth::user()->college_id : $request->college,
            "course_id" => $request->course,
            "published_at" => $request->published,
            "abstract" => $request->abstract,
            "book_status" => $request->status,
        ]);

        if ($request->hasFile("file")) {
            $filename = $book->id . ".pdf";
            $request->file("file")->storeAs("capstone", $filename, "local");
        }
        if ($book->wasChanged()) {
            $msg = ["Book Updated", $book->title . " data has been updated."];
            $this->audit(ActivityLog::EDIT, $msg[1]);
            return redirect()->back()->with("info", $msg);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Books  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Books $book)
    {
        $request->validate([
            "password" => "required"
        ]);

        if (!verifyMe($request->password)) {
            return redirect()->back()->withErrors(["verify" => "The password is incorrect, please try again!"]);
        }

        $book->update(["deleted_at" => Carbon::now()]);

        $msg = ["Book Deleted", $book->name . " has been removed to the book data."];
        return redirect()->back()->with("danger", $msg);
    }

    public function review(Books $book) {
        return view("admin.show.review", compact("book"));
    }
}
