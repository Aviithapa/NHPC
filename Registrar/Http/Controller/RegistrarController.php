<?php


namespace Registrar\Http\Controller;


use App\Http\Controllers\MailController;
use App\Models\Exam\ExamProcessing;
use App\Modules\Backend\Authentication\User\Repositories\UserRepository;
use App\Modules\Backend\Exam\Exam\Repositories\ExamRepository;
use App\Modules\Backend\Exam\ExamProcessing\Repositories\ExamProcessingRepository;
use App\Modules\Backend\Exam\ExamProcessingDetails\Repositories\ExamProcessingDetailsRepository;
use App\Modules\Backend\Profile\Profilelogs\Repositories\ProfileLogsRepository;
use App\Modules\Backend\Profile\ProfileProcessing\Repositories\ProfileProcessingRepository;
use Illuminate\Support\Facades\Auth;
use Operator\Modules\Framework\Request;
use Student\Models\Profile;
use Student\Modules\Profile\Repositories\ProfileRepository;
use Student\Modules\Qualification\Repositories\QualificationRepository;
use function Symfony\Component\Mime\cc;

class RegistrarController  extends BaseController
{
    private  $log,$profileProcessing,
        $profileRepository, $userRepository,
        $qualificationRepository,$user_data,
        $profileLogsRepository,$profileProcessingRepository,
        $examRepository,$examProcessingRepository, $examProcessingDetailsRepository;
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
     * @param ExamProcessingDetailsRepository $examProcessingDetailsRepository
     */

    public function __construct(ProfileRepository $profileRepository, UserRepository $userRepository, QualificationRepository $qualificationRepository,
                                ProfileLogsRepository $profileLogsRepository, ProfileProcessingRepository $profileProcessingRepository,
                                ExamRepository $examRepository,ExamProcessingRepository $examProcessingRepository, ExamProcessingDetailsRepository $examProcessingDetailsRepository)
    {
        $this->profileRepository=$profileRepository;
        $this->userRepository=$userRepository;
        $this->qualificationRepository=$qualificationRepository;
        $this->profileLogsRepository = $profileLogsRepository;
        $this->profileProcessingRepository = $profileProcessingRepository;
        $this->examRepository=$examRepository;
        $this->examProcessingRepository=$examProcessingRepository;
        $this->examProcessingDetailsRepository=$examProcessingDetailsRepository;
        parent::__construct();
    }

