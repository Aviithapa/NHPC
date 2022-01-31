<?php


namespace ExamCommittee\Http\Controller;


use App\Modules\Backend\AdmitCard\Repositories\AdmitCardRepository;
use App\Modules\Backend\Authentication\User\Repositories\UserRepository;
use App\Modules\Backend\Exam\Exam\Repositories\ExamRepository;
use App\Modules\Backend\Exam\ExamProcessing\Repositories\ExamProcessingRepository;
use App\Modules\Backend\Profile\Profilelogs\Repositories\ProfileLogsRepository;
use App\Modules\Backend\Profile\ProfileProcessing\Repositories\ProfileProcessingRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Operator\Modules\Framework\Request;
use Student\Modules\Profile\Repositories\ProfileRepository;
use Student\Modules\Qualification\Repositories\QualificationRepository;

class ExamCommitteeController extends BaseController
{
    private  $log,$profileProcessing,
        $profileRepository, $userRepository,
        $qualificationRepository,$user_data,
        $profileLogsRepository,$profileProcessingRepository,
        $examRepository,$examProcessingRepository,$admitCardRepository;
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
     * @param AdmitCardRepository $admitCardRepository
     */

    public function __construct(ProfileRepository $profileRepository, UserRepository $userRepository, QualificationRepository $qualificationRepository,
                                ProfileLogsRepository $profileLogsRepository, ProfileProcessingRepository $profileProcessingRepository,
                                ExamRepository $examRepository,ExamProcessingRepository $examProcessingRepository,
AdmitCardRepository $admitCardRepository)
    {
        $this->profileRepository=$profileRepository;
        $this->userRepository=$userRepository;
        $this->qualificationRepository=$qualificationRepository;
        $this->profileLogsRepository = $profileLogsRepository;
        $this->profileProcessingRepository = $profileProcessingRepository;
        $this->examRepository=$examRepository;
        $this->examProcessingRepository=$examProcessingRepository;
        $this->admitCardRepository=$admitCardRepository;
        parent::__construct();
    }

    public function generateAdmitCard($status,$current_state){
        $users = $this->examProcessingRepository->getAll()->where('status' ,'=',$status)
            ->where('state','=',$current_state)
            ->where('is_admit_card_generate', '!=' ,'yes');
        if ($users->isEmpty()){
            session()->flash('success','Admit Card Already Been Generated');
            return redirect()->back()->withInput();
        }else {
            $i = 1;
            foreach ($users as $user) {
                $index = $i++;
                $data['profile_id'] = $user['profile_id'];
                $data['exam_processing_id'] = $user['id'];
                $data['symbol_number'] = $this->generateSymbolNumber($index);
                $data['created_by'] = Auth::user()->id;
                $this->admitCardRepository->create($data);
                $exam_data['is_admit_card_generate'] = 'yes';
                $this->examProcessingRepository->update($exam_data, $user['id']);
            }
            session()->flash('success', 'Admit Card Successfully Generated');
            return redirect()->back()->withInput();
        }
    }

    public function generateSymbolNumber($index){
        $now = Carbon::now();
        $year = $now->year;
        $year = substr( $year, -2);
        $month = $now->format('m');
        $num =$year.$month.str_pad($index, 3, "0", STR_PAD_LEFT);
        return $num;
    }

    public function admit($status, $current_state)
    {
        $users = $this->examProcessingRepository->getAll()->where('status' ,'=',$status)
            ->where('state','=',$current_state);

        return $this->view('pages.application-list',$users);
    }

