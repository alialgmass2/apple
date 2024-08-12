<?php

namespace App\Http\Middleware\User;

use Closure;
use Illuminate\Http\Request;
use Log;
use Symfony\Component\HttpFoundation\Response;

class HandleRegisterOTPMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        return $next($request);
        Log::info('will handlCheck middleware redirection');
        if (RegisterStepCheck()) {
            if (authRegisterStep()->otp != '') {
                return redirect()->route('user.register.otp');
            }
        } elseif (authCheck()) {
            // FORGAT PASSWORD STEP ONE TO OTP
            if (authUser()->forgot_password_otp != '' && authUser()->is_forgot_password_otp_verfied == 0 && authUser()->otp_verified == 0) {
                return redirect()->route('user.forgotpassword.otp');
                // dd('forgat password',authUser());
            } elseif (authUser()->forgot_password_otp != '' && authUser()->is_forgot_password_otp_verfied == 1 && authUser()->otp_verified == 0) {
                return redirect()->route('user.forgotpassword.new');
            } elseif (authUser()->otp != '' && authUser()->otp_verified == 0) {
                return redirect()->route('user.login.otp');
            } elseif (authUser()->otp == '' && authUser()->otp_verified == 1 && authUser()->forgot_password_otp == '') {
                // AFTER LOGIN AS NORMAL USER WILL MOVE OTHER LOGIN IN TO LOGIN IN BOOT
                return $next($request);
                // return redirect()->route('user.organization.organizations');
            }
            // else {
            //     // AFTER LOGIN AS NORMAL USER WILL MOVE OTHER LOGIN IN TO LOGIN IN BOOT
            //     return $next($request);
            // }
            // add
            // Log::info('toched main auth');
            // dd('#HERE# toched main auth');
            // if (condition) {
            //     # code...
            // }
        } else {
            return $next($request);
        }

    }
}
