<?php


namespace SubjectCommittee\Http\Controller;


use App\Models\Exam\ExamProcessing;
use App\Models\Profile\Profilelogs;
use App\Models\Profile\ProfileProcessing;
use App\Models\SubjectCommittee\SubjectCommitteeUser;
use App\Modules\Backend\Admin\Program\Repositories\ProgramRepository;
use App\Modules\Backend\Authentication\User\Repositories\UserRepository;
use App\Modules\Backend\Exam\Exam\Repositories\ExamRepository;
use App\Modules\Backend\Exam\ExamProcessing\Repositories\ExamProcessingRepository;
use App\Modules\Backend\Exam\ExamProcessingDetails\Repositories\ExamProcessingDetailsRepository;
use App\Modules\Backend\Profile\Profilelogs\Repositories\ProfileLogsRepository;
use App\Modules\Backend\Profile\ProfileProcessing\Repositories\ProfileProcessingRepository;
use App\Modules\Backend\SubjectCommittee\SubjectCommittee\SubjectCommitteeRepository;
use App\Modules\Backend\SubjectCommittee\SubjectCommitteRole\SubjectCommitteeUserRepository;
use Illuminate\Support\Facades\Auth;
use Operator\Modules\Framework\Request;
use Student\Models\Profile;
use Student\Modules\Profile\Repositories\ProfileRepository;
use Student\Modules\Qualification\Repositories\QualificationRepository;

class SubjectCommitteeController extends BaseController
{
    private  $log,$profileProcessing,
        $profileRepository, $userRepository,
        $qualificationRepository,$user_data,
        $profileLogsRepository,$profileProcessingRepository,
        $examRepository,$examProcessingRepository,$subjectCommitteeUserRepository , $subjectCommitteeRepository, $programRepository;
    private $viewData, $exam_processing, $current_user = false;

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
     * @param SubjectCommitteeRepository $subjectCommitteeRepository
     * @param SubjectCommitteeUserRepository $subjectCommitteeUserRepository
     * @param ProgramRepository $programRepository
     */

    public function __construct(ProfileRepository $profileRepository, UserRepository $userRepository, QualificationRepository $qualificationRepository,
                                ProfileLogsRepository $profileLogsRepository, ProfileProcessingRepository $profileProcessingRepository,
                                ExamRepository $examRepository,ExamProcessingRepository $examProcessingRepository, ExamProcessingDetailsRepository $examProcessingDetailsRepository,
SubjectCommitteeRepository $subjectCommitteeRepository, SubjectCommitteeUserRepository $subjectCommitteeUserRepository, ProgramRepository $programRepository)
    {
        $this->profileRepository=$profileRepository;
        $this->userRepository=$userRepository;
        $this->qualificationRepository=$qualificationRepository;
        $this->profileLogsRepository = $profileLogsRepository;
        $this->profileProcessingRepository = $profileProcessingRepository;
        $this->examRepository=$examRepository;
        $this->examProcessingRepository=$examProcessingRepository;
        $this->examProcessingDetailsRepository=$examProcessingDetailsRepository;
        $this->subjectCommitteeRepository = $subjectCommitteeRepository;
        $this->subjectCommitteeUserRepository= $subjectCommitteeUserRepository;
        $this->programRepository = $programRepository;
        parent::__construct();
    }

