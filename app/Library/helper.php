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
                return 'https://via.placeholder.com/350x150';
            //return asset('images/default.png');

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
