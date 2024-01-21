<?php


namespace Operator\Http\Controller;


use App\Http\Controllers\MailController;
use App\Imports\OldFileImport;
use App\Models\Address\Provinces;
use App\Models\Certificate\Certificate;
use App\Models\Certificate\KYCData;
use App\Models\Exam\Exam;
use App\Models\Exam\ExamProcessing;
use App\Models\Profile\Profilelogs;
use App\Modules\Backend\Admin\Program\Repositories\ProgramRepository;
use App\Modules\Backend\Authentication\User\Repositories\UserRepository;
use App\Modules\Backend\BackDate\BackDataRepository;
use App\Modules\Backend\Certificate\Repositories\CertificateRepository;
use App\Modules\Backend\CertificateHistory\Repositories\CertificateHistoryRepository;
use App\Modules\Backend\CertificateHistoryDataBack\Repositories\CertificateHistoryDataBackRepository;
use App\Modules\Backend\Exam\Exam\Repositories\ExamRepository;
use App\Modules\Backend\Exam\ExamProcessing\Repositories\ExamProcessingRepository;
use App\Modules\Backend\Exam\ExamProcessingDetails\Repositories\ExamProcessingDetailsRepository;
use App\Modules\Backend\KYC\KYCRepository;
use App\Modules\Backend\Profile\Profilelogs\Repositories\ProfileLogsRepository;
use App\Modules\Backend\Profile\ProfileProcessing\Repositories\ProfileProcessingRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;
use Operator\Modules\Framework\Request;
use Student\Models\Profile;
use Student\Modules\Profile\Repositories\ProfileRepository;
use Student\Modules\Qualification\Repositories\QualificationRepository;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class OperatorController extends BaseController
{
    private $log, $profileProcessing, $profileRepository,
        $userRepository, $qualificationRepository,
        $user_data, $profileLogsRepository, $programRepository,
        $profileProcessingRepository, $examRepository,  $kycRepository, $examProcessingRepository, $examProcessingDetailsRepository, $certificateRepository, $certificateHistoryRepository, $backDataRepository, $certificateHistoryDataBackRepository;

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
     * @param ProgramRepository $programRepository
     * @param ExamProcessingDetailsRepository $examProcessingDetailsRepository
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
        ProgramRepository $programRepository,
        ExamProcessingDetailsRepository $examProcessingDetailsRepository,
        CertificateRepository $certificateRepository,
        CertificateHistoryRepository $certificateHistoryRepository,
        BackDataRepository $backDataRepository,
        CertificateHistoryDataBackRepository $certificateHistoryDataBackRepository,
        KYCRepository $kycRepository

    ) {
        $this->viewData['commonRoute'] = $this->commonRoute;
        $this->viewData['commonView'] = 'operator::' . $this->commonView;
        $this->viewData['commonName'] = $this->commonName;
        $this->viewData['commonMessage'] = $this->commonMessage;
        $this->profileRepository = $profileRepository;
        $this->userRepository = $userRepository;
        $this->qualificationRepository = $qualificationRepository;
        $this->profileLogsRepository = $profileLogsRepository;
        $this->profileProcessingRepository = $profileProcessingRepository;
        $this->examRepository = $examRepository;
        $this->examProcessingRepository = $examProcessingRepository;
        $this->examProcessingDetailsRepository = $examProcessingDetailsRepository;
        $this->programRepository = $programRepository;
        $this->certificateRepository = $certificateRepository;
        $this->certificateHistoryRepository = $certificateHistoryRepository;
        $this->backDataRepository = $backDataRepository;
        $this->certificateHistoryDataBackRepository = $certificateHistoryDataBackRepository;
        $this->kycRepository = $kycRepository;
        parent::__construct();
    }

    public function dashboard()
    {
        if (Auth::user()->mainRole()->name === 'operator') {


            // $tslc = ExamProcessing::select(\DB::raw("COUNT(program_id) as count"), \DB::raw("program_id as program_id"))
            //     ->groupBy('program_id')
            //     ->orderBy('count')
            //     ->where('exam_registration.state', '!=', 'rejected')
            //     ->where('exam_registration.exam_id', '=', '3')
            //     ->get();


            // $failed_student = ExamProcessing::select(\DB::raw("COUNT(program_id) as count"), \DB::raw("program_id as program_id"))
            //     ->groupBy('program_id')
            //     ->orderBy('count')
            //     ->where('level_id', '<=', 3)
            //     ->where('isPassed', '=', 0)
            //     ->where('state', '=', 'exam_committee')
            //     ->get();

            // $re_apply_student = ExamProcessing::select(\DB::raw("COUNT(program_id) as count"), \DB::raw("program_id as program_id"))
            //     ->groupBy('program_id')
            //     ->orderBy('count')
            //     ->where('level_id', '<=', 3)
            //     ->where('status', '=', 're-exam')
            //     ->get();

            // $re_apply_student_count = DB::table('exam_registration')
            // ->select('profile_id','exam_id', DB::raw('COUNT(*) as `count`'))
            // ->groupBy('profile_id', 'exam_id')
            // ->havingRaw('COUNT(*) >= 2')
            // ->get();

            // dd($re_apply_student_count);
            // $rejected = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
            //     ->join('profile_processing', 'profile_processing.profile_id', '=', 'profiles.id')
            //     ->where('profile_processing.current_state', '=', 'computer_operator')
            //     ->where('profile_processing.status', '=', 'rejected')
            //     ->get();
            //                dd($rejected);

            $exams = DB::table('exam')->where('id', '>', '2')->get();

            return view('operator::pages.dashboard', compact('exams'));
        } else {
            return redirect()->route('login');
        }
    }

    public function getProgramWiseStudent($id,  $status, $state)
    {
        $students = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
            ->where('exam_registration.program_id', '=', $id)
            ->join('program', 'program.id', '=', 'exam_registration.program_id')
            //            ->join('profile_processing','profile_processing.profile_id','=','profiles.id')
            ->where('exam_registration.created_at', '>', '2022-07-16')
            ->where('exam_registration.status', 're-exam')
            ->get(['profiles.*', 'program.name as program_name', 'profiles.id as profile_id']);


        return view('operator::pages.program-student', compact('students'));
    }
    public function exam($status, $state)
    {
        if (Auth::user()->mainRole()->name === 'operator') {
            $users = $this->examProcessingRepository->getAll()->where('status', '=', $status)
                ->where('state', '=', $state);
            return $this->view('pages.application-list', $users);
        } else {
            return redirect()->route('login');
        }
    }

    public function profile($status, $state, $level = 5)
    {
        if (Auth::user()->mainRole()->name === 'operator') {
            if ($status === 'rejected') {
                $data = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
                    ->join('profile_processing', 'profile_processing.profile_id', '=', 'profiles.id')
                    ->where('profile_processing.current_state', '=', $state)
                    ->where('profile_processing.status', '=', $status)
                    ->join('program', 'program.id', '=', 'exam_registration.program_id')
                    ->where('exam_registration.level_id', '=', $level)
                    //                    ->where('exam_registration.created_at', '>', '2022-07-16')
                    ->orderBy('profiles.created_at', 'ASC')
                    ->get(['profiles.*', 'program.name as program_name', 'profiles.id as profile_id', 'profile_processing.*', 'exam_registration.state as exam_registration_state', 'exam_registration.status as exam_registration_status', 'exam_registration.created_at as exam_registration_created_at']);


                $countmaster = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
                    ->join('profile_processing', 'profile_processing.profile_id', '=', 'profiles.id')
                    ->where('profile_processing.current_state', '=', $state)
                    ->where('profile_processing.status', '=', $status)
                    ->join('program', 'program.id', '=', 'exam_registration.program_id')
                    ->where('exam_registration.level_id', '=', 1)
                    ->get();

                $countbachelor = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
                    ->join('profile_processing', 'profile_processing.profile_id', '=', 'profiles.id')
                    ->where('profile_processing.current_state', '=', $state)
                    ->where('profile_processing.status', '=', $status)
                    ->join('program', 'program.id', '=', 'exam_registration.program_id')
                    ->where('exam_registration.level_id', '=', 2)
                    ->get();

                $countPCL = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
                    ->join('profile_processing', 'profile_processing.profile_id', '=', 'profiles.id')
                    ->where('profile_processing.current_state', '=', $state)
                    ->where('profile_processing.status', '=', $status)
                    ->join('program', 'program.id', '=', 'exam_registration.program_id')
                    ->where('exam_registration.level_id', '=', 3)
                    ->get();

                $countTSLC = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
                    ->join('profile_processing', 'profile_processing.profile_id', '=', 'profiles.id')
                    ->where('profile_processing.current_state', '=', $state)
                    ->where('profile_processing.status', '=', $status)
                    ->join('program', 'program.id', '=', 'exam_registration.program_id')
                    ->where('exam_registration.level_id', '=', 4)
                    ->get();
            } else if ($status === 'pending') {
                $data = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
                    ->join('profile_processing', 'profile_processing.profile_id', '=', 'profiles.id')
                    ->where('profile_processing.current_state', '=', $state)
                    ->where('profile_processing.status', '=', $status)
                    ->join('program', 'program.id', '=', 'exam_registration.program_id')
                    ->where('exam_registration.level_id', '=', $level)
                    //                    ->where('exam_registration.created_at', '>', '2022-07-16')
                    ->orderBy('profiles.created_at', 'ASC')
                    ->get(['profiles.*', 'program.name as program_name', 'profiles.id as profile_id', 'profile_processing.*', 'exam_registration.state as exam_registration_state', 'exam_registration.status as exam_registration_status', 'exam_registration.created_at as exam_registration_created_at']);


                $countmaster = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
                    ->join('profile_processing', 'profile_processing.profile_id', '=', 'profiles.id')
                    ->where('profile_processing.current_state', '=', $state)
                    ->where('profile_processing.status', '=', $status)
                    ->join('program', 'program.id', '=', 'exam_registration.program_id')
                    ->where('exam_registration.level_id', '=', 1)
                    ->get();

                $countbachelor = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
                    ->join('profile_processing', 'profile_processing.profile_id', '=', 'profiles.id')
                    ->where('profile_processing.current_state', '=', $state)
                    ->where('profile_processing.status', '=', $status)
                    ->join('program', 'program.id', '=', 'exam_registration.program_id')
                    ->where('exam_registration.level_id', '=', 2)
                    ->get();

                $countPCL = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
                    ->join('profile_processing', 'profile_processing.profile_id', '=', 'profiles.id')
                    ->where('profile_processing.current_state', '=', $state)
                    ->where('profile_processing.status', '=', $status)
                    ->join('program', 'program.id', '=', 'exam_registration.program_id')
                    ->where('exam_registration.level_id', '=', 3)
                    ->get();

                $countTSLC = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
                    ->join('profile_processing', 'profile_processing.profile_id', '=', 'profiles.id')
                    ->where('profile_processing.current_state', '=', $state)
                    ->where('profile_processing.status', '=', $status)
                    ->join('program', 'program.id', '=', 'exam_registration.program_id')
                    ->where('exam_registration.level_id', '=', 4)
                    ->get();
            } else if ($status === 'accepted') {
                $data = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
                    ->join('profile_processing', 'profile_processing.profile_id', '=', 'profiles.id')
                    ->where('profile_processing.current_state', '!=', 'computer_operator')
                    ->where('profile_processing.current_state', '!=', 'student')
                    ->join('program', 'program.id', '=', 'exam_registration.program_id')
                    ->where('exam_registration.level_id', '=', $level)
                    //                    ->where('exam_registration.created_at', '>', '2022-07-16')
                    ->orderBy('profiles.created_at', 'DESC')
                    ->get(['profiles.*', 'program.name as program_name', 'profiles.id as profile_id', 'profile_processing.*', 'exam_registration.state as exam_registration_state', 'exam_registration.status as exam_registration_status', 'exam_registration.created_at as exam_registration_created_at'])
                    ->unique('profile_id');


                $countmaster = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
                    ->join('profile_processing', 'profile_processing.profile_id', '=', 'profiles.id')
                    ->where('profile_processing.current_state', '!=', 'computer_operator')
                    ->where('profile_processing.current_state', '!=', 'student')
                    ->join('program', 'program.id', '=', 'exam_registration.program_id')
                    ->where('exam_registration.level_id', '=', 1)
                    ->get('profiles.id as profile_id')
                    ->unique('profile_id');


                $countbachelor = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
                    ->join('profile_processing', 'profile_processing.profile_id', '=', 'profiles.id')
                    ->where('profile_processing.current_state', '!=', 'computer_operator')
                    ->where('profile_processing.current_state', '!=', 'student')
                    ->join('program', 'program.id', '=', 'exam_registration.program_id')
                    ->where('exam_registration.level_id', '=', 2)
                    ->get('profiles.id as profile_id')
                    ->unique('profile_id');


                $countPCL = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
                    ->join('profile_processing', 'profile_processing.profile_id', '=', 'profiles.id')
                    ->where('profile_processing.current_state', '!=', 'computer_operator')
                    ->where('profile_processing.current_state', '!=', 'student')
                    ->join('program', 'program.id', '=', 'exam_registration.program_id')
                    ->where('exam_registration.level_id', '=', 3)
                    ->get('profiles.id as profile_id')
                    ->unique('profile_id');


                $countTSLC = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
                    ->join('profile_processing', 'profile_processing.profile_id', '=', 'profiles.id')
                    ->where('profile_processing.current_state', '!=', 'computer_operator')
                    ->where('profile_processing.current_state', '!=', 'student')
                    ->join('program', 'program.id', '=', 'exam_registration.program_id')
                    ->where('exam_registration.level_id', '=', 4)
                    ->get('profiles.id as profile_id')
                    ->unique('profile_id');
            } elseif ($level == 4) {
                $data = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
                    //                    ->join('profile_processing','profile_processing.profile_id','=','profiles.id')
                    //                    ->where('profile_processing.current_state', '=', $state)
                    //                    ->where('profile_processing.status', '=', $status)
                    ->where('exam_registration.state', '=', $state)
                    ->where('exam_registration.status', '=', $status)
                    ->join('program', 'program.id', '=', 'exam_registration.program_id')
                    ->where('exam_registration.level_id', '=', 4)
                    //                    ->where('exam_registration.created_at', '<', '2022-07-16')
                    ->orderBy('profiles.created_at', 'ASC')
                    ->get(['profiles.*', 'program.name as program_name', 'profiles.id as profile_id', 'exam_registration.state as exam_registration_state', 'exam_registration.status as exam_registration_status', 'exam_registration.created_at as exam_registration_created_at']);


                $countmaster = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
                    //                    ->join('profile_processing','profile_processing.profile_id','=','profiles.id')
                    //                    ->where('profile_processing.current_state', '=', $state)
                    //                    ->where('profile_processing.status', '=', $status)
                    ->where('exam_registration.state', '=', $state)
                    ->where('exam_registration.status', '=', $status)
                    ->join('program', 'program.id', '=', 'exam_registration.program_id')
                    ->where('exam_registration.level_id', '=', 1)
                    // ->where('exam_registration.created_at', '>', '2022-07-16')
                    ->get();

                $countbachelor = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
                    //                    ->join('profile_processing','profile_processing.profile_id','=','profiles.id')
                    //                    ->where('profile_processing.current_state', '=', $state)
                    //                    ->where('profile_processing.status', '=', $status)
                    ->where('exam_registration.state', '=', $state)
                    ->where('exam_registration.status', '=', $status)
                    ->join('program', 'program.id', '=', 'exam_registration.program_id')
                    ->where('exam_registration.level_id', '=', 2)
                    // ->where('exam_registration.created_at', '>', '2022-07-16')
                    ->get();

                $countPCL = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
                    //                    ->join('profile_processing','profile_processing.profile_id','=','profiles.id')
                    //                    ->where('profile_processing.current_state', '=', $state)
                    //                    ->where('profile_processing.status', '=', $status)
                    ->where('exam_registration.state', '=', $state)
                    ->where('exam_registration.status', '=', $status)
                    ->join('program', 'program.id', '=', 'exam_registration.program_id')
                    ->where('exam_registration.level_id', '=', 3)
                    // ->where('exam_registration.created_at', '>', '2022-07-16')
                    ->get();

                $countTSLC = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
                    //                    ->join('profile_processing','profile_processing.profile_id','=','profiles.id')
                    //                    ->where('profile_processing.current_state', '=', $state)
                    //                    ->where('profile_processing.status', '=', $status)
                    ->where('exam_registration.state', '=', $state)
                    ->where('exam_registration.status', '=', $status)
                    ->join('program', 'program.id', '=', 'exam_registration.program_id')
                    ->where('exam_registration.level_id', '=', 4)
                    //                    ->where('exam_registration.created_at', '>', '2022-07-16')
                    ->get();

                //                dd($countTSLC);
            } else if ($status === 'accepted') {
                $data = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
                    ->join('profile_processing', 'profile_processing.profile_id', '=', 'profiles.id')
                    ->where('profile_processing.current_state', '!=', 'computer_operator')
                    ->where('profile_processing.current_state', '!=', 'student')
                    ->join('program', 'program.id', '=', 'exam_registration.program_id')
                    ->where('exam_registration.level_id', '=', $level)
                    //                    ->where('exam_registration.created_at', '>', '2022-07-16')
                    ->orderBy('profiles.created_at', 'DESC')
                    ->get(['profiles.*', 'program.name as program_name', 'profiles.id as profile_id', 'profile_processing.*', 'exam_registration.state as exam_registration_state', 'exam_registration.status as exam_registration_status', 'exam_registration.created_at as exam_registration_created_at'])
                    ->unique('profile_id');


                $countmaster = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
                    ->join('profile_processing', 'profile_processing.profile_id', '=', 'profiles.id')
                    ->where('profile_processing.current_state', '!=', 'computer_operator')
                    ->where('profile_processing.current_state', '!=', 'student')
                    ->join('program', 'program.id', '=', 'exam_registration.program_id')
                    ->where('exam_registration.level_id', '=', 1)
                    ->get('profiles.id as profile_id')
                    ->unique('profile_id');


                $countbachelor = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
                    ->join('profile_processing', 'profile_processing.profile_id', '=', 'profiles.id')
                    ->where('profile_processing.current_state', '!=', 'computer_operator')
                    ->where('profile_processing.current_state', '!=', 'student')
                    ->join('program', 'program.id', '=', 'exam_registration.program_id')
                    ->where('exam_registration.level_id', '=', 2)
                    ->get('profiles.id as profile_id')
                    ->unique('profile_id');


                $countPCL = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
                    ->join('profile_processing', 'profile_processing.profile_id', '=', 'profiles.id')
                    ->where('profile_processing.current_state', '!=', 'computer_operator')
                    ->where('profile_processing.current_state', '!=', 'student')
                    ->join('program', 'program.id', '=', 'exam_registration.program_id')
                    ->where('exam_registration.level_id', '=', 3)
                    ->get('profiles.id as profile_id')
                    ->unique('profile_id');


                $countTSLC = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
                    ->join('profile_processing', 'profile_processing.profile_id', '=', 'profiles.id')
                    ->where('profile_processing.current_state', '!=', 'computer_operator')
                    ->where('profile_processing.current_state', '!=', 'student')
                    ->join('program', 'program.id', '=', 'exam_registration.program_id')
                    ->where('exam_registration.level_id', '=', 4)
                    ->get('profiles.id as profile_id')
                    ->unique('profile_id');
            } else {
                $data = ExamProcessing::
                    //                    ->join('profile_processing','profile_processing.profile_id','=','profiles.id')
                    join('program', 'program.id', '=', 'exam_registration.program_id')
                    //                    ->where('profile_processing.current_state', '=', $state)
                    //                    ->where('profile_processing.status', '=', $status)
                    ->where('exam_registration.state', '=', $state)
                    ->where('exam_registration.status', '=', $status)

                    ->where('exam_registration.level_id', '=', $level)
                    ->join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
                    //                    ->where('exam_registration.created_at', '>', '2022-07-16')
                    //                    ->orderBy('profiles.created_at', 'ASC')
                    ->get(['profiles.*', 'program.name as program_name', 'profiles.id as profile_id', 'exam_registration.state as exam_registration_state', 'exam_registration.status as exam_registration_status', 'exam_registration.created_at as exam_registration_created_at']);

                //                dd($data);
                $countmaster = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
                    //                    ->join('profile_processing','profile_processing.profile_id','=','profiles.id')
                    //                    ->where('profile_processing.current_state', '=', $state)
                    //                    ->where('profile_processing.status', '=', $status)
                    ->where('exam_registration.state', '=', $state)
                    ->where('exam_registration.status', '=', $status)
                    ->join('program', 'program.id', '=', 'exam_registration.program_id')
                    ->where('exam_registration.level_id', '=', 1)
                    //                    ->where('exam_registration.created_at', '>', '2022-07-16')
                    ->get();

                $countbachelor = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
                    //                    ->join('profile_processing','profile_processing.profile_id','=','profiles.id')
                    //                    ->where('profile_processing.current_state', '=', $state)
                    //                    ->where('profile_processing.status', '=', $status)
                    ->where('exam_registration.state', '=', $state)
                    ->where('exam_registration.status', '=', $status)
                    ->join('program', 'program.id', '=', 'exam_registration.program_id')
                    ->where('exam_registration.level_id', '=', 2)
                    //                    ->where('exam_registration.created_at', '>', '2022-07-16')
                    ->get();

                $countPCL = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
                    //                    ->join('profile_processing','profile_processing.profile_id','=','profiles.id')
                    //                    ->where('profile_processing.current_state', '=', $state)
                    //                    ->where('profile_processing.status', '=', $status)
                    ->where('exam_registration.state', '=', $state)
                    ->where('exam_registration.status', '=', $status)
                    ->join('program', 'program.id', '=', 'exam_registration.program_id')
                    ->where('exam_registration.level_id', '=', 3)
                    //                    ->where('exam_registration.created_at', '>', '2022-07-16')
                    ->get();

                $countTSLC = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
                    //                    ->join('profile_processing','profile_processing.profile_id','=','profiles.id')
                    //                    ->where('profile_processing.current_state', '=', $state)
                    //                    ->where('profile_processing.status', '=', $status)
                    ->where('exam_registration.state', '=', $state)
                    ->where('exam_registration.status', '=', $status)
                    ->join('program', 'program.id', '=', 'exam_registration.program_id')
                    ->where('exam_registration.level_id', '=', 4)
                    //                    ->where('exam_registration.created_at', '>', '2022-07-16')
                    ->get();
            }


            return view('operator::pages.applicant-profile-list', compact(
                'data',
                'state',
                'status',
                'countTSLC',
                'countPCL',
                'countmaster',
                'countbachelor'
            ));
        } else {
            return redirect()->route('login');
        }
    }

    public function edit($id)
    {
        if (Auth::user()->mainRole()->name === 'operator') {
            $data = $this->profileRepository->findById($id);
            $user_id = $data['user_id'];
            $user_data = $this->userRepository->findById($user_id);
            $qualification = $this->qualificationRepository->getAll()->where('user_id', '=', $data['user_id']);
            $profile_logs = $this->profileLogsRepository->getAll()->where('profile_id', '=', $id);
            $profile_processing = $this->profileProcessingRepository->getAll()->where('profile_id', '=', $id)->first();
            $exams = $this->examProcessingRepository->getAll()->where('profile_id', '=', $id);
            $examslatest = DB::table('exam_registration')
                ->where('profile_id', '=', $id)
                ->latest()
                ->first();
            $certificate = DB::table('certificate_history')
                ->where('profile_id', '=', $id)
                ->get();
            // dd($certificate);
            // $this->examProcessingRepository->getAll()->where('profile_id', '=', $id);

            return view('operator::pages.application-list-review', compact('data', 'user_data', 'qualification', 'profile_logs', 'profile_processing', 'exams', 'examslatest', 'certificate'));
        } else {
            return redirect()->route('login');
        }
    }

    public function store(Request $request, $id)
    {
    }

    public function status(Request $request)
    {
        if (Auth::user()->mainRole()->name === 'operator') {
            $data = $request->all();
            $profile_log['profile_id'] = $data['profile_id'];
            $profile_log['state'] = 'computer_operator';
            $profile_log['created_by'] = Auth::user()->id;
            $profile_id = $data['profile_id'];
            $exam_processing = '';

            try {
                $id = $data['profile_id'];
                $data['created_by'] = Auth::user()->id;
                $data['state'] =  'computer_operator';
                $profileEmail = $this->profileRepository->findById($id);
                $email = $this->userRepository->findBy('id', '=', $profileEmail['user_id'])->first();
                if ($data['profile_status'] === "Verified" || $data['profile_status'] === "Reviewing") {
                    $data['profile_state'] = 'officer';
                    $profile_log['status'] = 'progress';
                    $profile_log['remarks'] =  isset($data['remarks']) ? $data['remarks'] : 'Profile Verified and forwarded to Officer';
                    $profile_log['review_status'] = 'Successfully Accepeted';
                    $profile_processing['current_state'] = 'officer';
                    $profile_processing['status'] = 'progress';
                    $exam['state'] = 'officer';
                    $exam['status'] = 'progress';
                    $logs = $this->profileLogs($profile_log);
                    if ($logs) {
                        $profileProcessingId = $this->profileProcessingRepository->getAll()->where('profile_id', '=', $profile_id)->first();
                        if ($profileProcessingId === null) {
                            $profileProcessings = $this->profileProcessingRepository->create($profile_processing);
                        } else {
                            $profileProcessings = $this->profileProcessingRepository->update($profile_processing, $profileProcessingId['id']);
                        }
                        if ($profileProcessings == 'false') {
                            session()->flash('error', 'Error Occured While Saving Data');
                        }
                        // dd($profile_processing,'p1');
                        $examProcessing = $this->examProcessingRepository->getAll()->where('state', '=', 'computer_operator')->where('profile_id', '=', $profile_id)->first();

                        if ($examProcessing) {
                            $exam_processing = $this->examProcessingRepository->update($exam, $examProcessing['id']);
                            if ($exam_processing === 'false') {

                                session()->flash('error', 'Error Occured While Saving Data');
                            }
                            // dd($exam_processing, 'p2');

                            $profile_log['exam_processing_id'] = $examProcessing['id'];
                            $examlog = $this->examLog($profile_log);
                            // dd($examLog);
                            if ($examlog) {
                                MailController::sendprofileVerification($email["name"], $email['email'], $data['remarks']);
                            }
                        }
                    }
                } elseif ($data['profile_status'] === "Rejected") {
                    $profile_log['status'] = 'rejected';
                    $profile_log['remarks'] = isset($data['remarks']) ? $data['remarks'] : 'Rejected By Computer Operator';
                    $profile_log['review_status'] = 'Rejected';
                    $profile_processing['current_state'] = 'computer_operator';
                    $profile_processing['status'] = 'rejected';
                    $exam['state'] = 'computer_operator';
                    $exam['status'] = 'rejected';
                    $data['profile_state'] = 'computer_operator';
                    $logs = $this->profileLogs($profile_log);

                    if ($logs) {
                        $profileProcessingId = $this->profileProcessingRepository->getAll()->where('profile_id', '=', $profile_id)->first();
                        if ($profileProcessingId === null) {
                            $profileProcessings = $this->profileProcessingRepository->create($profile_processing);
                        } else {
                            $profileProcessings = $this->profileProcessingRepository->update($profile_processing, $profileProcessingId['id']);
                        }
                        $examProcessing = $this->examProcessingRepository->getAll()->where('state', '=', 'computer_operator')->where('profile_id', '=', $profile_id)->first();
                        if ($examProcessing) {
                            $exam_processing = $this->examProcessingRepository->update($exam, $examProcessing['id']);
                            if ($exam_processing === 'false') {
                                session()->flash('error', 'Error Occured While Saving Data');
                            }
                            $profile_log['exam_processing_id'] = $examProcessing['id'];
                            $examlog = $this->examLog($profile_log);
                            if ($examlog) {
                                MailController::sendprofileVerification($email["name"], $email['email'], $data['remarks']);
                            }
                        }
                    }
                } else {
                    $profile_log['status'] = 'pending';
                    $profile_log['remarks'] = isset($data['remarks']) ? $data['remarks'] : 'Pending By Computer Operator';
                    $profile_log['review_status'] = 'Pending';
                    $profile_processing['current_state'] = 'computer_operator';
                    $profile_processing['status'] = 'pending';
                    $exam['state'] = 'computer_operator';
                    $exam['status'] = 'pending';
                    $data['profile_state'] = 'computer_operator';
                    $data['profile_status'] = 'Pending';

                    $logs = $this->profileLogs($profile_log);

                    if ($logs) {
                        $profileProcessingId = $this->profileProcessingRepository->getAll()->where('profile_id', '=', $profile_id)->first();
                        if ($profileProcessingId === null) {
                            $profileProcessings = $this->profileProcessingRepository->create($profile_processing);
                        } else {
                            $profileProcessings = $this->profileProcessingRepository->update($profile_processing, $profileProcessingId['id']);
                        }
                        $examProcessing = $this->examProcessingRepository->getAll()->where('state', '=', 'computer_operator')->where('profile_id', '=', $profile_id)

                            ->last();
                        if ($examProcessing) {
                            $exam_processing = $this->examProcessingRepository->update($exam, $examProcessing['id']);
                            if ($exam_processing === 'false') {
                                session()->flash('error', 'Error Occured While Saving Data');
                            }
                            $profile_log['exam_processing_id'] = $examProcessing['id'];
                            $examlog = $this->examLog($profile_log);
                        }
                    }
                }
                $profile = $this->profileRepository->update($data, $id);

                if ($profile == false) {
                    session()->flash('danger', 'Oops! Something went wrong.');
                    return redirect()->back()->withInput();
                }
                session()->flash('success', 'User Profile Status Information have been saved successfully');
                $examProcessing = $this->examProcessingRepository->getAll()->where('state', '=', 'officer')->where('profile_id', '=', $profile_id)->first();


                return redirect()->route('operator.applicant.profile.list', ['status' => 'progress', 'state' => 'computer_operator',  'level' => isset($examProcessing['level_id']) ? $examProcessing['level_id'] : 1]);
                //
            } catch (\Exception $e) {
                dd($e);
                session()->flash('error', 'Error Occured While Saving Data');
                return redirect()->back()->withInput();
            }
        } else {
            return redirect()->route('login');
        }
    }


    public function examAppliedReExam($id)
    {
        try {
            $exam['status'] = 'progress';
            $examUpdate = $this->examProcessingRepository->update($exam, $id);
            return redirect()->back();
        } catch (\Exception $e) {
            session()->flash('error', 'Error Occured While Saving Data');
            return redirect()->back()->withInput();
        }
    }

    public function profileLogs($data)
    {
        $logs = $this->profileLogsRepository->create($data);
        if ($logs == false)
            return false;
        return true;
    }

    public function examLog($data)
    {
        $logs = $this->examProcessingDetailsRepository->create($data);
        if ($logs == false)
            return false;
        return true;
    }

    public function profileLog(array $data)
    {
        if (Auth::user()->mainRole()->name === 'operator') {
            $logs = $this->profileLogsRepository->create($data);

            $this->ExamProcessingLog($data, $data['exam_id'], $data['profile_id']);
            if ($logs == false)
                return false;
            return true;
        } else {
            return redirect()->route('login');
        }
    }

    public function profileProcessing($id, $data)
    {
        if (Auth::user()->mainRole()->name === 'operator') {
            $profileProcessing['profile_id'] = $id;
            $profileEmail = $this->profileRepository->findById($id);
            $email = $this->userRepository->findBy('id', '=', $profileEmail['user_id'])->first();
            $profileProcessingId = $this->profileProcessingRepository->getAll()->where('profile_id', '=', $id)->first();

            if ($data['profile_status'] === "Verified" || $data['profile_status'] === "Reviewing") {
                $data['status'] = 'progress';
                $data['remarks'] = 'Document Verified and is Forwarded to Officer';
                $data['review_status'] = 'Successful';
                $data['current_state'] = 'officer';
                $profileEmail = $this->profileRepository->findById($id);
                $email = $this->userRepository->findBy('id', '=', $profileEmail['user_id'])->first();

                MailController::sendprofileVerification($email["name"], $email['email'], $data['remarks']);
                if ($profileProcessingId) {
                    $profileProcessings = $this->profileProcessingRepository->update($data, $profileProcessingId['id']);
                } else
                    $profileProcessings = $this->profileProcessingRepository->create($data);
            } elseif ($data['profile_status'] == "Rejected" || $data['status'] === 'rejected') {
                $data['status'] = 'rejected';
                $data['review_status'] = 'Rejected';
                $data['current_state'] = 'computer_operator';

                MailController::sendprofileVerification($email["name"], $email['email'], $data['remarks']);
                if ($profileProcessingId) {
                    $profileProcessings = $this->profileProcessingRepository->update($data, $profileProcessingId['id']);
                } else
                    $profileProcessings = $this->profileProcessingRepository->create($data);
            } elseif ($data['profile_status'] === "Pending") {
                $data['status'] = 'pending';
                $data['review_status'] = 'Pending';
                $data['current_state'] = 'computer_operator';
                MailController::sendprofileVerification($email["name"], $email['email'], $data['remarks']);
                if ($profileProcessingId) {
                    $profileProcessings = $this->profileProcessingRepository->update($data, $profileProcessingId['id']);
                } else
                    $profileProcessings = $this->profileProcessingRepository->create($data);
            }
        } else {
            return redirect()->route('login');
        }
    }


    public function level(Request $request)
    {
        if (Auth::user()->mainRole()->name === 'operator') {
            $data = $request->all();
            try {
                $id = $data['profile_id'];
                $profile = $this->profileRepository->update($data, $id);
                $examProcessing = $this->examProcessingRepository->getAll()->where('profile_id', '=', $id);
                foreach ($examProcessing as $exam) {

                    $exams = $this->examProcessingRepository->findById($exam['id']);
                    // dd($exams);
                    $data['level_id'] = $data['level'];
                    $this->examProcessingRepository->update($data, $exams['id']);
                }
                session()->flash('success', 'User Profile Level has been changed successfully');
                return redirect()->back();
                //
            } catch (\Exception $e) {
                session()->flash('danger', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function RejectExam($data, $status)
    {
        if (Auth::user()->mainRole()->name === 'operator') {
            $id = $data;
            $data['status'] = $status;
            $data['state'] = 'computer_operator';
            dd($data);
            try {
                $exam_processing = $this->examProcessingRepository->update($data, $id);
                $profile_id = $exam_processing['profile_id'];
                $profile = $this->profileRepository->findById($profile_id);
                $this->ExamProcessingLog($data, $id, $profile_id);

                if ($exam_processing == false) {
                    session()->flash('danger', 'Oops! Something went wrong.');
                    return redirect()->back()->withInput();
                }
                session()->flash('success', 'Application have been Rejected');
                return redirect()->back();
            } catch (\Exception $e) {
                session()->flash('danger', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function RejectExamProcessing(Request $request)
    {
        if (Auth::user()->mainRole()->name === 'operator') {
            $data = $request->all();
            $id = $data['id'];
            $data['status'] = 'rejected';
            $data['state'] = 'computer_operator';
            try {
                $exam_processing = $this->examProcessingRepository->update($data, $id);
                $profile_id = $exam_processing['profile_id'];
                $this->ExamProcessingLog($data, $id, $profile_id);
                $data['profile_id'] = $profile_id;
                $data['created_by'] = Auth::user()->id;
                //                dd($data);
                $this->profileLog($data);
                $profileEmail = $this->profileRepository->findById($profile_id);
                $email = $this->userRepository->findBy('id', '=', $profileEmail['user_id'])->first();
                MailController::sendprofileVerification($email["name"], $email['email'], $data['remarks']);
                if ($exam_processing == false) {
                    session()->flash('danger', 'Oops! Something went wrong.');
                    return redirect()->back()->withInput();
                }
                session()->flash('success', 'Application have been Rejected');
                return redirect()->back();
            } catch (\Exception $e) {
                session()->flash('danger', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
        } else {
            return redirect()->route('login');
        }
    }
    public function ReExamProcessing(Request $request)
    {
        if (Auth::user()->mainRole()->name === 'operator') {

            $data = $request->all();
            $id = $data['id'];
            $data['rejected'] = 1;
            try {
                $exam_processing = $this->examProcessingRepository->update($data, $id);
                $profile_id = $exam_processing['profile_id'];
                $this->ExamProcessingLog($data, $id, $profile_id);
                if ($exam_processing == false) {
                    session()->flash('danger', 'Oops! Something went wrong.');
                    return redirect()->back()->withInput();
                }
                session()->flash('success', 'Application have been Rejected');
                return redirect()->back();
            } catch (\Exception $e) {
                session()->flash('danger', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function AcceptExam($id)
    {
        if (Auth::user()->mainRole()->name === 'operator') {
            $data['status'] = 'progress';
            $data['state'] = 'officer';
            try {
                $exam_processing = $this->examProcessingRepository->update($data, $id);
                $profile_id = $exam_processing['profile_id'];
                //                $this->ExamProcessingLog($data, $id, $profile_id);
                $data['profile_id'] = $profile_id;
                $data['exam_id'] = $exam_processing->id;
                $data['created_by'] = Auth::user()->id;
                $this->profileLog($data);
                if ($exam_processing == false) {
                    session()->flash('danger', 'Oops! Something went wrong.');
                    return redirect()->back()->withInput();
                }
                session()->flash('success', 'Application Move to forward for Verification');
                return redirect()->back()->refresh()->withInput();
            } catch (\Exception $e) {
                session()->flash('danger', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function AcceptExamProcessing($id)
    {
        if (Auth::user()->mainRole()->name === 'operator') {
            $data['status'] = 'progress';
            $data['state'] = 'officer';
            try {
                $exam_processing = $this->examProcessingRepository->update($data, $id);
                $profile_id = $exam_processing['profile_id'];
                $this->ExamProcessingLog($data, $id, $profile_id);
                if ($exam_processing == false) {
                    session()->flash('danger', 'Oops! Something went wrong.');
                    return redirect()->back()->withInput();
                }
                session()->flash('success', 'Application Move to forward for Verification');
                return redirect()->back()->refresh()->withInput();
            } catch (\Exception $e) {
                session()->flash('danger', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function ExamProcessingLog($data, $id, $profile_id)
    {
        if (Auth::user()->mainRole()->name === 'operator') {

            $data['state'] = 'computer_operator';
            $data["created_by"] = Auth::user()->id;
            $data['exam_processing_id'] = $id;
            $data['profile_id'] = $profile_id;
            if ($data['status'] === 'accepted') {
                $data['remarks'] = 'Exam Applied has been accepted';
                $data['review_status'] = 'Successful';
            } elseif ($data['status'] === 'rejected') {
                $data['review_status'] = 'Failed';
            }
            $logs = $this->examProcessingDetailsRepository->create($data);
            if ($logs == false)
                return false;
            return true;
        } else {
            return redirect()->route('login');
        }
    }

    public function editExamApply($id)
    {


        $exams = Exam::all();
        $exam = $this->examProcessingRepository->findById($id);
        $profile = $this->profileRepository->findById($exam->profile_id);
        $all_program = $this->programRepository->getAll();
        //                        dd($all_program);
        return view('superAdmin::admin.applicant.edit-program-name', compact('all_program', "profile", 'exam', 'exams'));
    }

    public function applyExam(Request $request)
    {
        $data = $request->all();
        $data["status"] = 'progress';
        $data['voucher_image'] = $data['voucher'];
        try {
            $exam = $this->examProcessingRepository->update($data, $data['exam_processing_id']);
            if ($exam == false) {
                session()->flash('danger', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
            session()->flash('success', 'Program has been changed successfully');
            return redirect()->back()->refresh()->withInput();
        } catch (\Exception $e) {
            session()->flash('success', 'Program has been changed successfully.');
            return redirect()->back()->withInput();
        }
    }

    public function doubleDustur()
    {
        $date = "2022-05-05 00:00:00";

        $profiles = Profile::join('exam_registration', 'exam_registration.profile_id', '=', 'profiles.id')
            ->where('exam_registration.created_at', '>', $date)
            ->orderBy('profiles.created_at', 'ASC')
            ->get(['profiles.*', 'exam_registration.*']);

        return $this->view('pages.application-list-double', $profiles);
    }

    public function printCertificate($id, $level)
    {
        $level_id = 0;
        if ($level == 1) {
            $level_id = 5;
        }
        $certificate = Certificate::join('profiles', 'profiles.id', '=', 'certificate_history.profile_id')
            ->join('program', 'program.id', '=', 'certificate_history.program_id')
            ->join('provinces', 'provinces.id', '=', 'profiles.development_region')
            ->join('registrant_qualification', 'registrant_qualification.user_id', '=', 'profiles.user_id')
            ->where('certificate_history.id', '=', $id)
            // ->where('registrant_qualification.program_id', '=', 'certificate_history.program_name')
            ->orderBy('certificate_history.id', 'ASC')
            ->get(['certificate_history.*', 'certificate_history.name as certificate_name', 'certificate_history.program_name as certificate_program_name', 'profiles.*', 'program.name as Name_program', 'registrant_qualification.*', 'provinces.province_name', 'certificate_history.id as certificate_history_id', 'program.code_ as program_code', 'program.qualification as program_qualification', 'registrant_qualification.program_id as regis', 'certificate_history.program_id as certificate_program_id'])->first();

        if ($certificate != null) {

            $qualification = $this->qualificationRepository->getAll()->where('user_id', '=', $certificate->user_id)->where('program_id', '=', $certificate->certificate_program_id)->first();
            if ($qualification == null) {
                $qualification = $this->qualificationRepository->getAll()->where('level', '=', $level)->where('user_id', '=', $certificate->user_id)->first();
            }
            //    dd($qualification, $certificate);
            //        $this->certificateRepository->findById($id);
            $profile = $this->profileRepository->findById($certificate['profile_id']);
            //        $year= auth()->user()->created_at->format('Y');
            //        $month= auth()->user()->created_at->format('m');
            //        $day= auth()->user()->created_at->format('d');
            //        $date=($year,$month,$day);
            //        dd($certificate);
            return view('operator::pages.certificate', compact('certificate', 'profile', 'qualification'));
        }

        session()->flash('success', 'Please update kyc');
        return redirect()->back();
    }

    public function printed($id, $level)
    {
        $certificate = Certificate::join('profiles', 'profiles.id', '=', 'certificate_history.profile_id')
            ->join('program', 'program.id', '=', 'certificate_history.program_id')
            ->join('provinces', 'provinces.id', '=', 'profiles.development_region')
            ->join('registrant_qualification', 'registrant_qualification.user_id', '=', 'profiles.user_id')
            ->where('certificate_history.id', '=', $id)
            ->where('registrant_qualification.level', '=', $level)
            ->orderBy('certificate_history.id', 'ASC')
            ->get(['certificate_history.*', 'certificate_history.name as certificate_name', 'certificate_history.program_name as certificate_program_name', 'profiles.*', 'program.name as Name_program', 'registrant_qualification.*', 'provinces.province_name', 'certificate_history.id as certificate_history_id', 'program.code_ as program_code', 'program.qualification as program_qualification'])->first();

        //        dd($certificate);
        //        $this->certificateRepository->findById($id);
        $profile = $this->profileRepository->findById($certificate['profile_id']);
        //        $year= auth()->user()->created_at->format('Y');
        //        $month= auth()->user()->created_at->format('m');
        //        $day= auth()->user()->created_at->format('d');
        //        $date=($year,$month,$day);
        //        dd($certificate);
        return view('operator::pages.printedCertificate', compact('certificate', 'profile'));
    }


    public function printCertificateIndex($status, $program_id)
    {
        $certificates =  Certificate::join('profiles', 'profiles.id', '=', 'certificate_history.profile_id')
            ->join('program', 'program.id', '=', 'certificate_history.program_id')
            ->join('provinces', 'provinces.id', '=', 'profiles.development_region')
            ->where('certificate_history.is_printed', '=', $status)
            ->where('certificate_history.program_id', '=', $program_id)
            ->get(['certificate_history.*', 'profiles.*', 'program.name as Name_program', 'provinces.province_name', 'certificate_history.id as certificate_history_id']);

        return view('operator::pages.certificate-list', compact('certificates', 'status'));
    }


    public function printCertificateLevel($status)
    {
        return view('operator::pages.certificate.printDesign.index', compact('status'));
    }

    public function printCertificateDashboard($status, $level_name)
    {
        $certificates = Certificate::select(\DB::raw("COUNT(*) as count"), \DB::raw("program_id as program_id"))
            ->groupBy('program_id')
            ->orderBy('count')
            ->where('is_printed', '=', $status)
            ->where('level_name', '=', $level_name)
            ->where('profile_id', '!=', '')
            ->get();

        return view('operator::pages.certificate-card', compact('certificates', 'status'));
    }

    public function printedCertificate($id)
    {
        $data[] = $this->certificateRepository->findById($id);
        $data['is_printed'] = 1;
        $data['printed_date'] = Carbon::now();
        $data['printed_by'] = Auth::user()->id;
        try {
            $exam = $this->certificateRepository->update($data, $id);;
            if ($exam == false) {
                session()->flash('danger', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
            session()->flash('success', 'Moved to printed list');
            return redirect()->back()->refresh()->withInput();
        } catch (\Exception $e) {
            session()->flash('success', 'Program has been changed successfully.');
            return redirect()->back()->withInput();
        }

        return redirect()->back();
    }



    public function subjectCommitteeDashboardList(Request $request, $level = 1, $status = "progress", $subject_commitee_id = 1, $page = 0)
    {
        $take = 20;
        $data = $request->all();
        if ($data != null) {
            if ($data['level_id'] != null)
                $level = $data['level_id'];
            if ($data['status'] != null)
                $status = $data['status'];
        }
        $datas = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
            ->where('exam_registration.level_id', '=', $level)
            ->join('program', 'program.id', '=', 'exam_registration.program_id')
            ->join('profile_processing', 'profile_processing.profile_id', '=', 'profiles.id')
            ->where('profile_processing.current_state', '=', 'subject_committee')
            ->where('profile_processing.status', '=', $status)
            ->where('program.subject-committee_id', '=', $subject_commitee_id)
            ->skip($page * $take)
            ->take($take)
            ->get(['profiles.*', 'program.name as program_name', 'profile_processing.*', 'profiles.id as profile_id']);
        $page = (int)$page;


        return view('operator::pages.subjectCommiteeList', compact('datas', 'level', 'status', 'subject_commitee_id', 'page'));
    }

    public function subjectCommitteeDashboard()
    {
        $examApplied = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
            ->where('exam_registration.level_id', '<', '4')
            ->join('program', 'program.id', '=', 'exam_registration.program_id')
            ->join('profile_processing', 'profile_processing.profile_id', '=', 'profiles.id')
            ->where('profile_processing.current_state', '=', 'subject_committee')
            ->where('program.subject-committee_id', '=', '1')
            ->count(['profiles.id']);

        $GM = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
            ->where('exam_registration.level_id', '<', '4')
            ->join('program', 'program.id', '=', 'exam_registration.program_id')
            ->join('profile_processing', 'profile_processing.profile_id', '=', 'profiles.id')
            ->where('profile_processing.current_state', '=', 'subject_committee')
            ->where('program.subject-committee_id', '=', '2')
            ->count(['profiles.id']);

        $lM = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
            ->where('exam_registration.level_id', '<', '4')
            ->join('program', 'program.id', '=', 'exam_registration.program_id')
            ->join('profile_processing', 'profile_processing.profile_id', '=', 'profiles.id')
            ->where('profile_processing.current_state', '=', 'subject_committee')
            ->where('program.subject-committee_id', '=', '3')
            ->count(['profiles.id']);

        $radio = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
            ->where('exam_registration.level_id', '<', '4')
            ->join('program', 'program.id', '=', 'exam_registration.program_id')
            ->join('profile_processing', 'profile_processing.profile_id', '=', 'profiles.id')
            ->where('profile_processing.current_state', '=', 'subject_committee')
            ->where('program.subject-committee_id', '=', '4')
            ->count(['profiles.id']);

        $opt = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
            ->where('exam_registration.level_id', '<', '4')
            ->join('program', 'program.id', '=', 'exam_registration.program_id')
            ->join('profile_processing', 'profile_processing.profile_id', '=', 'profiles.id')
            ->where('profile_processing.current_state', '=', 'subject_committee')
            ->where('program.subject-committee_id', '=', '5')
            ->count(['profiles.id']);

        $den = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
            ->where('exam_registration.level_id', '<', '4')
            ->join('program', 'program.id', '=', 'exam_registration.program_id')
            ->join('profile_processing', 'profile_processing.profile_id', '=', 'profiles.id')
            ->where('profile_processing.current_state', '=', 'subject_committee')
            ->where('program.subject-committee_id', '=', '6')
            ->count(['profiles.id']);

        $phy = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
            ->where('exam_registration.level_id', '<', '4')
            ->join('program', 'program.id', '=', 'exam_registration.program_id')
            ->join('profile_processing', 'profile_processing.profile_id', '=', 'profiles.id')
            ->where('profile_processing.current_state', '=', 'subject_committee')
            ->where('program.subject-committee_id', '=', '7')
            ->count(['profiles.id']);

        $mis = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
            ->where('exam_registration.level_id', '<', '4')
            ->join('program', 'program.id', '=', 'exam_registration.program_id')
            ->join('profile_processing', 'profile_processing.profile_id', '=', 'profiles.id')
            ->where('profile_processing.current_state', '=', 'subject_committee')
            ->where('program.subject-committee_id', '=', '8')
            ->count(['profiles.id']);

        return view('operator::pages.subjectCommittee', compact('examApplied', 'GM', 'lM', 'radio', 'opt', 'den', 'phy', 'mis'));
    }

    public function examStudentCount($level_id)
    {
        $datas = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
            ->where('exam_registration.level_id', '=', $level_id)
            ->join('program', 'program.id', '=', 'exam_registration.program_id')
            ->join('profile_processing', 'profile_processing.profile_id', '=', 'profiles.id')
            ->where('profile_processing.current_state', '!=', 'operator')
            ->where('profile_processing.current_state', '!=', 'officer')
            ->get(['profiles.*', 'program.name as program_name', 'profile_processing.*', 'profiles.id as profile_id']);


        return view('operator::pages.examStudentList', compact('datas'));
    }

    public  function updateCertificateIndex($certificate_id, $level)
    {
        $certificate = Certificate::join('profiles', 'profiles.id', '=', 'certificate_history.profile_id')
            ->join('program', 'program.id', '=', 'certificate_history.program_id')
            ->join('provinces', 'provinces.id', '=', 'profiles.development_region')
            ->join('registrant_qualification', 'registrant_qualification.user_id', '=', 'profiles.user_id')
            ->where('certificate_history.id', '=', $certificate_id)
            // ->where('registrant_qualification.program_id', '=', 'certificate_history.program_name')
            ->orderBy('certificate_history.id', 'ASC')
            ->get(['certificate_history.*', 'certificate_history.name as certificate_name', 'certificate_history.program_name as certificate_program_name', 'profiles.*', 'program.name as Name_program', 'registrant_qualification.*', 'provinces.province_name', 'certificate_history.id as certificate_history_id', 'program.code_ as program_code', 'program.qualification as program_qualification', 'registrant_qualification.program_id as regis', 'certificate_history.program_id as certificate_program_id'])->first();

        if ($certificate != null) {

            $qualification = $this->qualificationRepository->getAll()->where('user_id', '=', $certificate->user_id)->where('program_id', '=', $certificate->certificate_program_id)->first();

            if ($qualification == null) {
                $qualification = $this->qualificationRepository->getAll()->where('level', '=', $level)->where('user_id', '=', $certificate->user_id)->first();
            }
            //    dd($qualification, $certificate);
            //        $this->certificateRepository->findById($id);
            // $profile = $this->profileRepository->findById($certificate['profile_id']);
            // //        $year= auth()->user()->created_at->format('Y');
            // //        $month= auth()->user()->created_at->format('m');
            // //        $day= auth()->user()->created_at->format('d');
            // //        $date=($year,$month,$day);
            // //        dd($certificate);
            // return view('operator::pages.certificate', compact('certificate', 'profile', 'qualification'));
            $profile = $this->profileRepository->findById($certificate['profile_id']);
            $province = Provinces::all();

            return view('operator::pages.update-certificate', compact('certificate', 'profile', 'province', 'level', 'qualification'));
        }

        session()->flash('success', 'Please update kyc');
        return redirect()->back();
    }
    public  function updateCertificate(Request $request)
    {
        $data = $request->all();
        try {
            $id = $data['certificate_history_id'];
            $program['code_'] = $data['program_name'];
            $program['qualification'] = $data['code'];
            $profile = $this->certificateRepository->findById($id);
            $certificate = $this->certificateRepository->update($data, $id);
            $profileUpdate = $this->profileRepository->update($data, $profile['profile_id']);
            $documents = $this->qualificationRepository->findById($data['qualification_id']);
            $updateDocuments =  $this->qualificationRepository->update($data, $documents['id']);
            $exam = $this->examProcessingRepository->getAll()->where('profile_id', '=', $profile['profile_id'])->first();

            $updateProgram = $this->programRepository->update($program, $exam['program_id']);
            session()->flash('success', 'Certificate data has been changed successfully');

            return redirect()->route("operator.dashboard.printCertificateIndex", [
                'status' => $certificate['is_printed'],
                'program_id' =>    $exam['program_id']
            ]);
            //
        } catch (\Exception $e) {
            session()->flash('danger', 'Oops! Something went wrong.');
            return redirect()->back()->withInput();
        }
    }

    public function deleteExamApplied($id, $profile_id)
    {
        try {

            $profile_log['exam_processing_id'] = $id;
            $profile_log['state'] = 'computer_operator';
            $profile_log['status'] = 'rejected';
            $profile_log['remarks'] = 'Delete the applied Voucher';
            $profile_log['created_by'] = Auth::user()->id;
            $profile_log['profile_id'] = $profile_id;
            $examlog = $this->examLog($profile_log);
            $this->examProcessingRepository->delete($id);

            session()->flash('success', 'Exam has been deleted successfully');
            return redirect()->back();
        } catch (Exception $e) {
            session()->flash('danger', 'Oops! Something went wrong.');
            return redirect()->back()->withInput();
        }
    }


    public  function forwardStudent(Request $request)
    {
        $data = $request->all();
        try {
            $id = $data->profile_id;
            $profileProcessing['profile_id'] = $data->id;
            $profileEmail = $this->profileRepository->findById($data->id);
            $email = $this->userRepository->findBy('id', '=', $profileEmail['user_id'])->first();
            $profileProcessingId = $this->profileProcessingRepository->getAll()->where('profile_id', '=', $id)->first();
            if ($data['profile_status'] === "Verified" || $data['profile_status'] === "Reviewing") {
                $data['status'] = 'progress';
                $data['remarks'] = 'Document Verified and is Forwarded to Officer';
                $data['review_status'] = 'Successful';
                $data['current_state'] = 'officer';
                $profileEmail = $this->profileRepository->findById($id);
                $email = $this->userRepository->findBy('id', '=', $profileEmail['user_id'])->first();
                if ($profileProcessingId) {
                    $profileProcessings = $this->profileProcessingRepository->update($data, $profileProcessingId['id']);
                } else
                    $profileProcessings = $this->profileProcessingRepository->create($data);
            } elseif ($data['profile_status'] == "Rejected") {
                $data['status'] = 'rejected';
                $data['review_status'] = 'Rejected';
                $data['current_state'] = 'computer_operator';
                MailController::sendprofileVerification($email["name"], $email['email'], $data['remarks']);
                if ($profileProcessingId) {
                    $profileProcessings = $this->profileProcessingRepository->update($data, $profileProcessingId['id']);
                } else
                    $profileProcessings = $this->profileProcessingRepository->create($data);
            } elseif ($data['profile_status'] === "Pending") {
                $data['status'] = 'pending';
                $data['review_status'] = 'Pending';
                $data['current_state'] = 'computer_operator';
                MailController::sendprofileVerification($email["name"], $email['email'], $data['remarks']);
                if ($profileProcessingId) {
                    $profileProcessings = $this->profileProcessingRepository->update($data, $profileProcessingId['id']);
                } else
                    $profileProcessings = $this->profileProcessingRepository->create($data);
            }
        } catch (\Exception $e) {
            session()->flash('danger', 'Oops! Something went wrong.');
            return redirect()->back()->withInput();
        }
    }


    public function fowardStudentState(Request $request)
    {
        $data = $request->all();
        $id = $data['profile_id'];
        $data['current_state'] = $data['state'];
        $data['status'] = 'progress';
        $profileData['profile_state'] = $data['state'];
        $profileData['profile_status'] = 'Reviewing';
        $data['remark'] = "Forwared to Officer";
        try {
            $exam = $this->examProcessingRepository->findBy('profile_id', '=', $data['profile_id']);
            $profileProcesing  = $this->profileProcessingRepository->findBy('profile_id', '=', $data['profile_id'])->first();

            foreach ($exam as $exams)
                $examUpdate =  $this->examProcessingRepository->update($data, $exams['id']);
            $data['exam_id'] = $exam['id'];
            //   dd($id);
            $profileProcesingUpdate =  $this->profileRepository->update($profileData, $data['profile_id']);


            if ($profileProcesing) {
                $this->profileProcessingRepository->update($data, $profileProcesing['id']);
            } else {
                $profileProcessings = $this->profileProcessingRepository->create($data);
            }

            $this->profileLog($data);



            //             $id = $this->profileRepository->findById($data['profile_id']);

            //             dd('you are heer');
            //             return redirect()
            return redirect()->route('operator.applicant.list.review', ['id' => $data['profile_id']]);
        } catch (\Exception $e) {
            session()->flash('danger', 'Oops! Something went wrong.');
            dd($e);

            return redirect()->route('operator.applicant.list.review', ['id' => $data['profile_id']]);
        }
    }


    public function exportCsv(Request $request)
    {
        $fileName = 'tasks.csv';

        $tasks = ExamProcessing::select(\DB::raw("COUNT(program_id) as count"), \DB::raw("program_id as program_id"))
            ->groupBy('program_id')
            ->orderBy('count')
            ->where('level_id', '<=', 3)
            ->where('exam_registration.status', '!=', 'rejected')
            ->where('exam_registration.state', '!=', 'council')
            ->where('exam_registration.state', '!=', 'computer_operator')
            ->where('exam_registration.exam_id', '=', '3')
            ->get();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Count', 'Program Name');

        $callback = function () use ($tasks, $columns) {

            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            foreach ($tasks as $task) {
                $row['count'] = $task->count;
                $row['program_name'] = $task->getProgramName();


                fputcsv($file, array(
                    $row['count'],
                    $row['program_name'],
                ));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportPCLCertificate(Request $request)
    {
        $fileName = 'pclRegistrationNumber.csv';

        $tasks =  Certificate::join('admit_card', 'admit_card.profile_id', 'certificate_history.profile_id')
            ->where('certificate_history.level_name', '=', 'Second')
            ->where('certificate_history.decision_date', '=', '2022-09-21')
            ->whereDate('admit_card.created_at', '!=', date('2022-07-01'))
            ->get();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Name', 'Registration Number', ' Symbol Number', 'Date of Birth', 'Profile Id');

        $callback = function () use ($tasks, $columns) {

            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            foreach ($tasks as $task) {
                $row['Name'] = $task->name;
                $row['Registration Number'] = $task->cert_registration_number;
                $row['Symbol Number'] = $task->symbol_number;
                $row['Date of Birth'] = $task->date_of_birth;
                $row['Profile Id'] = $task->profile_id;



                fputcsv($file, array(
                    $row['Name'],
                    $row['Registration Number'],
                    $row['Symbol Number'],
                    $row['Date of Birth'],
                    $row['Profile Id'],


                ));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function statusUpdateExam()
    {
        $exams = ExamProcessing::all()->where('status', '=', 'rejected')->where('attempt', '=', 1);
        foreach ($exams as $exam) {
            $profile = $this->profileRepository->findById($exam->profile_id);
            if ($profile->profile_status == 'Rejected' && $profile->updated_at >= '2022-08-10' && $profile->profile_state == 'officer') {
                $examState['status'] = 'progress';
                $profileState['profile_state'] = 'computer_operator';
                $profileState['profile_status'] = 'Reviewing';
                $examStatue = $this->examProcessingRepository->update($examState, $exam->id);
                $profile = $this->profileRepository->update($profileState, $exam->profile_id);
                $profile_processing = $this->profileProcessingRepository->getAll()->where('profile_id', '=', $exam->profile_id)->first();
                if ($profile_processing === 'null') {
                    $profile_processings['profile_id'] = $exam->profile_id;
                    $profile_processings['current_state'] = 'computer_operator';
                    $profile_processings['status'] = 'rejected';
                    $this->profileProcessingRepository->create($profile_processings);
                }
            }
        }
        return redirect()->back();
    }

    public function deleteDuplicate($id)
    {
        $duplicateMessage = "Has been removed by Operator, Due to Duplicate";
        $profile_log['status'] = 'rejected';
        $profile_log['remarks'] = $duplicateMessage;
        $profile_log['review_status'] = 'Rejected';
        $profile_log['created_by'] = Auth::user()->id;
        $profile_log['profile_id'] = $id;

        $exam = $this->examProcessingRepository->getAll()->where('profile_id', '=', $id);
        if (count($exam) > 1) {
            return redirect()->back();
        } else {
            try {
                $exam = $this->examProcessingRepository->getAll()->where('profile_id', '=', $id)->first();
                $deleteExam = $this->examProcessingRepository->delete($exam->id);
                $deleteProfile = $this->profileRepository->delete($id);
                $logs = $this->profileLogs($profile_log);
            } catch (Exception $e) {
                return redirect()->back();
            }
        }
        session()->flash('success', 'Deleted Successfully');
        return redirect()->back();
    }

    public function failedStudentList($id)
    {
        // $profileLogs = Profilelogs::whereNull('state')
        //     ->where('remarks', 'LIKE', 'Profile Verified and forwarded to Subject Committee')
        //     ->get();

        // // dd($profileLogs);

        // foreach ($profileLogs as $profileLog) {
        //     $data['state'] = 'registrar';
        //     $data['created_by'] = 32594;

        //     $this->profileLogsRepository->update($data, $profileLog['id']);
        // }

        // $examApplieds = ExamProcessing::all()->where('exam_id', $id)->where('status', 'progress')->where('state', 'exam_committee');

        // foreach ($examApplieds as $examApplied) {
        //     $exam['status'] = 're-exam';
        //     $this->examProcessingRepository->update($exam, $examApplied['id']);
        // }
        $students =
            ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
            ->joinSub(function ($query) {
                $query->select('profile_id', DB::raw('GROUP_CONCAT(CONCAT(exam_id, "-", program_id, "-", voucher_image)) as applied_exams'))
                    ->from('exam_registration')
                    ->groupBy('profile_id');
            }, 'applied_exams_sub', function ($join) {
                $join->on('profiles.id', '=', 'applied_exams_sub.profile_id');
            })
            ->select('profiles.id as profile_id', 'applied_exams_sub.applied_exams', 'first_name', 'middle_name', 'last_name', 'dob_nep', 'status', 'state', 'level_id', 'voucher_image', 'exam_registration.id as exam_registration_id')
            ->where('exam_registration.state', '=', 'exam_committee')
            ->where('exam_registration.status', '=', 're-exam')
            ->where('exam_registration.exam_id', '=', $id)
            ->get();

        return view('operator::pages.application-list-double', compact('students'));
    }

    public function moveToCommittee(Request $request)
    {
    }


    public function examDetails($id)
    {
        $appliedCount = ExamProcessing::all()->where('exam_id', '=', $id);
        $rejectedCount = ExamProcessing::all()->where('status', '=', 'rejected')->where('exam_id', '=', $id);
        $failedCount =  DB::table('exam_registration')
            ->select('profile_id', 'exam_id', DB::raw('COUNT(*) as `count`'))
            ->groupBy('profile_id', 'exam_id')
            ->havingRaw('COUNT(*) >= 2')
            ->get();
        $operatorState = ExamProcessing::all()->where('exam_id', '=', $id)->where('state', '=', 'computer_operator')->where('status', '!=', 'rejected');
        $operatorAcceptedState = ExamProcessing::all()->where('exam_id', '=', $id)->where('state', '!=', 'computer_operator');
        $operatorRejectedState = ExamProcessing::all()->where('exam_id', '=', $id)->where('state', '=', 'computer_operator')->where('status', '=', 'rejected');

        $levelWiseCount = $appliedCount->groupBy('level_id')->map->count();
        $programWiseCount = $appliedCount->groupBy('program_id')->map->count();

        $examApplied = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
            ->where('exam_registration.exam_id', '=', $id)
            ->join('program', 'program.id', '=', 'exam_registration.program_id')
            ->where('exam_registration.state', '=', 'subject_committee')
            ->where('program.subject-committee_id', '=', '1')
            ->count(['profiles.id']);

        $GM = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
            ->where('exam_registration.exam_id', '=', $id)
            ->join('program', 'program.id', '=', 'exam_registration.program_id')
            ->where('exam_registration.state', '=', 'subject_committee')
            ->where('program.subject-committee_id', '=', '2')
            ->count(['profiles.id']);


        $lM = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
            ->where('exam_registration.exam_id', '=', $id)
            ->join('program', 'program.id', '=', 'exam_registration.program_id')
            ->where('exam_registration.state', '=', 'subject_committee')
            ->where('program.subject-committee_id', '=', '3')
            ->count(['profiles.id']);


        $radio = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
            ->where('exam_registration.exam_id', '=', $id)
            ->join('program', 'program.id', '=', 'exam_registration.program_id')
            ->where('exam_registration.state', '=', 'subject_committee')
            ->where('program.subject-committee_id', '=', '4')
            ->count(['profiles.id']);


        $opt = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
            ->where('exam_registration.exam_id', '=', $id)
            ->join('program', 'program.id', '=', 'exam_registration.program_id')
            ->where('exam_registration.state', '=', 'subject_committee')
            ->where('program.subject-committee_id', '=', '5')
            ->count(['profiles.id']);


        $den = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
            ->where('exam_registration.exam_id', '=', $id)
            ->join('program', 'program.id', '=', 'exam_registration.program_id')
            ->where('exam_registration.state', '=', 'subject_committee')
            ->where('program.subject-committee_id', '=', '6')
            ->count(['profiles.id']);


        $phy = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
            ->where('exam_registration.exam_id', '=', $id)
            ->join('program', 'program.id', '=', 'exam_registration.program_id')
            ->where('exam_registration.state', '=', 'subject_committee')
            ->where('program.subject-committee_id', '=', '7')
            ->count(['profiles.id']);

        $student = ExamProcessing::select('profile_id', 'exam_id', 'status', 'state')
            ->groupBy('profile_id', 'exam_id', 'status', 'state')
            // ->where('level_id','!=', '4')
            ->where('exam_registration.state', '=', 'exam_committee')
            ->where('exam_registration.status', '=', 're-exam')
            ->where('exam_registration.exam_id', '=', 3)
            ->get();

        return view('operator::pages.exam.show', compact(
            'appliedCount',
            'rejectedCount',
            'failedCount',
            'operatorState',
            'operatorAcceptedState',
            'operatorRejectedState',
            'levelWiseCount',
            'programWiseCount',
            'id',
            'examApplied',
            'GM',
            'lM',
            'radio',
            'opt',
            'den',
            'phy',
            'student'
        ));
    }

    public function getProgramStudent($id, $exam_id)
    {
        $students = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
            ->where('exam_registration.program_id', '=', $id)
            ->join('program', 'program.id', '=', 'exam_registration.program_id')
            ->where('exam_registration.exam_id', '=', $exam_id)
            ->get(['profiles.*', 'program.name as program_name', 'profiles.id as profile_id']);

        return view('operator::pages.program-student', compact('students'));
    }

    public function getDisappearStudents()
    {
        $students  =  Profile::join('exam_registration', 'exam_registration.profile_id', '=', 'profiles.id')
            ->where('profiles.profile_state', '=', 'officer')
            ->where('exam_registration.state', '=', 'computer_operator')
            ->join('program', 'program.id', '=', 'exam_registration.program_id')
            ->where('exam_registration.exam_id', '=', 3)
            ->get(['profiles.*', 'program.name as program_name', 'profiles.id as profile_id']);
        return view('operator::pages.program-student', compact('students'));
    }


    public function programWiseStudentCountCSV(Request $request)
    {
        $fileName = 'programWiseStudentCount.csv';
        $query =  ExamProcessing::query()->select(\DB::raw("COUNT(program_id) as count"), \DB::raw("program_id as program_id"))
            ->groupBy('program_id')
            ->orderBy('count')
            ->where('level_id', '<=', 3)
            ->where('exam_id', '=', $request->exam_id);
        if ($request->computer_operator != null) {
            $query->where('exam_registration.state', '!=', $request->computer_operator);
        }
        if ($request->officer != null) {
            $query->where('exam_registration.state', '!=', $request->officer);
        }
        if ($request->registrar != null) {
            $query->where('exam_registration.state', '!=',  $request->registar);
        }
        if ($request->subject_committee != null) {
            $query->where('exam_registration.state', '!=', $request->subject_committee);
        }
        if ($request->exam_committee != null) {
            $query->where('exam_registration.state', '!=',  $request->exam_committee);
        }
        if ($request->council != null) {
            $query->where('exam_registration.state', '!=', $request->council);
        }
        if ($request->rejected != null) {
            $query->where('exam_registration.status', '!=', $request->rejected);
        }
        if ($request->progress != null) {
            $query->where('exam_registration.status', '!=', $request->progress);
        }

        $tasks = $query->get();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Count', 'Program Name');

        $callback = function () use ($tasks, $columns) {

            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            foreach ($tasks as $task) {
                $row['count'] = $task->count;
                $row['program_name'] = $task->getProgramName();


                fputcsv($file, array(
                    $row['count'],
                    $row['program_name'],
                ));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function studentDetailCSV(Request $request)
    {
        $fileName = 'StudentDetail.csv';
        $query =  ExamProcessing::query()
            ->join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
            ->where('level_id', '<=', 3)
            // ->where('exam_id', '=', $request->exam_id)
            ->join('level', 'level.id', '=', 'exam_registration.level_id')
            ->join('users', 'users.id', '=', 'profiles.user_id')
            ->join('registrant_qualification', 'registrant_qualification.user_id', '=', 'profiles.user_id');
        // if ($request->computer_operator != null) {
        //     $query->where('exam_registration.state', '=', $request->computer_operator);
        // }
        // if ($request->officer != null) {
        //     $query->where('exam_registration.state', '=', $request->officer);
        // }
        // if ($request->registrar != null) {
        //     $query->where('exam_registration.state', '=',  $request->registar);
        // }
        // if ($request->subject_committee != null) {
        //     $query->where('exam_registration.state', '=', $request->subject_committee);
        // }
        // if ($request->exam_committee != null) {
        //     $query->where('exam_registration.state', '=',  $request->exam_committee);
        // }
        // if ($request->council != null) {
        //     $query->where('exam_registration.state', '=', $request->council);
        // }
        // if ($request->rejected != null) {
        //     $query->where('exam_registration.status', '=', $request->rejected);
        // }
        // if ($request->progress != null) {
        //     $query->where('exam_registration.status', '=', $request->progress);
        // }


        $tasks = $query->get(['level.name as level_name', 'profiles.*', 'users.email as email', 'users.phone_number as phone_number', 'exam_registration.*', 'exam_registration.id as exam_regisration_id', 'registrant_qualification.*']);;

        dd($tasks);

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array(
            'Name', 'Father Name', 'Mother Name', 'Date of Birth',
            'Gender', 'Citizenship', 'Program Name', 'Level', 'Email', 'Phone Number', 'State', 'Status', 'Symbol Number'
        );

        $callback = function () use ($tasks, $columns) {

            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            foreach ($tasks as $task) {
                $row['Name'] = $task->first_name . ' ' . $task->middle_name . '' . $task->last_name;
                $row['Father Name'] = $task->father_name;
                $row['Mother Name'] = $task->mother_name;
                $row['Date of Birth'] = $task->dob_nep;
                $row['Gender'] = $task->sex;
                $row['Citizenship'] = $task->citizenship_number;
                $row['program_name'] = getProgramName($task->program_id);
                $row['Level'] = $task->level_name;
                $row['Email'] = $task->email;
                $row['Phone Number'] = $task->phone_number;
                $row['State'] = $task->state;
                $row['Status'] = $task->status;
                $row['Symbol Number'] = $task->board_university;




                fputcsv($file, array(
                    $row['Name'],
                    $row['Father Name'],
                    $row['Mother Name'],
                    $row['Date of Birth'],
                    $row['Gender'],
                    $row['Citizenship'],
                    $row['program_name'],
                    $row['Level'],
                    $row['Email'],
                    $row['Phone Number'],
                    $row['State'],
                    $row['Status'],
                    $row['Symbol Number']
                ));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }


    public function studentCardShow($id)
    {
        $data = Certificate::where('certificate_history.id', '=', $id)
            ->get()->first();
        $exam = ExamProcessing::where('profile_id', '=', $data['profile_id'])->where('status', '=', 'accepted')->where('state', '=', 'council')->first();
        $profile = $this->profileRepository->findById($data['profile_id']);

        return view('operator::pages.id-card', compact('data', 'profile', 'exam'));
    }



    public function certificateIndex()
    {

        $data = $this->certificateHistoryRepository->getAll()->where('is_foreign', false);
        return view('operator::pages.certificate.index', compact('data'));
    }

    public function printPartilipiCertificate($id)
    {
        $data = $this->certificateHistoryRepository->findById($id);
        return view('operator::pages.certificate.print', compact('data'));
    }


    public function printForeignCertificate($id)
    {
        $data = $this->certificateHistoryRepository->findById($id);
        return view('operator::pages.certificate.foreign.print', compact('data'));
    }

    public function editForeignCertificate($id)
    {
        $data = $this->certificateHistoryRepository->findById($id);
        return view('operator::pages.certificate.foreign.edit', compact('data'));
    }

    public function indexForeignCertificate()
    {
        $data = $this->certificateHistoryRepository->getAll()->where('is_foreign', true);
        return view('operator::pages.certificate.foreign.index', compact('data'));
    }


    public function addPrintCertificate()
    {
        return view('operator::pages.certificate.form');
    }

    public function addForeignPrintCertificate()
    {
        return view('operator::pages.certificate.foreign.form');
    }

    public function storeCertificateData(Request $request)
    {
        $data = $request->all();
        try {
            $certificate = $this->certificateHistoryRepository->create($data);
            if ($certificate == false) {
                session()->flash('danger', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
            if (isset($data['is_foreign'])) {
                return redirect()->route("operator.certificateIndex.foreign.index");
            }
            return redirect()->route("operator.certificateIndex");
        } catch (Exception $e) {
            session()->flash('danger', 'Oops! Something went wrong.');
            return redirect()->back()->withInput();
        }
    }

    public function editCertificateData($id)
    {
        $data = $this->certificateHistoryRepository->findById($id);
        return view('operator::pages.certificate.edit', compact('data'));
    }


    public function updateCertificateData(Request $request)
    {
        $data = $request->all();
        $id = $data['id'];
        try {
            $certificate = $this->certificateHistoryRepository->update($data, $id);
            if ($certificate == false) {
                session()->flash('danger', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
            if (isset($data['is_foreign'])) {
                return redirect()->route("operator.certificateIndex.foreign.index");
            }
            return redirect()->route("operator.certificateIndex");
        } catch (Exception $e) {
            session()->flash('danger', 'Oops! Something went wrong.');
            return redirect()->back()->withInput();
        }
    }

    public function printDuplicateCertificate($id)
    {
        $data = $this->certificateHistoryRepository->findById($id);
        return view('operator::pages.certificate.printDuplicate', compact('data'));
    }

    public function backCertificate($id)
    {
        $data = $this->backDataRepository->getAll()->where('certificate_id', '=', $id);
        return view('operator::pages.backdata.index', compact('data', 'id'));
    }

    public function OldfileImport(Request $request)
    {
        Excel::import(new OldFileImport(), $request->file('file')->store('temp'));
        return back();
    }


    public function storeBackData(Request $request)
    {
        $data = $request->all();
        $date = Carbon::parse($data['update_date']);
        $data['expire_at'] = $date->addYear(5);
        try {
            $certificate = $this->backDataRepository->create($data);
            if ($certificate == false) {
                session()->flash('danger', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
            return redirect()->route("operator.certificateIndex.backCertificate", ['id' => $data['certificate_id']]);
        } catch (Exception $e) {
            session()->flash('danger', 'Oops! Something went wrong.');
            return redirect()->back()->withInput();
        }
    }

    public function updateBackData(Request $request)
    {
        $data = $request->all();
        $id = $data['id'];
        try {
            $certificate = $this->backDataRepository->update($data, $id);
            if ($certificate == false) {
                session()->flash('danger', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
            return redirect()->route("operator.certificateIndex");
        } catch (Exception $e) {
            session()->flash('danger', 'Oops! Something went wrong.');
            return redirect()->back()->withInput();
        }
    }

    public function addDataCertificate($id)
    {
        return view('operator::pages.backdata.form', compact('id'));
    }


    public function printCertificateBackUpData($id)
    {
        $certificate = Certificate::where('profile_id', '=', $id)->first();

        $detail_data = $this->certificateHistoryDataBackRepository->getAll()->where('profile_id', '=', $id)->first();
        // dd($detail_data);
        return view('operator::pages.certificateBackUpData.index', compact('certificate', 'detail_data'));
    }

    public function editCertificateBackUpData($id)
    {
        $data = Certificate::where('profile_id', '=', $id)->first();

        $detail_data = $this->certificateHistoryDataBackRepository->getAll()->where('profile_id', '=', $id)->first();
        return view('operator::pages.certificateBackUpData.edit', compact('data', 'detail_data'));
    }

    public function updateCertificateBackUpData(Request $request)
    {

        $data = $request->all();
        $certificate_id = $data['certificate_id'];
        $certificate_back_id = $data['certificate_back_id'];

        try {
            $certificate = $this->certificateRepository->update($data, $certificate_id);
            $certificate_back = $this->certificateHistoryDataBackRepository->update($data, $certificate_back_id);


            if ($certificate == false) {
                session()->flash('danger', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
            return redirect()->route("operator.printCertificateBackUpData", ['id' => $certificate['profile_id']]);
        } catch (Exception $e) {
            session()->flash('danger', 'Oops! Something went wrong.');
            return redirect()->back()->withInput();
        }
    }


    public function kycIndex(Request $request)
    {
        if ($request->isMethod('post')) {

            $query = KYCData::query();

            if ($request->name != null) {
                $query->where('name', 'like', '%' . $request->name  . '%');
            }


            $kycs = $query->get();


            return view('operator::pages.kyc.index', compact('kycs'));
        } else {
            $kycs = $this->kycRepository->getAll();
            // $kycs = [];
            // foreach ($kyces as $kyc) {
            //     $profile = $this->profileRepository->getAll()->where('id', '=', $kyc->profile_id)->first();
            //     if ($profile->father_name) {
            //         $kycs[] = $kyc;
            //     }
            // }
            return view('operator::pages.kyc.index', compact('kycs'));
        }
    }

    public function allocate($certificate_id)
    {
        $kycs = $this->kycRepository->getAll();
        return view('operator::pages.kyc.allocate', compact('kycs', 'certificate_id'));
    }

    public function deleteAllocate($id)
    {
        try {
            $kyc =  $this->kycRepository->delete($id);
            if ($kyc == false) {
                session()->flash('danger', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
            return redirect()->back();
        } catch (Exception $e) {
            session()->flash('danger', 'Oops! Something went wrong.');
            return redirect()->back()->withInput();
        }
    }

    public function uploadAllocate(Request $request)
    {
        $data = $request->all();
        $certificate = Certificate::where('id', '=', $data['certificate_profile_id'])->first();

        try {
            $certificates = $this->certificateRepository->update($data, $certificate->id);

            if ($certificates == false) {
                session()->flash('danger', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
            return redirect()->back();
        } catch (Exception $e) {
            session()->flash('danger', 'Oops! Something went wrong.');
            return redirect()->back()->withInput();
        }
    }


    public function exportCsvAsRegistrar(Request $request)
    {
        $fileName = 'tasks.csv';

        $tasks = ExamProcessing::where('exam_registration.created_at', '<=', '2023-04-06')
            ->where('exam_registration.created_at', '>=', '2023-03-20')
            // ->where('exam_registration.level_id', '<=', '3')
            ->where('exam_registration.exam_id', '=', '4')
            ->where('exam_registration.status', '!=', 'rejected')


            ->count();

        // foreach ($tasks as $task) {
        //     $data['exam_id'] = 5;
        //     $this->examProcessingRepository->update($data, $task['id']);
        // }

        dd($tasks);

        // $headers = array(
        //     "Content-type"        => "text/csv",
        //     "Content-Disposition" => "attachment; filename=$fileName",
        //     "Pragma"              => "no-cache",
        //     "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
        //     "Expires"             => "0"
        // );

        // $columns = array(
        //     'Name', 'Father Name', 'Mother Name', 'Date of Birth',
        //     'Gender', 'Citizenship', 'Program Name', 'Level', 'Email', 'Phone Number', 'State', 'Status', 'Symbol Number'
        // );

        // $callback = function () use ($tasks, $columns) {

        //     $file = fopen('php://output', 'w');
        //     fputcsv($file, $columns);
        //     foreach ($tasks as $task) {
        //         $row['Name'] = $task->first_name . ' ' . $task->middle_name . '' . $task->last_name;
        //         $row['Father Name'] = $task->father_name;
        //         $row['Mother Name'] = $task->mother_name;
        //         $row['Date of Birth'] = $task->dob_nep;
        //         $row['Gender'] = $task->sex;
        //         $row['Citizenship'] = $task->citizenship_number;
        //         $row['program_name'] = getProgramName($task->program_id);
        //         $row['Level'] = $task->level_id;
        //         $row['Email'] = $task->email;
        //         $row['Phone Number'] = $task->phone_number;
        //         $row['State'] = $task->state;
        //         $row['Status'] = $task->status;




        //         fputcsv($file, array(
        //             $row['Name'],
        //             $row['Father Name'],
        //             $row['Mother Name'],
        //             $row['Date of Birth'],
        //             $row['Gender'],
        //             $row['Citizenship'],
        //             $row['program_name'],
        //             $row['Level'],
        //             $row['Email'],
        //             $row['Phone Number'],
        //             $row['State'],
        //             $row['Status'],

        //         ));
        //     }

        //     fclose($file);
        // };

        // return response()->stream($callback, 200, $headers);
    }

    public function rejectAll()
    {

        $exams = ExamProcessing::all()->where('status', '=', 'progress')->where('state', '=', 'exam_committee')->where('level_id', '=', '1');
        // dd($exams);
        foreach ($exams as $exam) {
            $profile = $this->profileRepository->findById($exam->profile_id);
            $profile_id = $exam->profile_id;
            $profile_log['profile_id'] = $exam->profile_id;
            $profile_log['status'] = 'rejected';
            $profile_log['state'] = 'exam_committee';

            $profile_log['remarks'] =   'Upload all required document and Voucher';
            $profile_log['review_status'] = 'Rejected';
            $profile_log['created_by'] = Auth::user()->id;
            $profile_processing['status'] = 'rejected';

            $examed['status'] = 'rejected';

            $logs = $this->profileLogs($profile_log);
            $email = $this->userRepository->findBy('id', '=', $profile['user_id'])->first();

            if ($logs) {
                $profileProcessingId = $this->profileProcessingRepository->getAll()->where('profile_id', '=', $profile_id)->first();
                if ($profileProcessingId === null) {
                    $profileProcessings = $this->profileProcessingRepository->create($profile_processing);
                } else {
                    $profileProcessings = $this->profileProcessingRepository->update($profile_processing, $profileProcessingId['id']);
                }
                $examProcessing = $this->examProcessingRepository->getAll()->where('id', '=',  $exam->id)->first();
                if ($examProcessing) {
                    $exam_processing = $this->examProcessingRepository->update($examed, $examProcessing['id']);
                    if ($exam_processing === 'false') {
                        session()->flash('error', 'Error Occured While Saving Data');
                    }
                    $profile_log['exam_processing_id'] = $examProcessing['id'];
                    $examlog = $this->examLog($profile_log);
                    if ($examlog) {
                        MailController::sendprofileVerification($email["name"], $email['email'], $profile_log['remarks']);
                    }
                }
            }
        }

        return redirect()->back();
    }

    public function moveFileToSubjectCommittee()
    {

        $datas = $this->examProcessingRepository->getAll()->where('state', '=', 'registrar')->where('status', '=', 'progress');

        foreach ($datas as $profile) {
            $data['profile_state'] = 'subject_committee';
            $profile_log['status'] = 'progress';
            $profile_log['exam_id'] = $profile->id;
            $profile_log['profile_id'] = $profile->profile_id;
            $profile_log['remarks'] = 'Profile Verified and forwarded to Subject Committee';
            $profile_log['review_status'] = 'Successfully Accepeted';
            $profile_processing['current_state'] = 'subject_committee';
            $profile_processing['status'] = 'progress';
            $exam['state'] = 'subject_committee';
            $exam['status'] = 'progress';
            $logs = $this->profileLog($profile_log);
            if ($logs) {
                $profileProcessingId = $this->profileProcessingRepository->getAll()->where('profile_id', '=', $profile->profile_id)->first();
                if ($profileProcessingId === null) {
                    $profile_processing['profile_id'] = $profile->profile_id;
                    $this->profileProcessingRepository->create($profile_processing);
                } else {
                    $profileProcessings = $this->profileProcessingRepository->update($profile_processing, $profileProcessingId['id']);
                }
                $examProcessing = $this->examProcessingRepository->getAll()->where('state', '=', 'registrar')->where('profile_id', '=', $profile->profile_id)->first();
                if ($examProcessing) {
                    $exam_processing = $this->examProcessingRepository->update($exam, $examProcessing['id']);
                    if ($exam_processing === 'false') {
                        session()->flash('error', 'Error Occured While Saving Data');
                    }
                    $profile_log['exam_processing_id'] = $examProcessing['id'];
                    $examlog = $this->examLog($profile_log);
                }
            }
        }
    }


    public function removeUnwantedFile()
    {

        $duplicates = ExamProcessing::select('profile_id')
            ->groupBy('profile_id')
            ->where('status', 'progress')
            ->where('state', 'exam_committee')
            ->havingRaw('COUNT(*) > 1')
            ->get();

        dd($duplicates);
        foreach ($duplicates as $duplicate) {
            $exams = ExamProcessing::all()->where('profile_id', $duplicate->profile_id);
            foreach ($exams as $exam) {
                $data['status'] = 'rejected';
                $this->examProcessingRepository->update($data, $exam->id);
            }
            // dd($exams);
        }
        $exams = ExamProcessing::all()->where('exam_id', '!=', '5')->where('level_id', '=', '3')->where('status', '=', 'progress');
        dd($exams);
        foreach ($exams as $exam) {
            $data['exam_id'] = 5;
            $this->examProcessingRepository->update($data, $exam->id);
        }

        return redirect()->back();
    }

    public function moveToExamCommittee(Request $request)
    {
        $datas = $request->all();
        foreach ($datas['selectedStudents'] as $data) {
            $exam['status'] = 'progress';
            $this->examProcessingRepository->update($exam, $data);
        }
        return redirect()->route('operator.failedStudentList', ['id' => 6]);
    }


    public function getQualification($id)
    {
        $qualification = $this->qualificationRepository->findById($id);
        $master_program = $this->programRepository->getAll();
        // dd($qualification);
        return view('operator::pages.qualification.qualification', compact('qualification', 'master_program'));
    }


    public function updateQualification(Request $request, $id)
    {
        $data = $request->all();
        try {
            $post = $this->qualificationRepository->update($data, $id);
            if ($post == false) {
                session()->flash('danger', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
            session()->flash('success', 'Qualification updated successfully');
            return redirect()->back();
        } catch (\Exception $e) {
            dd($e);
            session()->flash('danger', 'Oops! Something went wrong.');
            return redirect()->back()->withInput();
        }
    }

    public function deleteQualification($id)
    {
        try {
            $certificate = $this->qualificationRepository->delete($id);
            if ($certificate == false) {
                session()->flash('danger', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
            return redirect()->back();
        } catch (Exception $e) {
            session()->flash('danger', 'Oops! Something went wrong.');
            return redirect()->back()->withInput();
        }
    }

    public function deleteDuplicateCertificate($id)
    {

        try {
            $certificate = $this->certificateHistoryRepository->delete($id);
            if ($certificate == false) {
                session()->flash('danger', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
            return redirect()->route("operator.certificateIndex");
        } catch (Exception $e) {
            session()->flash('danger', 'Oops! Something went wrong.');
            return redirect()->back()->withInput();
        }
    }




    public function examPendingList()
    {
        $datas = $this->examProcessingRepository->getAll()->where('status', 'pending')->where('state', 'computer_operator');
        foreach ($datas as $da) {
            $profile_processing = $this->profileProcessingRepository->getAll()->where('profile_id', $da['profile_id'])->first();
            if (!$profile_processing) {
                $data['status'] = 'pending';
                $data['profile_id'] = $da['profile_id'];
                $data['remarks'] = 'Pending';
                $data['review_status'] = 'Pending';
                $data['current_state'] = 'computer_operator';
                $this->profileProcessingRepository->create($data);
            }
        }

        return redirect()->back();
    }


    public function updateRegistrarApproveLogs()
    {

        $datas = $this->profileLogsRepository->getAll()->where('remarks', 'Like', '% Profile Verified and forwarded to Subject Committee %');
        dd($datas);
        foreach ($datas as $da) {

            $data['state'] = 'registrar';
            $data['created_by'] = 32594;
            $this->profileProcessingRepository->update($data, $da['id']);
        }

        return redirect()->back();
    }

    public function allTslcStudent()
    {
        $examIdsToUpdate = $this->examProcessingRepository
            ->getAll()
            ->where('state', 'subject_committee')
            ->where('status', 'progress')
            ->where('level_id', '4')
            ->whereIn('program_id', ['41', '42', '44', '45', '127'])
            ->pluck('id'); // Assuming 'id' is the primary key of your table

        // Update the status to 'council'
        ExamProcessing::whereIn('id', $examIdsToUpdate)->update(['state' => 'council']);
        dd($examIdsToUpdate);
    }


    public function allProgressList()
    {
        $data =
            DB::table('exam_registration')
            ->select('state', DB::raw('count(*) as application_count'))
            ->where('exam_id', 7)
            ->groupBy('state')
            ->get();

        dd($data);
    }

    // public function distantProgramName()
    // {
    //     $profilesWithChanges = ExamProcessing::select('profile_id')
    //         ->selectRaw('COUNT(DISTINCT program_id) as program_count')
    //         ->groupBy('profile_id')
    //         ->having('program_count', '>', 1)
    //         ->where('status', )
    //         ->get();

    //     dd($profilesWithChanges);
    // }


    public function updateLogs()
    {
        // $sub = $this->subjectCommitteeUserRepository->getAll()->where('user_id', '=', Auth::user()->id)->first();

        $data = Profile::join('profile_processing', 'profile_processing.profile_id', '=', 'profiles.id')
            ->join('exam_registration', 'exam_registration.profile_id', '=', 'profiles.id')
            ->join('program', 'program.id', '=', 'exam_registration.program_id')
            ->where('profile_processing.current_state', 'subject_committee')
            ->where('profile_processing.status', 'progress')
            ->where('profile_processing.subject_committee_accepted_num', '<=', '2')
            ->where('program.subject-committee_id', '=', 2)
            ->orderBy('profiles.created_at', 'ASC')
            // ->where('exam_registration.exam_id', 7)
            // ->where('exam_registration.level_id', '=', '4')
            ->get(['profiles.id as profile_id']);

        dd($data);
    }
}