    public function dashboard()
    {
        if (Auth::user()->mainRole()->name === 'registrar') {
//            $data= Profile::select(\DB::raw("COUNT(*) as count"), \DB::raw("profile_status as profile_status"))
//                ->groupBy('profile_status')
//                ->orderBy('count')
//                ->get();
//            $profile= Profile::select(\DB::raw("COUNT(*) as count"), \DB::raw("profile_state as profile_state"))
//                ->groupBy('profile_state')
//                ->orderBy('count')
//                ->get();
//
//            $exams = ExamProcessing::select(\DB::raw("COUNT(*) as count"), \DB::raw("program_id as program_id"))
//                ->groupBy('program_id')
//                ->orderBy('count')
//                ->get();
//            $tslc = ExamProcessing::select(\DB::raw("COUNT(*) as count"), \DB::raw("program_id as program_id"))
//                ->groupBy('program_id')
//                ->orderBy('count')
//                ->where('level_id', '<', 3)
//                ->get();
//
//
//
//            $examPieChart = ExamProcessing::select(\DB::raw("COUNT(*) as count"), \DB::raw("program_id as program_id"))
//                ->groupBy('program_id')
//                ->orderBy('count')
//                ->get();
//            $verified= Profile::where('profile_status','Verified')->get();
//            $reviewing= Profile::where('profile_status','Reviewing')->get();
//            $rejected= Profile::where('profile_status','Rejected')->get();
//
//            $examApplied = ExamProcessing::join('profiles','profiles.id','=','exam_registration.profile_id')
//                ->where('exam_registration.level_id','<','4')
//                ->join('program','program.id','=','exam_registration.program_id')
//                ->join('profile_processing','profile_processing.profile_id','=','profiles.id')
//                ->where('profile_processing.status','=',"progress")
//                ->count(['profiles.id']);
//
//            $examNotTaken = ExamProcessing::join('profiles','profiles.id','=','exam_registration.profile_id')
//                ->where('exam_registration.level_id','=','4')
//                ->join('program','program.id','=','exam_registration.program_id')
//                ->join('profile_processing','profile_processing.profile_id','=','profiles.id')
//                ->where('profile_processing.current_state','!=','computer_operator')
//                ->count(['profiles.id']);
//
//            $subjectCommiteeExamApplied = ExamProcessing::join('profiles','profiles.id','=','exam_registration.profile_id')
//                ->where('exam_registration.level_id','<','4')
//                ->join('program','program.id','=','exam_registration.program_id')
//                ->join('profile_processing','profile_processing.profile_id','=','profiles.id')
//                ->where('profile_processing.status','=',"progress")
//                ->where('profile_processing.current_state','!=','computer_operator')
//                ->count(['profiles.id']);
//
//            $subjectCommiteeRejectList = ExamProcessing::join('profiles','profiles.id','=','exam_registration.profile_id')
//                ->where('exam_registration.level_id','<','4')
//                ->join('program','program.id','=','exam_registration.program_id')
//                ->join('profile_processing','profile_processing.profile_id','=','profiles.id')
//                ->where('profile_processing.status','=',"rejected")
//                ->where('profile_processing.current_state','=','subject_committee')
//                ->count(['profiles.id']);
//
//            return view('registrar::pages.dashboard',compact('data','profile','verified','reviewing','rejected',
//                'examPieChart','exams','tslc','examApplied','examNotTaken','subjectCommiteeExamApplied','subjectCommiteeRejectList'));
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
                ->where('isPassed','=',0)
                ->where('state','=','exam_committee')
                ->get();

            $re_apply_student = ExamProcessing::select(\DB::raw("COUNT(program_id) as count"), \DB::raw("program_id as program_id"))
                ->groupBy('program_id')
                ->orderBy('count')
                ->where('level_id','<=',3)
                ->where('status','=','re-exam')
                ->get();

            $re_apply_student_count = ExamProcessing::
            where('status','=','re-exam')
                ->get();

            $third_licence_exam_student_count = ExamProcessing::select(\DB::raw("COUNT(program_id) as count"))
                ->orderBy('count')
                ->where('created_at','<','2022-07-16')
                ->where('level_id','!=','4')
                ->count();


            $third_licence_exam_qualified_student_count = ExamProcessing::select(\DB::raw("COUNT(program_id) as count"))
                ->orderBy('count')
                ->where('state','=','exam_committee')
                ->orWhere('state','=','council')
                ->where('created_at','<','2022-07-16')
                ->where('level_id','!=','4')
                ->count();

            $third_licence_exam_passed_student_count = ExamProcessing::select(\DB::raw("COUNT(program_id) as count"))
                ->orderBy('count')
//                ->where('state','=','exam_committee')
                ->where('state','=','council')
                ->where('created_at','<','2022-07-16')
                ->where('level_id','!=','4')
                ->count();

            $third_licence_exam_failed_student_count = ExamProcessing::select(\DB::raw("COUNT(program_id) as count"))
                ->orderBy('count')
                ->where('state','=','exam_committee')
//                ->where('status','=','rejected')
//                ->where('attempt','=',2)
                ->where('is_admit_card_generate','=','Yes')
                ->where('created_at','<','2022-07-16')
                ->where('level_id','!=','4')
                ->count();

            $operator_pending = ExamProcessing::select(\DB::raw("COUNT(program_id) as count"))
                ->orderBy('count')
                ->where('state','=','computer_operator')
                ->where('status','=','progress')
//                ->where('attempt','=',2)
//                ->where('is_admit_card_generate','=','Yes')
                ->where('created_at','>','2022-07-16')
                ->where('level_id','!=','4')
                ->count();

            $operator_rejected = ExamProcessing::select(\DB::raw("COUNT(program_id) as count"))
                ->orderBy('count')
                ->where('state','=','computer_operator')
                ->where('status','=','rejected')
//                ->where('attempt','=',2)
//                ->where('is_admit_card_generate','=','Yes')
                ->where('created_at','>','2022-07-16')
                ->where('level_id','!=','4')
                ->count();

            $operator_verified = ExamProcessing::select(\DB::raw("COUNT(program_id) as count"))
                ->orderBy('count')
                ->where('state','!=','computer_operator')
                ->where('status','=','progress')
//                ->where('attempt','=',2)
//                ->where('is_admit_card_generate','=','Yes')
                ->where('created_at','>','2022-07-16')
                ->where('level_id','!=','4')
                ->count();


            $officer_pending = ExamProcessing::select(\DB::raw("COUNT(program_id) as count"))
                ->orderBy('count')
                ->where('state','=','officer')
                ->where('status','=','progress')
//                ->where('attempt','=',2)
//                ->where('is_admit_card_generate','=','Yes')
                ->where('created_at','>','2022-07-16')
                ->where('level_id','!=','4')
                ->count();

            $officer_rejected = ExamProcessing::select(\DB::raw("COUNT(program_id) as count"))
                ->orderBy('count')
                ->where('state','=','officer')
                ->where('status','=','rejected')
//                ->where('attempt','=',2)
//                ->where('is_admit_card_generate','=','Yes')
                ->where('created_at','>','2022-07-16')
                ->where('level_id','!=','4')
                ->count();

            $officer_verified = ExamProcessing::select(\DB::raw("COUNT(program_id) as count"))
                ->orderBy('count')
                ->where('state','!=','officer')
                ->where('state','!=','computer_operator')
                ->where('status','=','progress')
//                ->where('attempt','=',2)
//                ->where('is_admit_card_generate','=','Yes')
                ->where('created_at','>','2022-07-16')
                ->where('level_id','!=','4')
                ->count();


//            dd($third_licence_exam_failed_student_count);

            return view('registrar::pages.dashboard',compact('tslc', 'failed_student','re_apply_student','re_apply_student_count','third_licence_exam_student_count','third_licence_exam_qualified_student_count',
            'third_licence_exam_passed_student_count','third_licence_exam_failed_student_count',
            'operator_pending','operator_verified','operator_rejected',
            'officer_pending','officer_rejected','officer_verified'));
        }else{
            return redirect()->route('login');
        }
    }

