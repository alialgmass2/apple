<?php

namespace App\Http\Middleware\User;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (authCheck() && authUser()->otp_verified == 1 && authUser()->otp == '' && authUser()->forgot_password_otp == '') {
            return $next($request);
        }
        // return redirect()->back();
        Auth::logout();
        return redirect()->route('user.login');


    }
}
