<?php


namespace officer\Http\Controller;


use App\Modules\Backend\Authentication\User\Repositories\UserRepository;
use App\Modules\Backend\Profile\Profilelogs\Repositories\ProfileLogsRepository;
use App\Modules\Backend\Profile\ProfileProcessing\Repositories\ProfileProcessingRepository;
use Illuminate\Support\Facades\Auth;
use Operator\Http\Controller\BaseController;
use Operator\Modules\Framework\Request;
use Student\Modules\Profile\Repositories\ProfileRepository;
use Student\Modules\Qualification\Repositories\QualificationRepository;

class OfficerController extends BaseController
{
    private  $log,$profileProcessing, $profileRepository, $userRepository, $qualificationRepository,$user_data, $profileLogsRepository,$profileProcessingRepository;
    private $viewData, $profile;

    /**
     * PermissionController constructor.
     * @param ProfileRepository $profileRepository
     * @param UserRepository $userRepository
     * @param QualificationRepository $qualificationRepository
     * @param ProfileLogsRepository $profileLogsRepository
     * @param ProfileProcessingRepository $profileProcessingRepository
     */

    public function __construct(ProfileRepository $profileRepository, UserRepository $userRepository, QualificationRepository $qualificationRepository,
                                ProfileLogsRepository $profileLogsRepository, ProfileProcessingRepository $profileProcessingRepository)
    {
        $this->profileRepository=$profileRepository;
        $this->userRepository=$userRepository;
        $this->qualificationRepository=$qualificationRepository;
        $this->profileLogsRepository = $profileLogsRepository;
        $this->profileProcessingRepository = $profileProcessingRepository;
        parent::__construct();
    }

    public function index()
    {
        $users = $this->profileProcessingRepository->getAll();
        foreach ($users as $user){
            $profile = $this->profileRepository->getAll()->where('id','=',$user['profile_id']);
        }
        return $this->view('pages.application-list',$profile);
    }


}

