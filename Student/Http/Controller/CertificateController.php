<?php

namespace Student\Http\Controller;

use App\Modules\Backend\Profile\Profilelogs\Repositories\ProfileLogsRepository;
use App\Modules\Backend\Profile\ProfileProcessing\Repositories\ProfileProcessingRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Student\Modules\Framework\Request;
use Student\Modules\Profile\Repositories\ProfileRepository;
use App\Modules\Backend\Certificate\Repositories\CertificateRepository;
use App\Modules\Backend\KYC\KYCRepository;
use Exception;

class CertificateController extends BaseController
{

    private  $certificateRepository, $profileRepository, $kycRepository;
    public function __construct(
        Log $log,
        ProfileRepository $profileRepository,
        ProfileProcessingRepository $profileProcessingRepository,
        CertificateRepository $certificateRepository,
        ProfileLogsRepository $profileLogsRepository,
        KYCRepository $kycRepository
    ) {
        $this->profileRepository = $profileRepository;
        $this->profileProcessingRepository = $profileProcessingRepository;
        $this->profileLogsRepository = $profileLogsRepository;
        $this->certificateRepository = $certificateRepository;
        $this->kycRepository = $kycRepository;
        $this->log = $log;
        parent::__construct();
    }


    public function index()
    {
        // $certificates = $this->certificateRepository->getAll()->where('user_id', '=', Auth::user()->id);
        // $profile = $this->profileRepository->getAll()->where('user_id', '=', Auth::user()->id)->first();
        // dd($profile);
        return view('student::pages.certificates.index');
    }

    public function edit()
    {
        return view('student::pages.certificates.form');
    }

    public function validateCertificate(Request $request)
    {
        $data = $request->all();

        try {
            $profile = $this->profileRepository->getAll()->where('user_id', '=', Auth::user()->id)->first();
            if ($profile) {
                $data['profile_id'] = $profile->id;
                $kyc = $this->kycRepository->create($data);
                if ($kyc == false) {
                    session()->flash('danger', 'Oops! Something went wrong.');
                    return redirect()->back()->withInput();
                }
                session()->flash('success', 'Your request has been submitted to the council you will notify when the certificate is  linked to your account till that wait');
                return redirect()->back();
            } else {
                session()->flash('success', 'Oops! Somthing went wrong !');
                return redirect()->back();
            }
        } catch (Exception $e) {
            session()->flash('danger', 'Oops! Something went wrong.');
            return redirect()->back()->withInput();
        }
    }
}
