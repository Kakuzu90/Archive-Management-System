<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Books;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        return view("user.home");
    }

    public function book(Books $book) {
        return view("user.book", compact("book"));
    }
}
