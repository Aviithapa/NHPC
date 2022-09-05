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
use Student\Models\Profile;
use Student\Modules\Profile\Repositories\ProfileRepository;
use Student\Modules\Qualification\Repositories\QualificationRepository;

class CouncilController extends BaseController
{
    private  $log, $profileProcessing,
        $profileRepository, $userRepository,
        $qualificationRepository, $user_data,
        $profileLogsRepository, $profileProcessingRepository,
        $examRepository, $examProcessingRepository, $admitCardRepository, $examResultRepository, $levelRepository,
        $programRepository, $certificateRepository;
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

    public function __construct(
        ProfileRepository $profileRepository,
        UserRepository $userRepository,
        QualificationRepository $qualificationRepository,
        ProfileLogsRepository $profileLogsRepository,
        ProfileProcessingRepository $profileProcessingRepository,
        ExamRepository $examRepository,
        ExamProcessingRepository $examProcessingRepository,
        AdmitCardRepository $admitCardRepository,
        ExamResultRepository $examResultRepository,
        ProgramRepository $programRepository,
        LevelRepository $levelRepository,
        CertificateRepository $certificateRepository
    ) {
        $this->profileRepository = $profileRepository;
        $this->userRepository = $userRepository;
        $this->qualificationRepository = $qualificationRepository;
        $this->profileLogsRepository = $profileLogsRepository;
        $this->profileProcessingRepository = $profileProcessingRepository;
        $this->examRepository = $examRepository;
        $this->examProcessingRepository = $examProcessingRepository;
        $this->admitCardRepository = $admitCardRepository;
        $this->examResultRepository = $examResultRepository;
        $this->programRepository = $programRepository;
        $this->levelRepository = $levelRepository;
        $this->certificateRepository = $certificateRepository;

        parent::__construct();
    }


    public function admit($status, $current_state)
    {
        if (Auth::user()->mainRole()->name === 'council') {

            $users = $this->examProcessingRepository->getAll()->where('status', '=', $status)
                ->where('state', '=', $current_state);

            return $this->view('pages.application-list', $users);
        } else {
            return redirect()->route('login');
        }
    }

    public function viewAdmitCardDetails($id)
    {
        if (Auth::user()->mainRole()->name === 'council') {

            $admitcard = $this->admitCardRepository->getAll()->where('exam_processing_id', '=', $id)->first();
            $profileDetails = $this->profileRepository->findById($admitcard['profile_id']);
            $exam = $this->examProcessingRepository->findById($admitcard['exam_processing_id']);
            return \view('examCommittee::pages.view-admit-card', compact('admitcard', 'profileDetails', 'exam'));
        } else {
            return redirect()->route('login');
        }
    }
    public function dartaBookIndex(Request $request)
    {
        if (Auth::user()->mainRole()->name === 'council') {
            $data = $request->all();
            $date = isset($data['date']);
            if (isset($data['date'])) {
                
                if ($data['date']  === "2022-07-08") {
                    $certificate = DB::table('certificate_history')
                        ->select('program_id', 'level_name', 'program_certificate_code',  DB::raw('count(*) as total'), DB::raw('group_concat(srn) as srns'))
                        ->groupBy('program_id', 'level_name', 'program_certificate_code')
                        ->orWhere('decision_date', '=', '2022-07-12')
                        ->orWhere('decision_date', '=', '2022-07-14')
                        ->orWhere('decision_date', '=', '2022-07-18')
                        ->orderBy('srn','DESC')
                        ->get(array('srn'))
                        ->unique('program_id');
                } else {
                    $certificate = DB::table('certificate_history')

                        ->select('program_id', 'level_name', 'program_certificate_code',  DB::raw('count(*) as total'), DB::raw('group_concat(srn) as srns'))
                        ->groupBy('program_id', 'level_name', 'program_certificate_code')
                        ->orWhere('decision_date', '=', $date)
                        //                    ->orWhere('decision_date','=','2022-07-14')
                        //                    ->orWhere('decision_date','=','2022-07-18')
                        ->orderBy('level_name')
                        ->orderBy('srn', 'ASC')
                        ->get(array('srn'))
                        ->unique('program_id');
                }



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
            } else {
                $certificate = DB::table('certificate_history')

                    ->select('program_id', 'level_name', 'program_certificate_code',  DB::raw('count(*) as total'), DB::raw('group_concat(srn) as srns'))
                    ->groupBy('program_id', 'level_name', 'program_certificate_code')
                    ->orWhere('decision_date', '=', '2022-06-05')
                    //                    ->orWhere('decision_date','=','2022-07-14')
                    //                    ->orWhere('decision_date','=','2022-07-18')
                    ->orderBy('level_name')
                    ->orderBy('srn', 'ASC')
                    ->get(array('srn'))
                    ->unique('program_id');
            }

            //            else
            //                $program_certificates_code = Certificate::select('program_certificate_code')->distinct()->get();
            return \view('council::pages.darta-book', compact('certificate','date'));
        } else {
            return redirect()->route('login');
        }
    }


