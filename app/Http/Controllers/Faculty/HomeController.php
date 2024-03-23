<?php

namespace App\Http\Controllers\Faculty;

use App\Models\Books;
use App\Models\BookReview;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() {
        return view("user.home");
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
