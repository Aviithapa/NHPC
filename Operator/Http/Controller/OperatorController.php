<?php


namespace Operator\Http\Controller;


use App\Http\Controllers\MailController;
use App\Models\Address\Provinces;
use App\Models\Certificate\Certificate;
use App\Models\Exam\ExamProcessing;
use App\Models\Profile\ProfileProcessing;
use App\Modules\Backend\Admin\Program\Repositories\ProgramRepository;
use App\Modules\Backend\Authentication\User\Repositories\UserRepository;
use App\Modules\Backend\Certificate\Repositories\CertificateRepository;
use App\Modules\Backend\Exam\Exam\Repositories\ExamRepository;
use App\Modules\Backend\Exam\ExamProcessing\Repositories\ExamProcessingRepository;
use App\Modules\Backend\Exam\ExamProcessingDetails\Repositories\ExamProcessingDetailsRepository;
use App\Modules\Backend\Profile\Profilelogs\Repositories\ProfileLogsRepository;
use App\Modules\Backend\Profile\ProfileProcessing\Repositories\ProfileProcessingRepository;
use Database\Seeders\District;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Krishnahimself\DateConverter\DateConverter;
use Operator\Modules\Framework\Request;
use Student\Http\Controller\ProfileController;
use Student\Models\Profile;
use Student\Models\Qualification;
use Student\Modules\Profile\Repositories\ProfileRepository;
use Student\Modules\Qualification\Repositories\QualificationRepository;
use Yajra\DataTables\Facades\DataTables;

class OperatorController extends BaseController
{
    private $log, $profileProcessing, $profileRepository,
        $userRepository, $qualificationRepository,
        $user_data, $profileLogsRepository,$programRepository,
        $profileProcessingRepository, $examRepository, $examProcessingRepository, $examProcessingDetailsRepository,$certificateRepository;

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

    public function __construct(ProfileRepository $profileRepository,
                                UserRepository $userRepository, QualificationRepository $qualificationRepository,
                                ProfileLogsRepository $profileLogsRepository,
                                ProfileProcessingRepository $profileProcessingRepository,
                                ExamRepository $examRepository, ExamProcessingRepository $examProcessingRepository,
                                ProgramRepository $programRepository,
                                ExamProcessingDetailsRepository $examProcessingDetailsRepository, CertificateRepository $certificateRepository)
    {
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
        $this->certificateRepository =$certificateRepository;
        parent::__construct();
    }

    public function dashboard(){
            if (Auth::user()->mainRole()->name === 'operator') {


                $tslc = ExamProcessing::select(\DB::raw("COUNT(program_id) as count"), \DB::raw("program_id as program_id"))
                    ->groupBy('program_id')
                    ->orderBy('count')
                    ->where('level_id','<=',3)
                    ->where('created_at','>','2022-07-16')
                    ->get();

                $failed_student = ExamProcessing::select(\DB::raw("COUNT(program_id) as count"), \DB::raw("program_id as program_id"))
                    ->groupBy('program_id')
                    ->orderBy('count')
                    ->where('level_id','<=',3)
//                    ->where('created_at','>','2022-07-16')
                    ->where('isPassed','=',0)
                    ->where('state','=','exam_committee')
                    ->get();

                $re_apply_student = ExamProcessing::select(\DB::raw("COUNT(program_id) as count"), \DB::raw("program_id as program_id"))
                    ->groupBy('program_id')
                    ->orderBy('count')
                    ->where('level_id','<=',3)
//                    ->where('created_at','>','2022-07-16')
//                    ->where('isPassed','=',0)
                    ->where('status','=','re-exam')
                    ->get();

                $re_apply_student_count = ExamProcessing::
//                    ->where('created_at','>','2022-07-16')
//                    ->where('isPassed','=',0)
                      where('status','=','re-exam')
                    ->get();
//                dd($failed_student);
                return view('operator::pages.dashboard',compact('tslc', 'failed_student','re_apply_student','re_apply_student_count'));
            }else {
                return redirect()->route('login');
            }
    }

