<?php

namespace App\Http\Middleware;

use App;
use App\Models\Visitor;
use Carbon\Carbon;
use Closure;

class IdentifyVisitor
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
        if (App::environment('testing')) {
            return $next($request);
        }
        if (!\Auth::check() && !$request->session()->has('visitorId')) {
            $userAgent = $request->header('User-Agent');
            $hash = sha1($userAgent.$request->ip());
            $visitor = Visitor::find($hash);
            if (!$visitor) {
                $platform = [];
                preg_match('/(?<=\\()[a-z 0-9.]+(?=[,; ])/ui', $userAgent, $platform);
                $visitor = Visitor::create([
                    'id' => $hash,
                    'platform' => $platform[0] ?? null,
                    'isHuman' => count($platform)
                ]);
            }
            $request->session()->put('visitorId', $hash);
            if ($visitor->isStoringSession(Carbon::now())) {
                $visitor->visits()->create([]);
            } else {
                $visitor->update(['isHuman' => 0]);
                abort(403);
            }
        }
        return $next($request);
    }
}
