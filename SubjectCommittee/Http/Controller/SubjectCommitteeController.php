<?php


namespace SubjectCommittee\Http\Controller;


use App\Models\Exam\ExamProcessing;
use App\Models\Profile\ProfileProcessing;
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

    public function profile($status, $current_state, $level)
    {
        if (Auth::user()->mainRole()->name === 'subject_committee') {
            $subject_Committee_id = $this->subjectCommitteeUserRepository->getAll()->where('user_id','=',Auth::user()->id)->first();
            $level = $level ? $level : 1;
            $datas = [];
            $profiles = Profile::join('exam_registration','exam_registration.profile_id','=','profiles.id')
                ->join('program','program.id','=','exam_registration.program_id')
                ->join('profile_processing','profile_processing.profile_id','=','profiles.id')
                ->where('profile_processing.current_state',$current_state)
                ->where('profiles.level',$level)
                ->where('profile_processing.status',$status)
                ->where('program.subject-committee_id',$subject_Committee_id['subjecr_committee_id'])
                ->orderBy('profiles.created_at','ASC')
                ->get(['profiles.*']);


            foreach ($profiles as $data){
                $log = $this->profileLogsRepository->getAll()->where('profile_id', '=', $data['id'])
                    ->where('state', '=', $current_state)
                    ->where('status', '=', $status)
                    ->where('created_by','=',Auth::user()->id)
                    ->first();
                if (!$log) {
                    $datas[] = $this->profileRepository->getAll()->where('id', '=', $data['id']);
                }
            }
            return view('subjectCommittee::pages.applicant-profile-list', compact('datas','status','current_state'));
        }else{
            return redirect()->route('login');
        }
    }

    public function exam($status, $current_state)
    {
        if (Auth::user()->mainRole()->name === 'subject_committee') {
            $users = $this->examProcessingRepository->getAll()->where('status', '=', $status)
                ->where('state', '=', $current_state);
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
            $profile_processing = $this->profileProcessingRepository->getAll()->where('profile_id','=',$id)->first();
            $exams = $this->examProcessingRepository->getAll()->where('profile_id','=',$id);
            $exam = $this->examProcessingRepository->getAll()->where('profile_id','=',$id)->first();
            if ($profile_processing['subject_committee_accepted_num'] != 0) {
                $current_user = $this->profileLogsRepository->getAll()->where('created_by', '=', Auth::user()->id)
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
            return view('subjectCommittee::pages.application-list-review',compact('data','user_data','qualification','profile_logs','profile_processing','exams','current_user','current_exam_user'));
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
                    return redirect()->back()->withInput();
                }
                session()->flash('success', 'User Profile Status Information have been saved successfully');
                return redirect()->route('subjectCommittee.applicant.profile.list');
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
        $id= $this->profileProcessingRepository->getAll()->where('profile_id' ,'=',$id)->first();
        $profile_processing = $id;
        if ($profile_processing['current_state'] === 'subject_committee'){
            if($profile_processing->subject_committee_accepted_num < 3)
                $profileProcessing['subject_committee_accepted_num'] = $profile_processing->subject_committee_accepted_num + 1;
            else {
                $profileProcessing['remarks'] = 'Profile is forward to Exam Committee';
                $profileProcessing['review_status'] = 'Successful';
                $profileProcessing['current_state'] = 'exam_committee';
            }
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
}

