<?php

namespace App\Livewire\Website\Auth;

use App\Models\RegisterStep;
use App\Models\User;
use App\Services\OTPService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class ForgotPassword extends Component
{

    public $state = [];

    public function boot()
    {
        if (authCheck() && authUser()->otp == '' && authUser()->otp_verified == 1 && authUser()->forgot_password_otp == '') {
            return redirect()->to('/');
        }
    }

    public function render()
    {
        return view('livewire.website.auth.forgot-password');
    }

    public function login()
    {
        Validator::make($this->state, [
            'email' => 'required|email|max:100',
        ])->validate();
        $email = $this->state['email'];
        $user = User::where('email', $this->state['email'])->first() ?? RegisterStep::where('email', $email)->first();
        $otp = OTPService::generateOtp();
        OTPService::send($this->state['email'], $otp);
//        dd($user);
        if ($user != '') {

            // MANUAL LOGIN USER

            if (RegisterStep::where('email', $email)->exists()){
                $user->update([
                    'otp' => $otp,
                ]);
                session()->put('email', $email);
                $this->reset('state');
                return redirect()->route('user.forgotpassword.otp');

            }else{
                $user->update([
                    'otp' => '',
                    'otp_verified' => 0,
                    'forgot_password_otp' => $otp,
                ]);
                Auth::guard('web')->login($user);
                $this->reset('state');
                return redirect()->route('user.forgotpassword.otp');

            }

        } else {
            throw ValidationException::withMessages([
                'email' => 'email invalid',
            ]);
        }
    }

}
