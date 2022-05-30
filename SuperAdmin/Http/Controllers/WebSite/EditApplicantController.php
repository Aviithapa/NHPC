<?php

namespace SuperAdmin\Http\Controllers\WebSite;

use App\Http\Controllers\Admin\BaseController;
use App\Models\Address\District;
use App\Models\Address\Municipality;
use App\Models\Address\Provinces;
use App\Models\Profile\ProfileProcessing;
use App\Modules\Backend\Address\Repositories\MunicipalityRepository;
use App\Modules\Backend\Admin\College\Repositories\CollegeRepository;
use App\Modules\Backend\Admin\Program\Repositories\ProgramRepository;
use App\Modules\Backend\Authentication\User\Repositories\UserRepository;
use App\Modules\Backend\Exam\Exam\Repositories\ExamRepository;
use App\Modules\Backend\Exam\ExamProcessing\Repositories\ExamProcessingRepository;
use App\Modules\Backend\Exam\ExamProcessingDetails\Repositories\ExamProcessingDetailsRepository;
use App\Modules\Backend\Profile\Profilelogs\Repositories\ProfileLogsRepository;
use App\Modules\Backend\Profile\ProfileProcessing\Repositories\ProfileProcessingRepository;
use App\Modules\Framework\Request;
use Illuminate\Support\Facades\Auth;
use Student\Models\Qualification;
use Student\Modules\Profile\Repositories\ProfileRepository;
use Student\Modules\Qualification\Repositories\QualificationRepository;

class EditApplicantController  extends BaseController
{

    private $log, $profileProcessing, $profileRepository,
        $userRepository, $qualificationRepository,
        $user_data, $profileLogsRepository, $profileProcessingRepository,
        $municipalityRepository, $collageRepository, $programRepository,
        $examRepository, $examProcessingRepository, $examProcessingDetailsRepository;

    private $commonView = 'operator::pages.';
    private $commonMessage = 'Profile ';
    private $commonName = 'Profile ';
    private $commonRoute = 'operator.dashboard';
    private $viewData;

    /**
     * PermissionController constructor.
     * @param ProfileRepository $profileRepository
     * @param UserRepository $userRepository
     * @param QualificationRepository $qualificationRepository
     * @param ProfileLogsRepository $profileLogsRepository
     * @param ProfileProcessingRepository $profileProcessingRepository
     * @param ExamRepository $examRepository
     * @param ExamProcessingRepository $examProcessingRepository
     * @param ExamProcessingDetailsRepository $examProcessingDetailsRepository
     */

    public function __construct(ProfileRepository        $profileRepository, UserRepository $userRepository, QualificationRepository $qualificationRepository,
                                ProfileLogsRepository    $profileLogsRepository, ProfileProcessingRepository $profileProcessingRepository,
                                ExamRepository           $examRepository, MunicipalityRepository $municipalityRepository, CollegeRepository $collageRepository,
                                ExamProcessingRepository $examProcessingRepository, ExamProcessingDetailsRepository $examProcessingDetailsRepository,
    ProgramRepository $programRepository)
    {
        $this->viewData['commonRoute'] = $this->commonRoute;
        $this->viewData['commonView'] = 'superAdmin::' . $this->commonView;
        $this->viewData['commonName'] = $this->commonName;
        $this->viewData['commonMessage'] = $this->commonMessage;
        $this->profileRepository = $profileRepository;
        $this->userRepository = $userRepository;
        $this->qualificationRepository = $qualificationRepository;
        $this->profileLogsRepository = $profileLogsRepository;
        $this->profileProcessingRepository = $profileProcessingRepository;
        $this->examRepository = $examRepository;
        $this->examProcessingRepository = $examProcessingRepository;
        $this->municipalityRepository = $municipalityRepository;
        $this->collageRepository = $collageRepository;
        $this->programRepository = $programRepository;
        $this->examProcessingDetailsRepository = $examProcessingDetailsRepository;
        parent::__construct();
    }

    public function profileEdit($id){
        $province = Provinces::all();
        $district = District::all();
        $municipalities = Municipality::all();
        $data = $this->profileRepository->findById($id);
        return view('superAdmin::admin.applicant.edit-applicant', compact("data", 'province','district','municipalities'));
    }

