<?php


namespace Council\Http\Controller;


use App\Exports\ResultExport;
use App\Imports\ResultImport;
use App\Modules\Backend\AdmitCard\Repositories\AdmitCardRepository;
use App\Modules\Backend\Authentication\User\Repositories\UserRepository;
use App\Modules\Backend\Exam\Exam\Repositories\ExamRepository;
use App\Modules\Backend\Exam\ExamProcessing\Repositories\ExamProcessingRepository;
use App\Modules\Backend\Profile\Profilelogs\Repositories\ProfileLogsRepository;
use App\Modules\Backend\Profile\ProfileProcessing\Repositories\ProfileProcessingRepository;
use App\Modules\Backend\Result\Repositories\ExamResultRepository;
use Carbon\Carbon;
use ExamCommittee\Http\Controller\BaseController;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Operator\Modules\Framework\Request;
use Student\Modules\Profile\Repositories\ProfileRepository;
use Student\Modules\Qualification\Repositories\QualificationRepository;

class CouncilController extends BaseController
{
    private  $log,$profileProcessing,
        $profileRepository, $userRepository,
        $qualificationRepository,$user_data,
        $profileLogsRepository,$profileProcessingRepository,
        $examRepository,$examProcessingRepository,$admitCardRepository,$examResultRepository;
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
     * @param ExamResultRepository $examResultRepository
     */

    public function __construct(ProfileRepository $profileRepository, UserRepository $userRepository, QualificationRepository $qualificationRepository,
                                ProfileLogsRepository $profileLogsRepository, ProfileProcessingRepository $profileProcessingRepository,
                                ExamRepository $examRepository,ExamProcessingRepository $examProcessingRepository,
                                AdmitCardRepository $admitCardRepository, ExamResultRepository $examResultRepository)
    {
        $this->profileRepository=$profileRepository;
        $this->userRepository=$userRepository;
        $this->qualificationRepository=$qualificationRepository;
        $this->profileLogsRepository = $profileLogsRepository;
        $this->profileProcessingRepository = $profileProcessingRepository;
        $this->examRepository=$examRepository;
        $this->examProcessingRepository=$examProcessingRepository;
        $this->admitCardRepository=$admitCardRepository;
        $this->examResultRepository=$examResultRepository;
        parent::__construct();
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






}

