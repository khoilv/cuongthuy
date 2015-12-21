<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Redirect;
class MaintenanceMiddleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (file_exists("public/data/maintenance.dat")) {
            list($start_date, $end_date, $message) = file("public/data/maintenance.dat", FILE_IGNORE_NEW_LINES);
            if (strtotime($start_date) <= strtotime('now') && strtotime($end_date) >= strtotime('now')){
                return Redirect::action('Frontend\MaintenanceController@index');
            }
        }
        return $next($request);
    }
}
