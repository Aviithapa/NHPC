<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


if (! function_exists('uploadedAsset')) {
    /**
     * Generates an asset path for the uploads.
     * @param null $path
     * @param null $file_name
     * @return string
     */
    function uploadedAsset($path = null, $file_name = null)
    {
        $path  = Storage::url($path.'/'.$file_name);
        return $path;
    }
}

if (! function_exists('getApplicantCount')) {
    /**
     * Generates an asset path for the uploads.
     * @param null $path
     * @param null $file_name
     * @return string
     */
    function getApplicantCount($status)
    {
         $count =0;
         $profiles = \Student\Models\Profile::all()->where("profile_status",'=' ,$status);
         foreach ($profiles as $profile)
             $count++;
        return $count;
    }
}


if (! function_exists('getProgramLicenceCount')) {
    /**
     * Generates an asset path for the uploads.
     * @param null $path
     * @param null $file_name
     * @return string
     */
    function getProgramLicenceCount($id)
    {
        $count =0;
        $exam = \App\Models\Exam\ExamProcessing::all()->where("state",'=' ,'council');
        foreach ($exam as $ex)
            if ($ex['program_id'] === $id)
                  $count++;
        return $count;
    }
}
if (! function_exists('getDartaNumber')) {
    /**
     * Generates an asset path for the uploads.
     * @param null $path
     * @param null $file_name
     * @return string
     */
    function getDartaNumber($id)
    {
        $exam = \App\Models\Certificate\Certificate::all()->where("program_id",'=' ,$id);
        return $exam;
    }
}

if (! function_exists('getExamApplicantList')) {
    /**
     * Generates an asset path for the uploads.
     * @param null $path
     * @param null $file_name
     * @return string
     */
    function getExamApplicantList($status)
    {
        $count =0;
        $profiles = \App\Models\Exam\ExamProcessing::all()->where("status",'=' ,$status);
        foreach ($profiles as $profile)
            $count++;
        return $count;
    }
}


if(!function_exists('imageNotFound')) {
    /**
     * @param null $type
     * @return string
     */
    function imageNotFound($type = null)
    {
        switch ($type){
            case 'user':
                return 'dist/img/img1.jpg';
                break;
            case 'small':
                return 'https://via.placeholder.com/350x150';
                break;
            default:
                return 'dist/img/avatar.png';
            //return asset('images/default.png');

        }
    }
}

if (!function_exists('getProfileImage')){
    function getProfileImage(){
        $data = \Student\Models\Profile::all()->where('user_id','=', Auth::user()->id)->first();
        if (!$data){
           return asset('dist/img/avatar.png');
        }else{
            return $data->getProfileImage();
        }
    }
}


if(!function_exists('profileImage')) {
    /**
     * @param null $type
     * @return string
     */
    function profileImage()
    {
            return  \Student\Models\Profile::getProfileImage();

    }
}
if(!function_exists('levelExits')) {
    /**
     * @param null $type
     * @return string
     */
    function levelExits()
    {
        $data = \Student\Models\Profile::all()->where('user_id','=', Auth::user()->id)->first();
        if ($data['level'] === 0){
            return false;
        }else{
            return true;
        }
    }
}

if(!function_exists('admitCard')) {
    /**
     * @param null $type
     * @return string
     */
    function admitCard()
    {
        $data = \Student\Models\Profile::all()->where('user_id','=', Auth::user()->id)->first();
        $exam= \App\Models\Exam\ExamProcessing::all()->where('profile_id','=',$data['id'])->first();
        if ($exam['is_admit_card_generate'] === 'no'){
            return false;
        }else{
            return true;
        }
    }
}


if(!function_exists('symbolNumber')) {
    /**
     * @param null $type
     * @return string
     */
    function symbolNumber($id)
    {
        $exam= \App\Models\Exam\ExamProcessing::all()->where('id','=',$id)->first();
        if ($exam['is_admit_card_generate'] === 'no'){
            return "Not Generated yet";
        }else{
            $admit_card = \App\Models\AdmitCard\AdmitCard::all()->where('exam_processing_id','=',$id)->first();
            return $admit_card['symbol_number'];
        }
    }
}


if(!function_exists('countAdmitCard')) {
    /**
     * @param null $type
     * @return string
     */
    function countAdmitCard()
    {
        $count = 0;
        $exams= \App\Models\Exam\ExamProcessing::all();
        foreach ($exams as $exam) {
            if ($exam['is_admit_card_generate'] === 'no') {
                 $count = ++$count;
            }
        }
        return $count;
    }
}
