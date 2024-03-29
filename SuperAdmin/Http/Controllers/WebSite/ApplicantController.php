<?php

namespace SuperAdmin\Http\Controllers\WebSite;

use App\Http\Controllers\Admin\BaseController;
use App\Models\Address\Municipality;
use App\Models\Admin\Program;
use App\Models\Admin\University;
use App\Models\Certificate\Certificate;
use App\Models\Certificate\CertificateHistory;
use App\Models\Exam\ExamProcessing;
use App\Models\Website\Post;
use App\Modules\Backend\Address\Repositories\MunicipalityRepository;
use App\Modules\Backend\Admin\College\Repositories\CollegeRepository;
use App\Modules\Backend\Admin\Program\Repositories\ProgramRepository;
use App\Modules\Backend\Authentication\Role\Repositories\RoleRepository;
use App\Modules\Backend\Authentication\User\Repositories\UserRepository;
use App\Modules\Backend\Certificate\Repositories\CertificateRepository;
use App\Modules\Backend\Exam\Exam\Repositories\ExamRepository;
use App\Modules\Backend\Exam\ExamProcessing\Repositories\ExamProcessingRepository;
use App\Modules\Backend\Exam\ExamProcessingDetails\Repositories\ExamProcessingDetailsRepository;
use App\Modules\Backend\Profile\Profilelogs\Repositories\ProfileLogsRepository;
use App\Modules\Backend\Profile\ProfileProcessing\Repositories\ProfileProcessingRepository;
use App\Modules\Backend\SubjectCommittee\SubjectCommitteRole\SubjectCommitteeUserRepository;
use App\Modules\Backend\Website\Post\Repositories\PostRepository;
use App\Modules\Backend\Website\Post\Requests\CreatePostRequest;
use App\Modules\Backend\Website\Post\Requests\UpdatePostRequest;
use Carbon\Carbon;
use Database\Seeders\District;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Mockery\Expectation;
use Operator\Modules\Framework\Request;
use PhpParser\Node\Stmt\TryCatch;
use Student\Models\Profile;
use Student\Modules\Profile\Repositories\ProfileRepository;
use Student\Modules\Qualification\Repositories\QualificationRepository;
use Yajra\DataTables\Facades\DataTables;
use function GuzzleHttp\Promise\all;

class ApplicantController  extends BaseController
{

    private $log, $profileProcessing, $profileRepository,
        $userRepository, $qualificationRepository,
        $user_data, $profileLogsRepository, $profileProcessingRepository,
        $municipalityRepository, $collageRepository,
        $examRepository, $examProcessingRepository, $roleRepository, $certificateRepository, $examProcessingDetailsRepository, $programRepository, $subjectCommitteeUserRepository;

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
     * @param MunicipalityRepository $municipalityRepository
     * @param CollegeRepository $collageRepository
     * @param ExamProcessingRepository $examProcessingRepository
     * @param ProgramRepository $programRepository
     * @param SubjectCommitteeUserRepository $subjectCommitteeUserRepository
     * @param ExamProcessingDetailsRepository $examProcessingDetailsRepository
     * @param RoleRepository $roleRepository
     * @param CertificateRepository $certificateRepository
     */

