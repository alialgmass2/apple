<?php

namespace App\Livewire\Website\Auth;

use App\Models\RegisterStep;
use App\Services\OTPService;
use App\Services\RegisterStepService;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class RegisterOtp extends Component
{

    public $otp_1;
    public $otp_2;
    public $otp_3;
    public $otp_4;
    public $parm;

    public function boot()
    {
//        if (RegisterStepCheck() && authRegisterStep()->otp != '') {
//        }else {
//            return redirect()->route('user.register.otp');
//            // return redirect()->to('/');
//        }

    }

    public function resend()
    {
        $resendRegisterData = RegisterStep::where('email', authRegisterStep()->email)->firstOrfail();
        $otp = OTPService::generateOtp();
        $resendRegisterData->otp = $otp;
        $resendRegisterData->save();
        // $resendRegisterData->update([
        //     'otp' => $otp,
        // ]);
        // SEND OTP
        $otpMail = $resendRegisterData->email;
        OTPService::send($otpMail, $otp);
        $this->resetErrorBag();
        $this->reset('otp_1', 'otp_2', 'otp_3', 'otp_4');
        session()->flash('success', __('app.data_saved'));
    }

    public function register()
    {
        $this->resetErrorBag();
        $this->validate([
            'otp_1' => 'required|integer|min:1',
            'otp_2' => 'required|integer|min:1',
            'otp_3' => 'required|integer|min:1',
            'otp_4' => 'required|integer|min:1',
        ]);
        $merageOtps = $this->otp_1 . $this->otp_2 . $this->otp_3 . $this->otp_4;
        // GET CHOSE ORGNIZATION
        $eegisterStepToFinishCheck = RegisterStep::where('email', authRegisterStep()->email)->where('otp', $merageOtps);
        if ($eegisterStepToFinishCheck->count() > 0) {
            $registerStepFinished = $eegisterStepToFinishCheck->firstOrfail();
            RegisterStepService::moveDataToUserTableAndHandleGuards($registerStepFinished);
            // $eegisterStepToFinishCheck->firstOrfail()->update([
            //     'email' => $this->email,
            //     'otp' => '',
            //     'step' => 4,
            // ]);
            // SAVE IN USER REGITER MODEL #INSIDE SERVICE
            // $user = User::create([
            //     'user_type' => $registerStepFinished->user_type,
            //     'region_id' => $registerStepFinished->region_id,
            //     'city_id' => $registerStepFinished->city_id,
            //     'education_level_id' => $registerStepFinished->education_level_id,
            //     'organization_id' => $registerStepFinished->organization_id,
            //     'email' => $registerStepFinished->email,
            //     // 'password' => 123456,
            //     'password' => $registerStepFinished->password,
            //     'otp_verified' => 1,
            // ]);
            // LOGOUT FROM GUARD REGISTER STEP #inside service
            // Auth::guard(REGISTER_STEP)->logout(); #inside service
            // LOGIN IN DEFAULT GUARD WEB
            // Auth::login($user); #inside service
            // DELETE THE DATA FROM  REGISTER STEP TABLE
            // $registerStepFinished->delete(); #inside service
            // MANUAL LOGIN USER #inside server
            // GO TO FINISH PAGE
            return redirect()->route('user.register.finish');
        } else {
            throw ValidationException::withMessages(['otp_1' => __('app.otp_invalid')]);
        }

    }

    public function render()
    {
        // Auth::guard(REGISTER_STEP)->logout();
        // dd('#HERE# ',RegisterStepCheck());
        // dd('#HERE# REGISTER OTP',Auth::guard(REGISTER_STEP)->user(),Auth::guard(REGISTER_STEP)->logout());
        // if (authCheck() && authUser()->otp_verified == 1) {
        //     redirect()->route('user.dashboard');
        // }
        // if ($this->currentStep == 3) {
        // $this->registerStepData = RegisterStep::where('email', $this->f_email_org)->first();
        // $registerStepOrgnization = Organization::where('id', $this->organization_id)->first();

        // }
        // if ($this->registerStepData != '' && $this->registerStepData->step == 3) {
        //     $this->currentStep = 4;
        // } else {
        //     $this->currentStep = $this->currentStep;
        // }

        return view('livewire.website.auth.register-otp');
    }

}
