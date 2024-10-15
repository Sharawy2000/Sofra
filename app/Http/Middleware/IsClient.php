<?php

namespace App\Http\Middleware;

use App\Traits\Helper;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsClient
{
    use Helper;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $client = auth()->guard('client')->user();

        if(!$client){
            return $this->responseJson('لا يوجد عميل',null,403);
        }
        return $next($request);
    }
}
