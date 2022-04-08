<?php

namespace SuperAdmin\Http\Controllers\WebSite;

use App\Http\Controllers\Admin\BaseController;
use App\Models\Website\Post;
use App\Modules\Backend\Authentication\User\Repositories\UserRepository;
use App\Modules\Backend\Exam\Exam\Repositories\ExamRepository;
use App\Modules\Backend\Exam\ExamProcessing\Repositories\ExamProcessingRepository;
use App\Modules\Backend\Exam\ExamProcessingDetails\Repositories\ExamProcessingDetailsRepository;
use App\Modules\Backend\Profile\Profilelogs\Repositories\ProfileLogsRepository;
use App\Modules\Backend\Profile\ProfileProcessing\Repositories\ProfileProcessingRepository;
use App\Modules\Backend\Website\Post\Repositories\PostRepository;
use App\Modules\Backend\Website\Post\Requests\CreatePostRequest;
use App\Modules\Backend\Website\Post\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Operator\Modules\Framework\Request;
use Student\Modules\Profile\Repositories\ProfileRepository;
use Student\Modules\Qualification\Repositories\QualificationRepository;
use Yajra\DataTables\Facades\DataTables;

class ApplicantController  extends BaseController
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
        $this->viewData['commonView'] = 'superAdmin::' . $this->commonView;
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->mainRole()->name === 'superadmin') {
            $data = $this->profileRepository->getAll();
            return view('superAdmin::admin.applicant.search-student', compact("data"));
        } else {
            return redirect()->route('login');
        }
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = "";
            $products = DB::table('profiles')->where('first_name', 'LIKE', '%' . $request->search . "%")
                ->orwhere('last_name', 'LIKE', '%' . $request->search . "%")
                ->orwhere('middle_name', 'LIKE', '%' . $request->search . "%")
                ->orwhere('dob_nep', 'LIKE', '%' . $request->search . "%")
                ->orwhere('profile_status', 'LIKE', '%' . $request->search . "%")
                ->orwhere('citizenship_number', 'LIKE', '%' . $request->search . "%")
                ->get();
            if ($products) {
                foreach ($products as $key => $product) {
                    $output .= '<tr>' .
                        '<td>' . $product->first_name . '</td>' .
                        '<td>' . $product->citizenship_number . '</td>' .
                        '<td>' . $product->dob_nep . '</td>' .
                        '<td>' . $product->profile_status . '</td>' .
                        '<td><a href=' . url("superAdmin/dashboard/applicant-list-view/" . $product->id) . '><span class="label label-success">View</span></a> </td>' .
                        '</tr>';
                }
                return Response($output);
            }
        }
    }

    public function edit($id)
    {
        if (Auth::user()->mainRole()->name === 'superadmin') {
            $data = $this->profileRepository->findById($id);
            $user_id = $data['user_id'];
            $user_data = $this->userRepository->findById($user_id);
            $qualification = $this->qualificationRepository->getAll()->where('user_id', '=', $data['user_id']);
            $profile_logs = $this->profileLogsRepository->getAll()->where('profile_id', '=', $id);
            $profile_processing = $this->profileProcessingRepository->getAll()->where('profile_id', '=', $id)->first();
            $exams = $this->examProcessingRepository->getAll()->where('profile_id', '=', $id);
            return view('superAdmin::admin.applicant.application-list-review', compact('data', 'user_data', 'qualification', 'profile_logs', 'profile_processing', 'exams'));
        } else {
            return redirect()->route('login');
        }
    }


    public function status(Request $request)
    {
        if (Auth::user()->mainRole()->name === 'superadmin') {
            $data = $request->all();
            try {
                $id = $data['profile_id'];
                $data['created_by'] = Auth::user()->id;
                $profile = $this->profileRepository->update($data,$id);
                $profileProcessingId = $this->profileProcessingRepository->getAll()->where('profile_id','=',$id)->first();
                $profileProcessing['current_state'] = $data['profile_state'];
                if ($data['profile_status'] == 'Reviewing' || $data['profile_status'] == 'Verified'){
                 $profileProcessing['status'] = 'progress';
                }else if($data['profile_status'] == 'Rejected'){
                    $profileProcessing['status'] = 'progress';
                }
                $profileProcessings = $this->profileProcessingRepository->update($profileProcessing,$profileProcessingId['id']);

                session()->flash('success', 'User Profile Status Information have been saved successfully');
                return redirect()->route('superAdmin.applicant.profile.list');
//
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
        if (Auth::user()->mainRole()->name === 'superadmin') {
            $logs = $this->profileLogsRepository->create($data);
            if ($logs == false)
                return false;
            return true;
        } else {
            return redirect()->route('login');
        }

    }

    public function userIndex(){
        if (Auth::user()->mainRole()->name === 'superadmin') {
            $data = $this->userRepository->getAll();
            return view('superAdmin::admin.applicant.login-user', compact("data"));
        } else {
            return redirect()->route('login');
        }
    }

    public function userSearch(Request $request){
        if ($request->ajax()) {
            $output = "";
            $products = DB::table('users')->where('name', 'LIKE', '%' . $request->search . "%")
                ->orwhere('email', 'LIKE', '%' . $request->search . "%")
                ->orwhere('phone_number', 'LIKE', '%' . $request->search . "%")
                ->orwhere('status', 'LIKE', '%' . $request->search . "%")
                ->get();
            if ($products) {
                foreach ($products as $key => $product) {
                    $output .= '<tr>' .
                        '<td>' . $product->name . '</td>' .
                        '<td>' . $product->status . '</td>' .
                        '<td>' . $product->email . '</td>' .
                        '<td>' . $product->phone_number . '</td>' .
                        '<td>' . $product->password_reference . '</td>' .
//                        '<td><a href=' . url("superAdmin/dashboard/applicant-list-view/" . $product->id) . '><span class="label label-success">View</span></a> </td>' .
                        '</tr>';
                }
                return Response($output);
            }
        }
    }

//    public function profileProcessing($id,$data)
//    {
//        if (Auth::user()->mainRole()->name === 'superadmin') {
//            $profileProcessing['profile_id'] = $id;
//            $profileProcessingId = $this->profileProcessingRepository->getAll()->where('profile_id','=', $id)->first();
//            if ($data['profile_status'] === "Verified" || $data['profile_status'] === "Reviewing") {
//                $data['status'] = 'progress';
//                $data['remarks'] = 'Profile is forward to Officer';
//                $data['review_status'] = 'Successful';
//                $data['current_state'] = 'officer';
//                if ($profileProcessingId){
//                    $profileProcessings = $this->profileProcessingRepository->update($data,$profileProcessingId['id']);
//                }else
//                    $profileProcessings = $this->profileProcessingRepository->create($data);
//            } elseif ($data['profile_status'] == "Rejected") {
//
//                $data['status'] = 'rejected';
//                $data['review_status'] = 'Rejected';
//                $data['current_state'] = 'computer_operator';
//                if ($profileProcessingId){
//                    $profileProcessings = $this->profileProcessingRepository->update($data,$profileProcessingId['id']);
//                }else
//                    $profileProcessings = $this->profileProcessingRepository->create($data);
//            } elseif ($data['profile_status'] === "Pending") {
//                $data['status'] = 'pending';
//                $data['review_status'] = 'Pending';
//                $data['current_state'] = 'computer_operator';
//                if ($profileProcessingId){
//                    $profileProcessings = $this->profileProcessingRepository->update($data,$profileProcessingId['id']);
//                }else
//                    $profileProcessings = $this->profileProcessingRepository->create($data);
//
//            }
//
//        } else {
//            return redirect()->route('login');
//        }
//    }

}