    public function index(){
        $data = $this->subjectCommitteeUserRepository->getAll()->where('user_id','=',Auth::user()->id)->first();
        $subject_committee = $this->subjectCommitteeRepository->findById($data['subjecr_committee_id']);
//        $profiles = Profile::join('exam_registration','exam_registration.profile_id','=','profiles.id')
//            ->join('program','program.id','=','exam_registration.program_id')
//            ;
//        $progress = $profiles->where('profiles.profile_state','subject_committee')
//            ->where('profiles.profile_status','Reviewing')
//            ->where('program.subject-committee_id',$data['subjecr_committee_id'])
//            ->count();
//        $rejected = $profiles->where('profiles.profile_state','subject_committee')
//            ->where('profiles.profile_status','Rejected')
//            ->where('program.subject-committee_id',$data['subjecr_committee_id'])
//            ->count();
//        $pending = $profiles->where('profiles.profile_state','subject_committee')
//            ->where('profiles.profile_status','Pending')
//            ->where('program.subject-committee_id',$data['subjecr_committee_id'])
//            ->count();

//
//        $tslc_count =0;
//        $pcl_count =0;
//        $bachelor_count =0;
//        $master_count =0;
//        $common =Profile::join('exam_registration','exam_registration.profile_id','=','profiles.id')
//            ->join('program','program.id','=','exam_registration.program_id')
//            ->join('profile_processing','profile_processing.profile_id','=','profiles.id')
//            ->where('profile_processing.current_state','subject_committee')
//            ->where('profile_processing.status','progress')
//            ->where('program.subject-committee_id',$data['subjecr_committee_id'])
//            ->orderBy('profiles.created_at','ASC');
//        $tslc = $common->where('profiles.level','3')
//            ->get(['profiles.*']);

//        $pcl =  $common->where('profiles.level','3')
//            ->get(['profiles.*']);
//
//        $bachelor =  $common->where('profiles.level','4')
//            ->get(['profiles.*']);
//
//        $master =  $common->where('profiles.level','5')
//            ->get(['profiles.*']);

//        foreach ($tslc as $data){
//            $log = \App\Models\Profile\Profilelogs::all()->where('profile_id', '=', $data['id'])
//                ->where('state', '=', 'subject_committee')
//                ->where('status', '=', 'progress')
//                ->where('created_by','=',Auth::user()->id)
//                ->first();;
//            if (!$log) {
//                $tslc_count++;
//            }
//        }
//        foreach ($pcl as $data){
//            $log = \App\Models\Profile\Profilelogs::all()->where('profile_id', '=', $data['id'])
//                ->where('state', '=', 'subject_committee')
//                ->where('status', '=', 'progress')
//                ->where('created_by','=',Auth::user()->id)
//                ->first();;
//            if (!$log) {
//                $pcl_count++;
//            }
//        }foreach ($bachelor as $data){
//            $log = \App\Models\Profile\Profilelogs::all()->where('profile_id', '=', $data['id'])
//                ->where('state', '=', 'subject_committee')
//                ->where('status', '=', 'progress')
//                ->where('created_by','=',Auth::user()->id)
//                ->first();;
//            if (!$log) {
//                $bachelor_count++;
//            }
//        }foreach ($master as $data){
//            $log = \App\Models\Profile\Profilelogs::all()->where('profile_id', '=', $data['id'])
//                ->where('state', '=', 'subject_committee')
//                ->where('status', '=', 'progress')
//                ->where('created_by','=',Auth::user()->id)
//                ->first();;
//            if (!$log) {
//                $master_count++;
//            }
//        }
        return view('subjectCommittee::pages.dashboard',compact('data','subject_committee'));
//        return view('subjectCommittee::pages.dashboard',compact('data','subject_committee','progress','rejected','pending','tslc_count','pcl_count'
//        ,'bachelor_count','master_count'));
    }
    public function profile($status, $current_state, $level, $page = 0)
    {
        if (Auth::user()->mainRole()->name === 'subject_committee') {
            $subject_Committee_id = $this->subjectCommitteeUserRepository->getAll()->where('user_id','=',Auth::user()->id)->first();
            $level = $level ? $level : 1;
            $page = $page ? $page : 0;
            $master_count = 0;
            $bachelor_count = 0;
            $pcl_count = 0;
            $tslc_count = 0;
            $take = 100;
//            $datas = [];
//
//            $datas = Profilelogs::join('profiles','profiles.id','=','profile_logs.profile_id')
//                ->join('profile_processing','profile_processing.profile_id','=','profiles.id')
//                     ->where('profile_logs.state', '!=', $current_state)
//                    ->where('profile_logs.status', '!=', $status)
//                ->where('profile_processing.current_state',$current_state)
//                ->where('profiles.level',$level)
//                ->where('profile_processing.status',$status)
//                    ->where('profile_logs.created_by','!=',Auth::user()->id)
//                ->groupBy('profiles.id','profiles.first_name')
//                    ->get(['profiles.id','profiles.first_name']);
//            dd($datas);
            $datas= Profile::join('exam_registration','exam_registration.profile_id','=','profiles.id')
                ->join('program','program.id','=','exam_registration.program_id')
                ->join('profile_processing','profile_processing.profile_id','=','profiles.id')
                ->leftJoin('profile_logs', function ($join) {
                    $join->on('profiles.id', '=', 'profile_logs.profile_id')
//                ->where('profile_logs.created_by', '!=', Auth::user()->id)

//                        ->where('profile_logs.status', '=', 'progress')
//                        ->where('profile_logs.state', '!=', 'computer_operator')
//                        ->where('profile_logs.state', '!=', 'officer')
//                        ->where('profile_logs.state','=','subject_committee')
//                        ->where('profile_logs.review_status','!=','Successful')
//                        ->where('profile_logs.created_by', '!=', Auth::user()->id)
//                        ->orderBy('profile_logs_created_by')
//                        ->first()

                        ->where('profile_logs.state', '!=', 'computer_operator')
                        ->where('profile_logs.state', '!=', 'officer')
                        ->where('profile_logs.state', '!=', 'registrar')
                        ->where('profile_logs.state','=','subject_committee')
                        ->where('profile_logs.review_status','=','Successful')
                        ->where('profile_logs.created_by', '=', Auth::user()->id)
                      ;
                })
                ->where('profile_processing.current_state',$current_state)
//                ->where('profile_logs.created_by', '!=', Auth::user()->id)
                ->where('profiles.level',$level)
                ->where('profile_processing.status',$status)
                ->where('program.subject-committee_id',$subject_Committee_id['subjecr_committee_id'])
                ->orderBy('profiles.created_at','ASC')
//                ->skip($page * $take)
//                ->take($take)
//                ->count();
                ->get(['profiles.*','program.name as program_name','profile_logs.created_by','profile_logs.state']);

//dd($datas);
//            foreach ($datas as $data){
//                $log = $this->profileLogsRepository->getAll()->where('profile_id', '=', $data['id'])
//                    ->where('state', '=', $current_state)
//                    ->where('status', '=', $status)
//                    ->where('created_by','=',Auth::user()->id)
//                    ->first();
//            }


//            $CountDatas= Profile::join('exam_registration','exam_registration.profile_id','=','profiles.id')
//                ->join('program','program.id','=','exam_registration.program_id')
//                ->join('profile_processing','profile_processing.profile_id','=','profiles.id')
//                ->leftJoin('profile_logs', function ($join) {
//                    $join->on('profiles.id', '=', 'profile_logs.profile_id')
////                    ->join('subject_committee_user','subject_committee_user.user_id','=','profile_logs.created_by')
////                ->join('users','users.id','=','profile_logs.created_by')
////                        ->where('profile_logs.state','subject_committee')
////                        ->where('profile_logs.status','progress')
////                        ->where('profile_logs.profile_id',$id)
////                ->where('profile_logs.created_by', '!=', Auth::user()->id)
//
//                        ->where('profile_logs.status', '=', 'progress')
//                        ->where('profile_logs.state', '!=', 'computer_operator')
//                        ->where('profile_logs.state', '!=', 'officer')
//                        ->where('profile_logs.state','=','subject_committee')
//                        ->where('profile_logs.review_status','!=','Successful')
//                        ->where('profile_logs.created_by', '!=', Auth::user()->id)
//                    ;
//                })
//                ->where('profile_processing.current_state',$current_state)
////                ->where('profile_logs.created_by', '!=', Auth::user()->id)
//                ->where('profile_processing.status',$status)
//                ->where('program.subject-committee_id',$subject_Committee_id['subjecr_committee_id'])
//                ->orderBy('profiles.created_at','ASC')
////                ->skip($page * $take)
////                ->take($take)
////                ->count();
//                ->get(['profiles.*','program.name as program_name','profile_logs.created_by']);
//            foreach ($CountDatas as $data){
//                if($data->created_by != \Illuminate\Support\Facades\Auth::user()->id && $data->level == 5)
//                    $master_count = $master_count +1;
//            }
//            foreach ($CountDatas as $data){
//                if($data->created_by != \Illuminate\Support\Facades\Auth::user()->id)
//                    if( $data->level === 4)
//                    $bachelor_count = $bachelor_count +1;
//            }
//            foreach ($CountDatas as $data){
//                if($data->created_by != \Illuminate\Support\Facades\Auth::user()->id && $data->level == 3)
//                    $pcl_count = $pcl_count +1;
//            }
//            foreach ($CountDatas as $data){
//                if($data->created_by != \Illuminate\Support\Facades\Auth::user()->id && $data->level === 2)
//                    $tslc_count = $tslc_count +1;
//
//            }
//

//            dd($master_count, $bachelor_count, $pcl_count, $tslc_count);
//            foreach ($profiles as $data){
//                $log = $this->profileLogsRepository->getAll()->where('profile_id', '=', $data['id'])
//                    ->where('state', '=', $current_state)
//                    ->where('status', '=', $status)
//                    ->where('created_by','=',Auth::user()->id)
//                    ->first();
//                if (!$log) {
//                    $datas[]= Profile::join('exam_registration','exam_registration.profile_id','=','profiles.id')
//                        ->join('program','program.id','=','exam_registration.program_id')
//                        ->where('profiles.id', '=', $data['id'])
//                        ->skip($page * $take)
//                        ->take($take)
//                        ->get(['profiles.*','program.name as program_name']);
//                }
//            }
//            dd($datas);
            $data = $this->subjectCommitteeUserRepository->getAll()->where('user_id','=',Auth::user()->id)->first();
            $subject_committee = $this->subjectCommitteeRepository->findById($data['subjecr_committee_id']);
            return view('subjectCommittee::pages.applicant-profile-list', compact('datas','status','current_state','page','level','subject_committee',"master_count", "bachelor_count", "pcl_count", "tslc_count"));
        }else{
            return redirect()->route('login');
        }
    }

