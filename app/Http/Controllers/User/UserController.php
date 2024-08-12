<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function logout(Request $request)
    {
        if (authCheck()) {
            authUser()->update([
                'otp_verified' => 0,
            ]);
            Auth::guard('web')->logout();
        } elseif (registerStepCheck()) {
            Auth::guard(REGISTER_STEP)->logout();
        }
        // Auth::logout();
//        $request->session()->invalidate();
//        $request->session()->regenerateToken();
        return redirect()->route('user.login');
    }

}
