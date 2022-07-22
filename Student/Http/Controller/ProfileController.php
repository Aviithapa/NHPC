<?php


namespace Student\Http\Controller;

use App\Models\Address\District;
use App\Models\Address\Municipality;
use App\Models\Address\Provinces;
use App\Models\Admin\Program;
use App\Models\Admin\University;
use App\Models\Exam\ExamProcessing;
use App\Modules\Backend\Admin\College\Repositories\CollegeRepository;
use App\Modules\Backend\Admin\Level\Repositories\LevelRepository;
use App\Modules\Backend\Admin\Program\Repositories\ProgramRepository;
use App\Modules\Backend\AdmitCard\Repositories\AdmitCardRepository;
use App\Modules\Backend\Exam\ExamProcessing\Repositories\ExamProcessingRepository;
use App\Modules\Backend\Profile\Profilelogs\Repositories\ProfileLogsRepository;
use App\Modules\Backend\Profile\ProfileProcessing\Repositories\ProfileProcessingRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Mockery\CountValidator\Exception;
use Student\Modules\Framework\Request;
use Student\Modules\Profile\Repositories\ProfileRepository;
use Student\Modules\Qualification\Repositories\QualificationRepository;

class ProfileController extends BaseController
{
   private $profileRepository,$log, $collegeRepository,$levelRepository, $qualificationRepository,$profileLogsRepository, $programRepository,$examProcessingRepository,$admitCardRepository,$profileProcessingRepository;
    public function __construct(Log $log, ProfileRepository $profileRepository,
                                QualificationRepository $qualificationRepository,
                                ProgramRepository $programRepository,
                                ExamProcessingRepository $examProcessingRepository,
                                AdmitCardRepository $admitCardRepository, ProfileProcessingRepository $profileProcessingRepository,
                                ProfileLogsRepository $profileLogsRepository,CollegeRepository $collegeRepository,
                                LevelRepository $levelRepository)
    {
        $this->profileRepository=$profileRepository;
        $this->qualificationRepository=$qualificationRepository;
        $this->programRepository=$programRepository;
        $this->examProcessingRepository=$examProcessingRepository;
        $this->admitCardRepository=$admitCardRepository;
        $this->profileProcessingRepository=$profileProcessingRepository;
        $this->profileLogsRepository=$profileLogsRepository;
        $this->collegeRepository=$collegeRepository;
        $this->levelRepository = $levelRepository;
        $this->log=$log;
        parent::__construct();
    }


    public function dashboard(){
        $data=$this->profileRepository->findByFirst('user_id',Auth::user()->id,'=');

        $rejected = null;
        $exam_re = null;
        if ($data) {
            if ($data['profile_status'] === "Rejected") {
                $rejected = "Your application has been rejected";
            }
            $re_exam  = ExamProcessing::orderBy('created_at', 'desc')->where('profile_id','=',$data['id'])->where('is_admit_card_generate','=','yes')
                ->where('attempt','=','2')->where('isPassed','=','0')->first();
            if($re_exam){
                $re_exam_applied  = ExamProcessing::orderBy('created_at', 'desc')->where('status','=','re-exam')->first();
                if($re_exam_applied){
                    $exam_re = null;

                }else{
                    $exam_re = "Please upload your voucher to reapply for the exam";
                }

            }
        }

        $exam=$this->profileRepository->findByFirst('user_id',Auth::user()->id,'=');
        $level = $this->levelRepository->getAll();
        return view('student::pages.dashboard',compact('rejected','exam', 'data','level','exam_re'));
    }

