<?php


namespace Council\Http\Controller;


use App\Exports\ResultExport;
use App\Imports\ResultImport;
use App\Models\Certificate\Certificate;
use App\Modules\Backend\Admin\Level\Repositories\LevelRepository;
use App\Modules\Backend\Admin\Program\Repositories\ProgramRepository;
use App\Modules\Backend\AdmitCard\Repositories\AdmitCardRepository;
use App\Modules\Backend\Authentication\User\Repositories\UserRepository;
use App\Modules\Backend\Certificate\Repositories\CertificateRepository;
use App\Modules\Backend\Exam\Exam\Repositories\ExamRepository;
use App\Modules\Backend\Exam\ExamProcessing\Repositories\ExamProcessingRepository;
use App\Modules\Backend\Profile\Profilelogs\Repositories\ProfileLogsRepository;
use App\Modules\Backend\Profile\ProfileProcessing\Repositories\ProfileProcessingRepository;
use App\Modules\Backend\Result\Repositories\ExamResultRepository;
use Carbon\Carbon;
use ExamCommittee\Http\Controller\BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Operator\Modules\Framework\Request;
use Student\Modules\Profile\Repositories\ProfileRepository;
use Student\Modules\Qualification\Repositories\QualificationRepository;

class CouncilController extends BaseController
{
    private  $log,$profileProcessing,
        $profileRepository, $userRepository,
        $qualificationRepository,$user_data,
        $profileLogsRepository,$profileProcessingRepository,
        $examRepository,$examProcessingRepository,$admitCardRepository,$examResultRepository, $levelRepository,
        $programRepository,$certificateRepository;
    private $viewData, $exam_processing;

    /**
     * PermissionController constructor.
     * @param ProfileRepository $profileRepository
     * @param UserRepository $userRepository
     * @param QualificationRepository $qualificationRepository
     * @param ProfileLogsRepository $profileLogsRepository
     * @param ProfileProcessingRepository $profileProcessingRepository
     * @param ExamRepository $examRepository
     * @param ExamProcessingRepository $examProcessingRepository
     * @param AdmitCardRepository $admitCardRepository
     * @param ExamResultRepository $examResultRepository
     * @param ProgramRepository $programRepository
     * @param LevelRepository $levelRepository
     * @param CertificateRepository $certificateRepository
     */

    public function __construct(ProfileRepository $profileRepository, UserRepository $userRepository, QualificationRepository $qualificationRepository,
                                ProfileLogsRepository $profileLogsRepository, ProfileProcessingRepository $profileProcessingRepository,
                                ExamRepository $examRepository,ExamProcessingRepository $examProcessingRepository,
                                AdmitCardRepository $admitCardRepository, ExamResultRepository $examResultRepository,
                                ProgramRepository $programRepository, LevelRepository $levelRepository,
                                CertificateRepository $certificateRepository)
    {
        $this->profileRepository=$profileRepository;
        $this->userRepository=$userRepository;
        $this->qualificationRepository=$qualificationRepository;
        $this->profileLogsRepository = $profileLogsRepository;
        $this->profileProcessingRepository = $profileProcessingRepository;
        $this->examRepository=$examRepository;
        $this->examProcessingRepository=$examProcessingRepository;
        $this->admitCardRepository=$admitCardRepository;
        $this->examResultRepository=$examResultRepository;
        $this->programRepository=$programRepository;
        $this->levelRepository=$levelRepository;
        $this->certificateRepository=$certificateRepository;

        parent::__construct();
    }


    public function admit($status, $current_state)
    {
        if (Auth::user()->mainRole()->name === 'council') {

            $users = $this->examProcessingRepository->getAll()->where('status', '=', $status)
                ->where('state', '=', $current_state);

            return $this->view('pages.application-list', $users);
        }else{
            return redirect()->route('login');
        }
    }