    public function internalData($state,$status){
        $datas = ExamProcessing::join('profiles','profiles.id','=','exam_registration.profile_id')
            ->where('exam_registration.state', '=', $state)
            ->where('exam_registration.status', '=', $status)
            ->join('program','program.id','=','exam_registration.program_id')
            ->where('exam_registration.level_id', '!=', 4)
            ->where('exam_registration.created_at', '>', '2022-07-16')
            ->orderBy('profiles.created_at','ASC')
            ->get(['profiles.*','exam_registration.*','program.name as program_name']);

//        dd($datas);

        return view('registrar::pages.internalData',compact('datas'));
    }

    public function profile($status, $current_state, $level, $page = 0)
    {
        if (Auth::user()->mainRole()->name === 'registrar') {
            $page = $page ? $page : 0;
            $take = 20;
            $datas = Profile::join('exam_registration','exam_registration.profile_id','=','profiles.id')
                ->join('program','program.id','=','exam_registration.program_id')
                ->join('profile_processing','profile_processing.profile_id','=','profiles.id')
                ->where('profile_processing.current_state', '=', $current_state)
                ->where('profile_processing.status', '=', $status)
                ->where('profiles.level', '=', $level)
                ->orderBy('profiles.created_at','ASC')
                ->skip($page * $take)
                ->take($take)
                ->get(['profiles.*','program.name as program_name']);
            $state = $current_state;
            $page = (int)$page;

            return view('registrar::pages.applicant-profile-list', compact('datas','state','status','page','level'));
        }else{
            return redirect()->route('login');
        }
    }

    public function exam($status, $state)
    {
        if (Auth::user()->mainRole()->name === 'registrar') {
            $users = $this->examProcessingRepository->getAll()->where('status', '=', $status)
                ->where('state', '=', $state);
            return $this->view('pages.application-list', $users);
        }else{
            return redirect()->route('login');
        }
    }

    public function edit($id)
    {
        if (Auth::user()->mainRole()->name === 'registrar') {
            $data = $this->profileRepository->findById($id);
            $user_id = $data['user_id'];
            $user_data = $this->userRepository->findById($user_id);
            $qualification = $this->qualificationRepository->getAll()->where('user_id', '=', $data['user_id']);
            $profile_logs = $this->profileLogsRepository->getAll()->where('profile_id', '=', $id);
            $profile_processing = $this->profileProcessingRepository->getAll()->where('profile_id', '=', $id)->first();
            $exams = $this->examProcessingRepository->getAll()->where('profile_id', '=', $id);
            return view('registrar::pages.application-list-review', compact('data', 'user_data', 'qualification', 'profile_logs', 'profile_processing', 'exams'));
        }else{
            return redirect()->route('login');
        }
    }

