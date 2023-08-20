<?php


namespace Operator\Http\Controller;

use App\Models\Admin\Program;
use App\Models\Certificate\Certificate;
use App\Models\Certificate\CertificateHistory;
use App\Models\Exam\ExamProcessing;
use App\Modules\Backend\Admin\College\Repositories\CollegeRepository;
use App\Modules\Backend\Authentication\User\Repositories\UserRepository;
use App\Modules\Backend\Exam\Exam\Repositories\ExamRepository;
use App\Modules\Backend\Exam\ExamProcessing\Repositories\ExamProcessingRepository;
use App\Modules\Backend\Exam\ExamProcessingDetails\Repositories\ExamProcessingDetailsRepository;
use App\Modules\Backend\Profile\Profilelogs\Repositories\ProfileLogsRepository;
use App\Modules\Backend\Profile\ProfileProcessing\Repositories\ProfileProcessingRepository;
use http\Env\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Operator\Modules\Framework\Request;
use Student\Models\Profile;
use Student\Modules\Profile\Repositories\ProfileRepository;
use Student\Modules\Qualification\Repositories\QualificationRepository;

class SearchController extends BaseController
{
    private $log, $profileProcessing, $profileRepository,
        $userRepository, $qualificationRepository,
        $user_data, $profileLogsRepository, $collageRepository, $profileProcessingRepository, $examRepository, $examProcessingRepository, $examProcessingDetailsRepository;

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
     * @param CollegeRepository $collageRepository
     */

    public function __construct(
        ProfileRepository $profileRepository,
        UserRepository $userRepository,
        QualificationRepository $qualificationRepository,
        ProfileLogsRepository $profileLogsRepository,
        ProfileProcessingRepository $profileProcessingRepository,
        ExamRepository $examRepository,
        ExamProcessingRepository $examProcessingRepository,
        ExamProcessingDetailsRepository $examProcessingDetailsRepository,
        CollegeRepository $collageRepository
    ) {
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
        $this->collageRepository = $collageRepository;
        parent::__construct();
    }

