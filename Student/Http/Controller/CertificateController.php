<?php

namespace Student\Http\Controller;

use App\Modules\Backend\Profile\Profilelogs\Repositories\ProfileLogsRepository;
use App\Modules\Backend\Profile\ProfileProcessing\Repositories\ProfileProcessingRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Student\Modules\Framework\Request;
use Student\Modules\Profile\Repositories\ProfileRepository;
use App\Modules\Backend\Certificate\Repositories\CertificateRepository;


class CertificateController extends BaseController{

    private  $certificateRepository, $profileRepository;
    public function __construct(Log $log,  ProfileRepository $profileRepository,
                                                                        ProfileProcessingRepository $profileProcessingRepository,
                                                                        CertificateRepository $certificateRepository,
                                                            ProfileLogsRepository $profileLogsRepository)
    {
        $this->profileRepository=$profileRepository;
        $this->profileProcessingRepository=$profileProcessingRepository;
        $this->profileLogsRepository=$profileLogsRepository;
        $this->certificateRepository = $certificateRepository;
        $this->log=$log;
        parent::__construct();
    }


    public function index(){
        $certificates = $this->certificateRepository->getAll()->where('user_id','=',Auth::user()->id);
        $profile = $this->profileRepository->getAll()->where('user_id','=',Auth::user()->id)->first();
       return view('student::pages.certificates.index',compact('certificates','profile'));
    }

    public function edit(){
        return view('student::pages.certificates.form');
    }

    public function validateCertificate(Request $request){
        $data = $request->all();
        $certificates = $this->certificateRepository->getAll()->where('cert_registration_number' ,'=', $data['certificate_number'])
            ->where('date_of_birth','=',$data['dob'])->first();
        if (!$certificates) {
            session()->flash('error', 'Sorry We donot find certificate related to the Information. Please Connect to our customer service for further information');
            return redirect()->back();
        }
        $user_id = $certificates['registration_id'];
        session()->flash('success', 'Your request has been submitted to the council you will notify when it linked to your account or will b');
        return redirect()->back();
    }
}
