<?php

namespace App\Services;

use App\Mail\TestMail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Mail\OTPMail;
use Illuminate\Validation\ValidationException;

class OTPService
{

    public static function send($to, $otp)
    {
       
        Mail::to($to)->send(new OTPMail($otp));
        return true;
    }
    // public static function send($to,$otp)
    // {
    //     $response = Http::acceptJson()->post(config('services.otp.url'), [
    //         "to" => $to,
    //         "supject" => "Apple OTP",
    //         "body" => "OTP is  " . $otp,
    //         "from_name" => "JAWRAA",
    //         "from_email" => "info@jawraa.com",
    //     ]);
    //     return $response;
    // }

    // GENERATE RANDOM CODE AND NUMBERS
    public static function generateOtp($length = 4)
    {
        // $characters = '0123456789';
        $characters = '123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}
