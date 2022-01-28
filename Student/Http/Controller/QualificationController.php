<?php


namespace Student\Http\Controller;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Student\Modules\Framework\Request;
use Student\Modules\Profile\Repositories\ProfileRepository;
use Student\Modules\Qualification\Repositories\QualificationRepository;

class QualificationController extends BaseController
{
    private $qualificationRepository,$log, $profileRepository;
    public function __construct(Log $log, QualificationRepository $qualificationRepository, ProfileRepository $profileRepository)
    {
        $this->qualificationRepository=$qualificationRepository;
        $this->profileRepository=$profileRepository;
        $this->log=$log;
        parent::__construct();
    }


    public function index(Request $request){
        $qualifications = $this->qualificationRepository->getAll()->where('user_id','=',Auth::user()->id);
       return view('student::pages.qualification.index',compact('qualifications'));
    }

    public function create(Request $request){
        return view('student::pages.qualification.form');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['name'] = $data['level'];
        $data['user_id'] = Auth::user()->id;
        $data['transcript_image'] = $data['transcript'];
        $data['provisional_image'] = $data['provisional'];
        $data['character_image'] = $data['character'];
        $profiles['registration_level'] =$data['level'];
        try {
            $qualification = $this->qualificationRepository->create($data);
            if ($qualification == false) {
                session()->flash('danger', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
            $this->checkLevel($profiles);
            session()->flash('success', $data["level_name"].' Qualification have been Saved Successfully');
            $slc_data = $this->qualificationRepository->slcData(Auth::user()->id);
            $plus_2 = $this->qualificationRepository->pclData(Auth::user()->id);
            $bachelor = $this->qualificationRepository->bachelorData(Auth::user()->id);
            $master = $this->qualificationRepository->masterData(Auth::user()->id);

            return redirect()->route('student.specific',compact('slc_data','plus_2','bachelor','master'));
        } catch (\Exception $e) {
            session()->flash('danger', 'Oops! Something went wrong.');
            return redirect()->back()->withInput();
        }
    }


    public function checkLevel($profiles){
        $id=$this->profileRepository->findByFirst('user_id',Auth::user()->id,'=');
        if ($id['registration_level'] < $profiles['registration_level'])
            $profile = $this->profileRepository->update($profiles,$id['id']);

    }



}
