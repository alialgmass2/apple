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
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\Password;
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
    public $password;
    public $otp;
    public $terms;

    #[Locked]
    public $totalSteps = 3;
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

    #[Locked]
    public int $f_region_id;
    #[Locked]
    public int $f_city_id;
    #[Locked]
    public int $f_terms;
    #[Locked]
    public int $f_education_level_id;
    #[Locked]
    public int $f_organization_id;
    #[Locked]
    public string $f_email;
    #[Locked]
    public string $f_email_org;
    #[Locked]
    public string $f_password;

    public $registerStepData;

    public function mount()
    {
        $this->currentStep = 1;
        $this->regions = Region::listDropdown()->get();
        $this->educationLevels = EducationLevel::listDropdown()->has('organizations')->get();
        $this->f_email_org = '';
    }

    public function updatedRegionId($value)
    {
        $this->cities = City::listDropdownByRegionId($value)->get();
    }
    public function updatedEducationLevelId($value)
    {
        $this->organizations = Organization::listDropdownByEducationLevelId($value)->get();
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
            $this->f_city_id = $this->city_id;
            $this->f_region_id = $this->region_id;

        } elseif ($this->currentStep == 2) {
            $this->validate([
                'education_level_id' => 'required|integer|exists:education_levels,id',
                'organization_id' => 'required|integer|exists:organizations,id',
            ]);
            $this->f_education_level_id = $this->education_level_id;
            $this->f_organization_id = $this->organization_id;
        } elseif ($this->currentStep == 3) {
            $this->validate([
                'email' => 'required|max:50|regex:/^[a-zA-Z0-9_\.\-]*$/',
                'password' => ['required', 'string', Password::min(6)->letters()->mixedCase()->numbers()->symbols()->uncompromised()],
                'terms' => 'required|accepted',
//                'accept' => ['required'],
            ],[
                'email'=>'The email field format is invalid i.e. "abdullahali" '
            ]);
            // GET CHOSE ORGNIZATION
            $orgnization = Organization::where('id', $this->organization_id)->firstOrfail();
            // GET CHOSE ORGNIZATION
            $otpMail = $this->email . '@' . $orgnization->domain;
            $checkMailUniqeNeesInRegisterStep = RegisterStep::where('email', $otpMail)->count();
            if ($checkMailUniqeNeesInRegisterStep > 0) {
                $this->dispatch('open-modal-mail-exists');
                throw ValidationException::withMessages([
                    'email' => __('app.email_already_exists'),
                ]);
            }
            $checkMailUniqeNeesInUser = User::where('email', $otpMail)->count();
            if ($checkMailUniqeNeesInUser) {
                $this->dispatch('open-modal-mail-exists');
                throw ValidationException::withMessages([

                    'email' => __('app.email_already_exists'),
                ]);
            }
            $otp = OTPService::generateOtp();
            $this->f_email = $this->email;
            $this->f_password = $this->password;
            $this->f_email_org = $otpMail;

            $this->f_terms = $this->terms;
            // CREATE STARTING FROM EMAIL STEP
            $registerStep = RegisterStep::create([
                // 'ip' => request()->ip(),
                'user_type' => UserType::STUDENT,
                'region_id' => $this->region_id,
                'city_id' => $this->city_id,
                'education_level_id' => $this->education_level_id,
                'organization_id' => $this->f_organization_id,
                'email' => $otpMail,
                'terms' => $this->f_terms,
                'password' => $this->f_password,
                'password_without_hash' => $this->f_password,
                'otp' => $otp,
                'step' => 3,
            ]);
            // SEND OTP
            OTPService::send($otpMail, $otp);
            Auth::guard(REGISTER_STEP)->login($registerStep);
            // HERE GO TO ANOTHER PAGE WITH AUTH GUARD REGISTER STEP
            return redirect()->route('user.register.otp');
        }
        // elseif ($this->currentStep == 4) {
        //     $this->validate([
        //         'otp_1' => 'required|integer|min:1',
        //         'otp_2' => 'required|integer|min:1',
        //         'otp_3' => 'required|integer|min:1',
        //         'otp_4' => 'required|integer|min:1',
        //     ]);
        // }
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
        // $eegisterStepToFinishCheck = RegisterStep::byIpAddress(request()->ip())->where('otp', $merageOtps);
        // GET CHOSE ORGNIZATION
        $eegisterStepToFinishCheck = RegisterStep::where('email', $this->f_email_org)->where('otp', $merageOtps);
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
                'region_id' => $this->f_region_id,
                'city_id' => $this->f_city_id,
                'education_level_id' => $this->f_education_level_id,
                'organization_id' => $this->f_organization_id,
                'email' => $tempRegister->email,
                // 'password' => 123456,
                'password' => $tempRegister->password,
                'otp_verified' => 1,
            ]);
            // $user = User::create([
            //     'user_type' => UserType::STUDENT,
            //     'region_id' => $tempRegister->region_id,
            //     'city_id' => $tempRegister->city_id,
            //     'education_level_id' => $tempRegister->education_level_id,
            //     'organization_id' => $tempRegister->organization_id,
            //     'email' => $tempRegister->email,
            //     'password' => 123456,
            //     'otp_verified' => 1,
            // ]);
            // RESET TEMP REGISTER
            $tempRegister->delete();
            // MANUAL LOGIN USER
            Auth::login($user);
            // GO TO FINISH PAGE
            return redirect()->route('user.register.finish');
        } else {
            throw ValidationException::withMessages(['otp_1' => 'Otp Invalid']);
        }

    }

    public function render()
    {
        Log::info('from from rander');

        // if (RegisterStepCheck()) {
        //     if (authRegisterStep()->otp != '') {
        //         // $this->redirectRoute('user.register.otp');
        //         // return redirect()->back();
        //         // dd('#HERE# WILL REDIRECT BACK');s
        //     }
        // } else {
        //     // dd('#HERE# not auth');
        // }
        // if (authCheck() && authUser()->otp_verified == 1) {
        //     redirect()->route('user.dashboard');
        // }
        // if ($this->currentStep == 3) {
        $this->registerStepData = RegisterStep::where('email', $this->f_email_org)->first();
        $registerStepOrgnization = Organization::where('id', $this->organization_id)->first();

        // }
        if ($this->registerStepData != '' && $this->registerStepData->step == 3) {
            $this->currentStep = 4;
        } else {
            $this->currentStep = $this->currentStep;
        }

        return view('livewire.website.auth.register', [
            'registerStepOrgnization' => $registerStepOrgnization,
        ]);
    }
}
