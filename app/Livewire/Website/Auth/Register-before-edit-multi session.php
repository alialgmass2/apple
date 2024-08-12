<?php

namespace App\Livewire\Website\Auth;

use App\Enums\UserType;
use App\Models\City;
use App\Models\EducationLevel;
use App\Models\Organization;
use App\Models\Region;
use App\Models\RegisterStep;
use App\Models\User;
use App\Services\OTPService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Locked;
use Livewire\Component;

class Register extends Component
{
    // public $user_type;
    public $region_id;
    public $city_id;
    public $education_level_id;
    public $organization_id;
    public $email;
    public $otp;

    #[Locked]
    public $totalSteps = 4;
    #[Locked]
    public $currentStep = 1;

    public $regions = [];
    public $cities = [];
    public $educationLevels = [];
    public $organizations = [];
    public $otp_1;
    public $otp_2;
    public $otp_3;
    public $otp_4;

    public $registerStepData;

    public function mount()
    {
        $this->currentStep = 1;
        $this->regions = Region::listDropdown()->get();
        $this->educationLevels = EducationLevel::listDropdown()->get();

    }

    public function updatedRegionId($value)
    {
        $this->cities = City::listDropdownByRegionId($value)->get();
    }
    public function updatedEducationLevelId($value)
    {
        $this->organizations = Organization::listDropdownByEducationLevelId($value)->get();
    }

    public function resend()
    {
        $eegisterStep = RegisterStep::byIpAddress(request()->ip())->firstOrfail();
        $otp = OTPService::generateOtp();
        $eegisterStep->update([
            'otp' => $otp,
        ]);
        // SEND OTP #hERE#
        $otpMail = $eegisterStep->email . '@' . $eegisterStep->organization->domain;
        OTPService::send($otpMail, $otp);
        $this->resetErrorBag();
        session()->flash('success', __('app.data_saved'));
    }

    public function testOtp()
    {
        $response = Http::acceptJson()->post("http://216.219.83.182/SendMail/public/api/sendMail", [
            // "to" => "talents@alexon.online",
            // "to" => "meshrf.emam@gmail.com",
            // "to" => "ali.ehab@alexondev.net",
            "to" => "testmail@greensaudi.exchange",
            "supject" => "test mail title from inside the code ###",
            "body" => "test mail body  from inside the code  ## " . now(),
        ]);
        dd($response->body());
    }

    public function increaseStep()
    {
        $this->resetErrorBag();
        $this->validateData();
        $this->currentStep++;
        if ($this->currentStep > $this->totalSteps) {
            $this->currentStep = $this->totalSteps;
        }
    }

    public function decreaseStep()
    {
        $this->resetErrorBag();
        $this->currentStep--;
        if ($this->currentStep < 1) {
            $this->currentStep = 1;
        }
    }

    public function validateData()
    {

        if ($this->currentStep == 1) {
            $this->validate([
                // 'user_type' => 'required|string|in:STUDENT,TEACHER',
                'region_id' => 'required|integer|exists:regions,id',
                'city_id' => 'required|integer|exists:cities,id',
            ]);

            $registerStepCheck = RegisterStep::where('ip', request()->ip());
            if ($registerStepCheck->count() > 0) {
                $registerStepCheck->first()->delete();
            }

            RegisterStep::create([
                'ip' => request()->ip(),
                'user_type' => UserType::STUDENT,
                'region_id' => $this->region_id,
                'city_id' => $this->city_id,
                'step' => 1,
            ]);

        } elseif ($this->currentStep == 2) {
            $this->validate([
                'education_level_id' => 'required|integer|exists:education_levels,id',
                'organization_id' => 'required|integer|exists:organizations,id',
            ]);
            $eegisterStep = RegisterStep::byIpAddress(request()->ip())->first()->update([
                'education_level_id' => $this->education_level_id,
                'organization_id' => $this->organization_id,
                'step' => 2,
            ]);

        } elseif ($this->currentStep == 3) {
            $this->validate([
                'email' => 'required|required|max:50',
            ]);
            $eegisterStep = RegisterStep::byIpAddress(request()->ip())->firstOrfail();
            $otp = OTPService::generateOtp();
            $otpMail = $this->email . '@' . $eegisterStep->organization->domain;
            $eegisterStep->update([
                'email' => $otpMail,
                'otp' => $otp,
                'step' => 3,
            ]);
            // SEND OTP #hERE#
            OTPService::send($otpMail, $otp);
        } elseif ($this->currentStep == 4) {
            $this->validate([
                'otp_1' => 'required|integer|min:1',
                'otp_2' => 'required|integer|min:1',
                'otp_3' => 'required|integer|min:1',
                'otp_4' => 'required|integer|min:1',
            ]);
        }
    }

    public function register()
    {
        $this->resetErrorBag();
        if ($this->currentStep == 4) {
            $this->validate([
                'otp_1' => 'required|integer|min:1',
                'otp_2' => 'required|integer|min:1',
                'otp_3' => 'required|integer|min:1',
                'otp_4' => 'required|integer|min:1',
            ]);
        }
        $merageOtps = $this->otp_1 . $this->otp_2 . $this->otp_3 . $this->otp_4;
        $eegisterStepToFinishCheck = RegisterStep::byIpAddress(request()->ip())->where('otp', $merageOtps);
        if ($eegisterStepToFinishCheck->count() > 0) {
            $tempRegister = $eegisterStepToFinishCheck->firstOrfail();
            // $eegisterStepToFinishCheck->firstOrfail()->update([
            //     'email' => $this->email,
            //     'otp' => '',
            //     'step' => 4,
            // ]);
            // SAVE IN REGITER MODEL
            $user = User::create([
                'user_type' => UserType::STUDENT,
                'region_id' => $tempRegister->region_id,
                'city_id' => $tempRegister->city_id,
                'education_level_id' => $tempRegister->education_level_id,
                'organization_id' => $tempRegister->organization_id,
                'email' => $tempRegister->email,
                'password' => 123456,
                'otp_verified' => 1
            ]);
            // RESET TEMP REGISTER
            $tempRegister->delete();
            // MANUAL LOGIN USER
            Auth::login($user);
            // GO TO FINISH PAGE
            return redirect()->route('register.finish');
        } else {
            throw ValidationException::withMessages(['otp_1' => 'Otp Invalid']);
        }

    }

    public function render()
    {
        if (authCheck() && authUser()->otp_verified == 1) {
            redirect()->route('user.dashboard');
        }
        // if ($this->currentStep == 3) {
        $this->registerStepData = RegisterStep::where('ip', request()->ip())->first();
        // }
        if ($this->registerStepData != '' && $this->registerStepData->step == 3) {
            $this->currentStep = 4;
        }else {
            $this->currentStep = $this->currentStep;
        }

        return view('livewire.website.auth.register');
    }
}
