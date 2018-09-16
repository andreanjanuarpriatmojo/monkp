<?php 
namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\RedirectResponse;

class RedirectIfUser {

	/**
	 * This actually $user->role.
	 */
	protected $user;

	public function __construct($user)
	{
		$this->user = $user;
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		$user = strtoupper($this->user);
		if(Auth::user())
		{
			if (Auth::user()->role != $user) {
				abort(401);
			}
		}
		return $next($request);
	}

}
