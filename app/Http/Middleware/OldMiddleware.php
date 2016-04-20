<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Redirect;
class OldMiddleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (!Session::has('user_id')) {
            return Redirect::action('Admin\LoginController@login');
        }
        return $next($request);
    }
}
