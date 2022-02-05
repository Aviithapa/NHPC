<?php


namespace officer\Http\Controller;


use App\Models\Exam\ExamProcessing;
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

    public function profile($status, $current_state)
    {
        if (Auth::user()->mainRole()->name === 'officer') {
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
            if ( $data['profile_status']=== "Verified" || $data['profile_status'] === "Reviewing"){
                $data['status'] = 'progress';
                $data['remarks'] =  'Profile is forward to Registrar';
                $data['review_status'] =  'Successful';
                $this->profileLog($data);
                $this->profileProcessing($id,'progress');
            }elseif($data['profile_status']=== "Rejected"){
                $data['status'] =  'rejected';
                $data['review_status'] =  'Rejected';
                $this->profileLog($data);
                $this->profileProcessing($id, 'rejected');
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

    public function profileProcessing( $id , $status){
        $profileProcessing['profile_id'] = $id;
        if ($status === 'progress') {
            $profileProcessing['current_state'] = "registrar";
            $profileProcessing['status'] = "progress";
        }else{
            $profileProcessing['current_state'] = "officer";
            $profileProcessing['status'] = "rejected";
        }
        $id= $this->profileProcessingRepository->getAll()->where('profile_id' ,'=',$id)->first();
        $profileProcessings = $this->profileProcessingRepository->update($profileProcessing,$id['id']);
        if($profileProcessings == false)
            return false;
        return true;

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

}

