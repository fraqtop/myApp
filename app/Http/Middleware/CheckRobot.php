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
        if (\App::environment('testing')) {
            return $next($request);
        }
        if ($request->session()->has('visitorId')) {
            if (@!Visitor::find($request->session()->get('visitorId'))->isHuman) {
                return redirect('/caught');
            }
            return $next($request);
        }
        return redirect('/caught');
    }
}
