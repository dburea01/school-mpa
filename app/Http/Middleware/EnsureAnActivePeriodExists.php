<?php
namespace App\Http\Middleware;

use App\Models\Period;
use Closure;
use Illuminate\Http\Request;

class EnsureAnActivePeriodExists
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $period = Period::where('school_id', $request->school->id)->where('current', true)->first();
        if ($period) {
            $request->merge(['period' => $period]);
            return $next($request);
        } else {
            return response()->view('errors.no_current_period');
        }
    }
}
