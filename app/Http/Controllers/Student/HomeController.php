<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\BookReview;
use App\Models\Books;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        return view("user.home");
    }

    public function book(Books $pdf) {
        $reviews = BookReview::where("book_id", $pdf->id)->skip(0)->take(5)->get();
        return view("user.book", compact("pdf", "reviews"));
    }
}
