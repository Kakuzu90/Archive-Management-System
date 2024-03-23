<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\BookDownload;
use App\Models\Books;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class DownloadController extends Controller
{
    public function __invoke(Books $book) {
        if (Auth::user()->isSuperAdmin() || (Auth::user()->college_id === $book->college_id || Auth::user()->isAdmin())) {

            if (!in_array(Auth::user()->role_id, [Role::ADMIN, Role::SUPER_ADMIN]) && BookDownload::isNotAlreadyDownloaded($book->id)) {
                BookDownload::create(["user_id" => Auth::id(), "book_id" => $book->id]);
                $this->audit(ActivityLog::DOWNLOAD, "Downloaded a book with title of " . $book->title);
            }

            $path = storage_path("app/capstone/" . $book->id . ".pdf");

            abort_if(!File::exists($path), 404);

            $file = File::get($path);
            $type = File::mimeType($path);

            $response = Response::make($file, 200);
            $response->header("Content-Type", $type);

            return $response;
        }
    }
}