    public function acceptedByMe($status, $current_state, $level, $page = 0)
    {
        if (Auth::user()->mainRole()->name === 'subject_committee') {
            $subject_Committee_id = $this->subjectCommitteeUserRepository->getAll()->where('user_id','=',Auth::user()->id)->first();
            $level = $level ? $level : 1;
            $page = $page ? $page : 0;
            $take = 1000;

            $datas= Profile::join('exam_registration','exam_registration.profile_id','=','profiles.id')
                ->join('program','program.id','=','exam_registration.program_id')
                ->join('profile_processing','profile_processing.profile_id','=','profiles.id')
                ->leftJoin('profile_logs', function ($join) {
                    $join->on('profiles.id', '=', 'profile_logs.profile_id')
                        ->where('profile_logs.state','=','subject_committee')
                        ->where('profile_logs.review_status','=','Successful')
                        ->where('profile_logs.created_by', '=', Auth::user()->id)
                    ;
                })
                ->where('profile_processing.current_state',$current_state)
                ->where('profiles.level',$level)
                ->where('profile_processing.status',$status)
                ->where('program.subject-committee_id',$subject_Committee_id['subjecr_committee_id'])
                ->orderBy('profiles.created_at','ASC')
                ->get(['profiles.*','program.name as program_name','profile_logs.created_by','profile_logs.state']);


            $data = $this->subjectCommitteeUserRepository->getAll()->where('user_id','=',Auth::user()->id)->first();
            $subject_committee = $this->subjectCommitteeRepository->findById($data['subjecr_committee_id']);
            return view('subjectCommittee::pages.accepted-by-me', compact('datas','status','current_state','page','level','subject_committee'));
        }else{
            return redirect()->route('login');
        }
    }

