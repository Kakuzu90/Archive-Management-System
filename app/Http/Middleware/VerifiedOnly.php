<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class VerifiedOnly
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
		if (is_null(Auth::user()->verified_at)) {
			$msg = ["Not Authorized", "You cannot access the home page if your account is not verified by the administrator."];
			$route = redirect()->route("faculty.profile.index")->with("danger", $msg);
			if (Auth::user()->isStudent()) {
				$route = redirect()->route("student.profile.index")->with("danger", $msg);
			}
			return $route;
		}

		if (Carbon::today()->gt(Auth::user()->verified_till_at)) {
			$msg = ["Account Expired", "You cannot access the home page because your account is expired please contact your administrator."];
			$route = redirect()->route("faculty.profile.index")->with("danger", $msg);
			if (Auth::user()->isStudent()) {
				$route = redirect()->route("student.profile.index")->with("danger", $msg);
			}
			return $route;
		}

		return $next($request);
	}
}
