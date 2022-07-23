<?php


namespace officer\Http\Controller;


use App\Http\Controllers\MailController;
use App\Models\Exam\ExamProcessing;
use App\Models\Profile\Profilelogs;
use App\Models\Profile\ProfileProcessing;
use App\Models\SubjectCommittee\SubjectCommittee;
use App\Models\SubjectCommittee\SubjectCommitteeUser;
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

class OfficerController  extends BaseController
{
    private  $log,$profileProcessing,
         $profileRepository, $userRepository,
        $qualificationRepository,$user_data,
        $profileLogsRepository,$profileProcessingRepository,
        $examRepository,$examProcessingRepository,$examProcessingDetailsRepository;
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
                                ExamRepository $examRepository,ExamProcessingRepository $examProcessingRepository,
                                ExamProcessingDetailsRepository $examProcessingDetailsRepository)
    {
        $this->profileRepository=$profileRepository;
        $this->userRepository=$userRepository;
        $this->qualificationRepository=$qualificationRepository;
        $this->profileLogsRepository = $profileLogsRepository;
        $this->profileProcessingRepository = $profileProcessingRepository;
        $this->examRepository=$examRepository;
        $this->examProcessingRepository=$examProcessingRepository;
        $this->examProcessingDetailsRepository = $examProcessingDetailsRepository;
        parent::__construct();
    }

    public function profile($status, $current_state, $level,$page = 0)
    {
        if (Auth::user()->mainRole()->name === 'officer') {
            $page = $page ? $page : 0;
            $take = 20;
            $datas = Profile::join('exam_registration','exam_registration.profile_id','=','profiles.id')
                ->join('program','program.id','=','exam_registration.program_id')
                ->where('profiles.profile_state', '=', $current_state)
                ->where('profiles.profile_status', '=', $status)
                ->where('profiles.level', '=', $level)
                ->orderBy('profiles.created_at','ASC')
                ->skip($page * $take)
                ->take($take)
                ->get(['profiles.*','program.name as program_name']);
            $state = $current_state;
            $page = (int)$page;
            return view('officer::pages.applicant-profile-list', compact('datas','state','status','page','level'));
        }else {
                return redirect()->route('login');
            }
    }

    public function exam($status,$state)
    {
        if (Auth::user()->mainRole()->name === 'officer') {
            $users = $this->examProcessingRepository->getAll()->where('status' ,'=',$status)
        ->where('state','=',$state);
        return $this->view('pages.application-list',$users);
        }else {
            return redirect()->route('login');
        }
    }

    public function edit($id)
    {
        if (Auth::user()->mainRole()->name === 'officer') {
            $data = $this->profileRepository->findById($id);
        $user_id=$data['user_id'];
        $user_data = $this->userRepository->findById($user_id);
        $qualification = $this->qualificationRepository->getAll()->where('user_id','=',$data['user_id']);
        $profile_logs = $this->profileLogsRepository->getAll()->where('profile_id','=',$id);
        $profile_processing = $this->profileProcessingRepository->getAll()->where('profile_id','=',$id)->first();
        $exams = $this->examProcessingRepository->getAll()->where('profile_id','=',$id);
        return view('officer::pages.application-list-review',compact('data','user_data','qualification','profile_logs','profile_processing','exams'));
        }else {
            return redirect()->route('login');
        }

    }

    public function status(Request $request)
    {
        if (Auth::user()->mainRole()->name === 'officer') {
            $data = $request->all();
        try {
            $id=$data['profile_id'];
            $data['created_by'] = Auth::user()->id;
            $data['state'] =  'officer';
            $profileEmail = $this->profileRepository->findById($id);
            $email = $this->userRepository->findBy('id','=',$profileEmail['user_id'])->first();
            if ( $data['profile_status']=== "Verified" || $data['profile_status'] === "Reviewing"){
                $data['status'] = 'progress';
                $data['remarks'] =  'Profile Verified and forwarded to Registrar';
                $data['review_status'] =  'Successful';
                $data['profile_state'] = 'registrar';
//                MailController::sendprofileVerification($email["name"], $email['email'], $data['remarks']);
                $this->profileLog($data);
                $this->profileProcessing($id,$data);
            }elseif($data['profile_status']=== "Rejected"){
                $data['status'] =  'rejected';
                $data['review_status'] =  'Rejected';
//                MailController::sendprofileVerification($email["name"], $email['email'], $data['remarks']);
//                $data['profile_state'] = 'student';
                $this->profileLog($data);
                $this->profileProcessing($id, $data);
            }
            $profile = $this->profileRepository->update($data,$id);
            if ($profile == false) {
                session()->flash('danger', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
            session()->flash('success','User Profile Status Information have been saved successfully');
            return redirect()->route('officer.applicant.profile.list');
//
        } catch (\Exception $e) {
            session()->flash('danger', 'Oops! Something went wrong.');
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

    public function profileProcessing( $id , $data){

        $profileProcessing['profile_id'] = $id;
        $profileEmail = $this->profileRepository->findById($id);
        $email = $this->userRepository->findBy('id','=',$profileEmail['user_id'])->first();
        $profileProcessingId = $this->profileProcessingRepository->getAll()->where('profile_id','=', $id)->first();
        if ($data['profile_status'] === "Verified" || $data['profile_status'] === "Reviewing") {

            $data['status'] = 'progress';
            $data['remarks'] = 'Verified and Document is forward to Registrar';
            $data['review_status'] = 'Successful';
            $data['current_state'] = 'registrar';
//            MailController::sendprofileVerification($email["name"], $email['email'], $data['remarks']);
            $profileProcessings = $this->profileProcessingRepository->update($data,$profileProcessingId['id']);
        } elseif ($data['profile_status'] == "Rejected") {

            $data['status'] = 'rejected';
            $data['review_status'] = 'Rejected';
            $data['current_state'] = 'officer';
//            MailController::sendprofileVerification($email["name"], $email['email'], $data['remarks']);
            $profileProcessings = $this->profileProcessingRepository->update($data,$profileProcessingId['id']);
        } elseif ($data['profile_status'] === "Pending") {
            $data['status'] = 'pending';
            $data['review_status'] = 'Pending';
            $data['current_state'] = 'officer';
//            MailController::sendprofileVerification($email["name"], $email['email'], $data['remarks']);
            $profileProcessings = $this->profileProcessingRepository->update($data,$profileProcessingId['id']);

        }

    }


    public function RejectExamProcessing(Request $request){
        if (Auth::user()->mainRole()->name === 'officer') {
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
                session()->flash('success', 'Exam Application have been Rejected');
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
            if (Auth::user()->mainRole()->name === 'officer') {
                $data['status'] = 'progress';
                $data['state'] = 'registrar';
                try {
                    $exam_processing = $this->examProcessingRepository->update($data, $id);
                    $profile_id = $exam_processing['profile_id'];
                    $this->ExamProcessingLog($data, $id, $profile_id);
                    if ($exam_processing == false) {
                        session()->flash('danger', 'Oops! Something went wrong.');
                        return redirect()->back()->withInput();
                    }
                    session()->flash('success', 'Exam Registration file has been Moved forward for further more Verification');
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
        $data['state'] = 'officer';
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
            ->get(['profiles.*','program.name as program_name','profile_processing.*', 'profiles.id as profile_id']);
        $page = (int)$page;


        return view('officer::pages.subjectCommiteeList',compact('datas','level','status','subject_commitee_id','page'));
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


        return view('officer::pages.subjectCommittee',compact('examApplied','GM','lM','radio','opt','den','phy'));
    }


    public function minuteDataSubjectCommitteeIndex(){
        $subjectCommitteeUser = SubjectCommitteeUser::join('users','users.id','=','subject_committee_user.user_id')
                                         ->join('subject_committee','subject_committee.id','=','subject_committee_user.subjecr_committee_id')
            ->get(['users.*','subject_committee.name as subject_committee_name']);
        return view('officer::pages.minute-subject-index',compact('subjectCommitteeUser'));
    }
    public function minuteDataApplicantIndex($id){
        $profiles = Profilelogs::join('profiles','profiles.id','=','profile_logs.profile_id')
            ->where('profile_logs.created_by','=', $id)
            ->join('exam_registration','exam_registration.profile_id','=','profile_logs.profile_id')
            ->join('level','level.id','=','exam_registration.level_id')
            ->where('profile_logs.status','!=','rejected')
            ->get(['profiles.*','exam_registration.*','level.level_ as level_name','profiles.id as profile_id' ])
           ->unique('profile_id');

//        dd($profiles);

        return view('officer::pages.minute-applicant-list',compact('profiles'));
    }

}