    public function __construct(
        ProfileRepository $profileRepository,
        UserRepository $userRepository,
        QualificationRepository $qualificationRepository,
        ProfileLogsRepository $profileLogsRepository,
        ProfileProcessingRepository $profileProcessingRepository,
        ExamRepository $examRepository,
        MunicipalityRepository $municipalityRepository,
        CollegeRepository $collageRepository,
        ExamProcessingRepository $examProcessingRepository,
        ProgramRepository $programRepository,
        SubjectCommitteeUserRepository $subjectCommitteeUserRepository,
        ExamProcessingDetailsRepository $examProcessingDetailsRepository,
        RoleRepository $roleRepository,
        CertificateRepository $certificateRepository
    ) {
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
        $this->programRepository = $programRepository;
        $this->subjectCommitteeUserRepository = $subjectCommitteeUserRepository;
        $this->certificateRepository = $certificateRepository;
        $this->roleRepository = $roleRepository;
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

        try {


            $output = "";
            if ($request->ajax()) {
                $products = DB::table('profiles')->join('users', 'users.id', '=', 'profiles.user_id')
                    ->select(
                        'profiles.first_name as first_name',
                        'profiles.last_name as last_name',
                        // 'profiles.middle_name as middle_name',
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

                if ($products->isNotEmpty()) {
                    foreach ($products as $key => $product) {
                        $output .= '<tr>' .
                            '<td>' . $product->first_name . '</td>' .
                            '<td>' . $product->citizenship_number . '</td>' .
                            '<td>' . $product->dob_nep . '</td>' .
                            '<td>' . $product->profile_status . '</td>' .
                            '<td>' . $product->email . '</td>' .
                            '<td><a href=' . url("superAdmin/dashboard/applicant-list-view/" . $product->profile_id) . '><span class="label label-success">View</span></a> <a href=' . url("superAdmin/dashboard/delete/" . $product->profile_id) . '><span class="label label-danger">Delete</span></a></td>' .
                            '<td><a href=' . url("student/dashboard/admit/admitCardProfileId/" . $product->profile_id) . ' target="_blank"><span class="label label-success">Print Admit Card</span></a></td> ' .

                            '</tr>';
                    }
                    return Response($output);
                } else {
                    $output .= '<tr>' .
                        '<td>' . "No record Found" . '</td>' .
                        '</tr>';

                    return Response($output);
                }
            }
        } catch (Exception $e) {
            $output .= '<tr>' .
                '<td>' . "No record Found" . '</td>' .
                '</tr>';

            return Response($output);
        }
    }

    public function edit($id)
    {

        $data = $this->profileRepository->findById($id);
        $user_id = $data['user_id'];
        $user_data = $this->userRepository->findById($user_id);
        $qualification = $this->qualificationRepository->getAll()->where('user_id', '=', $data['user_id']);
        $profile_logs = $this->profileLogsRepository->getAll()->where('profile_id', '=', $id);
        $profile_processing = $this->profileProcessingRepository->getAll()->where('profile_id', '=', $id)->first();
        $exams = $this->examProcessingRepository->getAll()->where('profile_id', '=', $id);
        $certificate = DB::table('certificate_history')
            ->where('profile_id', '=', $id)
            ->get();
        return view('superAdmin::admin.applicant.application-list-review', compact('data', 'user_data', 'qualification', 'profile_logs', 'profile_processing', 'exams', 'certificate'));
    }

    public function changeStateProfileLogs(Request $request, $id)
    {
        $data = $request->all();
        $profile_logs = $this->profileLogsRepository->update($data, $id);
        if ($profile_logs === false) {
            session('error', 'error while saving the logs');
        }
        return redirect()->back()->withInput();
    }

    public function status(Request $request)
    {
        if (Auth::user()->mainRole()->name === 'superadmin') {
            $data = $request->all();
            try {
                $id = $data['profile_id'];
                $data['created_by'] = Auth::user()->id;
                $profile = $this->profileRepository->update($data, $id);
                $profileProcessingId = $this->profileProcessingRepository->getAll()->where('profile_id', '=', $id)->first();
                $profileProcessing['current_state'] = $data['profile_state'];
                if ($data['profile_status'] == 'Reviewing' || $data['profile_status'] == 'Verified') {
                    $profileProcessing['status'] = 'progress';
                } else if ($data['profile_status'] == 'Rejected') {
                    $profileProcessing['status'] = 'progress';
                }
                $profileProcessings = $this->profileProcessingRepository->update($profileProcessing, $profileProcessingId['id']);

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

    public function level(Request $request)
    {
        if (Auth::user()->mainRole()->name === 'superadmin') {
            $data = $request->all();
            try {
                $id = $data['profile_id'];
                $profile = $this->profileRepository->update($data, $id);
                session()->flash('success', 'User Profile Level has been changed successfully');
                return redirect()->back();
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

    public function userIndex()
    {
        if (Auth::user()->mainRole()->name === 'superadmin') {
            $data = $this->userRepository->getAll();
            return view('superAdmin::admin.applicant.login-user', compact("data"));
        } else {
            return redirect()->route('login');
        }
    }

    public function userSearch(Request $request)
    {
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
                        '<td><a href=' . url("superAdmin/dashboard/active/" . $product->id) . '><span class="label label-success">Active</span></a> <a href=' . url("superAdmin/dashboard/inactive/" . $product->id) . '><span class="label label-danger">In Active</span></a>
                        <a href=' . url("superAdmin/dashboard/user/delete/" . $product->id) . '><span class="label label-danger">Delete</span></a>
                        </td>' .
                        '<td><a href=' . url("superAdmin/dashboard/mapUser/index/" . $product->id) . '><span class="label label-danger">Assign</span></a></td>' .
                        '<td><a href=' . url("superAdmin/dashboard/edit/user/" . $product->id) . '><span class="label label-success">Edit</span></a></td>' .
                        '</tr>';
                }
                return Response($output);
            }
        }
    }

    public function userEdit($id)
    {
        $data = $this->userRepository->findById($id);
        return view('superAdmin::admin.applicant.user.edit', compact("data"));
    }



    public function active($id)
    {
        if (Auth::user()->mainRole()->name === 'superadmin') {
            $data = $this->userRepository->findById($id);
            $profile['status'] = 'active';
            $this->userRepository->update($profile, $id);
            session()->flash('success', 'User has been successfully activated');
            return redirect()->back();
        } else {
            return redirect()->route('login');
        }
    }

    public function inactive($id)
    {
        if (Auth::user()->mainRole()->name === 'superadmin') {
            $data = $this->userRepository->findById($id);
            $profile['status'] = 'in-active';
            $this->userRepository->update($profile, $id);
            session()->flash('success', 'User has been successfully in activated');
            return redirect()->back();
        } else {
            return redirect()->route('login');
        }
    }

    public function delete($id)
    {
        if (Auth::user()->mainRole()->name === 'superadmin') {
            $this->profileRepository->hardDelete($id);
            session()->flash('success', 'User has been deleted successfully');
            return redirect()->back();
        } else {
            return redirect()->route('login');
        }
    }

    public function userDelete($id)
    {
        if (Auth::user()->mainRole()->name === 'superadmin') {
            $this->userRepository->hardDelete($id);
            session()->flash('success', 'User has been deleted successfully');
            return redirect()->back();
        } else {
            return redirect()->route('login');
        }
    }
    public function editExamApply($id)
    {
        $profile = $this->profileRepository->findById($id);
        if ($profile) {

            $qualification = $this->qualificationRepository->getAll()->where('user_id', '=', $profile->user_id)
                ->where('level', '!=', 1);
            $exam = $this->examProcessingRepository->getAll()->where('profile_id', '=', $id)->first();
            if ($qualification != null) {
                foreach ($qualification as $quali)
                    if (is_numeric($quali['program_id']))
                        $all_program[] = $this->programRepository->findById($quali['program_id']);
            }
            return view('superAdmin::admin.applicant.edit-program-name', compact('all_program', "profile", 'exam'));
        }
    }

    public function applyExam(Request $request)
    {
        $data = $request->all();
        //        $data["status"] = 'progress';
        $data['voucher_image'] = $data['voucher'];
        try {
            $exam = $this->examProcessingRepository->update($data, $data['exam_processing_id']);
            if ($exam == false) {
                session()->flash('danger', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
            session()->flash('success', 'Program has been changed successfully');
            return redirect()->route('operator.applicant.list.review', ['id' => $data['profile_id']]);
        } catch (\Exception $e) {
            session()->flash('success', 'Program has been changed successfully.');
            return redirect()->back()->withInput();
        }
    }




    public function mapUser(Request $request)
    {
        $data = $request->all();
        try {
            $isAlreadyAssigned  =  $this->subjectCommitteeUserRepository->findBy('user_id', $data['user_id'], '=')->first();
            if ($isAlreadyAssigned)
                $subject_committee = $this->subjectCommitteeUserRepository->update($data, $isAlreadyAssigned['id']);
            else
                $subject_committee = $this->subjectCommitteeUserRepository->create($data);
            if ($subject_committee == false) {
                session()->flash('danger', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
            session()->flash('success', 'User has been assigned role successfully.');
            return redirect()->back();
        } catch (\Exception $e) {
            session()->flash('success', 'Program has been changed successfully.');
            return redirect()->back()->withInput();
        }
    }
    public function mapUserIndex($id)
    {
        return view('superAdmin::admin.applicant.role-assign', compact('id'));
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


    public function programList(Request $request)
    {
        $data = Program::all();
        if ($request->isMethod('post')) {

            $query = Program::query();


            if ($request->name != null) {
                $query->where('name', 'like', '%' . $request->name  . '%');
            }
            $data = $query->get();

            return view('superAdmin::admin.applicant.program.index', compact("data", 'request'));
        } else {
            return view('superAdmin::admin.applicant.program.index', compact("data"));
        }
    }

    public function programEdit($id)
    {
        $data = $this->programRepository->findById($id);
        return view('superAdmin::admin.applicant.program.edit', compact("data"));
    }


    public function program()
    {
        return view('superAdmin::admin.applicant.program.program');
    }

    public function programStore(Request $request)
    {
        $data = $request->all();
        $data['created_by'] = Auth::user()->id;
        $data['category_id'] = 4;
        try {
            $exam = $this->programRepository->create($data);
            if ($exam == false) {
                session()->flash('error', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
            session()->flash('success', 'Program Has been Added Successfully');
            return redirect()->to(route('superAdmin.program'));
        } catch (Expectation $ex) {
            session()->flash('error', 'Oops! Something went wrong.');
            return redirect()->back()->withInput();
        }
    }

    public function programUpdate(Request $request, $id)
    {
        $data = $request->all();
        $mun = $this->programRepository->update($data, $id);
        if ($mun == false) {
            session()->flash('error', 'Oops! Something went wrong.');
            return redirect()->back()->withInput();
        }
        session()->flash('success', 'Program has been updated');
        $data = Program::all();
        return view('superAdmin::admin.applicant.program.index', compact("data"));
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
    }

    public function updateUser(Request $request, $id)
    {
        $this->validator($request->all())->validate();
        $data = $request->all();
        if ($data['password']) {
            $userDetail['password_reference'] = $data['password'];
            $userDetail['password'] = bcrypt($data['password']);
        }

        $userDetail['email'] = $data['email'];
        $userDetail['name'] = $data['name'];
        $mun = $this->userRepository->update($userDetail, $id);
        if ($mun == false) {
            session()->flash('error', 'Oops! Something went wrong.');
            return redirect()->back()->withInput();
        }
        session()->flash('success', 'User has been updated');
        return redirect()->back();
    }

    public function municipalityList(Request $request)
    {
        $data = Municipality::all();
        if ($request->isMethod('post')) {

            $query = Municipality::query();


            if ($request->name != null) {
                $query->where('name', 'like', '%' . $request->name  . '%');
            }

            $data = $query->get();

            return view('superAdmin::admin.applicant.municipality.index', compact("data", 'request'));
        } else {
            return view('superAdmin::admin.applicant.municipality.index', compact("data"));
        }
    }

    public function municipalityEdit($id)
    {
        $data = $this->municipalityRepository->findById($id);
        return view('superAdmin::admin.applicant.municipality.edit', compact("data"));
    }


    public function municipality()
    {
        $data = \App\Models\Address\District::all();
        return view('superAdmin::admin.applicant.municipality', compact("data"));
    }
    public function municipalitySave(Request $request)
    {
        $data = $request->all();
        $mun = $this->municipalityRepository->create($data);
        if ($mun == false) {
            session()->flash('error', 'Oops! Something went wrong.');
            return redirect()->back()->withInput();
        }

        session()->flash('success', 'New Municipality has been added');
        $data = Municipality::all();
        return view('superAdmin::admin.applicant.municipality.index', compact("data"));
    }

    public function municipalityUpdate(Request $request, $id)
    {
        $data = $request->all();
        $mun = $this->municipalityRepository->update($data, $id);
        if ($mun == false) {
            session()->flash('error', 'Oops! Something went wrong.');
            return redirect()->back()->withInput();
        }

        session()->flash('success', 'Municipality has been updated');
        $data = Municipality::all();
        return view('superAdmin::admin.applicant.municipality.index', compact("data"));
    }


    public function collage()
    {
        $data = \App\Models\Address\District::all();
        return view('superAdmin::admin.applicant.collage', compact("data"));
    }
    public function collageSave(Request $request)
    {
        $data = $request->all();
        $mun = $this->collageRepository->create($data);
        if ($mun == false) {
            session()->flash('error', 'Oops! Something went wrong.');
            return redirect()->back()->withInput();
        }

        session()->flash('success', 'New Collage has been added');
        return redirect()->back();
    }


    public function generateCertificateIndex()
    {
        $student = $profiles = Profile::join('exam_registration', 'exam_registration.profile_id', '=', 'profiles.id')
            ->join('program', 'program.id', '=', 'exam_registration.program_id')
            ->join('level', 'level.id', '=', 'program.level_id')
            ->join('provinces', 'provinces.id', '=', 'profiles.development_region')
            ->where('exam_registration.status', "=", 'progress')
            ->where('exam_registration.state', "=", 'council')
            ->where('exam_registration.level_id', "=", '3')
            ->where('exam_registration.attempt', "=", '1')
            ->where('exam_registration.isPassed', "=", true)
            ->where('exam_registration.certificate_generate', '=', 'No')
            ->orderBy('profiles.created_at', 'ASC')
            ->get([
                'profiles.*', 'profiles.id as profile_id', 'profiles.created_at as profile_created_at', 'program.name as program_name', 'program.*',
                'program.id as program_id', 'level.*', 'provinces.province_name', 'exam_registration.id as exam_registration_id', 'exam_registration.*'
            ]);

        return view('superAdmin::admin.applicant.certificate-index', compact('student'));
    }

    public function generateCertificate()
    {
        $students = $profiles = Profile::join('exam_registration', 'exam_registration.profile_id', '=', 'profiles.id')
            ->join('program', 'program.id', '=', 'exam_registration.program_id')
            ->join('level', 'level.id', '=', 'program.level_id')
            ->join('provinces', 'provinces.id', '=', 'profiles.development_region')
            ->join('profile_processing', 'profile_processing.profile_id', '=', 'profiles.id')
            ->where('exam_registration.status', "=", 'progress')
            ->where('exam_registration.state', "=", 'council')
            ->where('exam_registration.level_id', "=", '3')
            ->where('exam_registration.attempt', "=", '1')
            ->where('exam_registration.isPassed', "=", true)
            ->where('exam_registration.certificate_generate', '=', 'No')
            ->orderBy('profiles.created_at', 'ASC')
            ->get([
                'profiles.*', 'profiles.id as profile_id', 'profiles.created_at as profile_created_at', 'program.name as program_name', 'program.*',
                'program.id as program_id', 'level.*', 'provinces.province_name', 'exam_registration.id as exam_registration_id'
            ]);
        foreach ($students as $student) {
            $srn_number = 0;
            $date = '2022/07/08';
            $srn_number = Certificate::where('program_id', '=', $student['program_id'])->orderBy('srn', 'desc')->first();
            $registration_number = Certificate::orderBy('registration_id', 'desc')->first();
            $qualification = $this->qualificationRepository->getAll()->where('user_id', '=', $student['user_id'])
                ->where('program_id', '=', $student['program_id'])->first();
            if ($srn_number)
                $srn = $srn_number['srn'];
            $registration_id = $registration_number['registration_id'];
            $data['registration_id'] = ++$registration_id;
            $data['category_id'] = $student[''];
            $data['profile_id'] = $student['profile_id'];
            $data['program_id'] = $student['program_id'];
            $data['srn'] = ++$srn;
            $data['program_certificate_code'] = $student['certificate_name'];
            $data['cert_registration_number'] = $this->certRegistrationNumber($student['level_code'], $data['srn'], $student['certificate_name']);
            $data['registrar'] = 'Lila Nath Bhandari';
            $data['decision_date'] =                    Carbon::today()->toDateString();

            //            $date;
            $data['name'] = $student['first_name'] . ' ' . $student['middle_name'] . ' ' . $student['last_name'];
            $data['date_of_birth'] = $student['dob_nep'];
            $data['address'] = $student['province_name'] . ':' . $student['district'] . ':' . $student['vdc_municiplality'] . ':' . $student['ward_no'];
            $data['program_name'] = $student['qualification'];
            $data['level_name'] = $student['level_'];
            $data['qualification'] = $student['program_name'] . ':' . $student['board_university'] . ':'  . $student['passed_year'];
            $data['issued_year'] = Carbon::today()->year;
            $data['issued_date'] = $date;
            $data['valid_till'] = Carbon::now()->addYears(5);
            $data['certificate'] = 'new';
            $data['issued_by'] = Auth::user()->id;
            $data['certificate_status'] = 1;
            $certificate = $this->certificateRepository->create($data);
            $examupdate['status'] = "accepted";
            $examupdate['state'] = "council";
            $this->examProcessingRepository->update($examupdate, $student['exam_registration_id']);
            //                $this->updateQualificationHistory($qualification);
            $profilesProcessing = $this->profileProcessingRepository->getAll()->where('profile_id', '=', $student['profile_id'])->first();
            $data['current_state'] = 'council';
            $data['status'] = 'accepted';
            $this->profileProcessingRepository->update($data, $profilesProcessing['id']);
        }

        return redirect()->back();
    }
    public function generateSingleCertificate($id)
    {
        $students  = Profile::join('exam_registration', 'exam_registration.profile_id', '=', 'profiles.id')
            ->join('program', 'program.id', '=', 'exam_registration.program_id')
            ->join('level', 'level.id', '=', 'program.level_id')
            ->join('provinces', 'provinces.id', '=', 'profiles.development_region')
            ->join('profile_processing', 'profile_processing.profile_id', '=', 'profiles.id')
            ->where('profiles.id', '=', $id)
            ->where('exam_registration.status', "=", 'progress')
            ->where('exam_registration.state', "=", 'council')
            ->where('exam_registration.level_id', "=", '1')
            ->where('exam_registration.attempt', "=", '1')
            ->where('exam_registration.isPassed', "=", true)
            ->where('exam_registration.certificate_generate', '=', 'No')
            ->get([
                'profiles.*', 'profiles.id as profile_id', 'profiles.created_at as profile_created_at', 'program.name as program_name', 'program.*',
                'program.id as program_id', 'level.*', 'provinces.province_name', 'exam_registration.id as exam_registration_id'
            ]);


        foreach ($students as $student) {
            $date = '2022/07/08';
            $srn_number = 0;
            $srn_number = Certificate::where('program_id', '=', $student['program_id'])->orderBy('srn', 'desc')->first();
            $registration_number = Certificate::orderBy('registration_id', 'desc')->first();
            $qualification = $this->qualificationRepository->getAll()->where('user_id', '=', $student['user_id'])
                ->where('program_id', '=', $student['program_id'])->first();
            if ($srn_number)
                $srn = $srn_number['srn'];
            $registration_id = $registration_number['registration_id'];
            $data['registration_id'] = ++$registration_id;
            $data['category_id'] = $student[''];
            $data['profile_id'] = $student['profile_id'];
            $data['program_id'] = $student['program_id'];
            $data['srn'] = ++$srn;
            $data['program_certificate_code'] = $student['certificate_name'];
            $data['cert_registration_number'] = $this->certRegistrationNumber($student['level_code'], $data['srn'], $student['certificate_name']);
            $data['registrar'] = 'Lila Nath Bhandari';
            $data['decision_date'] =
                //                    $date;
                Carbon::today()->toDateString();
            $data['name'] = $student['first_name'] . ' ' . $student['middle_name'] . ' ' . $student['last_name'];
            $data['date_of_birth'] = $student['dob_nep'];
            $data['address'] = $student['province_name'] . ':' . $student['district'] . ':' . $student['vdc_municiplality'] . ':' . $student['ward_no'];
            $data['program_name'] = $student['qualification'];
            $data['level_name'] = $student['level_'];
            $data['qualification'] = $student['program_name'] . ':' . $student['board_university'] . ':'  . $student['passed_year'];
            $data['issued_year'] = Carbon::today()->year;
            $data['issued_date'] =
                //                    $date;
                Carbon::today()->toDateString();
            $data['valid_till'] = Carbon::now()->addYears(5);
            $data['certificate'] = 'new';
            $data['issued_by'] = Auth::user()->id;
            $data['certificate_status'] = 1;
            $certificate = $this->certificateRepository->create($data);
            $examupdate['status'] = "accepted";
            $examupdate['state'] = "council";
            $this->examProcessingRepository->update($examupdate, $student['exam_registration_id']);
            //                $this->updateQualificationHistory($qualification);
            $profilesProcessing = $this->profileProcessingRepository->getAll()->where('profile_id', '=', $student['profile_id'])->first();
            $data['current_state'] = 'council';
            $data['status'] = 'accepted';
            $this->profileProcessingRepository->update($data, $profilesProcessing['id']);
        }

        return redirect()->back();
    }

    private function certRegistrationNumber($level_code, $srn, $program_code)
    {
        return $level_code . '-' . $srn . ' ' . $program_code;
    }

    public function updateQualificationHistory($qualification)
    {
        $data['licence'] = 'yes';
        $update = $this->qualificationRepository->update($data, $qualification['id']);
        if ($update == false)
            return false;
        return true;
    }

    public function minuteData()
    {
        $certificates = Certificate::all()->where('decision_date', '=', '2022-06-05')->groupBy('program_id');
        $count = 0;
        $count42 = 0;

        foreach ($certificates[41] as $certificate)
            $count = $count + 1;

        foreach ($certificates[42] as $certificate)
            $count42 = $count42 + 1;
        return view('superAdmin::admin.applicant.minuteData', compact('certificates', 'count', 'count42'));
    }


    public function attachRole(Request $request)
    {
        $data = $request->all();
        $user = $this->userRepository->findById($data['user_id']);
        //        $role = $this->roleRepository->getAll()->where('user_id','=',$data['user_id']);
        $assignRole =  $user->roles()->sync([$data['role']]);
        //        $user->attachRole($data['role']);
        //        dd($user);
        session()->flash('success', 'Role has been Assigned');
        return redirect()->back();
    }


    // public function getRejectedList(){
    //     $exam= ExamProcessing::all()->where('status','!=','council')->where('state','=','rejected');
    //     return view()
    // }


    public function deleteCertificate($id)
    {
        $certificate = $this->certificateRepository->delete($id);
        return redirect()->back();
    }


    public function stats()
    {
        // $computer_operator = 
        return view('superAdmin::admin.applicant.stats');
    }


    public function examDetails()
    {
        $exam = $this->examRepository->getAll();
        return view('superAdmin::admin.applicant.exam.index', compact('exam'));
    }

    public function create()
    {
        return view('superAdmin::admin.applicant.exam.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['created_by'] = Auth::user()->id;
        try {
            $exam = $this->examRepository->create($data);
            if ($exam == false) {
                session()->flash('error', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
            session()->flash('success', 'Exam Has been Added Successfully');
            return redirect()->to(route('superAdmin.exam'));
        } catch (Expectation $ex) {
            session()->flash('error', 'Oops! Something went wrong.');
            return redirect()->back()->withInput();
        }
    }

    public function update($status, $id, Request $request)
    {
        $data['status'] = $status;

        try {
            $exam = $this->examRepository->update($data, $id);
            if ($exam == false) {
                session()->flash('error', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
            session()->flash('success', `Exam Has been ${status} Successfully`);
            return redirect()->to(route('superAdmin.exam'));
        } catch (Expectation $ex) {
            session()->flash('error', 'Oops! Something went wrong.');
            return redirect()->back()->withInput();
        }
    }

    public function show($id)
    {

        $appliedCount = ExamProcessing::all()->where('exam_id', '=', $id);
        $rejectedCount = ExamProcessing::all()->where('status', '=', 'rejected')->where('exam_id', '=', $id);
        $failedCount =  DB::table('exam_registration')
            ->select('profile_id', 'exam_id', DB::raw('COUNT(*) as `count`'))
            ->groupBy('profile_id', 'exam_id')
            ->havingRaw('COUNT(*) >= 2')
            ->get();
        return view('superAdmin::admin.applicant.exam.show', compact('appliedCount', 'rejectedCount', 'failedCount'));
    }

    public function studentCard(Request $request)
    {

        if ($request->isMethod('post')) {

            $query =  Certificate::query();


            if ($request->level != null) {
                $query->where('level_name', 'Like', '%' . $request->level . '%');
            }
            if ($request->darta_number != null) {
                $query->where('srn', 'like', $request->darta_number);
            }

            if ($request->first_name != null) {
                $query->where('name', 'like', '%' . $request->first_name  . '%');
            }



            if ($request->profile_id != null) {
                $query->where('profile_id', '=',   $request->profile_id);
            }

            if ($request->regratation_date != null) {
                $query->where('decision_date', '=',  $request->regratation_date);
            }


            $data = $query->get();

            return view('superAdmin::admin.applicant.id-card-list', compact('data', 'request'));
        } else {
            $data  = Certificate::where('profile_id', '!=',  '')->where('level_name', 'Like', '%' . 'Specialization' . '%')->get();
            return view('superAdmin::admin.applicant.id-card-list', compact('data'));
        }
    }

    public function studentCardShow($id)
    {
        $data = Certificate::where('certificate_history.id', '=', $id)
            ->get()->first();
        // dd($data);
        $exam = ExamProcessing::where('profile_id', '=', $data['profile_id'])->where('status', '=', 'accepted')->where('state', '=', 'council')->first();

        $profile = $this->profileRepository->findById($data['profile_id']);

        return view('superAdmin::admin.applicant.id-card', compact('data', 'profile', 'exam'));
    }

    public function searchStudent(Request $request)
    {
        $program = Program::get();
        if ($request->isMethod('post')) {

            $query = Profile::query()->join('exam_registration', 'exam_registration.profile_id', '=', 'profiles.id')
                ->join('users', 'users.id', '=', 'profiles.user_id');

            if ($request->state != null) {
                $query->where('exam_registration.state', 'like', $request->state);
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

            // dd($data[0]);
            // dd(isset($data));
            return view('superAdmin::admin.applicant.search-students', compact('data', 'program', 'request'));
        } else {
            return view('superAdmin::admin.applicant.search-students', compact('program'));
        }
    }

    public function university()
    {
        $data = University::all();
        return view('superAdmin::admin.applicant.university.index', compact("data"));
    }

    public function universityCreate()
    {
        return view('superAdmin::admin.applicant.university.form');
    }

    public function universityStore(Request $request)
    {
        $data = $request->all();
        $university = new University();
        $university->fill($data);

        // Save the data to the database
        $university->save();
        if ($university == false) {
            session()->flash('error', 'Oops! Something went wrong.');
            return redirect()->back()->withInput();
        }

        session()->flash('success', 'New Collage has been added');
        return redirect()->back();
    }
    public function universityEdit($id)
    {
        $data = University::find($id);
        return view('superAdmin::admin.applicant.university.edit', compact("data"));
    }

    public function universityUpdate(Request $request, $id)
    {
        $data = $request->all();
        $university = University::find($id); // Replace $id with the ID of the model you want to update
        $university->name = $data['name'];
        $university->save();

        if ($university == false) {
            session()->flash('error', 'Oops! Something went wrong.');
            return redirect()->back()->withInput();
        }

        session()->flash('success', 'New Collage has been added');
        return redirect()->back();
    }
}
