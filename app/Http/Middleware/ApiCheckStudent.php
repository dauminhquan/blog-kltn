<?php

namespace App\Http\Middleware;

use Closure;

class ApiCheckStudent
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
        if(Auth::user()->authentication == 3)
        {
            return $next($request);
        }
        return response()->json([
            'message' => 'Bạn không đủ quyền'
        ],406);
    }
}