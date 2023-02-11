<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $method = "get";
        $url = env("AUTH_SERVICE_URL") . "authentication/show";

        $response = Http::withHeaders([
            'bearrer' => request()->header("bearrer"),
            'refresh' => request()->header("refresh")
        ])->$method($url);

        request()->merge([
            'bearrer' => $response->header("bearrer"),
            'refresh' => $response->header("refresh")
        ]);

        return $response->failed() ? "hata" : $next($request);
    }
}