    public function getProgramWiseStudent($id,  $status, $state){
        $students = ExamProcessing::join('profiles','profiles.id','=','exam_registration.profile_id')
                            ->where('exam_registration.program_id','=',$id)
            ->join('program','program.id','=','exam_registration.program_id')
//            ->join('profile_processing','profile_processing.profile_id','=','profiles.id')
            ->where('exam_registration.status','=',$status)
            ->where('exam_registration.state','=',$state)
            ->where('exam_registration.created_at','>','2022-07-16')
            ->get(['profiles.*','program.name as program_name','profiles.id as profile_id']);


        return view('operator::pages.program-student',compact('students'));
    }
    public function exam($status, $state)
    {
        if (Auth::user()->mainRole()->name === 'operator') {
            $users = $this->examProcessingRepository->getAll()->where('status', '=', $status)
            ->where('state', '=',$state);
            return $this->view('pages.application-list', $users);
        } else {
            return redirect()->route('login');
        }
    }

    public function profile($status, $state, $level=5)
    {
        if (Auth::user()->mainRole()->name === 'operator') {
            $data = ExamProcessing::join('profiles','profiles.id','=','exam_registration.profile_id')
                ->where('exam_registration.state', '=', $state)
                ->where('exam_registration.status', '=', $status)
                ->join('program','program.id','=','exam_registration.program_id')
                ->where('exam_registration.level_id', '=', $level)
                ->where('exam_registration.created_at', '>', '2022-07-16')
                ->orderBy('profiles.created_at','ASC')
                ->skip(0)
                ->take(100)
                ->get(['profiles.*','exam_registration.*','program.name as program_name']);

            $countmaster = ExamProcessing::select(\DB::raw("COUNT(level_id) as count"))
                ->groupBy('level_id')
                ->orderBy('count')
//                    ->where('created_at','>','2022-07-16')
                ->where('level_id', '=', 1)
                ->where('state','=',$state)
                ->where('status','=',$status)
                ->where('created_at','>','2022-07-16')
                ->get();

            $countbachelor = ExamProcessing::select(\DB::raw("COUNT(level_id) as count"))
                ->groupBy('level_id')
                ->orderBy('count')
//                    ->where('created_at','>','2022-07-16')
                ->where('level_id', '=', 2)
                ->where('state','=',$state)
                ->where('status','=',$status)
                ->where('created_at','>','2022-07-16')
                ->get();

            $countPCL = ExamProcessing::select(\DB::raw("COUNT(level_id) as count"))
                ->groupBy('level_id')
                ->orderBy('count')
//                    ->where('created_at','>','2022-07-16')
                ->where('level_id', '=', 3)
                ->where('state','=',$state)
                ->where('status','=',$status)
                ->where('created_at','>','2022-07-16')
                ->get();

            $countTSLC =   ExamProcessing::select(\DB::raw("COUNT(level_id) as count"))
                ->groupBy('level_id')
                ->orderBy('count')
//                    ->where('created_at','>','2022-07-16')
                ->where('level_id', '=', 4)
                ->where('state','=',$state)
                ->where('status','=',$status)
                ->where('created_at','>','2022-07-16')
                ->get('count');




            return view('operator::pages.applicant-profile-list', compact('data','state','status','countTSLC','countPCL',
            'countmaster','countbachelor'));
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
            return view('operator::pages.application-list-review', compact('data', 'user_data', 'qualification', 'profile_logs', 'profile_processing', 'exams'));
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
            try {
                $id = $data['profile_id'];
                $data['created_by'] = Auth::user()->id;
                $data['state'] = 'computer_operator';
                $data['profile_state'] = 'officer';
                if ($data['profile_status'] === "Verified" || $data['profile_status'] === "Reviewing") {
                    $data['status'] = 'progress';
                    $data['remarks'] = 'Document Verified and is Forwarded to Officer';
                    $data['review_status'] = 'Successful';
                    $data['profile_state'] = 'officer';
                    $this->profileLog($data);
                    $this->profileProcessing($id,$data);
                } elseif ($data['profile_status'] === "Rejected") {
                    $data['status'] = 'rejected';
                    $data['review_status'] = 'Rejected';
                    $data['profile_state'] = 'student';
                    $this->profileLog($data);
                    $this->profileProcessing($id,$data);
                } elseif ($data['profile_status'] === "Pending") {
                    $data['status'] = 'pending';
                    $data['review_status'] = 'Pending';
                    $this->profileLog($data);
                    $this->profileProcessing($id,$data);
                }
                $profile = $this->profileRepository->update($data, $id);
                if ($profile == false) {
                    session()->flash('danger', 'Oops! Something went wrong.');
                    return redirect()->back()->withInput();
                }

                $state = "computer_operator";
                $status = "Reviewing";
                $level = $profile['level'];

                    $data = Profile::where('profile_state', '=', $state)
                        ->where('profile_status', '=', $status)
                        ->where('level', '=', $level)
                        ->orderBy('created_at','ASC')
                        ->skip(0)
                        ->take(20)
                        ->get();

                return view('operator::pages.applicant-profile-list', compact('data','state','status'));
            } catch (\Exception $e) {
                session()->flash('danger', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
        } else {
            return redirect()->route('login');
        }

    }

    public function profileLog(array $data)
    {
        if (Auth::user()->mainRole()->name === 'operator') {
            $logs = $this->profileLogsRepository->create($data);
            if ($logs == false)
                return false;
            return true;
        } else {
            return redirect()->route('login');
        }

    }

    public function profileProcessing($id,$data)
    {
        if (Auth::user()->mainRole()->name === 'operator') {
            $profileProcessing['profile_id'] = $id;
            $profileEmail = $this->profileRepository->findById($id);
            $email = $this->userRepository->findBy('id','=',$profileEmail['user_id'])->first();
            $profileProcessingId = $this->profileProcessingRepository->getAll()->where('profile_id','=', $id)->first();
            if ($data['profile_status'] === "Verified" || $data['profile_status'] === "Reviewing") {
                $data['status'] = 'progress';
                $data['remarks'] = 'Document Verified and is Forwarded to Officer';
                $data['review_status'] = 'Successful';
                $data['current_state'] = 'officer';
                $profileEmail = $this->profileRepository->findById($id);
                $email = $this->userRepository->findBy('id','=',$profileEmail['user_id'])->first();
                MailController::sendprofileVerification($email["name"], $email['email'], $data['remarks']);
                if ($profileProcessingId){
                    $profileProcessings = $this->profileProcessingRepository->update($data,$profileProcessingId['id']);
                }else
                  $profileProcessings = $this->profileProcessingRepository->create($data);

            } elseif ($data['profile_status'] == "Rejected") {
                $data['status'] = 'rejected';
                $data['review_status'] = 'Rejected';
                $data['current_state'] = 'computer_operator';
                MailController::sendprofileVerification($email["name"], $email['email'], $data['remarks']);
                if ($profileProcessingId){
                    $profileProcessings = $this->profileProcessingRepository->update($data,$profileProcessingId['id']);
                }else
                     $profileProcessings = $this->profileProcessingRepository->create($data);
            } elseif ($data['profile_status'] === "Pending") {
                $data['status'] = 'pending';
                $data['review_status'] = 'Pending';
                $data['current_state'] = 'computer_operator';
                MailController::sendprofileVerification($email["name"], $email['email'], $data['remarks']);
                if ($profileProcessingId){
                    $profileProcessings = $this->profileProcessingRepository->update($data,$profileProcessingId['id']);
                }else
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
                $profile = $this->profileRepository->update($data,$id);
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

    public function editExamApply($id){
        $profile = $this->profileRepository->findById($id);
        if ($profile){

            $qualification = $this->qualificationRepository->getAll()->where('user_id','=',$profile->user_id)
                ->where('level','!=' , 1);
            $exam = $this->examProcessingRepository->getAll()->where('profile_id','=',$id)->first();
            if ($qualification != null){
                foreach ($qualification as $quali)
                    if (is_numeric($quali['program_id']) )
                        $all_program[] = $this->programRepository->findById($quali['program_id']);
            }
            return view('superAdmin::admin.applicant.edit-program-name', compact( 'all_program', "profile",'exam'));

        }

    }

    public function applyExam(Request $request){
        $data= $request->all();
        $data["status"] = 'progress';
        $data['voucher_image'] = $data['voucher'];
        try {
            $exam = $this->examProcessingRepository->update($data,$data['exam_processing_id']);
            if ($exam == false) {
                session()->flash('danger', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
            session()->flash('success','Program has been changed successfully');
            return redirect()->back()->refresh()->withInput();
        } catch (\Exception $e) {
            session()->flash('success','Program has been changed successfully.');
            return redirect()->back()->withInput();
        }
    }

    public function doubleDustur(){
        $date = "2022-05-05 00:00:00";

        $profiles = Profile::join('exam_registration','exam_registration.profile_id','=','profiles.id')
            ->where('exam_registration.created_at','>', $date)
            ->orderBy('profiles.created_at','ASC')
            ->get(['profiles.*','exam_registration.*']);

        return $this->view('pages.application-list-double', $profiles);

    }

    public function printCertificate($id, $level){
        $certificate = Certificate::join('profiles','profiles.id','=','certificate_history.profile_id')
            ->join('program','program.id','=','certificate_history.program_id')
            ->join('provinces','provinces.id','=','profiles.development_region')
            ->join('registrant_qualification','registrant_qualification.user_id','=','profiles.user_id')
            ->where('certificate_history.id','=',$id)
            ->where('registrant_qualification.level','=',$level)
            ->orderBy('certificate_history.id','ASC')
            ->get(['certificate_history.*','certificate_history.name as certificate_name','certificate_history.program_name as certificate_program_name','profiles.*','program.name as Name_program','registrant_qualification.*','provinces.province_name','certificate_history.id as certificate_history_id'])->first();

//        dd($certificate);
//        $this->certificateRepository->findById($id);
        $profile = $this->profileRepository->findById($certificate['profile_id']);
//        $year= auth()->user()->created_at->format('Y');
//        $month= auth()->user()->created_at->format('m');
//        $day= auth()->user()->created_at->format('d');
//        $date=($year,$month,$day);
//        dd($certificate);
        return view('operator::pages.certificate', compact('certificate','profile'));
    }

    public function printCertificateIndex($status, $program_id){
        $certificates =  Certificate::join('profiles','profiles.id','=','certificate_history.profile_id')
                                      ->join('program','program.id','=','certificate_history.program_id')
                                      ->join('provinces','provinces.id','=','profiles.development_region')
                                      ->where('certificate_history.is_printed','=',$status)
                                       ->where('certificate_history.program_id','=',$program_id)
                                        ->get(['certificate_history.*','profiles.*','program.name as Name_program','provinces.province_name','certificate_history.id as certificate_history_id']);

        return view('operator::pages.certificate-list', compact('certificates','status'));
    }


    public function printCertificateDashboard($status){
        $certificates = Certificate::select(\DB::raw("COUNT(*) as count"), \DB::raw("program_id as program_id"))
            ->groupBy('program_id' )
            ->orderBy('count')
            ->where('is_printed','=',$status)
            ->where('profile_id','!=','')
            ->get();

        return view('operator::pages.certificate-card', compact('certificates','status'));
    }

 public function printedCertificate($id){
        $data[] = $this->certificateRepository->findById($id);
        $data['is_printed'] = 1 ;
     try {
         $exam = $this->certificateRepository->update($data,$id);;
         if ($exam == false) {
             session()->flash('danger', 'Oops! Something went wrong.');
             return redirect()->back()->withInput();
         }
         session()->flash('success','Moved to printed list');
         return redirect()->back()->refresh()->withInput();
     } catch (\Exception $e) {
         session()->flash('success','Program has been changed successfully.');
         return redirect()->back()->withInput();
     }

        return redirect()->back();
    }



    public function subjectCommitteeDashboardList( Request $request,$level= 1,$status = "progress",$subject_commitee_id = 1,$page = 0){
        $take = 20;
        $data = $request->all();
        if ($data != null){
            if ($data['level_id'] !=null )
                $level = $data['level_id'];
            if ($data['status'] != null)
                $status = $data['status'];
        }
        $datas = ExamProcessing::join('profiles','profiles.id','=','exam_registration.profile_id')
            ->where('exam_registration.level_id','=',$level)
            ->join('program','program.id','=','exam_registration.program_id')
            ->join('profile_processing','profile_processing.profile_id','=','profiles.id')
            ->where('profile_processing.current_state','=','subject_committee')
            ->where('profile_processing.status','=',$status)
            ->where('program.subject-committee_id','=',$subject_commitee_id)
            ->skip($page * $take)
            ->take($take)
            ->get(['profiles.*','program.name as program_name','profile_processing.*','profiles.id as profile_id']);
        $page = (int)$page;


        return view('operator::pages.subjectCommiteeList',compact('datas','level','status','subject_commitee_id','page'));
    }

    public function subjectCommitteeDashboard(){
        $examApplied = ExamProcessing::join('profiles','profiles.id','=','exam_registration.profile_id')
            ->where('exam_registration.level_id','<','4')
            ->join('program','program.id','=','exam_registration.program_id')
            ->join('profile_processing','profile_processing.profile_id','=','profiles.id')
            ->where('profile_processing.current_state','=','subject_committee')
            ->where('program.subject-committee_id','=','1')
            ->count(['profiles.id']);

        $GM = ExamProcessing::join('profiles','profiles.id','=','exam_registration.profile_id')
            ->where('exam_registration.level_id','<','4')
            ->join('program','program.id','=','exam_registration.program_id')
            ->join('profile_processing','profile_processing.profile_id','=','profiles.id')
            ->where('profile_processing.current_state','=','subject_committee')
            ->where('program.subject-committee_id','=','2')
            ->count(['profiles.id']);

        $lM = ExamProcessing::join('profiles','profiles.id','=','exam_registration.profile_id')
            ->where('exam_registration.level_id','<','4')
            ->join('program','program.id','=','exam_registration.program_id')
            ->join('profile_processing','profile_processing.profile_id','=','profiles.id')
            ->where('profile_processing.current_state','=','subject_committee')
            ->where('program.subject-committee_id','=','3')
            ->count(['profiles.id']);

        $radio = ExamProcessing::join('profiles','profiles.id','=','exam_registration.profile_id')
            ->where('exam_registration.level_id','<','4')
            ->join('program','program.id','=','exam_registration.program_id')
            ->join('profile_processing','profile_processing.profile_id','=','profiles.id')
            ->where('profile_processing.current_state','=','subject_committee')
            ->where('program.subject-committee_id','=','4')
            ->count(['profiles.id']);

        $opt = ExamProcessing::join('profiles','profiles.id','=','exam_registration.profile_id')
            ->where('exam_registration.level_id','<','4')
            ->join('program','program.id','=','exam_registration.program_id')
            ->join('profile_processing','profile_processing.profile_id','=','profiles.id')
            ->where('profile_processing.current_state','=','subject_committee')
            ->where('program.subject-committee_id','=','5')
            ->count(['profiles.id']);

        $den = ExamProcessing::join('profiles','profiles.id','=','exam_registration.profile_id')
            ->where('exam_registration.level_id','<','4')
            ->join('program','program.id','=','exam_registration.program_id')
            ->join('profile_processing','profile_processing.profile_id','=','profiles.id')
            ->where('profile_processing.current_state','=','subject_committee')
            ->where('program.subject-committee_id','=','6')
            ->count(['profiles.id']);

        $phy = ExamProcessing::join('profiles','profiles.id','=','exam_registration.profile_id')
            ->where('exam_registration.level_id','<','4')
            ->join('program','program.id','=','exam_registration.program_id')
            ->join('profile_processing','profile_processing.profile_id','=','profiles.id')
            ->where('profile_processing.current_state','=','subject_committee')
            ->where('program.subject-committee_id','=','7')
            ->count(['profiles.id']);

        $mis = ExamProcessing::join('profiles','profiles.id','=','exam_registration.profile_id')
            ->where('exam_registration.level_id','<','4')
            ->join('program','program.id','=','exam_registration.program_id')
            ->join('profile_processing','profile_processing.profile_id','=','profiles.id')
            ->where('profile_processing.current_state','=','subject_committee')
            ->where('program.subject-committee_id','=','8')
            ->count(['profiles.id']);

        return view('operator::pages.subjectCommittee',compact('examApplied','GM','lM','radio','opt','den','phy','mis'));
    }

    public function examStudentCount($level_id){
        $datas = ExamProcessing::join('profiles','profiles.id','=','exam_registration.profile_id')
            ->where('exam_registration.level_id','=',$level_id)
            ->join('program','program.id','=','exam_registration.program_id')
            ->join('profile_processing','profile_processing.profile_id','=','profiles.id')
            ->where('profile_processing.current_state','!=','operator')
            ->where('profile_processing.current_state','!=','officer')
            ->get(['profiles.*','program.name as program_name','profile_processing.*','profiles.id as profile_id']);


        return view('operator::pages.examStudentList',compact('datas'));
    }

    public  function updateCertificateIndex($certificate_id,$level){
        $certificate = Certificate::join('profiles','profiles.id','=','certificate_history.profile_id')
            ->join('program','program.id','=','certificate_history.program_id')
            ->join('provinces','provinces.id','=','profiles.development_region')
            ->join('registrant_qualification','registrant_qualification.user_id','=','profiles.user_id')
            ->where('certificate_history.id','=',$certificate_id)
            ->where('registrant_qualification.level','=',$level)
            ->orderBy('certificate_history.id','ASC')
            ->get(['certificate_history.*','certificate_history.name as certificate_name','certificate_history.program_name as certificate_program_name','profiles.*','program.name as Name_program','registrant_qualification.*','provinces.province_name','certificate_history.id as certificate_history_id'])->first();

        $profile = $this->profileRepository->findById($certificate['profile_id']);
        $province = Provinces::all();
        return view('operator::pages.update-certificate', compact('certificate','profile','province','level'));
    }
    public  function updateCertificate(Request $request){
        $data = $request->all();
        try {
            $id = $data['certificate_history_id'];
            $profile= $this->certificateRepository->findById($id);
            $certificate = $this->certificateRepository->update($data,$id);
            $profileUpdate = $this->profileRepository->update($data,$profile['profile_id']);
            $documents = $this->qualificationRepository->getAll()->where('user_id','=',$profileUpdate['user_id'])
            ->where('level','=',$data['level'])->first();
            $updateDocuments =  $this->qualificationRepository->update($data,$documents['id']);
            session()->flash('success', 'Certificate data has been changed successfully');
            return redirect()->back();
//
        } catch (\Exception $e) {
            session()->flash('danger', 'Oops! Something went wrong.');
            return redirect()->back()->withInput();
        }
    }



    public  function DataHub(){

     }
}

