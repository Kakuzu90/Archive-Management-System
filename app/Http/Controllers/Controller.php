<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function audit(int $type, string $context, int $id = null) {
        $array["type"] = $type;
        $array["context"] = $context;
        if ($id) {
            $array["user_id"] = $id;
        }
        ActivityLog::create($array);
    }
}