    public function exam($status, $current_state)
    {
        if (Auth::user()->mainRole()->name === 'subject_committee') {
            $users = $this->examProcessingRepository->getAll()->where('status', '=', $status)
                ->where('state', '=', $current_state);
            $data = $this->subjectCommitteeUserRepository->getAll()->where('user_id','=',Auth::user()->id)->first();
            $subject_committee = $this->subjectCommitteeRepository->findById($data['subjecr_committee_id']);
            return $this->view('pages.application-list', $users);
        }else{
            return redirect()->route('login');
        }
    }

    public function edit($id)
    {
        if (Auth::user()->mainRole()->name === 'subject_committee') {
            $data = $this->profileRepository->findById($id);
            $user_id=$data['user_id'];
            $user_data = $this->userRepository->findById($user_id);
            $qualification = $this->qualificationRepository->getAll()->where('user_id','=',$data['user_id']);
            $profile_logs = $this->profileLogsRepository->getAll()->where('profile_id','=',$id);
            $subject_committee_logs = Profilelogs::join('subject_committee_user','subject_committee_user.user_id','=','profile_logs.created_by')
                ->join('users','users.id','=','profile_logs.created_by')
                ->where('profile_logs.state','subject_committee')
                ->where('profile_logs.status','progress')
                ->where('profile_logs.profile_id',$id)
                ->get(['profile_logs.*','users.name as user_name']);
            $profile_processing = $this->profileProcessingRepository->getAll()->where('profile_id','=',$id)->first();
            $exams = $this->examProcessingRepository->getAll()->where('profile_id','=',$id);
            $exam = $this->examProcessingRepository->getAll()->where('profile_id','=',$id)->first();
            if ($profile_processing['subject_committee_accepted_num'] != 0) {
                $current_user = $this->profileLogsRepository->getAll()->where('created_by', '=', Auth::user()->id)
                    ->where('status','!=','rejected')
                                                                        ->where('profile_id','=',$id);
            }else {
                $current_user = null;
            }
            if ($exam) {
                if ($exam['subject_committee_count'] != 0) {
                    $current_exam_user = $this->examProcessingDetailsRepository->getAll()->where('created_by', '=', Auth::user()->id)
                        ->where('profile_id', '=', $id);;
                } else {
                    $current_exam_user = null;
                }
            }else{
                $current_exam_user = null;
            }
            $subjects = $this->subjectCommitteeUserRepository->getAll()->where('user_id','=',Auth::user()->id)->first();
            $subject_committee = $this->subjectCommitteeRepository->findById($subjects['subjecr_committee_id']);
            return view('subjectCommittee::pages.application-list-review',compact('data','user_data','qualification','profile_logs','profile_processing','exams','current_user','current_exam_user','subject_committee_logs','subject_committee'));
        }else{
            return redirect()->route('login');
        }

    }

