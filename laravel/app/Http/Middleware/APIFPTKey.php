<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class APIFPTKey
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
        $key = 'Basic ' . md5('fpt-api:2aHP2hRuRxa6zRXMrhDR');
        //$a = $request->header('Authorization');
        if ($request->header('Authorization') == $key) {

            //return $next($request);
            //return response()->json('OK', 200);
            $response = $next($request);

            $response->headers->set('Content-Type', 'application/json');

            return $response;
        } else {
            return response()->json([
                'status' => 0,
                'desc' => 'Authorization has been denied for this request. Please check username or password',
            ], 401);
        }
    }
}
