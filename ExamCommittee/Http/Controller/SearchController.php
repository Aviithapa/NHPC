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
            $products= AdmitCard::join('profiles','profiles.id','=','admit_card.profile_id')
                ->join('exam_registration','exam_registration.id','=','admit_card.exam_processing_id')
                ->join('program','program.id','=','exam_registration.program_id')
                ->where('admit_card.symbol_number', 'LIKE', '%' . $request->search . "%")
                ->get();

            if ($products) {
                foreach ($products as   $admit_card) {

                    $output .= '<tr>' .
                        '<td>' . $admit_card->first_name . ' '. $admit_card->middle_name . ' '.$admit_card->last_name. '</td>' .
                        '<td>' . $admit_card->citizenship_number . '</td>' .
                        '<td>' . $admit_card->dob_nep . '</td>' .
                        '<td>' . $admit_card->symbol_number . '</td>' .
                        '<td><a href='.route("examCommittee.view.admit.card",['id' =>$admit_card->id]).'><span class="label label-success">View</span></a> </td>' .
                        '</tr>';
                }
                return Response($output);
            }
        }
    }


}
