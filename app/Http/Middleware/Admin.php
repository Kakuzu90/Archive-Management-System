<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
	 * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
	 */
	public function handle(Request $request, Closure $next)
	{
		if (!in_array(Auth::user()->role_id, [Role::ADMIN, Role::SUPER_ADMIN])) {
			abort(404);
		}

		if (Auth::user()->isAdmin() && is_null(Auth::user()->verified_at)) {
			if (!in_array($request->route()->getName(), ["admin.profile.index", "admin.profile.general", "admin.profile.password", "admin.profile.logs"])) {
				$msg = ["Restricted Area", "You cannot access the page if you updated your college info, please contact your administrator!"];
				return redirect()->route("admin.profile.index")->with("danger", $msg);
			}
		}

		return $next($request);
	}
}
