<?php

namespace SuperAdmin\Http\Controllers\WebSite;

use App\Http\Controllers\Admin\BaseController;
use App\Models\Address\District;
use App\Models\Address\Municipality;
use App\Models\Address\Provinces;
use App\Modules\Backend\Address\Repositories\MunicipalityRepository;
use App\Modules\Backend\Admin\College\Repositories\CollegeRepository;
use App\Modules\Backend\Authentication\User\Repositories\UserRepository;
use App\Modules\Backend\Exam\Exam\Repositories\ExamRepository;
use App\Modules\Backend\Exam\ExamProcessing\Repositories\ExamProcessingRepository;
use App\Modules\Backend\Exam\ExamProcessingDetails\Repositories\ExamProcessingDetailsRepository;
use App\Modules\Backend\Profile\Profilelogs\Repositories\ProfileLogsRepository;
use App\Modules\Backend\Profile\ProfileProcessing\Repositories\ProfileProcessingRepository;
use App\Modules\Framework\Request;
use Student\Modules\Profile\Repositories\ProfileRepository;
use Student\Modules\Qualification\Repositories\QualificationRepository;

class EditApplicantController  extends BaseController
{

    private $log, $profileProcessing, $profileRepository,
        $userRepository, $qualificationRepository,
        $user_data, $profileLogsRepository, $profileProcessingRepository,
        $municipalityRepository, $collageRepository,
        $examRepository, $examProcessingRepository, $examProcessingDetailsRepository;

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

    public function __construct(ProfileRepository        $profileRepository, UserRepository $userRepository, QualificationRepository $qualificationRepository,
                                ProfileLogsRepository    $profileLogsRepository, ProfileProcessingRepository $profileProcessingRepository,
                                ExamRepository           $examRepository, MunicipalityRepository $municipalityRepository, CollegeRepository $collageRepository,
                                ExamProcessingRepository $examProcessingRepository, ExamProcessingDetailsRepository $examProcessingDetailsRepository)
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
        $this->municipalityRepository = $municipalityRepository;
        $this->collageRepository = $collageRepository;
        $this->examProcessingDetailsRepository = $examProcessingDetailsRepository;
        parent::__construct();
    }

    public function profileEdit($id){
        $province = Provinces::all();
        $district = District::all();
        $municipalities = Municipality::all();
        $data = $this->profileRepository->findById($id);
        return view('superAdmin::admin.applicant.edit-applicant', compact("data", 'province','district','municipalities'));
    }

    public function profileStore(Request  $request, $id){
        $data = $request->all();
        try {
            $profile = $this->profileRepository->update($data,$id);
            if ($profile == false) {
                session()->flash('error', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
            session()->flash('success','Profile has been successfully updated');
            return redirect()->to('superAdmin/dashboard');
        } catch (\Exception $e) {
            session()->flash('error', 'Oops! Something went wrong.');
            return redirect()->back()->withInput();
        }
       }
       public function qualificationEdit($id){

        $data = $this->profileRepository->findById($id);
        $user_id = $data['user_id'];
        $qualifications = $this->qualificationRepository->getAll()->where('user_id', '=',$user_id);
        return view('superAdmin::admin.applicant.edit-qualification', compact("qualifications"));
    }

    public function qualificationStore(Request  $request, $id){
        $data = $request->all();
        try {
            $profile = $this->profileRepository->update($data,$id);
            if ($profile == false) {
                session()->flash('error', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
            session()->flash('success','Profile has been successfully updated');
            return redirect()->to('superAdmin/dashboard');
        } catch (\Exception $e) {
            session()->flash('error', 'Oops! Something went wrong.');
            return redirect()->back()->withInput();
        }
       }
}
