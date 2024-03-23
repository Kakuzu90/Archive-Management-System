<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BookReview;
use App\Models\Books;
use Illuminate\Http\Request;

class LoadReviewController extends Controller
{
    public function __invoke(Books $book, Request $request) {
        $page = $request->input("page", 1);
        $perPage = 5;
        $data = BookReview::where("book_id", $book->id)->skip(($page - 1) * $perPage)->take($perPage)->latest()->get();

        $results = $data->map(function ($item) {
            $content = '<div class="col-12"><div class="card"><div class="card-body"><div class="d-flex justify-content-start"><div class="avatar"><img src="'.$item->user->avatar().'" class="rounded-circle" alt="Avatar" /></div>';
            $content .= '<div class="col ms-3"><div class="read-only-ratings px-0 mb-1" data-value="'.$item->rate.'" data-rateyo-read-only="true"></div><h6 class="text-dark fw-bold mb-1">'.$item->user->fullname.'</h6>';
            $content .= '<p class="mb-1 py-1 border-top border-bottom">'.$item->comment.'</p><span class="text-dark">'.$item->created_at->format("F d, Y").'</span></div></div></div></div></div>';
            return $content;
        });

        return response()->json([
            "data"=> $results,
            "hasMore" => BookReview::where("book_id", $book->id)->count() > ($page * $perPage)
        ]);
    }
}
