<?php


namespace Operator\Http\Controller;


use App\Modules\Backend\Authentication\User\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Operator\Modules\Framework\Request;
use Student\Http\Controller\ProfileController;
use Student\Models\Profile;
use Student\Modules\Profile\Repositories\ProfileRepository;
use Student\Modules\Qualification\Repositories\QualificationRepository;
use Yajra\DataTables\Facades\DataTables;

class OperatorController extends BaseController
{
    private  $log, $profileRepository, $userRepository, $qualificationRepository,$user_data;
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
     */

    public function __construct(ProfileRepository $profileRepository, UserRepository $userRepository, QualificationRepository $qualificationRepository)
    {
        $this->viewData['commonRoute']=$this->commonRoute;
        $this->viewData['commonView']='operator::'.$this->commonView;
        $this->viewData['commonName']=$this->commonName;
        $this->viewData['commonMessage']=$this->commonMessage;
        $this->profileRepository=$profileRepository;
        $this->userRepository=$userRepository;
        $this->qualificationRepository=$qualificationRepository;
        parent::__construct();
    }

    public function index()
    {
        $users = $this->profileRepository->getAll();
        return $this->view('pages.application-list',$users);
    }

    public function profile()
    {
        $users = $this->profileRepository->getAll()->where('profile_status','=','Reviewing');
        return $this->view('pages.applicant-profile-list',$users);
    }

    public function reject()
    {
        $users = $this->profileRepository->getAll()->where('profile_status','=','Rejected');
        return $this->view('pages.reject-applicant-profile-list',$users);
    }

    public function verified()
    {
        $users = $this->profileRepository->getAll()->where('profile_status','=','Verified');
        return $this->view('pages.verified-applicant-profile-list',$users);
    }
    public function edit($id)
    {
        $data = $this->profileRepository->findById($id);
        $user_data = $this->userRepository->findById($data['user_id']);
        $data['user_data']=$user_data;
        $qualification = $this->qualificationRepository->getAll()->where('user_id','=',$data['user_id']);
        return view('operator::pages.application-list-review',compact('data','user_data','qualification'));
    }

    public function store(Request $request, $id)
    {

    }

    public function status(Request $request)
    {
        $data = $request->all();
        try {
            $id=$data['user_id'];
            $profile = $this->profileRepository->update($data,$id);
            if ($profile == false) {
                session()->flash('danger', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }

//            $data = $this->profileRepository->findById($id);
//            $user_data = $this->userRepository->findById($data['user_id']);
//            $qualification = $this->qualificationRepository->getAll()->where('user_id','=',$data['user_id']);
            session()->flash('success','User Profile Status Information have been saved successfully');
            return redirect()->back();
//
        } catch (\Exception $e) {
            session()->flash('danger', 'Oops! Something went wrong.');
            return redirect()->back()->withInput();
        }

    }
}
