<?php

namespace App\Livewire\Website\Auth;

use App\Models\Organization;
use App\Models\RegisterStep;
use App\Models\User;
use App\Services\OTPService;
use App\Traits\HasModal;
use App\Traits\HasModalWebsite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Login extends Component
{
    use HasModalWebsite;
    public $state = [];

     public function boot()
    {
        if (authCheck() && authUser()->otp == '' && authUser()->otp_verified == 1 && authUser()->forgot_password_otp == '') {
            return redirect()->to('/');
        }
        // if (RegisterStepCheck()) {
        //     if (authRegisterStep()->otp != '') {
        //         return $this->redirectRoute('user.register.otp');
        //         // return redirect()->back();
        //         // dd('#HERE# WILL REDIRECT BACK');s
        //     }
        // } else {
        //     // dd('#HERE# not auth');
        // }

    }

    public function render()
    {
        return view('livewire.website.auth.login');
    }

    public function login()
    {
        Validator::make($this->state, [
            'email' => 'required|string|email|max:100',
            'password' => 'required|string|min:6',
            'remember'=>'nullable'
        ])->validate();
        $email = $this->state['email'];
        $password = $this->state['password'];
        $rememberMe = $this?->state['remember']??false ;
        // REGISTER REGITER_STEP MIDDLEWARE FIRST
        if (Auth::guard(REGISTER_STEP)->attempt(['email' => $email, 'password' => $password],$rememberMe)) {
            $user = RegisterStep::where('email', $this->state['email'])->firstOrFail();
            $otp = OTPService::generateOtp();
            $user->update([
                'otp' => $otp,
            ]);
            // $user->otp_verified = 0;
            // $user->otp = $otp;
            // $user->forgot_password_otp = '';
            // $user->save();
            OTPService::send($this->state['email'], $otp);
            return redirect()->route('user.register.otp');
        }
        // CHECK MAIN GUARD
        if (Auth::guard('web')->attempt(['email' => $email, 'password' => $password],$rememberMe)) {
            request()->session()->regenerate();
            $user = User::where('email', $this->state['email'])->firstOrFail();
//            $otp = OTPService::generateOtp();
//            $user->update([
//                'forgot_password_otp' => '',
//                'is_forgot_password_otp_verfied' => 0,
//                'otp_verified' => 0,
//                'otp' => $otp,
//            ]);
//            // $user->otp_verified = 0;
//            // $user->otp = $otp;
//            // $user->forgot_password_otp = '';
//            // $user->save();
//            OTPService::send($this->sendtate['email'], $otp);
// $user->update([
//     'otp' => $otp,
//     'otp_verified' => 0,
//     'forgot_password_otp' => '',
// ]);

// MANUAL LOGIN USER
            authUser()->update([
                'otp' => '',
                'otp_verified' => 1,
            ]);
            Auth::login($user,request('remember') ?? 0);
//            dd(\auth()->user());
//            $this->reset('state');
            return redirect()->route('user.organization.organizations');
        }
        throw ValidationException::withMessages([
            'email' => __('app.wrong_username_or_password'),
        ]);
    }
}
