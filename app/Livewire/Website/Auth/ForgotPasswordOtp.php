<?php

namespace App\Livewire\Website\Auth;

use App\Models\RegisterStep;
use App\Models\User;
use App\Services\OTPService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Session;

class ForgotPasswordOtp extends Component
{
    public $password;
    public $otp_1;
    public $otp_2;
    public $otp_3;
    public $otp_4;

    // public function mount()
    // {
    //     if (authCheck() && Session::exists('forgat-pass-otp-'.authUser()->id)) {
    //         $currentUrl = url()->current();
    //         $prevUrl = url()->previous();
    //         return  redirect()->to($prevUrl);
    //     }
    // }
    public function boot()
    {
        if (isset(authUser()->forgot_password_otp)){
            if (authCheck() && authUser()->forgot_password_otp != '' && authUser()->is_forgot_password_otp_verfied == 0 && authUser()->otp_verified == 0) {
            } elseif (authCheck() && authUser()->otp == '' && authUser()->otp_verified == 1 && authUser()->forgot_password_otp == '') {
                return redirect()->to('/');
            } else {
                return redirect()->to('/');
            }
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
        // if (authCheck() && authUser()->forgot_password_otp == '') {
        //     return redirect()->route('user.forgotpassword');
        //     abort(501, 'illiage access forgot password otp not generated');
        // }
        return view('livewire.website.auth.forgot-password-otp');
    }

    public function resend()
    {
        $otp = OTPService::generateOtp();
        authUser()->update([
            'forgot_password_otp' => $otp,
        ]);
        OTPService::send(authUser()->email, $otp);
        $this->resetErrorBag();
        $this->reset('otp_1', 'otp_2', 'otp_3', 'otp_4');
        session()->flash('success', __('app.otp_resent'));
    }

    public function resetPassword()
    {
        $this->validate([
            'otp_1' => 'required|integer|min:1',
            'otp_2' => 'required|integer|min:1',
            'otp_3' => 'required|integer|min:1',
            'otp_4' => 'required|integer|min:1',
            // 'password' => 'required|string|min:6|max:100',
        ]);
        $merageOtps = $this->otp_1 . $this->otp_2 . $this->otp_3 . $this->otp_4;
        if (session()->has('email') && ! User::where('email', session('email'))->exists()){
            $registerStepData = RegisterStep::where('email', \Illuminate\Support\Facades\Session::get('email'))->first();
            $user = User::create([
                'user_type' => $registerStepData->user_type,
                'region_id' => $registerStepData->region_id,
                'city_id' => $registerStepData->city_id,
                'education_level_id' => $registerStepData->education_level_id,
                'organization_id' => $registerStepData->organization_id,
                'email' => $registerStepData->email,
                'password' => Hash::make($registerStepData->password_without_hash),
                'forgot_password_otp' => $registerStepData->otp,
                'is_forgot_password_otp_verfied' =>0,
                'otp_verified' => 1,
            ]);
            $registerStepData->delete();
            Auth::login($user);
        }
        if (authUser() == null){
            $user = User::where('email', session('email'))->first();
            Auth::login($user);
        }
        $checkUser = User::where('forgot_password_otp', $merageOtps)->orWhere('otp', $merageOtps)->where('email', authUser()->email)->first();
        if ($checkUser != '') {
            $checkUser->is_forgot_password_otp_verfied = 1;
            $checkUser->save();
            return redirect()->route('user.forgotpassword.new');
            // $checkUser->update([
            //     'forgot_password_otp' => '',
            //     'password' => $this->password,
            // ]);

            // $this->reset('otp_1','otp_2','otp_3','otp_4','password');
            // Auth::logout();
            // return redirect()->route('user.login');

        } else {
            throw ValidationException::withMessages(['otp_1' => 'Otp Invalid']);
        }
    }

}
