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
use Illuminate\Support\Facades\DB;
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

            $exams = DB::table('exam')->where('id', '>', '2')->get();
            return view('registrar::pages.dashboard',compact('exams'));
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

    public function profile($status, $state, $level, $page = 0)
    {
        if (Auth::user()->mainRole()->name === 'registrar') {
            if ($status === 'rejected'){
                $datas = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
                    ->join('profile_processing','profile_processing.profile_id','=','profiles.id')
                    ->where('profile_processing.current_state', '=', $state)
                    ->where('profile_processing.status', '=', $status)
                    ->join('program', 'program.id', '=', 'exam_registration.program_id')
                    ->where('exam_registration.level_id', '=', 4)
                    ->orderBy('profiles.created_at', 'ASC')
                    ->get(['profiles.*', 'profiles.id as profile_id','program.name as program_name']);

                $countmaster =ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
                    ->where('exam_registration.state', '=', $state)
                    ->where('exam_registration.status', '=', $status)
                    ->join('program', 'program.id', '=', 'exam_registration.program_id')
                    ->where('exam_registration.level_id', '=', 1)
                    ->where('exam_registration.created_at', '>', '2022-07-16')
                    ->get();

                $countbachelor = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
                    ->where('exam_registration.state', '=', $state)
                    ->where('exam_registration.status', '=', $status)
                    ->join('program', 'program.id', '=', 'exam_registration.program_id')
                    ->where('exam_registration.level_id', '=', 2)
                    ->where('exam_registration.created_at', '>', '2022-07-16')
                    ->get();

                $countPCL = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
                    ->where('exam_registration.state', '=', $state)
                    ->where('exam_registration.status', '=', $status)
                    ->join('program', 'program.id', '=', 'exam_registration.program_id')
                    ->where('exam_registration.level_id', '=', 3)
                    ->where('exam_registration.created_at', '>', '2022-07-16')
                    ->get();

                $countTSLC = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
                    ->where('exam_registration.state', '=', $state)
                    ->where('exam_registration.status', '=', $status)
                    ->join('program', 'program.id', '=', 'exam_registration.program_id')
                    ->where('exam_registration.level_id', '=', 4)
                    ->get();

            }else {
                $datas = ExamProcessing::join('program', 'program.id', '=', 'exam_registration.program_id')
                    ->where('exam_registration.state', '=', $state)
                    ->where('exam_registration.status', '=', $status)
                    ->where('exam_registration.level_id', '=', $level)
                    ->join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
                    ->get([ 'profiles.*', 'program.name as program_name','profiles.id as profile_id']);

                $countmaster =ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
                    ->where('exam_registration.state', '=', $state)
                    ->where('exam_registration.status', '=', $status)
                    ->join('program', 'program.id', '=', 'exam_registration.program_id')
                    ->where('exam_registration.level_id', '=', 1)
                    ->get();

                $countbachelor = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
                    ->where('exam_registration.state', '=', $state)
                    ->where('exam_registration.status', '=', $status)
                    ->join('program', 'program.id', '=', 'exam_registration.program_id')
                    ->where('exam_registration.level_id', '=', 2)
                    ->get();

                $countPCL = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
                    ->where('exam_registration.state', '=', $state)
                    ->where('exam_registration.status', '=', $status)
                    ->join('program', 'program.id', '=', 'exam_registration.program_id')
                    ->where('exam_registration.level_id', '=', 3)
                    ->get();

                $countTSLC = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
                    ->where('exam_registration.state', '=', $state)
                    ->where('exam_registration.status', '=', $status)
                    ->join('program', 'program.id', '=', 'exam_registration.program_id')
                    ->where('exam_registration.level_id', '=', 4)
                    ->get();

            }

            return view('registrar::pages.applicant-profile-list', compact('datas','state','status','countTSLC','countPCL',
                'countmaster','countbachelor'));
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
            $certificate = DB::table('certificate_history')
            ->where('profile_id', '=', $id)
            ->get();
            return view('registrar::pages.application-list-review', compact('data', 'user_data', 'qualification', 'profile_logs', 'profile_processing', 'exams','certificate'));
        }else{
            return redirect()->route('login');
        }
    }

    public function status(Request $request)
    {
        if (Auth::user()->mainRole()->name === 'registrar') {
            $data = $request->all();
            $profile_log['profile_id'] = $data ['profile_id'];
            $profile_log['state'] = 'registrar';
            $profile_log['created_by'] = Auth::user()->id;
            $profile_id = $data['profile_id'];
            $exam_processing = '';
        try {
            $id=$data['profile_id'];
            $data['created_by'] = Auth::user()->id;
            $data['state'] =  'officer';
            $profileEmail = $this->profileRepository->findById($id);
            $email = $this->userRepository->findBy('id','=',$profileEmail['user_id'])->first();
            if ( $data['profile_status']=== "Verified" || $data['profile_status'] === "Reviewing"){
                $data['profile_state'] = 'subject_committee';
                $profile_log['status'] = 'progress';
                $profile_log['remarks'] =  isset($data['remarks']) ? $data['remarks'] : 'Profile Verified and forwarded to Subject Committee';
                $profile_log['review_status'] = 'Successfully Accepeted';
                $profile_processing['current_state'] = 'subject_committee';
                $profile_processing['status'] = 'progress';
                $exam['state'] = 'subject_committee';
                $exam['status'] = 'progress';        
               $logs = $this->profileLog($profile_log);
               if($logs){
                $profileProcessingId = $this->profileProcessingRepository->getAll()->where('profile_id','=', $profile_id)->first();
                if($profileProcessingId === null){
                    $profile_processing['profile_id'] = $profile_id;
                    $this->profileProcessingRepository->create($profile_processing);
                }
                else{
                    $profileProcessings = $this->profileProcessingRepository->update($profile_processing,$profileProcessingId['id']);
                }
                $examProcessing = $this->examProcessingRepository->getAll()->where('state','=','registrar')->where('profile_id','=',$profile_id)->first();
                if($examProcessing){
                    $exam_processing = $this->examProcessingRepository->update($exam, $examProcessing['id']);
                    if($exam_processing === 'false'){
                     session()->flash('error','Error Occured While Saving Data');
                    }
                     $profile_log['exam_processing_id'] = $examProcessing['id'];
                    $examlog = $this->examLog($profile_log);
                    if($examlog){
                        try {
                        MailController::sendprofileVerification($email["name"], $email['email'], $data['remarks']);

                        } catch (\Throwable $th) {
                            // session()->flash('error','Error While Sending Mail');
                        }
                    }
                }    
             }

            }elseif($data['profile_status']=== "Rejected"){
                $profile_log['status'] = 'rejected';
                $profile_log['remarks'] = isset($data['remarks']) ? $data['remarks'] : 'Rejected By Registrar';
                $profile_log['review_status'] = 'Rejected';
                $profile_processing['current_state'] = 'registrar';
                $profile_processing['status'] = 'rejected';
                $exam['state'] = 'registrar';
                $exam['status'] = 'rejected';
                $data['profile_state'] = 'registrar';
               $logs = $this->profileLog($profile_log);
               if($logs){
                $profileProcessingId = $this->profileProcessingRepository->getAll()->where('profile_id','=', $profile_id)->first();
                if($profileProcessingId === null){
                    $profile_processing['profile_id'] = $profile_id;
                    $this->profileProcessingRepository->create($profile_processing);
                }
                else{
                    $this->profileProcessingRepository->update($profile_processing,$profileProcessingId['id']);
                }
                $examProcessing = $this->examProcessingRepository->getAll()->where('state','=','registrar')->where('profile_id','=',$profile_id)->first();
                if($examProcessing){
                    $exam_processing = $this->examProcessingRepository->update($exam, $examProcessing['id']);
                    if($exam_processing === 'false'){
                     session()->flash('error','Error Occured While Saving Data');
                    }
                     $profile_log['exam_processing_id'] = $examProcessing['id'];
                    $examlog = $this->examLog($profile_log);
                    if($examlog){
                        try {
                        MailController::sendprofileVerification($email["name"], $email['email'], $data['remarks']);

                        } catch (\Throwable $th) {
                            session()->flash('error','Opps! Something went wrong please try after a while');
                        }
                    }
                } 
            }
        }
            $profile = $this->profileRepository->update($data,$id);

            if ($profile == false) {
                session()->flash('danger', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
            session()->flash('success','User Profile Status Information have been saved successfully');
            $examProcessing = $this->examProcessingRepository->getAll()->where('profile_id','=',$profile_id)->first();

           
            return redirect()->route('registrar.applicant.profile.list',['status'=> 'progress','state' => 'registrar',  'level'=>isset($examProcessing['level_id']) ? $examProcessing['level_id'] : 1]);
//
        } catch (\Exception $e) {
            dd($e);
            session()->flash('error','Error Occured While Saving Data');
            return redirect()->back()->withInput();
        }
        }else {
             return redirect()->route('login');
        }


}

    public function profileLog($data){
        $logs = $this->profileLogsRepository->create($data);
        if($logs == false)
            return false;
        return true;

    }

    public function examLog($data){
        $logs = $this->examProcessingDetailsRepository->create($data);
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


    public function pclToSubjectCommittee(){
        $datas = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
        ->join('profile_processing','profile_processing.profile_id' , '=' , 'exam_registration.profile_id')
        ->where('exam_registration.state', '=', 'registrar')
        ->where('exam_registration.status', '=', 'progress')
        ->where('exam_registration.level_id', '=', 3)
        ->get([  'profiles.id as profile_id', 'exam_registration.id as exam_processing_id', 'profile_processing.id as profile_processing_id']);
        $profile_log['status'] = 'progress';
        $profile_log['remarks'] =  isset($data['remarks']) ? $data['remarks'] : 'Profile Verified and forwarded to Subject Committee';
        $profile_log['review_status'] = 'Successfully Accepeted';
        $profile_log['state'] = 'registrar';
        $exam['state'] = 'subject_committee';
        $exam['status'] = 'progress';

        $profile['profile_state'] = 'subject_committee';
        $profile['profile_status'] = 'Reviewing';

        $profile_processing['current_state'] = 'subject_committee';
        $profile_processing['status'] = 'progress';

        foreach($datas as $data){
             $profiles =  $this->profileRepository->update($profile, $data->profile_id);
             $profileProcessings = $this->profileProcessingRepository->update($profile_processing,$data->profile_processing_id);
             $exam_processing = $this->examProcessingRepository->update($exam, $data->exam_processing_id);
             $profile_log['profile_id'] = $data->profile_id;
            $this->profileLog($profile_log);
             $profile_log['exam_processing_id'] = $data->exam_processing_id;
             $this->examLog($profile_log);

        }

        return redirect()->back();
    }

    public function examDetails($id){
        $appliedCount = ExamProcessing::all()->where('exam_id','=',$id);
        $rejectedCount = ExamProcessing::all()->where('status','=','rejected')->where('exam_id','=',$id);
        $failedCount =  DB::table('exam_registration')
        ->select('profile_id','exam_id', DB::raw('COUNT(*) as `count`'))
        ->groupBy('profile_id', 'exam_id')
        ->havingRaw('COUNT(*) >= 2')
        ->get();
        $operatorState = ExamProcessing::all()->where('exam_id','=',$id)->where('state','=','computer_operator')->where('status','!=','rejected');
        $operatorAcceptedState = ExamProcessing::all()->where('exam_id','=',$id)->where('state','!=','computer_operator'); 
        $operatorRejectedState = ExamProcessing::all()->where('exam_id','=',$id)->where('state','=','computer_operator')->where('status','=','rejected'); 
        
        $officerState = ExamProcessing::all()->where('exam_id','=',$id)->where('state','=','officer')->where('status','!=','rejected');
        $officerAcceptedState = ExamProcessing::all()->where('exam_id','=',$id)->where('state','!=','computer_operator')->where('state','!=','officer'); 
        $officerRejectedState = ExamProcessing::all()->where('exam_id','=',$id)->where('state','=','officer')->where('status','=','rejected'); 
        
        $registrarState = ExamProcessing::all()->where('exam_id','=',$id)->where('state','=','registrar')->where('status','!=','rejected');
        $registrarAcceptedState = ExamProcessing::all()->where('exam_id','=',$id)->where('state','!=','computer_operator')->where('state','!=','officer')->where('state','!=','registrar'); 
        $registrarRejectedState = ExamProcessing::all()->where('exam_id','=',$id)->where('state','=','registrar')->where('status','=','rejected'); 
        
        $examApplied = ExamProcessing::join('profiles','profiles.id','=','exam_registration.profile_id')
        ->where('exam_registration.exam_id','=',$id)
        ->join('program','program.id','=','exam_registration.program_id')
        ->where('exam_registration.state','=','subject_committee')
        ->where('program.subject-committee_id','=','1')
        ->count(['profiles.id']);

        $GM = ExamProcessing::join('profiles','profiles.id','=','exam_registration.profile_id')
        ->where('exam_registration.exam_id','=',$id)
        ->join('program','program.id','=','exam_registration.program_id')
        ->where('exam_registration.state','=','subject_committee')
        ->where('program.subject-committee_id','=','2')
        ->count(['profiles.id']);


            $lM = ExamProcessing::join('profiles','profiles.id','=','exam_registration.profile_id')
            ->where('exam_registration.exam_id','=',$id)
            ->join('program','program.id','=','exam_registration.program_id')
            ->where('exam_registration.state','=','subject_committee')
            ->where('program.subject-committee_id','=','3')
            ->count(['profiles.id']);


            $radio = ExamProcessing::join('profiles','profiles.id','=','exam_registration.profile_id')
            ->where('exam_registration.exam_id','=',$id)
            ->join('program','program.id','=','exam_registration.program_id')
            ->where('exam_registration.state','=','subject_committee')
            ->where('program.subject-committee_id','=','4')
            ->count(['profiles.id']);


            $opt = ExamProcessing::join('profiles','profiles.id','=','exam_registration.profile_id')
            ->where('exam_registration.exam_id','=',$id)
            ->join('program','program.id','=','exam_registration.program_id')
            ->where('exam_registration.state','=','subject_committee')
            ->where('program.subject-committee_id','=','5')
            ->count(['profiles.id']);


            $den = ExamProcessing::join('profiles','profiles.id','=','exam_registration.profile_id')
            ->where('exam_registration.exam_id','=',$id)
            ->join('program','program.id','=','exam_registration.program_id')
            ->where('exam_registration.state','=','subject_committee')
            ->where('program.subject-committee_id','=','6')
            ->count(['profiles.id']);


            $phy = ExamProcessing::join('profiles','profiles.id','=','exam_registration.profile_id')
            ->where('exam_registration.exam_id','=',$id)
            ->join('program','program.id','=','exam_registration.program_id')
            ->where('exam_registration.state','=','subject_committee')
            ->where('program.subject-committee_id','=','7')
            ->count(['profiles.id']);


        $levelWiseCount = $appliedCount->groupBy('level_id')->map->count();
        $programWiseCount = $appliedCount->groupBy('program_id')->map->count();
        return view('registrar::pages.exam.show',compact('appliedCount', 'rejectedCount','failedCount',
         'operatorState', 'operatorAcceptedState', 'operatorRejectedState', 'levelWiseCount', 'programWiseCount','id',
           'officerState', 'officerAcceptedState', 'officerRejectedState',
           'registrarState', 'registrarAcceptedState', 'registrarRejectedState',
           'examApplied','GM','lM','radio','opt','den','phy'));
    }

    public function getProgramStudent($id,$exam_id)
    {
        $students = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
            ->where('exam_registration.program_id', '=', $id)
            ->join('program', 'program.id', '=', 'exam_registration.program_id')
            ->where('exam_registration.exam_id', '=', $exam_id)
            ->get(['profiles.*', 'program.name as program_name', 'profiles.id as profile_id']);

        return view('registrar::pages.program-student', compact('students'));
    }
}