    public function status(Request $request)
    {
        if (Auth::user()->mainRole()->name === 'subject_committee') {
            $data = $request->all();
            try {
                $id = $data['profile_id'];
                $data['created_by'] = Auth::user()->id;
                $data['state'] = 'subject_committee';
                if ($data['profile_status'] === "Verified" || $data['profile_status'] === "Reviewing" ) {
                    $data['status'] = 'progress';
                    $data['remarks'] = 'Profile is Accepted by ' . Auth::user()->name;
                    $data['review_status'] = 'Successful';
                    $this->profileLog($data);
                    $this->profileProcessing($id);
                } elseif ($data['profile_status'] === "Rejected") {
                    $data['status'] = 'rejected';
                    $data['review_status'] = 'Rejected';
                    $this->rejectprofileProcessing($id,$data['remarks']);
                    $this->profileLog($data);
                }
                $profile = $this->profileRepository->update($data, $id);
                if ($profile == false) {
                    session()->flash('danger', 'Oops! Something went wrong.');
                }
                $current_state = "subject_committee";
                $status = $data['status'];
                session()->flash('success','User Profile Status Information have been saved successfully');
                return redirect()->route("subjectCommittee.applicant.profile.list", ['status'=> $status,'current_state' => $current_state, 'level'=>$profile['level']]);

            } catch (\Exception $e) {
                session()->flash('danger', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
        }else{
            return redirect()->route('login');
        }

    }

    public function profileLog( array  $data ){
        $data["created_by"] = Auth::user()->id;
        $logs = $this->profileLogsRepository->create($data);
        if($logs == false)
            return false;
        return true;

    }
    public function rejectprofileProcessing($id,$remarks){
        $profileProcessing['profile_id'] = $id;
        $profileProcessing['current_state'] = "subject_committee";
        $profileProcessing['status'] = "rejected";
        $id= $this->profileProcessingRepository->getAll()->where('profile_id' ,'=',$id)->first();
        $profile_processing = $id;
        $profileProcessing['remarks'] = $remarks;
        $profileProcessing['review_status'] = 'Rejected';
        $profileProcessing['current_state'] = 'subject_committee';
        $profileProcessings = $this->profileProcessingRepository->update($profileProcessing,$id['id']);
        if($profileProcessings == false)
            return false;
        return true;

    }

    public function profileProcessing( $id ){
        $profileProcessing['profile_id'] = $id;
        $profileProcessing['current_state'] = "subject_committee";
        $profileProcessing['status'] = "progress";
        $subject_Committee = $this->subjectCommitteeUserRepository->getAll()->where('user_id','=',Auth::user()->id)->first();
        $id= $this->profileProcessingRepository->getAll()->where('profile_id' ,'=',$id)->first();
        $profile_processing = $id;
        if ($profile_processing['current_state'] === 'subject_committee'){
            $profile_processing->subject_committee_accepted_num ++;
        }
        $profileProcessings = $this->profileProcessingRepository->update($profileProcessing,$id['id']);
        if($profileProcessings == false)
            return false;
        return true;

    }


    public function RejectExamProcessing(Request $request){
        $data= $request->all();
        $id = $data['id'];
        $data['status'] = 'rejected';
        $data['state'] = 'officer';
        try{
            $exam_processing = $this->examProcessingRepository->update($data,$id);
            $profile_id = $exam_processing['profile_id'];
            $this->ExamProcessingLog($data, $id, $profile_id);
            if ($exam_processing == false) {
                session()->flash('danger', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
            session()->flash('success','Application have been Rejected');
            return redirect()->back();

        } catch (\Exception $e) {
            session()->flash('danger', 'Oops! Something went wrong.');
            return redirect()->back()->withInput();
        }
    }

    public function AcceptExamProcessing($id){
        $data['status'] = 'progress';
        $exam_processing = $this->examProcessingRepository->findById($id);
        if ($exam_processing->state === 'subject_committee'){
            if($exam_processing->subject_committee_count < 3)
                $data['subject_committee_count'] = $exam_processing->subject_committee_count + 1;
            else
                $data['state'] = 'exam_committee';
        }
        try {
            $exam_processing = $this->examProcessingRepository->update($data,$id);
            $profile_id = $exam_processing['profile_id'];
            $this->ExamProcessingLog($data, $id, $profile_id);
            if ($exam_processing == false) {
                session()->flash('danger', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
            session()->flash('success','Application Move to forward for Verification');
            return redirect()->back()->refresh()->withInput();

        } catch (\Exception $e) {
            session()->flash('danger', 'Oops! Something went wrong.');
            return redirect()->back()->withInput();
        }

    }

    public function ExamProcessingLog($data, $id, $profile_id)
    {
        if (Auth::user()->mainRole()->name === 'subject_committee') {

            $data['state'] = 'subject_committee';
            $data["created_by"] = Auth::user()->id;
            $data['exam_processing_id'] = $id;
            $data['profile_id'] = $profile_id;
            if ($data['status'] === 'accepted') {
                $data['remarks'] = 'Exam Applied has been accepted by ' . ' ' . Auth::user()->name ;
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

    public function signatureImage(Request $request){
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;

       $subject_committee = $this->subjectCommitteeUserRepository->getAll()->where('user_id','=',Auth::user()->id)->first();
        try {
            $profile = $this->subjectCommitteeUserRepository->update($data,$subject_committee['id']);
            if ($profile == false) {
                session()->flash('danger', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
            session()->flash('success','Your signature has been uploaded Successfully. ');
            return redirect()->back();
        } catch (\Exception $e) {
            session()->flash('danger', 'Oops! Something went wrong.');
            return redirect()->back()->withInput();
        }

    }


    public function moveExam(){
        $subject_Committee = $this->subjectCommitteeUserRepository->getAll()->where('user_id','=',Auth::user()->id)->first();
        $subject_Committee_number = SubjectCommitteeUser::where('subjecr_committee_id', '=', $subject_Committee['subjecr_committee_id'])->get();
        $subjectCommitteeCount = $subject_Committee_number->count();
        $average = $subjectCommitteeCount / 2;
        $datas = Profile::join('exam_registration','exam_registration.profile_id','=','profiles.id')
            ->join('program','program.id','=','exam_registration.program_id')
            ->join('profile_processing','profile_processing.profile_id','=','profiles.id')
            ->where('profile_processing.current_state','subject_committee')
            ->where('profiles.level','>','2')
            ->where('program.subject-committee_id',$subject_Committee['subjecr_committee_id'])
            ->where('profile_processing.status','progress')
            ->where('profile_processing.subject_committee_accepted_num','>=',$average)
            ->orderBy('profiles.created_at','ASC')
            ->get(['profiles.*']);
        $data = $this->subjectCommitteeUserRepository->getAll()->where('user_id','=',Auth::user()->id)->first();
        $subject_committee = $this->subjectCommitteeRepository->findById($data['subjecr_committee_id']);
        return view('subjectCommittee::pages.exam', compact('datas','subject_committee'));
    }
    public function moveCouncil(){
        $subject_Committee = $this->subjectCommitteeUserRepository->getAll()->where('user_id','=',Auth::user()->id)->first();
        $subject_Committee_number = SubjectCommitteeUser::where('subjecr_committee_id', '=', $subject_Committee['subjecr_committee_id'])->get();
        $subjectCommitteeCount = $subject_Committee_number->count();
        $average = $subjectCommitteeCount / 2;
        $datas = Profile::join('exam_registration','exam_registration.profile_id','=','profiles.id')
            ->join('program','program.id','=','exam_registration.program_id')
            ->join('profile_processing','profile_processing.profile_id','=','profiles.id')
            ->where('profile_processing.current_state','subject_committee')
            ->where('profile_processing.status','progress')
            ->where('profile_processing.subject_committee_accepted_num','>=',$average)
            ->orderBy('profiles.created_at','ASC')
            ->get(['profiles.*']);
        $data = $this->subjectCommitteeUserRepository->getAll()->where('user_id','=',Auth::user()->id)->first();
        $subject_committee = $this->subjectCommitteeRepository->findById($data['subjecr_committee_id']);
        return view('subjectCommittee::pages.council', compact('datas','subject_committee'));
    }


    public function countSubjectCom(){

        $profiles = Profile::join('exam_registration','exam_registration.profile_id','=','profiles.id')
            ->join('program','program.id','=','exam_registration.program_id')
            ->join('profile_processing','profile_processing.profile_id','=','profiles.id')
            ->where('profile_processing.current_state','subject_committee')
            ->where('profile_processing.status','progress')
            ->orderBy('profiles.created_at','ASC')
            ->get(['profiles.*','profiles.id as profile_id']);

        foreach ($profiles as $profile){
            $logs = Profilelogs::all()->where('profile_id','=',$profile->profile_id)
                ->where('state','=','subject_committee')
                ->where('status','=','progress')
                ->count();
            dd($logs);
        }

        $subject_Committee = $this->subjectCommitteeUserRepository->getAll()->where('user_id','=',Auth::user()->id)->first();
        $subject_Committee_number = SubjectCommitteeUser::where('subjecr_committee_id', '=', $subject_Committee['subjecr_committee_id'])->get();
        $subjectCommitteeCount = $subject_Committee_number->count();
        $average = $subjectCommitteeCount / 2;
        $datas = Profile::join('exam_registration','exam_registration.profile_id','=','profiles.id')
            ->join('program','program.id','=','exam_registration.program_id')
            ->join('profile_processing','profile_processing.profile_id','=','profiles.id')
            ->where('profile_processing.current_state','subject_committee')
            ->where('profiles.level','2')
            ->where('profile_processing.status','progress')
            ->where('profile_processing.subject_committee_accepted_num','>=',$average)
            ->orderBy('profiles.created_at','ASC')
            ->get(['profiles.*']);
        $data = $this->subjectCommitteeUserRepository->getAll()->where('user_id','=',Auth::user()->id)->first();
        $subject_committee = $this->subjectCommitteeRepository->findById($data['subjecr_committee_id']);
        return view('subjectCommittee::pages.council', compact('datas','subject_committee'));
    }
}

