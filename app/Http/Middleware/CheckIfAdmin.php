<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckIfAdmin {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        if ($request->user()->user_role !== 'admin') {
          return view('403');
        }
        return $next($request);
    }

}