    public function status(Request $request)
    {
        if (Auth::user()->mainRole()->name === 'registrar') {
            $data = $request->all();
            try {
                $id = $data['profile_id'];
                $data['created_by'] = Auth::user()->id;
                $data['state'] = 'registrar';
                $profileEmail = $this->profileRepository->findById($id);
                $email = $this->userRepository->findBy('id','=',$profileEmail['user_id'])->first();

                if ($data['profile_status'] === "Verified" || $data['profile_status'] === "Reviewing") {
                    $data['status'] = 'progress';
                    $data['remarks'] = 'Document Verified and forwarded to Subject Committee';
                    $data['review_status'] = 'Successful';
                    $data['profile_state'] = 'subject_committee';
                    MailController::sendprofileVerification($email["name"], $email['email'], $data['remarks']);
                    $this->profileLog($data);
                    $this->profileProcessing($id, $data);
                } elseif ($data['profile_status'] === "Rejected") {
                    $data['status'] = 'rejected';
                    $data['review_status'] = 'Rejected';
                    $data['profile_state'] = 'student';
                    $this->profileLog($data);
                    $this->profileProcessing($id, $data);
                    MailController::sendprofileVerification($email["name"], $email['email'], $data['remarks']);

                }
                $profile = $this->profileRepository->update($data, $id);
                if ($profile == false) {
                    session()->flash('danger', 'Oops! Something went wrong.');
                    return redirect()->back()->withInput();
                }
                session()->flash('success', 'User Profile Status Information have been saved successfully');
                return redirect()->route('registrar.applicant.profile.list');
//
            } catch (\Exception $e) {
                session()->flash('danger', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
        }else{
            return redirect()->route('login');
        }

    }

    public function profileLog( array  $data ){
        $logs = $this->profileLogsRepository->create($data);
        if($logs == false)
            return false;
        return true;

    }

    public function profileProcessing( $id , $data){
        $profileProcessing['profile_id'] = $id;
        $profileEmail = $this->profileRepository->findById($id);
        $email = $this->userRepository->findBy('id','=',$profileEmail['user_id'])->first();
        $profileProcessingId = $this->profileProcessingRepository->getAll()->where('profile_id','=', $id)->first();
        if ($data['profile_status'] === "Verified" || $data['profile_status'] === "Reviewing") {

            $data['status'] = 'progress';
            $data['remarks'] = 'Document Verified and forwarded to Subject Committee';
            $data['review_status'] = 'Successful';
            $data['current_state'] = 'subject_committee';
            MailController::sendprofileVerification($email["name"], $email['email'], $data['remarks']);

            $profileProcessings = $this->profileProcessingRepository->update($data,$profileProcessingId['id']);
        } elseif ($data['profile_status'] == "Rejected") {

            $data['status'] = 'rejected';
            $data['review_status'] = 'Rejected';
            $data['current_state'] = 'registrar';
            MailController::sendprofileVerification($email["name"], $email['email'], $data['remarks']);

            $profileProcessings = $this->profileProcessingRepository->update($data,$profileProcessingId['id']);
        } elseif ($data['profile_status'] === "Pending") {
            $data['status'] = 'pending';
            $data['review_status'] = 'Pending';
            $data['current_state'] = 'registrar';
            MailController::sendprofileVerification($email["name"], $email['email'], $data['remarks']);

            $profileProcessings = $this->profileProcessingRepository->update($data,$profileProcessingId['id']);

        }
    }


    public function RejectExamProcessing(Request $request){
        if (Auth::user()->mainRole()->name === 'registrar') {
            $data = $request->all();
            $id = $data['id'];
            $data['status'] = 'rejected';
            $data['state'] = 'officer';
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
        }else{
            return redirect()->route('login');
        }
    }

    public function AcceptExamProcessing($id){
        if (Auth::user()->mainRole()->name === 'registrar') {

            $data['status'] = 'progress';
            $data['state'] = 'subject_committee';
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
        }else{
            return redirect()->route('login');
        }
    }

    public function ExamProcessingLog($data, $id,$profile_id){
        $data['state'] = 'registrar';
        $data["created_by"] = Auth::user()->id;
        $data['exam_processing_id'] = $id;
        $data['profile_id']=$profile_id;
        if ($data['status'] === 'accepted'){
            $data['remarks'] = 'Exam Applied has been accepted';
            $data['review_status'] = 'Successful';
        }elseif ($data['status'] === 'rejected'){
            $data['review_status'] = 'Failed';
        }
        $logs = $this->examProcessingDetailsRepository->create($data);
        if($logs == false)
            return false;
        return true;
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
            ->where('program.subject-committee_id','=','6')
            ->count(['profiles.id']);


        return view('registrar::pages.subjectCommittee',compact('examApplied','GM','lM','radio','opt','den','phy'));
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


        return view('registrar::pages.subjectCommiteeList',compact('datas','level','status','subject_commitee_id','page'));
    }
}


