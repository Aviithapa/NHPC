<?php


namespace Student\Http\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Student\Modules\Framework\Request;
use Student\Modules\Profile\Repositories\ProfileRepository;
use Student\Modules\Qualification\Repositories\QualificationRepository;

class ProfileController extends BaseController
{
   private $profileRepository,$log, $qualificationRepository;
    public function __construct(Log $log, ProfileRepository $profileRepository, QualificationRepository $qualificationRepository)
    {
        $this->profileRepository=$profileRepository;
        $this->qualificationRepository=$qualificationRepository;
        $this->log=$log;
        parent::__construct();
    }


    public function index($slug = null){
        $slug = $slug ? $slug : 'personal';
        $data=$this->profileRepository->findByFirst('user_id',Auth::user()->id,'=');
        $file_path = base_path().DIRECTORY_SEPARATOR.'Student'.DIRECTORY_SEPARATOR. 'resources' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . $slug . '.blade.php';
        if (file_exists($file_path)) {
            switch ($slug) {
                case 'personal':
                         if (!$data){
                             return view('student::pages.personal');
                         }else{
                             if(!$data["citizenship_number"]) {
                                 return view('student::pages.personal');
                             }else{
                                 session()->flash('already','Personal Information has already Setup');
                                 return redirect()->to('student/dashboard/student/guardian');
                             }
                         }
                    break;
                case 'guardian':
                    if(!$data){
                        return view('student::pages.guardian');
                    }else{
                        if(!$data["father_name"]) {
                            return view('student::pages.guardian');
                        }else{
                            session()->flash('already','All Information upto guardian  already Setup');
                            return redirect()->to('student/dashboard/student/specific');
                        }
                    }
                    break;
                case 'specific':
                    $slc_data = $this->qualificationRepository->slcData(Auth::user()->id);
                    $plus_2 = $this->qualificationRepository->pclData(Auth::user()->id);
                    $bachelor = $this->qualificationRepository->bachelorData(Auth::user()->id);
                    $master = $this->qualificationRepository->masterData(Auth::user()->id);

                    return view('student::pages.specific',compact('slc_data','plus_2','bachelor','master'));
                    break;
                default :
                    return view('student::pages.404');
                    break;
            }
        }else{
            return view('student::pages.404');
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

            $data = $request->all();
            $data['user_id'] = Auth::user()->id;
            try {
                $profile = $this->profileRepository->create($data);
                if ($profile == false) {
                    session()->flash('danger', 'Oops! Something went wrong.');
                    return redirect()->back()->withInput();
                }
                session()->flash('success','Personal Information have been Saved Successfully');
                return redirect()->to('student/dashboard/student/guardian');
            } catch (\Exception $e) {
                session()->flash('danger', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
        }



    public function update(Request $request)
    {
        $data = $request->all();
        try {
            $id=$this->profileRepository->findByFirst('user_id',Auth::user()->id,'=');
            $profile = $this->profileRepository->update($data,$id['id']);
            if ($profile == false) {
                session()->flash('danger', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
            if ($data['father_name']){
                session()->flash('success','Guardian Information have been saved successfully');
                return redirect()->to('student/dashboard/student/specific');
            }else{
                session()->flash('success','All Information have been saved successfully');
                return redirect()->route('student.dashboard');
            }
//
        } catch (\Exception $e) {
            session()->flash('danger', 'Oops! Something went wrong.');
            return redirect()->back()->withInput();
        }
    }










}