    public function viewAdmitCardDetails($id){
        if (Auth::user()->mainRole()->name === 'council') {

            $admitcard = $this->admitCardRepository->getAll()->where('exam_processing_id', '=', $id)->first();
            $profileDetails = $this->profileRepository->findById($admitcard['profile_id']);
            $exam = $this->examProcessingRepository->findById($admitcard['exam_processing_id']);
            return \view('examCommittee::pages.view-admit-card', compact('admitcard', 'profileDetails', 'exam'));
        }else{
            return redirect()->route('login');
        }
    }
    public function dartaBookIndex(){
        if (Auth::user()->mainRole()->name === 'council') {
            $date = "2022-07-12";
            if($date){
                $certificate = DB::table('certificate_history')

                    ->select('program_id','level_name','program_name',  DB::raw('count(*) as total'), DB::raw('group_concat(srn) as srns') )
                    ->groupBy('program_id','level_name','program_name')
                    ->where('decision_date','=', $date)
                    ->get(array('srn'))
                   ->unique('program_id');


//                $program_certificates_code = Certificate::all()
//                    ->where('decision_date','=', $date)
//                    ->groupBy('program_id','srn')
//
//                                  ;
//                $attributes = array_keys($program_certificates_code->toArray());
//                dd($attributes , $program_certificates_code);
////                foreach ($program_certificates_code as $program){
////                    if()
////                }
            }

//            else
//                $program_certificates_code = Certificate::select('program_certificate_code')->distinct()->get();
            return \view('council::pages.darta-book', compact(  'certificate'));
        }else{
            return redirect()->route('login');
        }
    }


    public function applicantdartaBookIndex($id){
        if (Auth::user()->mainRole()->name === 'council') {
            $certificate = $this->certificateRepository->getAll()->where('program_id', '=', $id);
            return \view('council::pages.darta-book-details', compact('certificate'));
        }else{
            return redirect()->route('login');
        }
    }

    public function getallExamPassedList(){
        if (Auth::user()->mainRole()->name === 'council') {

            $data = $this->examProcessingRepository->getAll()->where('state', '=', 'council')
                ->where('status', '=', 'progress');
            return \view('council::pages.passed-list', compact('data'));
        }else{
            return redirect()->route('login');
        }
    }


    public function moveToDartaBook(){
        $exams = $this->examProcessingRepository->getAll()->where('state','=','council')
                                                         ->where('status','=','progress');
        if ($exams->isEmpty()){
            session()->flash('success', 'No Application has been Found');
            return redirect()->back()->withInput();
        }else {
            $srn_number = Certificate::orderBy('srn', 'desc')->first();
            if ($srn_number)
                $srn = $srn_number['srn'];
            else
                $srn = 0;
            foreach ($exams as $exam) {
                $program = $this->programRepository->findById($exam['program_id']);
                $profile = $this->profileRepository->findById($exam['profile_id']);
                $level = $this->levelRepository->findById($exam['level_id']);
                $data['exam_processing_id'] = $exam['id'];
                $data['program_id'] = $exam['program_id'];
                $data['program_certificate_code'] = $program['certificate_name'];
                $data['srn'] = ++$srn;
                $data['cert_registration_number'] = $this->certRegistrationNumber($level, $srn, $program);
                $data['registrar'] = 'kashi nath rimal';
                $data['decision_date'] = Carbon::today()->toDateString();
                $data['name'] = $profile['first_name'] . ' ' . $profile['middle_name'] . ' ' . $profile['last_name'];
                $data['date_of_birth'] = $profile['dob_nep'] . ' (' . $profile['dob_eng'] . ' A.D.)';
                $data['address'] = $profile['dob_nep'] . ' (' . $profile['dob_eng'] . ' A.D.)';
                $data['program_name'] = $program['name'];
                $data['level_name'] = $level['name'];
                $data['qualification'] = $program['name'];
                $data['issued_year'] = Carbon::today()->year;
                $data['issued_date'] = Carbon::today()->toDateString();
                $data['valid_till'] = Carbon::now()->addYears(5);
                $data['certificate'] = 'new';
                $data['issued_by'] = Auth::user()->id;
                $data['certificate_status'] = 1;
                $this->certificateRepository->create($data);
                $examupdate['status'] = "accepted";
                $this->examProcessingRepository->update($examupdate, $exam['id']);
                $this->updateQualificationHistory($exam['profile_id'],$exam['program_id']);
            }
            session()->flash('success', 'All Application has been Moved to darta book');
            return redirect()->back()->withInput();
        }

    }

    private function certRegistrationNumber($level , $srn, $program){
        $level_code = $level['level_code'];
        $program_code= $program['certificate_name'];
        return $level_code.'- '.$srn.' '.$program_code;
    }

    public function updateQualificationHistory($id, $programId){
    $user_id = $this->profileRepository->findById($id);
    $qualificationData = $this->qualificationRepository->getAll()->where('user_id','=',$user_id['user_id'])
        ->where('program_id','=',$programId)->first();
    $qual['licence'] ='yes';
    $update= $this->qualificationRepository->update($qual,$qualificationData['id']);
     if ($update == false)
         return false;
     return true;
    }





}