    public function applicantdartaBookIndex($id, $date)
    {
        if (Auth::user()->mainRole()->name === 'council') {
            $date = "2022-08-15";
            $certificate = $this->certificateRepository->getAll()->where('program_id', '=', $id)->where('decision_date', '=', $date);
            return \view('council::pages.darta-book-details', compact('certificate'));
        } else {
            return redirect()->route('login');
        }
    }

    public function getallExamPassedList()
    {
        if (Auth::user()->mainRole()->name === 'council') {

            $data = $this->examProcessingRepository->getAll()->where('state', '=', 'council')
                ->where('status', '=', 'progress')
                ->where('level_id', '=', 4);
            return \view('council::pages.passed-list', compact('data'));
        } else {
            return redirect()->route('login');
        }
    }


    public function moveToDartaBook()
    {

        try {
            //code...
            $students = $profiles = Profile::join('exam_registration', 'exam_registration.profile_id', '=', 'profiles.id')
                ->join('program', 'program.id', '=', 'exam_registration.program_id')
                ->join('level', 'level.id', '=', 'program.level_id')
                ->join('provinces', 'provinces.id', '=', 'profiles.development_region')
                ->join('profile_processing', 'profile_processing.profile_id', '=', 'profiles.id')
                ->where('exam_registration.status', "=", 'progress')
                ->where('exam_registration.state', "=", 'council')
                ->where('exam_registration.level_id', "=", '4')
                ->where('exam_registration.attempt', "=", '1')
                //            ->where('exam_registration.isPassed',"=",true)
                ->where('exam_registration.certificate_generate', '=', 'No')
                ->orderBy('profiles.created_at', 'ASC')
                ->get([
                    'profiles.*', 'profiles.id as profile_id', 'profiles.created_at as profile_created_at', 'program.name as program_name', 'program.*',
                    'program.id as program_id', 'level.*', 'provinces.province_name', 'exam_registration.id as exam_registration_id'
                ]);
            foreach ($students as $student) {
                $srn_number = 0;
                $date = '2022/08/15';
                $srn_number = Certificate::where('program_id', '=', $student['program_id'])->orderBy('srn', 'desc')->first();
                $registration_number = Certificate::orderBy('registration_id', 'desc')->first();
                $qualification = $this->qualificationRepository->getAll()->where('user_id', '=', $student['user_id'])
                    ->where('program_id', '=', $student['program_id'])->first();
                if ($srn_number)
                    $srn = $srn_number['srn'];
                $registration_id = $registration_number['registration_id'];
                $data['registration_id'] = ++$registration_id;
                $data['category_id'] = $student[''];
                $data['profile_id'] = $student['profile_id'];
                $data['program_id'] = $student['program_id'];
                $data['srn'] = ++$srn;
                $data['program_certificate_code'] = $student['certificate_name'];
                $data['cert_registration_number'] = $this->certRegistrationNumber($data['srn'], $student['certificate_name']);
                $data['registrar'] = 'puspa raj khanal';
                $data['decision_date'] = $date;

                //            $date;
                $data['name'] = $student['first_name'] . ' ' . $student['middle_name'] . ' ' . $student['last_name'];
                $data['date_of_birth'] = $student['dob_nep'];
                $data['address'] = $student['province_name'] . ':' . $student['district'] . ':' . $student['vdc_municiplality'] . ':' . $student['ward_no'];
                $data['program_name'] = $student['qualification'];
                $data['level_name'] = $student['level_'];
                $data['qualification'] = $student['program_name'] . ':' . $student['board_university'] . ':'  . $student['passed_year'];
                $data['issued_year'] = Carbon::today()->year;
                $data['issued_date'] = $date;
                $data['valid_till'] = Carbon::now()->addYears(5);
                $data['certificate'] = 'new';
                $data['issued_by'] = Auth::user()->id;
                $data['certificate_status'] = 1;
                $certificate = $this->certificateRepository->create($data);
                $examupdate['status'] = "accepted";
                $examupdate['state'] = "council";
                $this->examProcessingRepository->update($examupdate, $student['exam_registration_id']);
                //                $this->updateQualificationHistory($qualification);
                $profilesProcessing = $this->profileProcessingRepository->getAll()->where('profile_id', '=', $student['profile_id'])->first();
                $data['current_state'] = 'council';
                $data['status'] = 'accepted';
                $this->profileProcessingRepository->update($data, $profilesProcessing['id']);
            }

            return redirect()->back();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    private function certRegistrationNumber($srn, $program_code)
    {
        return $srn . ' ' . $program_code;
    }

    public function updateQualificationHistory($id, $programId)
    {
        $user_id = $this->profileRepository->findById($id);
        $qualificationData = $this->qualificationRepository->getAll()->where('user_id', '=', $user_id['user_id'])
            ->where('program_id', '=', $programId)->first();
        $qual['licence'] = 'yes';
        $update = $this->qualificationRepository->update($qual, $qualificationData['id']);
        if ($update == false)
            return false;
        return true;
    }
}
