<?php


namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Web\BaseController;
use Illuminate\Http\Request;


class CaptchaValidationController  extends BaseController
{


    public function reloadCaptcha()
    {

        return response()->json(['captcha'=> captcha_img()]);
    }

}
