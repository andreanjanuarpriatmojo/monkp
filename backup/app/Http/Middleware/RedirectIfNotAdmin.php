<?php namespace App\Http\Middleware;

use Closure;

class RedirectIfNotAdmin {

	public function handle($request, Closure $next)
	{
		return (new RedirectIfUser('admin'))->handle($request, $next);
	}

}