    public function index()
    {
        if (Auth::user()->mainRole()->name === 'operator') {
            $data = null;
            return $this->view('pages.search-student', $data);
        } else {
            return redirect()->route('login');
        }
    }




    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = "";
            $products = DB::table('profiles')->join('users', 'users.id', '=', 'profiles.user_id')
                ->select(
                    'profiles.first_name as first_name',
                    'profiles.last_name as last_name',
                    'profiles.middle_name as middle_name',
                    'profiles.dob_nep as dob_nep',
                    'profiles.profile_status as profile_status',
                    'profiles.citizenship_number as citizenship_number',
                    'users.email as email',
                    'profiles.id as profile_id'
                )
                ->where('first_name', 'LIKE', '%' . $request->search . "%")
                ->orwhere('last_name', 'LIKE', '%' . $request->search . "%")
                // ->orwhere('middle_name', 'LIKE', '%' . $request->search . "%")
                ->orwhere('dob_nep', 'LIKE', '%' . $request->search . "%")
                ->orwhere('profile_status', 'LIKE', '%' . $request->search . "%")
                ->orwhere('citizenship_number', 'LIKE', '%' . $request->search . "%")
                ->orWhere('email', 'LIKE', '%' . $request->search . "%")
                ->paginate(15);
            // return $products;
            if ($products) {
                foreach ($products as $key => $product) {
                    $output .= '<tr>' .
                        '<td>' . $product->first_name  . $product->middle_name .  $product->last_name . '</td>' .
                        '<td>' . $product->citizenship_number . '</td>' .
                        '<td>' . $product->dob_nep . '</td>' .
                        '<td>' . $product->profile_status . '</td>' .
                        '<td>' . $product->email . '</td>' .
                        '<td><a href=' . url("operator/dashboard/operator/applicant-list-view/" . $product->profile_id) . '><span class="label label-success">View</span></a> </td>' .
                        '<td><a href=' . url("operator/dashboard/deleteDuplicate/" . $product->profile_id) . '><span class="label label-danger">Delete</span></a> </td>' .
                        '</tr>';
                }
                return Response($output);
            }
        }
    }

    public function collageIndex()
    {
        if (Auth::user()->mainRole()->name === 'operator') {
            $data = null;
            $collage = $this->collageRepository->getAll();
            return view('operator::pages.search-collage', compact('data', "collage"));
        } else {
            return redirect()->route('login');
        }
    }




    public function collageSearch(Request $request)
    {
        $qualifications = DB::table('registrant_qualification')->where('collage_name', 'LIKE', '%' . $request->search . "%")->get();

        if ($qualifications->isEmpty()) {
            $data = null;
        } else {
            foreach ($qualifications as $qualification) {
                $data[] = $this->profileRepository->getAll()->where('user_id', '=', $qualification->user_id);
            }
        }
        $collage = $this->collageRepository->getAll();
        return view('operator::pages.search-collage', compact('data', "collage"));
    }

    public function searchStudent(Request $request)
    {
        $program = Program::get();
        if ($request->isMethod('post')) {

            $query = Profile::query()->join('exam_registration', 'exam_registration.profile_id', '=', 'profiles.id')
                ->join('users', 'users.id', '=', 'profiles.user_id');
            if ($request->state != null) {
                $query->where('exam_registration.state', 'like', $request->state)->where('exam_registration.exam_id', '!=', 3)->where('exam_registration.is_admit_card_generate', '=', 'no');
            }
            if ($request->status != null) {
                $query->where('exam_registration.status', 'like', $request->status);
            }
            if ($request->level != null) {
                $query->where('exam_registration.level_id', 'like', $request->level);
                $program = Program::get()->where('level_id', '=',  $request->level);
            }
            if ($request->program != null) {
                $query->where('exam_registration.program_id', 'like', $request->program);
            }
            if ($request->darta_number != null) {
                $query->where('exam_registration.profile_id', 'like', $request->darta_number);
            }

            if ($request->first_name != null) {
                $query->where('profiles.first_name', 'like', '%' . $request->first_name  . '%');
            }

            if ($request->middle_name != null) {
                $query->where('profiles.middle_name', 'like', '%' . $request->middle_name  . '%');
            }

            if ($request->last_name != null) {
                $query->where('profiles.last_name', 'like', '%' . $request->last_name  . '%');
            }

            if ($request->citizenship_number != null) {
                $query->where('profiles.citizenship_number', 'like', '%' . $request->last_name  . '%');
            }
            if ($request->regratation_date != null) {
                $query->where('exam_registration.created_at', 'like', '%' . $request->regratation_date  . '%');
            }

            if ($request->profile_processing_state != null) {
                $query->where('profiles.profile_status', '=', $request->profile_processing_state);
            }
            if ($request->profile_processing_status != null) {
                $query->where('profiles.profile_state', '=', $request->profile_processing_status);
            }
            if ($request->email != null) {
                $query->where('users.email', 'like', '%' . $request->email . '%');
            }

            $data = $query->distinct('profile_id')->get();

            return view('operator::pages.search-students', compact('data', 'program', 'request'));
        } else {
            return view('operator::pages.search-students', compact('program'));
        }
    }

    public function studentUpdateExamApplyId()
    {
        $datas = ExamProcessing::where('exam_registration.created_at', '>=', '2022-12-23')
            ->where('exam_registration.exam_id', '!=', 3)
            ->where('exam_registration.level_id', '!=', 4)
            ->get();

        foreach ($datas as $data) {
            $exam['exam_id'] = 3;
            $exam_processing = $this->examProcessingRepository->update($exam, $data->id);
        }
        return redirect()->back();
    }


    public function searchCertificateStudent(Request $request)
    {
        $program = Program::get();
        if ($request->isMethod('post')) {

            $query = Certificate::query();

            if ($request->program != null) {
                $query->where('program_id', 'like', $request->program);
            }

            if ($request->name != null) {
                $query->where('name', 'like', '%' . $request->name  . '%');
            }

            if ($request->level_name != null) {
                $query->where('level_name', 'like', '%' . $request->level_name  . '%');
            }

            if ($request->date != null) {
                $query->where('decision_date', 'like', $request->date);
            }

            if ($request->is_printed != null) {
                $query->where('is_printed', 'like', $request->is_printed);
            }

            $data = $query->get();

            return view('operator::pages.search-certificate', compact('data', 'program', 'request'));
        } else {
            return view('operator::pages.search-certificate', compact('program'));
        }
    }
}
