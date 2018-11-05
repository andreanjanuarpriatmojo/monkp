<?php 
namespace App\Http\Middleware;

use Closure;

class RedirectIfNotStudent {

	public function handle($r, Closure $n)
	{
		return (new RedirectIfUser('student'))->handle($r, $n);
	}

}
