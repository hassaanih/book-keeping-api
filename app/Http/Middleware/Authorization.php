<?php

namespace App\Http\Middleware;

use App\Enums\UserTypeEnums;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class Authorization
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
        if(Auth::user()->user_type_id === UserTypeEnums::MANAGER){
            return $next($request);
        }else{
            return response()->json(['error' => 'Unauthorized'], Response::HTTP_FORBIDDEN);
        }
    }
}
