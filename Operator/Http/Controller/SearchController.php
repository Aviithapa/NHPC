<?php


namespace Operator\Http\Controller;


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
        $user_data, $profileLogsRepository,$collageRepository, $profileProcessingRepository, $examRepository, $examProcessingRepository, $examProcessingDetailsRepository;

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

    public function __construct(ProfileRepository $profileRepository, UserRepository $userRepository, QualificationRepository $qualificationRepository,
                                ProfileLogsRepository $profileLogsRepository, ProfileProcessingRepository $profileProcessingRepository,
                                ExamRepository $examRepository, ExamProcessingRepository $examProcessingRepository, ExamProcessingDetailsRepository $examProcessingDetailsRepository, CollegeRepository $collageRepository)
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
        if($request->ajax()) {
            $output = "";
            $products = Profile::join('exam_registration','exam_registration.profile_id','=','profiles.id')->where('first_name', 'LIKE', '%' . $request->search . "%")
                ->orwhere('profiles.last_name', 'LIKE', '%' . $request->search . "%")
                ->orwhere('profiles.middle_name', 'LIKE', '%' . $request->search . "%")
                ->orwhere('profiles.dob_nep', 'LIKE', '%' . $request->search . "%")
                ->orwhere('profiles.profile_status', 'LIKE', '%' . $request->search . "%")
                ->orwhere('profiles.citizenship_number', 'LIKE', '%' . $request->search . "%")
                ->get(['profiles.*', 'profiles.id as profiles_id', 'exam_registration.*']);

                // return $products;
            if ($products) {
                foreach ($products as $key => $product) {
                    $output .= '<tr>' .
                        '<td>' . $product->first_name . '</td>' .
                        '<td>' . $product->citizenship_number . '</td>' .
                        '<td>' . $product->dob_nep . '</td>' .
                        '<td>' . $product->state . '</td>' .
                        '<td><a href='.url("operator/dashboard/operator/applicant-list-view/".$product->profiles_id).'><span class="label label-success">View</span></a> </td>' .
                        '<td><a href='.url("operator/dashboard/deleteDuplicate/".$product->profiles_id).'><span class="label label-danger">Delete</span></a> </td>' .
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
            return view('operator::pages.search-collage', compact( 'data', "collage"));
        } else {
            return redirect()->route('login');
        }
    }




    public function collageSearch(Request $request)
    {
        $qualifications = DB::table('registrant_qualification')->where('collage_name','LIKE', '%' . $request->search . "%")->get();

        if ($qualifications->isEmpty()){
            $data = null;
        }else {
            foreach ($qualifications as $qualification) {
                  $data[] = $this->profileRepository->getAll()->where('user_id', '=', $qualification->user_id);
            }
        }
//        foreach ($data as $datas)
//            foreach ($datas as $profile)
//                dd($profile->id);

                $collage = $this->collageRepository->getAll();
        return view('operator::pages.search-collage', compact( 'data', "collage"));
    }


}

