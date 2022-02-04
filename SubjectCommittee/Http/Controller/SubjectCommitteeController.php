<?php


namespace SubjectCommittee\Http\Controller;


use App\Modules\Backend\Authentication\User\Repositories\UserRepository;
use App\Modules\Backend\Exam\Exam\Repositories\ExamRepository;
use App\Modules\Backend\Exam\ExamProcessing\Repositories\ExamProcessingRepository;
use App\Modules\Backend\Exam\ExamProcessingDetails\Repositories\ExamProcessingDetailsRepository;
use App\Modules\Backend\Profile\Profilelogs\Repositories\ProfileLogsRepository;
use App\Modules\Backend\Profile\ProfileProcessing\Repositories\ProfileProcessingRepository;
use Illuminate\Support\Facades\Auth;
use Operator\Modules\Framework\Request;
use Student\Modules\Profile\Repositories\ProfileRepository;
use Student\Modules\Qualification\Repositories\QualificationRepository;

class SubjectCommitteeController extends BaseController
{
    private  $log,$profileProcessing,
        $profileRepository, $userRepository,
        $qualificationRepository,$user_data,
        $profileLogsRepository,$profileProcessingRepository,
        $examRepository,$examProcessingRepository;
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

    public function profile($status, $current_state)
    {
        if (Auth::user()->mainRole()->name === 'subject_committee') {
            $users = $this->profileProcessingRepository->getAll()->where('current_state', '=', $current_state)
                ->where('status', '=', $status);
            if ($users->isEmpty())
                $profile = null;
            else {
                foreach ($users as $user) {
                    $profile[] = $this->profileRepository->getAll()->where('id', '=', $user['profile_id']);
                }
            }
            return $this->view('pages.applicant-profile-list', $profile);
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
                $current_user = $this->profileLogsRepository->getAll()->where('created_by', '=', Auth::user()->id);
            }else {
                $current_user = '';
            }
            if ($exam['subject_committee_count'] != 0) {
                $current_exam_user = $this->examProcessingDetailsRepository->getAll()->where('created_by', '=', Auth::user()->id);
            }else {
                $current_exam_user = '';
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
                    $data['status'] = 'Reviewing';
                    $data['remarks'] = 'Profile is Accepted by ' . Auth::user()->name;
                    $data['review_status'] = 'Successful';
                    $this->profileLog($data);
                    $this->profileProcessing($id);
                } elseif ($data['profile_status'] === "Rejected") {
                    $data['status'] = 'rejected';
                    $data['review_status'] = 'Rejected';
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
        $data['status'] = "progress";
        $logs = $this->profileLogsRepository->create($data);
        if($logs == false)
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
            if($profile_processing->subject_committee_accepted_num < 4)
                $profileProcessing['subject_committee_accepted_num'] = $profile_processing->subject_committee_accepted_num + 1;
            else
                $profileProcessing['current_state'] = 'exam_committee';
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
            if($exam_processing->subject_committee_count < 4)
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
}

