<?php


namespace Student\Http\Controller;


use App\Modules\Backend\Profile\Profilelogs\Repositories\ProfileLogsRepository;
use App\Modules\Backend\Profile\ProfileProcessing\Repositories\ProfileProcessingRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Student\Modules\Framework\Request;
use Student\Modules\Profile\Repositories\ProfileRepository;
use Student\Modules\Qualification\Repositories\QualificationRepository;

class QualificationController extends BaseController
{
    private $qualificationRepository,$log, $profileRepository,$profileProcessingRepository,$profileLogsRepository;
    public function __construct(Log $log, QualificationRepository $qualificationRepository, ProfileRepository $profileRepository,
                                                                        ProfileProcessingRepository $profileProcessingRepository,
                                                            ProfileLogsRepository $profileLogsRepository)
    {
        $this->qualificationRepository=$qualificationRepository;
        $this->profileRepository=$profileRepository;
        $this->profileProcessingRepository=$profileProcessingRepository;
        $this->profileLogsRepository=$profileLogsRepository;
        $this->log=$log;
        parent::__construct();
    }


    public function index(Request $request){
        $qualifications = $this->qualificationRepository->getAll()->where('user_id','=',Auth::user()->id);
        $profile = $this->profileRepository->getAll()->where('user_id','=',Auth::user()->id)->first();
       return view('student::pages.qualification.index',compact('qualifications','profile'));
    }

    public function create(Request $request){
        return view('student::pages.qualification.form');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['name'] = $data['level'];
        $data['user_id'] = Auth::user()->id;

        switch ($data['level']){
            case 1 :
                $data['transcript_image'] = $data['transcript_slc'];
                $data['provisional_image'] = $data['provisional_slc'];
                $data['character_image'] = $data['character_slc'];
                break;
                case 2 :
                $data['transcript_image'] = $data['transcript_tslc'];
                $data['provisional_image'] = $data['provisional_tslc'];
                $data['character_image'] = $data['character_tslc'];
                $data['ojt_image'] = $data['ojt_tslc'];
                break;
                case 3 :
                $data['transcript_image'] = $data['transcript_pcl'];
                $data['provisional_image'] = $data['provisional_pcl'];
                $data['character_image'] = $data['character_pcl'];
                $data['ojt_image'] = $data['ojt_pcl_image'];
                break;
            case 4 :
                $data['transcript_image'] = $data['transcript_bac'];
                $data['provisional_image'] = $data['provisional_bac'];
                $data['character_image'] = $data['character_bac'];
                $data['intership_image'] = $data['intership_bac'];
                $data['noc_image'] = $data['noc_bac'];
                $data['visa_image'] = $data['visa_bac'];
                $data['passport_image'] = $data['passport_bac'];
                break;
                case 5:
                $data['transcript_image'] = $data['transcript_mas'];
                $data['provisional_image'] = $data['provisional_mas'];
                $data['character_image'] = $data['character_mas'];
                $data['intership_image'] = $data['intership_mas'];
                $data['noc_image'] = $data['noc_mas'];
                $data['visa_image'] = $data['visa_mas'];
                $data['passport_image'] = $data['passport_mas'];
                break;


        }
        $profiles['level'] =$data['level'];
        $profiles['profile_state'] = 'computer_operator';
        try {
            $qualification = $this->qualificationRepository->create($data);
            if ($qualification == false) {
                session()->flash('danger', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
            $this->checkLevel($profiles);
            session()->flash('success', $data["level_name"].' Qualification have been Saved Successfully');
            $slc_data = $this->qualificationRepository->slcData(Auth::user()->id);
            $tslc_data = $this->qualificationRepository->tslcData(Auth::user()->id);
            $plus_2 = $this->qualificationRepository->pclData(Auth::user()->id);
            $bachelor = $this->qualificationRepository->bachelorData(Auth::user()->id);
            $master = $this->qualificationRepository->masterData(Auth::user()->id);

            return redirect()->route('student.specific',compact('slc_data','plus_2','bachelor','master','tslc_data'));
        } catch (\Exception $e) {
            session()->flash('danger', 'Oops! Something went wrong.');
            return redirect()->back()->withInput();
        }
    }


    public function checkLevel($profiles){
        $id=$this->profileRepository->findByFirst('user_id',Auth::user()->id,'=');
        if ($id['level'] < $profiles['level']){
            $profiles['profile_status'] = "Reviewing";
            $profile = $this->profileRepository->update($profiles,$id['id']);
        }else{
            $pros['profile_status'] = "Reviewing";
            $pros['profile_state'] = "computer_operator";
            $profile = $this->profileRepository->update($pros,$id['id']);
        }


    }

    public function edit($id){
        $qualification = $this->qualificationRepository->findById($id);
        return view('student::pages.qualification.edit-qualification',compact('qualification'));
    }


    public function update(Request $request, $id)
    {
        $data = $request->all();
        $data['name'] = $data['level'];
        $data['user_id'] = Auth::user()->id;
        $data['transcript_image'] = $data['transcript'];
        $data['provisional_image'] = $data['provisional'];
        $data['character_image'] = $data['character'];
        try {
            $post = $this->qualificationRepository->update($data, $id);
            $profile = $this->profileRepository->getAll()->where('user_id','=', Auth::user()->id)->first();
            $profile_processing = $this->profileProcessingRepository->getAll()->where('profile_id','=', $profile['id'])->first();
            $data['profile_status'] = 'Reviewing';
            $profile = $this->profileRepository->update($data,$profile['id']);

            $profiles['status'] = 'progress';
            $profiles_processing = $this->profileProcessingRepository->update($profiles,$profile_processing['id']);
            if($post == false) {
                session()->flash('danger', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
            session()->flash('success', 'Qualification updated successfully');
            return redirect()->route('qualification.index');
        }
        catch (\Exception $e) {
            $this->log->error('Content update : '.$e->getMessage());
            session()->flash('danger', 'Oops! Something went wrong.');
            return redirect()->back()->withInput();
        }
    }

    public function profileLog()
    {
        $data['remarks'] = "Profile Updated by". Auth::user()->name;
        $data['status'] = "progress";
        $logs = $this->profileLogsRepository->create($data);
        if ($logs == false)
            return false;
        return true;

    }


}