    public function saveLevelProgramSave(Request $request){
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        try {
            $profile = $this->profileRepository->create($data);
            if ($profile == false) {
                session()->flash('danger', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
            $authUser = $this->profileRepository->findByFirst('user_id',Auth::user()->id,'=');
            $province = Provinces::all();
            $district = District::all();
            session()->flash('success','Let\'s get started on the application.');
            return redirect()->to('student/dashboard/student/personal');
        } catch (\Exception $e) {
            session()->flash('danger', 'Oops! Something went wrong.');
            return redirect()->back()->withInput();
        }
    }

    public function store(Request $request)
    {
        $data = $request->all();
        try {
            $profile = $this->profileRepository->update($data, $data['profile_id']);
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



    public function index($slug = null){
        $slug = $slug ? $slug : 'personal';
        $data=$this->profileRepository->findByFirst('user_id',Auth::user()->id,'=');
        $profile=$this->profileRepository->findByFirst('user_id',Auth::user()->id,'=');

        $authUser = $this->profileRepository->findByFirst('user_id',Auth::user()->id,'=');
        $province = Provinces::all();
        $district = District::all();
        $file_path = base_path().DIRECTORY_SEPARATOR.'Student'.DIRECTORY_SEPARATOR. 'resources' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . $slug . '.blade.php';
        if (file_exists($file_path)) {
            switch ($slug) {
                case 'personal':
                             if (!$data) {
                                 return view('student::pages.personal', compact('authUser','province','district','profile'));
                             } else {
                                 if ($data['profile_status'] === "Rejected"){
                                     return view('student::pages.update-personal', compact('authUser', 'data','province','district','profile'));
                                 }else if (!$data["citizenship_number"] && !$data["first_name"]) {
                                     return view('student::pages.personal', compact('province','district','profile'));
                                }else if (!$data["citizenship_number"] || !$data["first_name"]) {
                                    return view('student::pages.update-personal', compact('authUser', 'data','province','district','profile'));
                                } else {
                                     session()->flash('already', 'Personal Information has already Setup');
                                     return redirect()->to('student/dashboard/student/guardian');
                                 }
                             }

                    break;
                case 'guardian':
                    if(!$data){
                        return view('student::pages.guardian',compact('authUser'));
                    }else{
                        if(!$data["father_name"]) {
                            return view('student::pages.guardian',compact('authUser'));
                        }else{
                            session()->flash('already','All Information upto guardian  already Setup');
                            return redirect()->to('student/dashboard/student/specific');
                        }
                    }
                    break;
                case 'specific':
                    $slc_data = $this->qualificationRepository->slcData(Auth::user()->id);
                    $tslc_data = $this->qualificationRepository->tslcData(Auth::user()->id);
                    $plus_2 = $this->qualificationRepository->pclData(Auth::user()->id);
                    $bachelor = $this->qualificationRepository->bachelorData(Auth::user()->id);
                    $master = $this->qualificationRepository->masterData(Auth::user()->id);
                    $slc_program = $this->programRepository->getAll()->where('level_id','=',4);
                    $plus_2_program = $this->programRepository->getAll()->where('level_id','=',3);
                    $bachelor_program = $this->programRepository->getAll()->where('level_id','=',2);
                    $master_program = $this->programRepository->getAll()->where('level_id','=',1);
                    $collage = $this->collegeRepository->getAll();
                    $university = University::get();
                    return view('student::pages.specific',compact('slc_data','plus_2','bachelor','master','slc_program',
                                                                            'plus_2_program','bachelor_program','master_program','tslc_data','collage','province','profile','university'));
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
                session()->flash('already','Guardian Information have been saved successfully');
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



    public function applyforExam(){
        $profile = $this->profileRepository->getAll()->where('user_id','=',Auth::user()->id)->first();
        if ($profile){
            if ($profile['level'] === 0 || $profile['level'] === null){
                session()->flash('error', 'Please fill your qualification details');
                return redirect()->to('student/dashboard/student/specific');
            }else{
                $exam = $this->examProcessingRepository->getAll()->where('profile_id','=',$profile['id'])->where('state','!=','council');
                if ($exam->isEmpty()){
                    $qualification = $this->qualificationRepository->getAll()->where('user_id','=',Auth::user()->id)
                                                                           ;
                    if ($qualification != null){
                        foreach ($qualification as $quali)
                            if (is_numeric($quali['program_id']) )
                                  $all_program[] = $this->programRepository->findById($quali['program_id']);
                    }
                    return view('student::pages.apply-exam', compact( 'all_program'));
                }else {
                    $re_exam  = ExamProcessing::orderBy('created_at', 'desc')->where('profile_id','=',$profile['id'])->where('is_admit_card_generate','=','yes')
                        ->where('attempt','=','2')->where('isPassed','=','0')->first();
                    if ($re_exam){
                        $re_exam_applied  = ExamProcessing::orderBy('created_at', 'desc')->where('profile_id','=',$profile['id'])->where('status','=','re-exam')->first();
                        if($re_exam_applied){
                            session()->flash('success', 'You have already enrolled in licence Exam ');
                            return redirect()->back();

                        }else{
                            $all_program[] = $this->programRepository->findById($re_exam['program_id']);
                            return view('student::pages.apply-exam', compact( 'all_program'));
                        }

                    }else{
                    $specific_program = ExamProcessing::orderBy('created_at', 'desc')->where('profile_id','=',$profile['id'])->where('status','=','rejected')->first();
                    if ($specific_program == null){
                        session()->flash('success', 'You have already enrolled in licence Exam ');
                    return redirect()->back();
                    }else{
                        return view('student::pages.update-apply-exam', compact(  'specific_program'));
                    }
                    }
                }

            }
        }else{
            session()->flash('success', 'Please setup your profile details');
            return redirect()->to('student/dashboard/student/personal');
        }
    }


    public function getAllLicencePassedRecord($id){
        $exam = $this->examProcessingRepository->getAll()->where('profile_id','=',$id)->where('state','!=','council');
        if ($exam->isEmpty()){
            $qualification = $this->qualificationRepository->getAll()->where('user_id','=',Auth::user()->id)
                ->where('licence','=', 'no')
                ->where('level','!=','1')->first();
            if($qualification != null){
                $specific_program = $this->programRepository->findById($qualification['program_id']);
                return $specific_program;
            }else{
                return false;
            }
        }else {
            $exam = ExamProcessing::orderBy('created_at', 'desc')->where('profile_id','=',$id)->where('status','=','rejected')->first();
            return $exam;
        }
    }



    public function applyExam(Request $request){
        $data= $request->all();
        if ($data['voucher'] == null){
            session()->flash('error', 'Please upload the voucher image');
            return redirect()->back();
        }
        $profile_id = $this->profileRepository->getAll()->where('user_id','=',Auth::user()->id)->first();
        $re_exam  = ExamProcessing::orderBy('created_at', 'desc')->where('profile_id','=',$profile_id['id'])->where('is_admit_card_generate','=','yes')
            ->where('attempt','=','2')->where('isPassed','=','0')->first();

        if($re_exam){
            $data["status"] = 're-exam';
            $data["state"] = 'exam_committee';
        }else{
            $data["status"] = 'progress';
            $data["state"] = 'computer_operator';
        }

        $data["profile_id"] = $profile_id['id'];

         $level = $this->programRepository->findById($data['program_id']);
        $data['level_id'] = $level['level_id'];
        $data['voucher_image'] = $data['voucher'];
        try {
            $exam = $this->examProcessingRepository->create($data);
            if ($exam == false) {
                session()->flash('danger', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
//            $data = $this->profileRepository->findById($profile_id['id']);
//            $user_id = $data['user_id'];
//            $user_data = $this->userRepository->findById($user_id);
//            $qualification = $this->qualificationRepository->getAll()->where('user_id', '=', $data['user_id']);
//            $profile_logs = $this->profileLogsRepository->getAll()->where('profile_id', '=', $profile_id['id']);
//            $profile_processing = $this->profileProcessingRepository->getAll()->where('profile_id', '=', $profile_id['id'])->first();
//            $exams = $this->examProcessingRepository->getAll()->where('profile_id', '=', $profile_id['id']);
//            return view('operator::pages.application-list-review', compact('data', 'user_data', 'qualification', 'profile_logs', 'profile_processing', 'exams'));

            session()->flash('success','Exam Processing has been started');
            return redirect()->to('student/dashboard');
        } catch (\Exception $e) {
            session()->flash('danger', 'Oops! Something went wrong.');
            return redirect()->back()->withInput();
        }
    }

    public function updateApplyExam(Request $request){
        $data= $request->all();
        $data["status"] = 'progress';
        $data['voucher_image'] = $data['voucher'];
        try {
            $exam = $this->examProcessingRepository->update($data,$data['exam_processing_id']);
            if ($exam == false) {
                session()->flash('danger', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
            session()->flash('success','Exam Processing has been updated successfully');
            return redirect()->to('student/dashboard');
        } catch (\Exception $e) {
            session()->flash('danger', 'Oops! Something went wrong.');
            return redirect()->back()->withInput();
        }
    }


    public function admitCardTemplate()
    {
        $profile = $this->profileRepository->getAll()->where('user_id','=',Auth::user()->id)->first();
        $admit_card = $this->admitCardRepository->getAll()->where('profile_id','=',$profile['id'])->first();
         if ($admit_card != null) {
            $exam_applied = $this->examProcessingRepository->getAll()->where('id', '=', $admit_card['exam_processing_id'])
                ->where('profile_id', '=', $profile['id'])->first();
        }else {
            $exam_applied = $this->examProcessingRepository->getAll()->where('profile_id', '=', $profile['id'])->first();
        }
        return view('student::pages.admit-card-template',compact('profile','admit_card','exam_applied'));
    }


    public function admitCardProfileId($id)
    {
         $profile = $this->profileRepository->findById($id);

        if($profile === null){
            $data = "Error";
            return view('student::pages.admit-download', compact('data'));
         }
        $admit_card = $this->admitCardRepository->getAll()->where('profile_id','=',$profile['id'])->first();
        if ($admit_card === null){
            $data = "Error";
            return view('student::pages.admit-download', compact('data'));
        }
        if ($admit_card != null) {
            $exam_applied = $this->examProcessingRepository->getAll()->where('id', '=', $admit_card['exam_processing_id'])
                ->where('profile_id', '=', $profile['id'])->first();
        }else {
            $exam_applied = $this->examProcessingRepository->getAll()->where('profile_id', '=', $profile['id'])->first();
        }

        return view('student::pages.admit-card-template-index',compact('profile','admit_card','exam_applied'));
    }


    public function admitCardRequestTemplate(Request $request)
    {
        $data= $request->all();
        $profile = $this->profileRepository->getAll()->where('dob_nep','=', $data['dob'])
            ->where('first_name','=',$data['first_name'])->first();

        if($profile === null){
            $data = "Error";
            return view('student::pages.admit-download', compact('data'));
        }
        $admit_card = $this->admitCardRepository->getAll()->where('profile_id','=',$profile['id'])->first();
        if ($admit_card === null){
            $data = "Error";
            return view('student::pages.admit-download', compact('data'));
        }
        if ($admit_card != null) {
            $exam_applied = $this->examProcessingRepository->getAll()->where('id', '=', $admit_card['exam_processing_id'])
                ->where('profile_id', '=', $profile['id'])->first();
        }else {
            $exam_applied = $this->examProcessingRepository->getAll()->where('profile_id', '=', $profile['id'])->first();
        }

        return view('student::pages.admit-card-template-index',compact('profile','admit_card','exam_applied'));
    }


    public function  admitCardPrintSection(){
        return view('student::pages.admit-download');

    }


    public function updateInformation(Request $request, $id){
        $data = $request->all();
//        $profileCheck = $this->profileRepository->findById($id);
//        $data['profile_status'] = 'Reviewing';
//        $data['profile_state'] = 'computer_operator';
        try {
            $profile = $this->profileRepository->update($data,$id);
            $profile_processing = $this->profileProcessingRepository->getAll()->where('profile_id','=', $id)->first();
//            $profiles['status'] = 'progress';
//            $profiles_processing = $this->profileProcessingRepository->update($profiles,$profile_processing['id']);
            $this->profileLog();
            if ($profile == false) {
                session()->flash('danger', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
                session()->flash('success','Personal Information has been updated');
                return redirect()->route('qualification.update.index',['id'=>'1']);
//
        } catch (\Exception $e) {
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



    public function getDistrict(Request $request){

        if($request->ajax()) {
//            $output = "";
            $districts = District::all()->where('province_id', '=',  $request->province_id);
            $output = '<option value= >Select District</option>';

            if ($districts) {
                foreach ($districts as $district) {
                    $output .= '<option value='.$district->name.' >' .$district->name.'</option>';
                }
                return Response($output);
            }
        }
    }
    public function getProgram(Request $request){

        if($request->ajax()) {
//            $output = "";
            $programs = Program::all()->where('level_id', '=',  $request->level_id)->where('status','=',1);
            $output = '<option value= >Select Program</option>';

            if ($programs) {
                foreach ($programs as $program) {
                    $output .= '<option value='.$program->id.' >' .$program->name.'</option>';
                }
                return Response($output);
            }
        }
    }
    public function getMunicipality(Request $request){
        if($request->ajax()) {
            $output = "";
            $districts = Municipality::all()->where('district_name', '=',  $request->district_name);
            if ($districts) {
                foreach ($districts as $district) {
                    $output .= '<option value='.$district->name.' >' .$district->name.'</option>';
                }
                return Response($output);
            }
        }
    }



}


