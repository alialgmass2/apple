<?php

namespace App\Livewire\Website\Auth;

use App\Models\City;
use App\Models\Role;
use App\Models\User;
use App\Models\Region;
use App\Enums\UserType;
use Illuminate\Support\Facades\Validator;

use Livewire\Component;
use App\Models\Organization;
use App\Models\RegisterStep;
use App\Services\OTPService;
use Livewire\Attributes\Locked;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class RegisterEducator extends Component
{

    // public $user_type;
    public $region_id;
    public $city_id;
    public $role_id;
    public $organization_id;
    public $email;
    public $terms;
    public $password;
    public $otp;

    #[Locked]
    public $totalStepsEducator = 3;
    #[Locked]
    public $currentStepEducator = 1;

    public $regions = [];
    public $cities = [];
    public $roles = [];
    public $organizations = [];
    public $otp_1;
    public $otp_2;
    public $otp_3;
    public $otp_4;

    public $registerStepData;

    #[Locked]
    public int $f_region_id;
    #[Locked]
    public int $f_city_id;
    #[Locked]
    public int $f_role_id;
    #[Locked]
    public int $f_terms;
    #[Locked]
    public int $f_organization_id;
    #[Locked]
    public string $f_email;
    #[Locked]
    public string $f_email_org;
    #[Locked]
    public string $f_password;

    public function mount()
    {
        $this->currentStepEducator = 1;
        $this->regions = Region::listDropdown()->get();
        $this->roles = Role::registerEducatorListDropdown()->get();
        $this->organizations = Organization::listDropown()->get();
        $this->f_email_org = '';
        // $this->f_terms = false;

    }

    public function updatedRegionId($value)
    {
        $this->cities = City::listDropdownByRegionId($value)->get();
    }

    public function increaseStep()
    {
        $this->resetErrorBag();
        $this->validateData();
        $this->currentStepEducator++;
        if ($this->currentStepEducator > $this->totalStepsEducator) {
            $this->currentStepEducator = $this->totalStepsEducator;
        }
    }

    public function decreaseStep()
    {
        $this->resetErrorBag();
        $this->currentStepEducator--;
        if ($this->currentStepEducator < 1) {
            $this->currentStepEducator = 1;
        }
    }

    public function validateData()
    {

        if ($this->currentStepEducator == 1) {
            $this->validate([
                'region_id' => 'required|integer|exists:regions,id',
                'city_id' => 'required|integer|exists:cities,id',
            ]);

            $this->f_city_id = $this->city_id;
            $this->f_region_id = $this->region_id;

        } elseif ($this->currentStepEducator == 2) {
            $this->validate([
                'role_id' => 'required|integer|exists:instractor_roles,id',
                'organization_id' => 'required|integer|exists:organizations,id',
            ]);
            $this->f_role_id = $this->role_id;
            $this->f_organization_id = $this->organization_id;

        } elseif ($this->currentStepEducator == 3) {
            $this->validate([
                'email' => 'required|max:50|regex:/^[a-zA-Z0-9_\.\-]*$/',
                'terms' => 'required|accepted',
//                'email' => 'required|required|max:50|regex:/^[a-z0-9_\.\-]*$/',
                'password' => ['required','string', Password::min(6)->letters()->mixedCase()->numbers()->symbols()->uncompromised()],
            ]);
            // GET CHOSE ORGNIZATION
            $orgnization = Organization::where('id', $this->organization_id)->firstOrfail();
// GET CHOSE ORGNIZATION
            $otpMail = $this->email . '@' . $orgnization->domain;
            list($localPart, $domainPart) = explode('@', $otpMail, 2);

            // Validate email address parts
            $validator = Validator::make([
                'email' => $otpMail,
                'localPart' => $localPart,
                'domainPart' => $domainPart
            ], [
                'email' => 'required|email|regex:/^[a-zA-Z]+[a-zA-Z0-9.-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',


            ]);

            if ($validator->fails()) {
                $errorMessage = $validator->errors()->first();
                throw ValidationException::withMessages(['email' => $errorMessage]);
            }

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
            $this->f_terms = $this->terms;
            $this->f_password = $this->password;
            $this->f_email_org = $otpMail;

            // $eegisterStep->update([
            //     'email' => $otpMail,
            //     'otp' => $otp,
            //     'step' => 3,
            // ]);
            // SEND OTP #hERE#
            // RegisterStep::create([
//     'ip' => request()->ip(),
//     'user_type' => UserType::TEACHER,
//     'region_id' => $this->region_id,
//     'city_id' => $this->city_id,
//     'step' => 1,
// ]);
// CREATE STARTING FROM EMAIL STEP
           $registerStep = RegisterStep::create([
                // 'ip' => request()->ip(),
                'user_type' => UserType::TEACHER,
                'region_id' => $this->region_id,
                'city_id' => $this->city_id,
                'role_id' => $this->role_id,
                'organization_id' => $this->f_organization_id,
                'email' => $otpMail,
                'password' => $this->f_password,
                'terms' => $this->f_terms,
                'password_without_hash' => $this->f_password,
                'otp' => $otp,
                'step' => 3,
            ]);

            OTPService::send($otpMail, $otp);
            Auth::guard(REGISTER_STEP)->login($registerStep);
// HERE GO TO ANOTHER PAGE WITH AUTH GUARD REGISTER STEP
            return redirect()->route('user.register.otp');

        }
        // elseif ($this->currentStepEducator == 4) {
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
        if ($this->currentStepEducator == 4) {
            $this->validate([
                'otp_1' => 'required|integer|min:1',
                'otp_2' => 'required|integer|min:1',
                'otp_3' => 'required|integer|min:1',
                'otp_4' => 'required|integer|min:1',
            ]);
        }
        $merageOtps = $this->otp_1 . $this->otp_2 . $this->otp_3 . $this->otp_4;
        // $eegisterStepToFinishCheck = RegisterStep::byIpAddress(request()->ip())->where('otp', $merageOtps);
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
                'user_type' => UserType::TEACHER,
                'region_id' => $this->f_region_id,
                'city_id' => $this->f_city_id,
                'role_id' => $this->f_role_id,
                'organization_id' => $this->f_organization_id,
                'email' => $tempRegister->email,
                // 'password' => 123456,
                'password' => $tempRegister->password,
                'otp_verified' => 1,
            ]);
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
        if (authCheck() && authUser()->otp_verified == 1) {
            redirect()->route('user.dashboard');
        }
        // if ($this->currentStepEducator == 3) {
        // $this->registerStepData = RegisterStep::where('ip', request()->ip())->first();
        $this->registerStepData = RegisterStep::where('email', $this->f_email_org)->first();
        $registerStepOrgnization = Organization::where('id', $this->organization_id)->first();
        // }
        if ($this->registerStepData != '' && $this->registerStepData->step == 3) {
            $this->currentStepEducator = 4;
        } else {
            $this->currentStepEducator = $this->currentStepEducator;
        }

        return view('livewire.website.auth.register-educator', [
            'registerStepOrgnization' => $registerStepOrgnization,
        ]);
    }

}
