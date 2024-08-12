<?php

namespace App\Livewire\Website\Auth;

use App\Models\User;
use App\Services\OTPService;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class LoginOtp extends Component
{

    public $otp_1;
    public $otp_2;
    public $otp_3;
    public $otp_4;


    public function boot()
    {
        // if (authCheck() && authUser()->forgot_password_otp != '' && authUser()->is_forgot_password_otp_verfied == 1 && authUser()->otp_verified == 0) {
        // } else {
        //     return redirect()->to('/');
        // }
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
        // if (authCheck() && authUser()->otp_verified == 0) {
        //     // abort(501,'illiage access');
        //     // back();
        // } else {
        //     return back();
        // }
        return view('livewire.website.auth.login-otp');
    }

    public function resend()
    {
        $otp = OTPService::generateOtp();
        authUser()->update([
            'otp' => $otp,
        ]);
        OTPService::send(authUser()->email, $otp);
        $this->resetErrorBag();
        $this->reset('otp_1', 'otp_2', 'otp_3', 'otp_4');
        session()->flash('success', __('app.data_saved'));

    }

    public function verifiy()
    {
        $this->validate([
            'otp_1' => 'required|integer|min:1',
            'otp_2' => 'required|integer|min:1',
            'otp_3' => 'required|integer|min:1',
            'otp_4' => 'required|integer|min:1',
        ]);
        $merageOtps = $this->otp_1 . $this->otp_2 . $this->otp_3 . $this->otp_4;
        $eegisterStepToFinishCheck = User::where('otp', $merageOtps);
        if ($eegisterStepToFinishCheck->count() > 0) {
            authUser()->update([
                'otp' => '',
                'otp_verified' => 1,
            ]);
            return redirect()->route('user.organization.organizations');

        } else {
            throw ValidationException::withMessages(['otp_1' => 'Otp Invalid']);
        }

    }
}
