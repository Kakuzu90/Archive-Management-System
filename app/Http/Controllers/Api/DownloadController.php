<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BookDownload;
use App\Models\Books;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class DownloadController extends Controller
{
    public function __invoke(Books $books) {
        if (Auth::user()->college_id === $books->college_id || Auth::user()->role_id === Role::ADMIN) {

            if (Auth::user()->role_id !== Role::ADMIN && BookDownload::isNotAlreadyDownloaded($books->id)) {
                BookDownload::create(["user_id" => Auth::id(), "book_id" => $books->id]);
            }

            $path = storage_path("app/public/capstone/" . $books->id . ".zip");

            abort_if(!File::exists($path),404);

            $file = File::get($path);
            $type = File::mimeType($path);

            $response = Response::make($file, 200);
            $response->header("Content-Type", $type);

            return $response;
        }
    }
}
