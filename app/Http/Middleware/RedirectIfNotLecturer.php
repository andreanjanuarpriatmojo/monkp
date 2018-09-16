<?php namespace App\Http\Middleware;

use Closure;

class RedirectIfNotLecturer {

	public function handle($request, Closure $next)
	{
		return (new RedirectIfUser('lecturer'))->handle($request, $next);
	}

}
