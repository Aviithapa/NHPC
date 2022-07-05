<?php


namespace ExamCommittee\Http\Controller;


use App\Models\AdmitCard\AdmitCard;
use App\Modules\Backend\Authentication\User\Repositories\UserRepository;
use App\Modules\Backend\Exam\Exam\Repositories\ExamRepository;
use App\Modules\Backend\Exam\ExamProcessing\Repositories\ExamProcessingRepository;
use App\Modules\Backend\Exam\ExamProcessingDetails\Repositories\ExamProcessingDetailsRepository;
use App\Modules\Backend\Profile\Profilelogs\Repositories\ProfileLogsRepository;
use App\Modules\Backend\Profile\ProfileProcessing\Repositories\ProfileProcessingRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Operator\Modules\Framework\Request;
use Student\Modules\Profile\Repositories\ProfileRepository;
use Student\Modules\Qualification\Repositories\QualificationRepository;

class SearchController extends BaseController
{
    private $log, $profileProcessing, $profileRepository,
        $userRepository, $qualificationRepository,
        $user_data, $profileLogsRepository, $profileProcessingRepository, $examRepository, $examProcessingRepository, $examProcessingDetailsRepository;


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

    public function index()
    {
        if (Auth::user()->mainRole()->name === 'exam_committee') {
            $data = null;
            return $this->view('pages.search-student', $data);
        } else {
            return redirect()->route('login');
        }
    }




    public function search(Request $request)
    {
        if($request->ajax()) {
            $output = "";
            $profile = "";
            $products = AdmitCard::all()->where('symbol_number', 'LIKE', '%' . $request->search . "%")->get();

            foreach ($products as $pro){
                $profile = $this->profileRepository->getAll()->where('id','=', $pro['profile_id']);
            }
//            $products = DB::table('profiles')->where('first_name', 'LIKE', '%' . $request->search . "%")
//                ->orwhere('last_name', 'LIKE', '%' . $request->search . "%")
//                ->orwhere('middle_name', 'LIKE', '%' . $request->search . "%")
//                ->orwhere('dob_nep', 'LIKE', '%' . $request->search . "%")
//                ->orwhere('profile_status', 'LIKE', '%' . $request->search . "%")
//                ->orwhere('citizenship_number', 'LIKE', '%' . $request->search . "%")
//                ->get();
            if ($products) {
                foreach ($products as $key => $admit_card) {
                    $output .= '<tr>' .
                        '<td>' . $admit_card->getFirstName() . '</td>' .
                        '<td>' . $admit_card->getCitizenshipNumber() . '</td>' .
//                        '<td>' . $admit_card->getProfile()->dob_nep . '</td>' .
                        '<td>' . $admit_card->symbol_number . '</td>' .
                        '<td><a href='.url("officer/dashboard/officer/applicant-list-view/".$admit_card->id).'><span class="label label-success">View</span></a> </td>' .
                        '</tr>';
                }
                return Response($output);
            }
        }
    }


}
