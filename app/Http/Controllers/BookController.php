<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\BookReview;
use App\Rules\UniqueEntry;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("user.book.create");
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
            "user_id" => Auth::id(),
            "title" => $request->title,
            "slug" => $request->title,
            "authors" => $implodeAuthors,
            "book_type" => $implodeBook,
            "college_id" => Auth::user()->college_id,
            "course_id" => $request->course,
            "published_at" => $request->published,
            "abstract" => $request->abstract,
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Books  $my_book
     * @return \Illuminate\Http\Response
     */
    public function show(Books $my_book)
    {
        $pdf = $my_book;
        $reviews = BookReview::where("book_id", $pdf->id)->skip(0)->take(5)->latest()->get();
        return view("user.book.show", compact("pdf", "reviews"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Books  $my_book
     * @return \Illuminate\Http\Response
     */
    public function edit(Books $my_book)
    {
        $book = $my_book;
        return view("user.book.edit", compact("book"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Books  $my_book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Books $my_book)
    {
        $request->validate([
            "authors" => "required",
            "file" => "nullable|mimes:pdf",
            "title" => ["required", new UniqueEntry("books", "title", $my_book->id)],
            "book_type" => "required",
            "course" => "required|numeric",
            "published" => "required|date|date_format:Y-m-d",
            "abstract" => "required",
            "status" => "nullable|numeric"
        ]);

        $decodeAuthors = json_decode($request->authors, true);
        $decodeBook = json_decode($request->book_type, true);
        $valueAuthors = array_column($decodeAuthors, "value");
        $valueBook = array_column($decodeBook, "value");
        $implodeAuthors = implode(",", $valueAuthors);
        $implodeBook = implode(",", $valueBook);
        
        $update = [
            "title" => $request->title,
            "slug" => $request->title,
            "authors" => $implodeAuthors,
            "book_type" => $implodeBook,
            "course_id" => $request->course,
            "published_at" => $request->published,
            "abstract" => $request->abstract,
        ];

        if ($request->filled("status")) {
            $update["status"] = $request->status;
        }

        $my_book->update($update);

        if ($request->hasFile("file")) {
            $filename = $my_book->id . ".pdf";
            $request->file("file")->storeAs("capstone", $filename, "local");
        }
        if ($my_book->wasChanged()) {
            $msg = ["Book Updated", $my_book->title . " data has been updated."];
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
    public function destroy(Books $book)
    {
        //
    }
}