    public function profileStore(Request  $request, $id){
        $data = $request->all();
        try {
            $profile = $this->profileRepository->update($data,$id);
            if ($profile == false) {
                session()->flash('error', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
            session()->flash('success','Profile has been successfully updated');
            return redirect()->to('superAdmin/dashboard');
        } catch (\Exception $e) {
            session()->flash('error', 'Oops! Something went wrong.');
            return redirect()->back()->withInput();
        }
       }
       public function qualificationEdit($id){
//        dd($id);
//        $data = $this->profileRepository->findById($id);
//        $user_id = $data['user_id'];

        $data = $this->qualificationRepository->findById($id);
           $collage = $this->collageRepository->getAll();
           $slc_program = $this->programRepository->getAll()->where('level_id','=',4);
           $plus_2_program = $this->programRepository->getAll()->where('level_id','=',3);
           $bachelor_program = $this->programRepository->getAll()->where('level_id','=',2);
           $master_program = $this->programRepository->getAll()->where('level_id','=',1);
           return view('superAdmin::admin.qualification.update.form', compact("data","collage",'slc_program','plus_2_program','bachelor_program','master_program'));
    }


    public function qualificationDelete(Request $request){
        $data= $request->all();
        try {
            $this->qualificationRepository->hardDelete($data['id']);
            session()->flash('success', 'Qualification deleted successfully');
            return redirect()->back();
        }
        catch (\Exception $e) {
            $this->log->error('Qualification delete : '.$e->getMessage());
            session()->flash('danger', 'Oops! Something went wrong.');
            return redirect()->back();
        }
    }
    public function qualificationAdd(Request $request, $id){
        $profile = $this->profileRepository->findById($id);
        $qualifications = $this->qualificationRepository->getAll()->where('user_id','=',$profile['user_id']);
        $slc_data = $this->qualificationRepository->slcData($id);
        $tslc_data = $this->qualificationRepository->tslcData($id);
        $plus_2 = $this->qualificationRepository->pclData($id);
        $bachelor = $this->qualificationRepository->bachelorData($id);
        $master = $this->qualificationRepository->masterData($id);
        $slc_program = $this->programRepository->getAll()->where('level_id','=',4);
        $plus_2_program = $this->programRepository->getAll()->where('level_id','=',3);
        $bachelor_program = $this->programRepository->getAll()->where('level_id','=',2);
        $master_program = $this->programRepository->getAll()->where('level_id','=',1);
        $collage = $this->collageRepository->getAll();
        return view('superAdmin::admin.applicant.specific',compact('qualifications','profile','master_program','collage','qualifications','slc_data','plus_2','bachelor','master','slc_program',
            'plus_2_program','bachelor_program','master_program','tslc_data','collage'));
    }
//    public function qualificationForm(Request $request, $id){
//        $qualifications = $this->qualificationRepository->getAll()->where('user_id','=',$id);
//        $profile = $this->profileRepository->getAll()->where('user_id','=',$id)->first();
//        return view('superAdmin::admin.applicant.qualification.form',compact('qualifications','profile'));
//    }


    public function qualificationStore(Request $request){
        $data = $request->all();
        $qualifications = Qualification::get()->where('user_id','=',$data['user_id']);
        $profile=$this->profileRepository->findByFirst('user_id',$data['user_id'],'=');
        $data['name'] = $data['level'];
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
        try {
            $qualification = $this->qualificationRepository->create($data);
            if ($qualification == false) {
                session()->flash('danger', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
            session()->flash('success', $data["level_name"].' Qualification have been Saved Successfully');
            $slc_data = $this->qualificationRepository->slcData(Auth::user()->id);
            $tslc_data = $this->qualificationRepository->tslcData(Auth::user()->id);
            $plus_2 = $this->qualificationRepository->pclData(Auth::user()->id);
            $bachelor = $this->qualificationRepository->bachelorData(Auth::user()->id);
            $master = $this->qualificationRepository->masterData(Auth::user()->id);
            $collage = $this->collageRepository->getAll();
            return view('superAdmin::admin.applicant.specific',compact('qualifications','profile','master_program','collage','qualifications','slc_data','plus_2','bachelor','master','slc_program',
                'plus_2_program','bachelor_program','master_program','tslc_data','collage'));
        } catch (\Exception $e) {
            session()->flash('danger', 'Oops! Something went wrong.');
            return redirect()->back()->withInput();
        }
    }

    public function create(Request $request, $id){
        $data = $this->profileRepository->getAll()->where('user_id','=',$id)->first;
        $qualifications = $this->qualificationRepository->getAll()->where('user_id','=',$id);
        $slc_data = $this->qualificationRepository->slcData($id);
        $tslc_data = $this->qualificationRepository->tslcData($id);
        $plus_2 = $this->qualificationRepository->pclData($id);
        $bachelor = $this->qualificationRepository->bachelorData($id);
        $master = $this->qualificationRepository->masterData($id);
        $slc_program = $this->programRepository->getAll()->where('level_id','=',4);
        $plus_2_program = $this->programRepository->getAll()->where('level_id','=',3);
        $bachelor_program = $this->programRepository->getAll()->where('level_id','=',2);
        $master_program = $this->programRepository->getAll()->where('level_id','=',1);
        $collage = $this->collageRepository->getAll();
        return view('superAdmin::admin.applicant.qualification.form',compact('data','master_program','collage','qualifications','slc_data','plus_2','bachelor','master','slc_program',
            'plus_2_program','bachelor_program','master_program','tslc_data','collage'));
    }

}
