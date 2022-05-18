<?php


namespace Operator\Http\Controller;


use App\Http\Controllers\MailController;
use App\Models\Profile\ProfileProcessing;
use App\Modules\Backend\Authentication\User\Repositories\UserRepository;
use App\Modules\Backend\Exam\Exam\Repositories\ExamRepository;
use App\Modules\Backend\Exam\ExamProcessing\Repositories\ExamProcessingRepository;
use App\Modules\Backend\Exam\ExamProcessingDetails\Repositories\ExamProcessingDetailsRepository;
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
    private $log, $profileProcessing, $profileRepository,
        $userRepository, $qualificationRepository,
        $user_data, $profileLogsRepository, $profileProcessingRepository, $examRepository, $examProcessingRepository, $examProcessingDetailsRepository;

    private $commonView = 'operator::pages.';
    private $commonMessage = 'Profile ';
    private $commonName = 'Profile ';
    private $commonRoute = 'operator.dashboard';
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
     * @param ExamProcessingDetailsRepository $examProcessingDetailsRepository
     */

    public function __construct(ProfileRepository $profileRepository, UserRepository $userRepository, QualificationRepository $qualificationRepository,
                                ProfileLogsRepository $profileLogsRepository, ProfileProcessingRepository $profileProcessingRepository,
                                ExamRepository $examRepository, ExamProcessingRepository $examProcessingRepository, ExamProcessingDetailsRepository $examProcessingDetailsRepository)
    {
        $this->viewData['commonRoute'] = $this->commonRoute;
        $this->viewData['commonView'] = 'operator::' . $this->commonView;
        $this->viewData['commonName'] = $this->commonName;
        $this->viewData['commonMessage'] = $this->commonMessage;
        $this->profileRepository = $profileRepository;
        $this->userRepository = $userRepository;
        $this->qualificationRepository = $qualificationRepository;
        $this->profileLogsRepository = $profileLogsRepository;
        $this->profileProcessingRepository = $profileProcessingRepository;
        $this->examRepository = $examRepository;
        $this->examProcessingRepository = $examProcessingRepository;
        $this->examProcessingDetailsRepository = $examProcessingDetailsRepository;
        parent::__construct();
    }

    public function exam($status, $state)
    {
        if (Auth::user()->mainRole()->name === 'operator') {
            $users = $this->examProcessingRepository->getAll()->where('status', '=', $status)
            ->where('state', '=',$state);
            return $this->view('pages.application-list', $users);
        } else {
            return redirect()->route('login');
        }
    }

    public function profile($status, $state)
    {
        if (Auth::user()->mainRole()->name === 'operator') {
            $users = ProfileProcessing::where('current_state', '=', $state)
                ->where('status', '=', $status)
                ->orderBy('created_at','ASC')
                ->skip(0)
                ->take(20)
                ->get();
            if ($users->isEmpty())
                $profile = null;
            else {
                foreach ($users as $user) {
                    $profile[] = $this->profileRepository->getAll()->where('id', '=', $user['profile_id']);
                }
            }
            return $this->view('pages.applicant-profile-list', $profile);
        } else {
            return redirect()->route('login');
        }
    }

    public function edit($id)
    {
        if (Auth::user()->mainRole()->name === 'operator') {
            $data = $this->profileRepository->findById($id);
            $user_id = $data['user_id'];
            $user_data = $this->userRepository->findById($user_id);
            $qualification = $this->qualificationRepository->getAll()->where('user_id', '=', $data['user_id']);
            $profile_logs = $this->profileLogsRepository->getAll()->where('profile_id', '=', $id);
            $profile_processing = $this->profileProcessingRepository->getAll()->where('profile_id', '=', $id)->first();
            $exams = $this->examProcessingRepository->getAll()->where('profile_id', '=', $id);
            return view('operator::pages.application-list-review', compact('data', 'user_data', 'qualification', 'profile_logs', 'profile_processing', 'exams'));
        } else {
            return redirect()->route('login');
        }
    }

    public function store(Request $request, $id)
    {

    }

    public function status(Request $request)
    {
        if (Auth::user()->mainRole()->name === 'operator') {
            $data = $request->all();
            try {
                $id = $data['profile_id'];
                $data['created_by'] = Auth::user()->id;
                $data['state'] = 'computer_operator';
                $data['profile_state'] = 'officer';
                if ($data['profile_status'] === "Verified" || $data['profile_status'] === "Reviewing") {
                    $data['status'] = 'progress';
                    $data['remarks'] = 'Document Verified and is Forwarded to Officer';
                    $data['review_status'] = 'Successful';
                    $data['profile_state'] = 'officer';
                    $this->profileLog($data);
                    $this->profileProcessing($id,$data);
                } elseif ($data['profile_status'] === "Rejected") {
                    $data['status'] = 'rejected';
                    $data['review_status'] = 'Rejected';
                    $data['profile_state'] = 'student';
                    $this->profileLog($data);
                    $this->profileProcessing($id,$data);
                } elseif ($data['profile_status'] === "Pending") {
                    $data['status'] = 'pending';
                    $data['review_status'] = 'Pending';
                    $this->profileLog($data);
                    $this->profileProcessing($id,$data);
                }
                $profile = $this->profileRepository->update($data, $id);
                if ($profile == false) {
                    session()->flash('danger', 'Oops! Something went wrong.');
                    return redirect()->back()->withInput();
                }

                $users = $this->profileRepository->getAll()->where('profile_status', '=', 'Reviewing')
                    ->where('profile_state','=', 'computer_operator');
                return $this->view('pages.applicant-profile-list', $users);
            } catch (\Exception $e) {
                session()->flash('danger', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
        } else {
            return redirect()->route('login');
        }

    }

    public function profileLog(array $data)
    {
        if (Auth::user()->mainRole()->name === 'operator') {
            $logs = $this->profileLogsRepository->create($data);
            if ($logs == false)
                return false;
            return true;
        } else {
            return redirect()->route('login');
        }

    }

    public function profileProcessing($id,$data)
    {
        if (Auth::user()->mainRole()->name === 'operator') {
            $profileProcessing['profile_id'] = $id;
            $profileEmail = $this->profileRepository->findById($id);
            $email = $this->userRepository->findBy('id','=',$profileEmail['user_id'])->first();
            $profileProcessingId = $this->profileProcessingRepository->getAll()->where('profile_id','=', $id)->first();
            if ($data['profile_status'] === "Verified" || $data['profile_status'] === "Reviewing") {
                $data['status'] = 'progress';
                $data['remarks'] = 'Document Verified and is Forwarded to Officer';
                $data['review_status'] = 'Successful';
                $data['current_state'] = 'officer';
                $profileEmail = $this->profileRepository->findById($id);
                $email = $this->userRepository->findBy('id','=',$profileEmail['user_id'])->first();
                MailController::sendprofileVerification($email["name"], $email['email'], $data['remarks']);
                if ($profileProcessingId){
                    $profileProcessings = $this->profileProcessingRepository->update($data,$profileProcessingId['id']);
                }else
                  $profileProcessings = $this->profileProcessingRepository->create($data);
            } elseif ($data['profile_status'] == "Rejected") {
                $data['status'] = 'rejected';
                $data['review_status'] = 'Rejected';
                $data['current_state'] = 'computer_operator';
                MailController::sendprofileVerification($email["name"], $email['email'], $data['remarks']);
                if ($profileProcessingId){
                    $profileProcessings = $this->profileProcessingRepository->update($data,$profileProcessingId['id']);
                }else
                     $profileProcessings = $this->profileProcessingRepository->create($data);
            } elseif ($data['profile_status'] === "Pending") {
                $data['status'] = 'pending';
                $data['review_status'] = 'Pending';
                $data['current_state'] = 'computer_operator';
                MailController::sendprofileVerification($email["name"], $email['email'], $data['remarks']);
                if ($profileProcessingId){
                    $profileProcessings = $this->profileProcessingRepository->update($data,$profileProcessingId['id']);
                }else
                    $profileProcessings = $this->profileProcessingRepository->create($data);

            }

        } else {
            return redirect()->route('login');
        }
    }


    public function RejectExamProcessing(Request $request)
    {
        if (Auth::user()->mainRole()->name === 'operator') {
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
                session()->flash('success', 'Application have been Rejected');
                return redirect()->back();

            } catch (\Exception $e) {
                session()->flash('danger', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function AcceptExamProcessing($id)
    {
        if (Auth::user()->mainRole()->name === 'operator') {
            $data['status'] = 'progress';
            $data['state'] = 'officer';
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
        } else {
            return redirect()->route('login');
        }

    }

    public function ExamProcessingLog($data, $id, $profile_id)
    {
        if (Auth::user()->mainRole()->name === 'operator') {

            $data['state'] = 'computer_operator';
            $data["created_by"] = Auth::user()->id;
            $data['exam_processing_id'] = $id;
            $data['profile_id'] = $profile_id;
            if ($data['status'] === 'accepted') {
                $data['remarks'] = 'Exam Applied has been accepted';
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

