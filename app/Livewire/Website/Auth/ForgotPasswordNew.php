<?php

namespace App\Livewire\Website\Auth;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class ForgotPasswordNew extends Component
{
    public $state = [];

    public function boot()
    {
//        if (authCheck() && authUser()->forgot_password_otp != '' && authUser()->is_forgot_password_otp_verfied == 1 && authUser()->otp_verified == 0) {
//        } else {
//            return redirect()->to('/');
//        }
//        if (authCheck() && authUser()->otp == '' && authUser()->otp_verified == 1 && authUser()->forgot_password_otp == '') {
//            return redirect()->to('/');
//        }

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

    public function mount()
    {
        $checkUser = User::where('forgot_password_otp', authUser()->forgot_password_otp)->where('is_forgot_password_otp_verfied', 1)->where('email', authUser()->email)->firstOrfail();

    }

    public function resetPasswordNow()
    {
        Validator::make($this->state, [
            'password' => ['required', 'string', 'min:6','max:100','confirmed',Password::min(6)->letters()->mixedCase()->numbers()->symbols()->uncompromised()],
            'password_confirmation' => 'required|string|min:6|max:100',
        ])->validate();
        $checkUser = User::where('forgot_password_otp', authUser()->forgot_password_otp)->where('is_forgot_password_otp_verfied', 1)->where('email', authUser()->email)->firstOrfail();
        if ($checkUser != '') {
            $checkUser->update([
                'forgot_password_otp' => '',
                'is_forgot_password_otp_verfied' => 0,
                'password' => $this->state['password'],
            ]);

            $this->reset('state');
            Auth::guard('web')->logout();
            session()->flash('success-reset-password', __('app.password_changed_message'));
            return redirect()->route('user.login');
        } else {
            Auth::logout();
            return redirect()->route('user.forgotpassword');
        }

    }

    public function render()
    {
        return view('livewire.website.auth.forgot-password-new');
    }
}
