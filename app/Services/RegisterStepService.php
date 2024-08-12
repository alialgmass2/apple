<?php

namespace App\Services;

use App\Models\RegisterStep;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Log;

class RegisterStepService
{
    public static function moveDataToUserTableAndHandleGuards(RegisterStep $registerStepData)
    {
        try {
            // MOVE DATA
            DB::beginTransaction();
            $user = User::create([
                'user_type' => $registerStepData->user_type,
                'region_id' => $registerStepData->region_id,
                'city_id' => $registerStepData->city_id,
                'education_level_id' => $registerStepData->education_level_id,
                'organization_id' => $registerStepData->organization_id,
                'email' => $registerStepData->email,
                // 'password' => 123456,
                'password' => $registerStepData->password_without_hash,
                'otp_verified' => 1,
            ]);
            Auth::guard(REGISTER_STEP)->logout();
            $registerStepData->delete();
            Auth::guard()->login($user);
            // DELETE THE DATA FROM  REGISTER STEP TABLE
            $registerStepData->delete();
            // LOGOUT FROM GUARD REGISTER STEP
// LOGIN IN DEFAULT GUARD WEB
            DB::commit();
            return $user;
        } catch (\Throwable $th) {
            DB::rollBack();
            //throw $th;
            Log::error('SOMETHING WRONG CATCH INSIDE SERVICE');
            Auth::guard(REGISTER_STEP)->logout();
            Auth::guard('web')->logout();
            return redirect()->to('/');
        }

    }
}
