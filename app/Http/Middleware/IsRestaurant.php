<?php

namespace App\Http\Middleware;

use App\Traits\Helper;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsRestaurant
{
    use Helper;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $restaurant = auth()->guard('restaurant')->user();

        if(!$restaurant){
            return $this->responseJson('لا يوجد مطعم',null,403);
        }
        return $next($request);
    }
}
