<?php

namespace App\Http\Middleware;

use App\Models\Visitor;
use Closure;

class CheckRobot
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->session()->has('visitorId')) {
            if (@!Visitor::find($request->session()->get('visitorId'))->isHuman) {
                abort(403);
            }
            return $next($request);
        }
        abort(403);
    }
}
