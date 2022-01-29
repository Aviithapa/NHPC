<?php


namespace Operator\Http\Controller;


use App\Modules\Backend\Authentication\User\Repositories\UserRepository;
use App\Modules\Backend\Exam\Exam\Repositories\ExamRepository;
use App\Modules\Backend\Exam\ExamProcessing\Repositories\ExamProcessingRepository;
use App\Modules\Backend\Profile\Profilelogs\Repositories\ProfileLogsRepository;
use App\Modules\Backend\Profile\ProfileProcessing\Repositories\ProfileProcessingRepository;
use Illuminate\Support\Facades\Auth;
use Operator\Modules\Framework\Request;
use Student\Http\Controller\ProfileController;
use Student\Models\Profile;
use Student\Modules\Profile\Repositories\ProfileRepository;
use Student\Modules\Qualification\Repositories\QualificationRepository;
use Yajra\DataTables\Facades\DataTables;

class OperatorController extends BaseController
{
    private  $log,$profileProcessing, $profileRepository,
        $userRepository, $qualificationRepository,
        $user_data, $profileLogsRepository,$profileProcessingRepository, $examRepository, $examProcessingRepository;
    private $commonView='operator::pages.';
    private $commonMessage='Profile ';
    private $commonName='Profile ';
    private $commonRoute='operator.dashboard';
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
     */

    public function __construct(ProfileRepository $profileRepository, UserRepository $userRepository, QualificationRepository $qualificationRepository,
                           ProfileLogsRepository $profileLogsRepository, ProfileProcessingRepository $profileProcessingRepository,
                            ExamRepository $examRepository, ExamProcessingRepository $examProcessingRepository)
    {
        $this->viewData['commonRoute']=$this->commonRoute;
        $this->viewData['commonView']='operator::'.$this->commonView;
        $this->viewData['commonName']=$this->commonName;
        $this->viewData['commonMessage']=$this->commonMessage;
        $this->profileRepository=$profileRepository;
        $this->userRepository=$userRepository;
        $this->qualificationRepository=$qualificationRepository;
        $this->profileLogsRepository = $profileLogsRepository;
        $this->profileProcessingRepository = $profileProcessingRepository;
        $this->examRepository = $examRepository;
        $this->examProcessingRepository = $examProcessingRepository;
        parent::__construct();
    }

    public function exam($status)
    {
        $users = $this->examProcessingRepository->getAll()->where('status' ,'=',$status);
        return $this->view('pages.application-list',$users);
    }

    public function profile($status)
    {
        $users = $this->profileRepository->getAll()->where('profile_status','=',$status);
        return $this->view('pages.applicant-profile-list',$users);
    }

    public function edit($id)
    {
        $data = $this->profileRepository->findById($id);
        $user_id=$data['user_id'];
        $user_data = $this->userRepository->findById($user_id);
        $qualification = $this->qualificationRepository->getAll()->where('user_id','=',$data['user_id']);
        $profile_logs = $this->profileLogsRepository->getAll()->where('profile_id','=',$id);
        $profile_processing = $this->profileProcessingRepository->getAll()->where('profile_id','=',$id)->first();
        $exams = $this->examProcessingRepository->getAll()->where('profile_id','=',$id);
        return view('operator::pages.application-list-review',compact('data','user_data','qualification','profile_logs','profile_processing','exams'));
    }

    public function store(Request $request, $id)
    {

    }

    public function status(Request $request)
    {
        $data = $request->all();
        try {
            $id=$data['user_id'];
            $data['created_by'] = Auth::user()->id;
            $data['state'] =  'computer_operator';
            if ( $data['profile_status']=== "Verified"){
                $data['status'] =  'accepted';
                $data['remarks'] =  'Profile is forward to Officer';
                $data['review_status'] =  'Successful';
                $this->profileLog($data);
                $this->profileProcessing($id);
            }elseif($data['profile_status']=== "Rejected"){
                $data['status'] =  'rejected';
                $data['review_status'] =  'Rejected';
                $this->profileLog($data);
            }
            $profile = $this->profileRepository->update($data,$id);
            if ($profile == false) {
                session()->flash('danger', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }

            session()->flash('success','User Profile Status Information have been saved successfully');
            return redirect()->route('operator.applicant.profile.list');
//
        } catch (\Exception $e) {
            session()->flash('danger', 'Oops! Something went wrong.');
            return redirect()->back()->withInput();
        }

    }

    public function profileLog( array  $data ){
        $data['profile_id'] = $data['user_id'];
        $logs = $this->profileLogsRepository->create($data);
        if($logs == false)
            return false;
        return true;

    }

    public function profileProcessing( $id ){
        $profileProcessing['profile_id'] = $id;
        $profileProcessing['current_state'] = "officer";
        $profileProcessing['status'] = "pending";
        $profileProcessings = $this->profileProcessingRepository->create($profileProcessing);
        if($profileProcessings == false)
            return false;
        return true;

    }


    public function RejectExamProcessing(Request $request){
        $data= $request->all();
        $id = $data['id'];
        $data['status'] = 'rejected';
        $data['state'] = 'computer_operator';
        try{
            $exam_processing = $this->examProcessingRepository->update($data,$id);
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
        $data['status'] = 'accepted';
        $data['state'] = 'officer';
        try {
            $exam_processing = $this->examProcessingRepository->update($data,$id);
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
}
