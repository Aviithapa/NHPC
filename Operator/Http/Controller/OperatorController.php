<?php


namespace Operator\Http\Controller;


use App\Modules\Backend\Authentication\User\Repositories\UserRepository;
use Operator\Modules\Framework\Request;
use Student\Http\Controller\ProfileController;
use Student\Modules\Profile\Repositories\ProfileRepository;
use Student\Modules\Qualification\Repositories\QualificationRepository;
use Yajra\DataTables\Facades\DataTables;

class OperatorController extends BaseController
{
    private  $log, $profileRepository, $userRepository, $qualificationRepository;
    private $commonView='operator::pages.';
    private $commonMessage='Profile ';
    private $commonName='Profile ';
    private $commonRoute='operator.dashboard';
    private $viewData;

    /**
     * PermissionController constructor.
     * @param ProfileRepository $profileRepository
     * @param UserRepository $userRepository
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

    public function edit($id)
    {
        $data = $this->profileRepository->findById($id);
        $user_data = $this->userRepository->findById($data['user_id']);
        $qualification = $this->qualificationRepository->getAll()->where('user_id','=',$data['user_id']);
        return view('operator::pages.application-list-review',compact('data','user_data','qualification'));
    }

    public function store(Request $request, $id)
    {

    }

}
