<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function search(Request $request) {
        $search = $request->input("search");

        if ($search) {
            $query = User::where("last_name", "like", "%$search%");
            if (Auth::user()->isSuperAdmin()) {
                $query->orWhere("role_id", Role::SUPER_ADMIN);
            }
            if (Auth::user()->isAdmin()) {
                $query->where("college_id", Auth::user()->college_id);
            }
            return $query->get()->map(function($user) {
                return ["id" => $user->id, "text" => $user->fullname, "avatar" => $user->avatar(), "role" => $user->role->name];
            });
        }
    }
}