    public function viewAdmitCardDetails($id){
      $admitcard = $this->admitCardRepository->getAll()->where('exam_processing_id','=',$id)->first();
      $profileDetails = $this->profileRepository->findById($admitcard['profile_id']);
      $exam= $this->examProcessingRepository->findById($admitcard['exam_processing_id']);

      return \view('examCommittee::pages.view-admit-card',compact('admitcard','profileDetails','exam'));
    }

//    public function edit($id)
//    {
//        $data = $this->profileRepository->findById($id);
//        $user_id=$data['user_id'];
//        $user_data = $this->userRepository->findById($user_id);
//        $qualification = $this->qualificationRepository->getAll()->where('user_id','=',$data['user_id']);
//        $profile_logs = $this->profileLogsRepository->getAll()->where('profile_id','=',$id);
//        $profile_processing = $this->profileProcessingRepository->getAll()->where('profile_id','=',$id)->first();
//        $exams = $this->examProcessingRepository->getAll()->where('profile_id','=',$id);
//        return view('subjectCommittee::pages.application-list-review',compact('data','user_data','qualification','profile_logs','profile_processing','exams'));
//    }
//
//    public function status(Request $request)
//    {
//        $data = $request->all();
//        try {
//            $id=$data['user_id'];
//            $data['created_by'] = Auth::user()->id;
//            $data['state'] =  'subject_committee';
//            if ( $data['profile_status']=== "Verified"){
//                $data['status'] =  'accepted';
//                $data['remarks'] =  'Profile is Accepted';
//                $data['review_status'] =  'Successful';
//                $this->profileLog($data);
//                $this->profileProcessing($id);
//            }elseif($data['profile_status']=== "Rejected"){
//                $data['status'] =  'rejected';
//                $data['review_status'] =  'Rejected';
//                $this->profileLog($data);
//            }
//            $profile = $this->profileRepository->update($data,$id);
//            if ($profile == false) {
//                session()->flash('danger', 'Oops! Something went wrong.');
//                return redirect()->back()->withInput();
//            }
//            session()->flash('success','User Profile Status Information have been saved successfully');
//            return redirect()->route('subjectCommittee.applicant.profile.list');
////
//        } catch (\Exception $e) {
//            session()->flash('danger', 'Oops! Something went wrong.');
//            return redirect()->back()->withInput();
//        }
//
//    }
//
//    public function profileLog( array  $data ){
//        $data['profile_id'] = $data['user_id'];
//        $logs = $this->profileLogsRepository->create($data);
//        if($logs == false)
//            return false;
//        return true;
//
//    }
//
//    public function profileProcessing( $id ){
//        $profileProcessing['profile_id'] = $id;
//        $profileProcessing['current_state'] = "subject_committee";
//        $profileProcessing['status'] = "progress";
//        $id= $this->profileProcessingRepository->getAll()->where('profile_id' ,'=',$id)->first();
//        $profileProcessings = $this->profileProcessingRepository->update($profileProcessing,$id['id']);
//        if($profileProcessings == false)
//            return false;
//        return true;
//
//    }
//
//
//    public function RejectExamProcessing(Request $request){
//        $data= $request->all();
//        $id = $data['id'];
//        $data['status'] = 'rejected';
//        $data['state'] = 'officer';
//        try{
//            $exam_processing = $this->examProcessingRepository->update($data,$id);
//            if ($exam_processing == false) {
//                session()->flash('danger', 'Oops! Something went wrong.');
//                return redirect()->back()->withInput();
//            }
//            session()->flash('success','Application have been Rejected');
//            return redirect()->back();
//
//        } catch (\Exception $e) {
//            session()->flash('danger', 'Oops! Something went wrong.');
//            return redirect()->back()->withInput();
//        }
//    }
//
//    public function AcceptExamProcessing($id){
//        $data['status'] = 'accepted';
//        $data['state'] = 'subject_committee';
//        try {
//            $exam_processing = $this->examProcessingRepository->update($data,$id);
//            if ($exam_processing == false) {
//                session()->flash('danger', 'Oops! Something went wrong.');
//                return redirect()->back()->withInput();
//            }
//            session()->flash('success','Application Move to forward for Verification');
//            return redirect()->back()->refresh()->withInput();
//
//        } catch (\Exception $e) {
//            session()->flash('danger', 'Oops! Something went wrong.');
//            return redirect()->back()->withInput();
//        }
//
//    }
}

