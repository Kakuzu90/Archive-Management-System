<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\BookReview;
use App\Models\Books;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request) {
        $query = $request->input("search");
        $year = $request->input("year");
        $type = $request->input("type");

        $books = Books::accepted()->where("college_id", Auth::user()->college_id);

        if ($query) {
            $books->where("title", "Like", "%$query%");
        }
        if ($year && $year !== "All") {
            $books->whereYear("published_at", $year);
        }
        if ($type && $type !== "All") {
            $books->where("book_type", "Like", "%$type%");
        }

        $books = $books->latest()->paginate(2)->withQueryString();

        return view("user.home", compact("books"));
    }

    public function book(Books $pdf) {
        $reviews = BookReview::where("book_id", $pdf->id)->skip(0)->take(5)->latest()->get();
        return view("user.book", compact("pdf", "reviews"));
    }

    public function store(Request $request, Books $pdf) {
        $request->validate([
            "rate" => "required|numeric",
            "comment" => "required"
        ]);

        BookReview::create([
            "rate" => $request->rate,
            "comment" => $request->comment,
            "user_id" => Auth::id(),
            "book_id" => $pdf->id,
        ]);

        $msg = ["Review Saved", "You have successfully submit a review of a study in titled with " . $pdf->title];
        $this->audit(ActivityLog::REVIEW, "Submitted a review in titled with " . $pdf->title);

        return redirect()->back()->with("success", $msg);
    }
}
