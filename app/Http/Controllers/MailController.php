<?php


namespace App\Http\Controllers;


use App\Mail\ProfileStatus;
use App\Mail\SignupEmail;
use Exception;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public static function sendSignupEmail($name, $email, $verification_code)
    {
        try {
            $data = [
                'name' => $name,
                'verification_code' => $verification_code
            ];
            Mail::to($email)->send(new SignupEmail($data));
        } catch (Exception $e) {
        }
    }

    public static function sendprofileVerification($name, $email, $verification_code)
    {
        try {
            $data = [
                'name' => $name,
                'verification_code' => $verification_code
            ];
            Mail::to($email)->send(new ProfileStatus($data));
        } catch (Exception $e) {
        }
    }
}
