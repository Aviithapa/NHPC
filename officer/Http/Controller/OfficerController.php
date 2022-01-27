<?php


namespace officer\Http\Controller;


use App\Models\Exam\ExamProcessing;
use App\Modules\Backend\Authentication\User\Repositories\UserRepository;
use App\Modules\Backend\Exam\Exam\Repositories\ExamRepository;
use App\Modules\Backend\Exam\ExamProcessing\Repositories\ExamProcessingRepository;
use App\Modules\Backend\Profile\Profilelogs\Repositories\ProfileLogsRepository;
use App\Modules\Backend\Profile\ProfileProcessing\Repositories\ProfileProcessingRepository;
use Illuminate\Support\Facades\Auth;
use Operator\Modules\Framework\Request;
use Student\Modules\Profile\Repositories\ProfileRepository;
use Student\Modules\Qualification\Repositories\QualificationRepository;

class OfficerController extends BaseController
{
    private  $log,$profileProcessing,
         $profileRepository, $userRepository,
        $qualificationRepository,$user_data,
        $profileLogsRepository,$profileProcessingRepository,
        $examRepository,$examProcessingRepository;
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
     */

    public function __construct(ProfileRepository $profileRepository, UserRepository $userRepository, QualificationRepository $qualificationRepository,
                                ProfileLogsRepository $profileLogsRepository, ProfileProcessingRepository $profileProcessingRepository,
                                ExamRepository $examRepository,ExamProcessingRepository $examProcessingRepository)
    {
        $this->profileRepository=$profileRepository;
        $this->userRepository=$userRepository;
        $this->qualificationRepository=$qualificationRepository;
        $this->profileLogsRepository = $profileLogsRepository;
        $this->profileProcessingRepository = $profileProcessingRepository;
        $this->examRepository=$examRepository;
        $this->examProcessingRepository=$examProcessingRepository;
        parent::__construct();
    }

    public function index()
    {
        $users = $this->profileProcessingRepository->getAll()->where('current_state', '=','officer');

        if ($users->isEmpty())
            $profile = null;
        else {
            foreach ($users as $user) {
                $profile[] = $this->profileRepository->getAll()->where('id', '=', $user['profile_id']);
            }
        }
        return $this->view('pages.applicant-profile-list',$profile);
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
        return view('officer::pages.application-list-review',compact('data','user_data','qualification','profile_logs','profile_processing','exams'));
    }

    public function status(Request $request)
    {
        $data = $request->all();
        try {
            $id=$data['user_id'];
            $data['created_by'] = Auth::user()->id;
            $data['state'] =  'officer';

            if ( $data['profile_status']=== "Verified"){
                $data['status'] =  'accepted';
                $data['remarks'] =  'Profile is forward to Registrar';
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
            return redirect()->route('officer.applicant.profile.list');
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
        $profileProcessing['current_state'] = "registrar";
        $profileProcessing['status'] = "pending";
        $id= $this->profileProcessingRepository->getAll()->where('profile_id' ,'=',$id)->first();
        $profileProcessings = $this->profileProcessingRepository->update($profileProcessing,$id['id']);
        if($profileProcessings == false)
            return false;
        return true;

    }


    public function verified()
    {
        $users = $this->profileRepository->getAll()->where('profile_status','=','Verified');
        return $this->view('pages.verified-applicant-profile-list',$users);
    }


    public function ExamApplyView($id){
        $exam_processing = $this->examProcessingRepository->findbyid($id);
        $exam = $this->examRepository->findbyid($exam_processing->exam_id);
        $profile = $this->profileRepository->findById($exam_processing->profile_id);
        $qualification = $this->qualificationRepository->getAll()->where( 'user_id','=', $profile->user_id );
        return response()->json([
            'exam' => $exam,
            'profile' => $profile,
            'qualification' => $qualification,
        ]);
    }
}

