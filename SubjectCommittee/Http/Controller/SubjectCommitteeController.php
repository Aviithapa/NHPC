<?php


namespace SubjectCommittee\Http\Controller;

use App\Models\Certificate\Certificate;
use App\Models\Exam\ExamProcessing;
use App\Models\Profile\Profilelogs;
use App\Models\Profile\ProfileProcessing;
use App\Models\SubjectCommittee\SubjectCommitteeUser;
use App\Modules\Backend\Admin\Program\Repositories\ProgramRepository;
use App\Modules\Backend\Authentication\User\Repositories\UserRepository;
use App\Modules\Backend\Certificate\Repositories\CertificateRepository;
use App\Modules\Backend\Exam\Exam\Repositories\ExamRepository;
use App\Modules\Backend\Exam\ExamProcessing\Repositories\ExamProcessingRepository;
use App\Modules\Backend\Exam\ExamProcessingDetails\Repositories\ExamProcessingDetailsRepository;
use App\Modules\Backend\Profile\Profilelogs\Repositories\ProfileLogsRepository;
use App\Modules\Backend\Profile\ProfileProcessing\Repositories\ProfileProcessingRepository;
use App\Modules\Backend\SubjectCommittee\SubjectCommittee\SubjectCommitteeRepository;
use App\Modules\Backend\SubjectCommittee\SubjectCommitteRole\SubjectCommitteeUserRepository;
use Illuminate\Support\Facades\Auth;
use Operator\Modules\Framework\Request;
use Student\Models\Profile;
use Student\Modules\Profile\Repositories\ProfileRepository;
use Student\Modules\Qualification\Repositories\QualificationRepository;

class SubjectCommitteeController extends BaseController
{
    private  $log, $profileProcessing,
        $profileRepository, $userRepository,
        $qualificationRepository, $user_data,
        $profileLogsRepository, $profileProcessingRepository,
        $examRepository, $examProcessingRepository, $subjectCommitteeUserRepository, $subjectCommitteeRepository, $programRepository, $certificateRepository;
    private $viewData, $exam_processing, $current_user = false;

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
     * @param SubjectCommitteeRepository $subjectCommitteeRepository
     * @param SubjectCommitteeUserRepository $subjectCommitteeUserRepository
     * @param ProgramRepository $programRepository
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
        SubjectCommitteeRepository $subjectCommitteeRepository,
        SubjectCommitteeUserRepository $subjectCommitteeUserRepository,
        ProgramRepository $programRepository
    ) {
        $this->profileRepository = $profileRepository;
        $this->userRepository = $userRepository;
        $this->qualificationRepository = $qualificationRepository;
        $this->profileLogsRepository = $profileLogsRepository;
        $this->profileProcessingRepository = $profileProcessingRepository;
        $this->examRepository = $examRepository;
        $this->examProcessingRepository = $examProcessingRepository;
        $this->examProcessingDetailsRepository = $examProcessingDetailsRepository;
        $this->subjectCommitteeRepository = $subjectCommitteeRepository;
        $this->subjectCommitteeUserRepository = $subjectCommitteeUserRepository;
        $this->programRepository = $programRepository;
        parent::__construct();
    }

    public function index()
    {
        $data = $this->subjectCommitteeUserRepository->getAll()->where('user_id', '=', Auth::user()->id)->first();
        $subject_committee = $this->subjectCommitteeRepository->findById($data['subjecr_committee_id']);
        $subject_Committee_id = $this->subjectCommitteeUserRepository->getAll()->where('user_id', '=', Auth::user()->id)->first();
        $pcl_count = 0;
        $master_count = 0;
        $bachelor_count = 0;

        $datas = Profile::join('exam_registration', 'exam_registration.profile_id', '=', 'profiles.id')
            ->join('program', 'program.id', '=', 'exam_registration.program_id')
            ->join('profile_processing', 'profile_processing.profile_id', '=', 'profiles.id')
            ->leftJoin('profile_logs', function ($join) {
                $join->on('profiles.id', '=', 'profile_logs.profile_id')
                    ->where('profile_logs.state', '=', 'subject_committee')
                    ->where('profile_logs.review_status', '=', 'Successful')
                    ->where('profile_logs.created_by', '=', Auth::user()->id);
            })
            ->where('profile_processing.current_state', 'subject_committee')
            ->where('exam_registration.level_id', 3)
            ->where('profile_processing.status', 'progress')
            ->where('program.subject-committee_id', $subject_Committee_id['subjecr_committee_id'])
            ->orderBy('profiles.created_at', 'ASC')

            ->select('profile_logs.created_by as profile_logs_created_by')
            ->get();


        foreach ($datas as $data) {
            if ($data->profile_logs_created_by != Auth::user()->id) {
                $pcl_count = ++$pcl_count;
            }
        }

        $master_datas = Profile::join('exam_registration', 'exam_registration.profile_id', '=', 'profiles.id')
            ->join('program', 'program.id', '=', 'exam_registration.program_id')
            ->join('profile_processing', 'profile_processing.profile_id', '=', 'profiles.id')
            ->leftJoin('profile_logs', function ($join) {
                $join->on('profiles.id', '=', 'profile_logs.profile_id')
                    ->where('profile_logs.state', '=', 'subject_committee')
                    ->where('profile_logs.review_status', '=', 'Successful')
                    ->where('profile_logs.created_by', '=', Auth::user()->id);
            })
            ->where('profile_processing.current_state', 'subject_committee')
            ->where('exam_registration.level_id', 1)
            ->where('profile_processing.status', 'progress')
            ->where('program.subject-committee_id', $subject_Committee_id['subjecr_committee_id'])
            ->orderBy('profiles.created_at', 'ASC')

            ->select('profile_logs.created_by as profile_logs_created_by')
            ->get();


        foreach ($master_datas as $data) {
            if ($data->profile_logs_created_by != Auth::user()->id) {
                $master_count = ++$master_count;
            }
        }

        $bachelor_datas = Profile::join('exam_registration', 'exam_registration.profile_id', '=', 'profiles.id')
            ->join('program', 'program.id', '=', 'exam_registration.program_id')
            ->join('profile_processing', 'profile_processing.profile_id', '=', 'profiles.id')
            ->leftJoin('profile_logs', function ($join) {
                $join->on('profiles.id', '=', 'profile_logs.profile_id')
                    ->where('profile_logs.state', '=', 'subject_committee')
                    ->where('profile_logs.review_status', '=', 'Successful')
                    ->where('profile_logs.created_by', '=', Auth::user()->id);
            })
            ->where('profile_processing.current_state', 'subject_committee')
            ->where('exam_registration.level_id', 2)
            ->where('profile_processing.status', 'progress')
            ->where('program.subject-committee_id', $subject_Committee_id['subjecr_committee_id'])
            ->orderBy('profiles.created_at', 'ASC')

            ->select('profile_logs.created_by as profile_logs_created_by')
            ->get();


        foreach ($bachelor_datas as $data) {
            if ($data->profile_logs_created_by != Auth::user()->id) {
                $bachelor_count = ++$bachelor_count;
            }
        }

        return view('subjectCommittee::pages.dashboard', compact('data', 'subject_committee', 'pcl_count', 'master_count', 'bachelor_count'));
    }

    public function ajaxIndex()
    {
        return view('subjectCommittee::pages.index');
    }

    public function ajaxProfile(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        $level = $request->get('level');


        // Total records
        $totalRecords = Profile::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Profile::select('count(*) as allcount')->where('first_name', 'like', '%' . $searchValue . '%')->count();

        $subject_Committee_id = $this->subjectCommitteeUserRepository->getAll()->where('user_id', '=', Auth::user()->id)->first();
        // Fetch records
        if ($level) {
            $records =  Profile::join('exam_registration', 'exam_registration.profile_id', '=', 'profiles.id')
                ->join('program', 'program.id', '=', 'exam_registration.program_id')
                ->join('profile_processing', 'profile_processing.profile_id', '=', 'profiles.id')
                ->leftJoin('profile_logs', function ($join) {
                    $join->on('profiles.id', '=', 'profile_logs.profile_id')
                        ->where('profile_logs.state', '=', 'subject_committee')
                        ->where('profile_logs.review_status', '=', 'Successful')
                        ->where('profile_logs.created_by', '!=', Auth::user()->id);
                })
                ->where('profile_processing.current_state', 'subject_committee')
                ->where('profile_processing.status', 'progress')
                ->where('program.subject-committee_id', $subject_Committee_id['subjecr_committee_id'])

                ->where('exam_registration.level_id', $level)
                ->orderBy($columnName, $columnSortOrder)
                ->skip($start)
                ->take($rowperpage)
                ->select('profiles.id', 'profiles.first_name', 'profiles.middle_name', 'profiles.last_name', 'profiles.citizenship_number', 'program.name as program_name', 'profile_logs.created_by as profile_logs_created_by')
                ->get();
        } else {
            $records =  Profile::join('exam_registration', 'exam_registration.profile_id', '=', 'profiles.id')
                ->join('program', 'program.id', '=', 'exam_registration.program_id')
                ->join('profile_processing', 'profile_processing.profile_id', '=', 'profiles.id')
                ->leftJoin('profile_logs', function ($join) {
                    $join->on('profiles.id', '=', 'profile_logs.profile_id')
                        ->where('profile_logs.state', '=', 'subject_committee')
                        ->where('profile_logs.review_status', '=', 'Successful')
                        ->where('profile_logs.created_by', '!=', Auth::user()->id);
                })
                ->where('profile_processing.current_state', 'subject_committee')
                ->where('profile_processing.status', 'progress')
                ->where('program.subject-committee_id', $subject_Committee_id['subjecr_committee_id'])

                // ->where('exam_registration.level_id',$level)
                ->orderBy($columnName, $columnSortOrder)
                ->skip($start)
                ->take($rowperpage)
                ->select('profiles.id', 'profiles.first_name', 'profiles.middle_name', 'profiles.last_name', 'profiles.citizenship_number', 'program.name as program_name', 'profile_logs.created_by as profile_logs_created_by')
                ->get();
        }

        // 

        //   return $records;


        $data_arr = array();
        $count = 1;
        $totalRecords = 0;
        $totalRecordswithFilter = 0;
        foreach ($records as $record) {

            if (Auth::user()->id !== $record->profile_logs_created_by) {
                $totalRecords = $count + 1;
                $totalRecordswithFilter = $count + 1;
                $id = $record->id;
                $name = $record->first_name . ' ' . $record->middle_name . ' ' . $record->last_name;
                $citizenship = $record->citizenship_number;
                $program_name =  $record->program_name;
                $data_arr[] = array(
                    "id" => $id,
                    "name" => $name,
                    "program_name" => $program_name,
                    "citizenship" =>  $citizenship,
                    "action" => '
                  <a target="_blank" href=' . url("subjectCommittee/dashboard/subjectCommittee/applicant-list-view/" . $record["id"]) . '><span class="label label-success">View</span></a>
                  '
                );
            }
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
        );

        echo json_encode($response);
        exit;
    }
    public function profile($status, $current_state, $level, $page = 0)
    {
        if (Auth::user()->mainRole()->name === 'subject_committee') {
            $subject_Committee_id = $this->subjectCommitteeUserRepository->getAll()->where('user_id', '=', Auth::user()->id)->first();
            $level = $level ? $level : 1;
            $page = $page ? $page : 0;
            $master_count = 0;
            $bachelor_count = 0;
            $pcl_count = 0;
            $tslc_count = 0;
            $take = 100;

            $datas = Profile::join('exam_registration', 'exam_registration.profile_id', '=', 'profiles.id')
                ->join('program', 'program.id', '=', 'exam_registration.program_id')
                ->join('profile_processing', 'profile_processing.profile_id', '=', 'profiles.id')
                ->leftJoin('profile_logs', function ($join) {
                    $join->on('profiles.id', '=', 'profile_logs.profile_id')
                        ->where('profile_logs.state', '=', 'subject_committee')
                        ->where('profile_logs.review_status', '=', 'Successful')
                        ->where('profile_logs.created_by', '=', Auth::user()->id);
                })
                ->where('profile_processing.current_state', $current_state)
                ->where('exam_registration.level_id', $level)
                ->where('profile_processing.status', $status)
                ->where('program.subject-committee_id', $subject_Committee_id['subjecr_committee_id'])
                ->orderBy('profiles.created_at', 'ASC')
                ->select('profiles.id', 'profiles.first_name', 'profiles.middle_name', 'profiles.last_name', 'profiles.citizenship_number', 'profiles.created_at', 'program.name as program_name', 'profile_logs.created_by as profile_logs_created_by')
                ->get();

            $data = $this->subjectCommitteeUserRepository->getAll()->where('user_id', '=', Auth::user()->id)->first();
            $subject_committee = $this->subjectCommitteeRepository->findById($data['subjecr_committee_id']);
            return view('subjectCommittee::pages.applicant-profile-list', compact('datas', 'status', 'current_state', 'page', 'level', 'subject_committee', "master_count", "bachelor_count", "pcl_count", "tslc_count"));
        } else {
            return redirect()->route('login');
        }
    }

    public function acceptedByMe()
    {
        if (Auth::user()->mainRole()->name === 'subject_committee') {
            $datas = Profilelogs::join('profiles', 'profiles.id', '=', 'profile_logs.profile_id')
                ->where('profile_logs.created_by', '=', Auth::user()->id)
                ->join('exam_registration', 'exam_registration.profile_id', '=', 'profiles.id')
                ->join('program', 'program.id', '=', 'exam_registration.program_id')
                ->get(['profiles.*', 'profiles.id as profile_id', 'program.name as program', 'profile_logs.created_at as profiles_logs'])
                ->unique('id');

            return view('subjectCommittee::pages.accepted-by-me', compact('datas'));
        } else {
            return redirect()->route('login');
        }
    }


    public function acceptedByMeSubmitCSV()
    {
        $fileName = 'SubjectCommitteeAcceptedList.csv';

        $tasks = Profilelogs::join('profiles', 'profiles.id', '=', 'profile_logs.profile_id')
            ->where('profile_logs.created_by', '=', Auth::user()->id)
            ->join('exam_registration', 'exam_registration.profile_id', '=', 'profiles.id')
            ->join('program', 'program.id', '=', 'exam_registration.program_id')
            ->get(['profiles.*', 'profiles.id as profile_id', 'program.name as program', 'profile_logs.created_at as profiles_logs'])
            ->unique('id');

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('RegistrationID', 'Name', 'Citizenship Number', 'Program', ' Accepted At');

        $callback = function () use ($tasks, $columns) {

            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            foreach ($tasks as $task) {
                $row['profile_id'] = $task->profile_id;
                $row['name'] = $task->first_name . ' ' . $task->middle_name . ' ' . $task->last_name;
                $row['citizenship_number'] = $task->citizenship_number;
                $row['program'] = $task->program;
                $row['profile_logs'] = $task->profiles_logs;

                fputcsv($file, array(
                    $row['profile_id'],
                    $row['name'],
                    $row['citizenship_number'],
                    $row['program'],
                    $row['profile_logs']
                ));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exam($status, $current_state)
    {
        if (Auth::user()->mainRole()->name === 'subject_committee') {
            $users = $this->examProcessingRepository->getAll()->where('status', '=', $status)
                ->where('state', '=', $current_state);
            $data = $this->subjectCommitteeUserRepository->getAll()->where('user_id', '=', Auth::user()->id)->first();
            $subject_committee = $this->subjectCommitteeRepository->findById($data['subjecr_committee_id']);
            return $this->view('pages.application-list', $users);
        } else {
            return redirect()->route('login');
        }
    }

    public function edit($id)
    {
        if (Auth::user()->mainRole()->name === 'subject_committee') {
            $data = $this->profileRepository->findById($id);
            $user_id = $data['user_id'];
            $user_data = $this->userRepository->findById($user_id);
            $qualification = $this->qualificationRepository->getAll()->where('user_id', '=', $data['user_id']);
            $profile_logs = $this->profileLogsRepository->getAll()->where('profile_id', '=', $id);
            $subject_committee_logs = Profilelogs::join('subject_committee_user', 'subject_committee_user.user_id', '=', 'profile_logs.created_by')
                ->join('users', 'users.id', '=', 'profile_logs.created_by')
                ->where('profile_logs.state', 'subject_committee')
                ->where('profile_logs.status', 'progress')
                ->where('profile_logs.profile_id', $id)
                ->get(['profile_logs.*', 'users.name as user_name']);
            $profile_processing = $this->profileProcessingRepository->getAll()->where('profile_id', '=', $id)->first();
            $exams = $this->examProcessingRepository->getAll()->where('profile_id', '=', $id);
            $exam = $this->examProcessingRepository->getAll()->where('profile_id', '=', $id)->first();
            if ($profile_processing['subject_committee_accepted_num'] != 0) {
                $current_user = $this->profileLogsRepository->getAll()->where('created_by', '=', Auth::user()->id)
                    ->where('status', '!=', 'rejected')
                    ->where('profile_id', '=', $id);
            } else {
                $current_user = null;
            }
            if ($exam) {
                if ($exam['subject_committee_count'] != 0) {
                    $current_exam_user = $this->examProcessingDetailsRepository->getAll()->where('created_by', '=', Auth::user()->id)
                        ->where('profile_id', '=', $id);;
                } else {
                    $current_exam_user = null;
                }
            } else {
                $current_exam_user = null;
            }
            $subjects = $this->subjectCommitteeUserRepository->getAll()->where('user_id', '=', Auth::user()->id)->first();
            $subject_committee = $this->subjectCommitteeRepository->findById($subjects['subjecr_committee_id']);
            return view('subjectCommittee::pages.application-list-review', compact('data', 'user_data', 'qualification', 'profile_logs', 'profile_processing', 'exams', 'current_user', 'current_exam_user', 'subject_committee_logs', 'subject_committee'));
        } else {
            return redirect()->route('login');
        }
    }

    public function status(Request $request)
    {
        if (Auth::user()->mainRole()->name === 'subject_committee') {
            $data = $request->all();
            try {
                $id = $data['profile_id'];
                $data['created_by'] = Auth::user()->id;
                $data['state'] = 'subject_committee';
                if ($data['profile_status'] === "Verified" || $data['profile_status'] === "Reviewing") {
                    $data['status'] = 'progress';
                    $data['remarks'] = 'Profile is Accepted by Subject Committee';
                    $data['review_status'] = 'Successful';
                    $this->profileLog($data);
                    $this->profileProcessing($id);
                } elseif ($data['profile_status'] === "Rejected") {
                    $data['status'] = 'rejected';
                    $data['review_status'] = 'Rejected';
                    $this->rejectprofileProcessing($id, $data['remarks']);
                    $this->profileLog($data);
                }
                $profile = $this->profileRepository->update($data, $id);
                if ($profile == false) {
                    session()->flash('danger', 'Oops! Something went wrong.');
                }
                $current_state = "subject_committee";
                $status = $data['status'];
                session()->flash('success', 'User Profile Status Information have been saved successfully');
                return redirect()->route("subjectCommittee.applicant.profile.list", ['status' => $status, 'current_state' => $current_state, 'level' => isset($profile['level']) ? $profile['level'] : 4]);
            } catch (\Exception $e) {
                session()->flash('danger', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function profileLog(array  $data)
    {
        $data["created_by"] = Auth::user()->id;
        $logs = $this->profileLogsRepository->create($data);
        if ($logs == false)
            return false;
        return true;
    }
    public function rejectprofileProcessing($id, $remarks)
    {
        $profileProcessing['profile_id'] = $id;
        $profileProcessing['current_state'] = "subject_committee";
        $profileProcessing['status'] = "rejected";
        $id = $this->profileProcessingRepository->getAll()->where('profile_id', '=', $id)->first();
        $profile_processing = $id;
        $profileProcessing['remarks'] = $remarks;
        $profileProcessing['review_status'] = 'Rejected';
        $profileProcessing['current_state'] = 'subject_committee';
        $profileProcessings = $this->profileProcessingRepository->update($profileProcessing, $id['id']);
        if ($profileProcessings == false)
            return false;
        return true;
    }

    public function profileProcessing($id)
    {
        $profileProcessing['profile_id'] = $id;
        $profileProcessing['current_state'] = "subject_committee";
        $profileProcessing['status'] = "progress";
        $subject_Committee = $this->subjectCommitteeUserRepository->getAll()->where('user_id', '=', Auth::user()->id)->first();
        $id = $this->profileProcessingRepository->getAll()->where('profile_id', '=', $id)->first();
        $profile_processing = $id;
        if ($profile_processing['current_state'] === 'subject_committee') {
            $profile_processing->subject_committee_accepted_num++;
        }
        $profileProcessings = $this->profileProcessingRepository->update($profileProcessing, $id['id']);
        if ($profileProcessings == false)
            return false;
        return true;
    }


    public function RejectExamProcessing(Request $request)
    {
        $data = $request->all();
        $id = $data['id'];
        $data['status'] = 'rejected';
        $data['state'] = 'officer';
        try {
            $exam_processing = $this->examProcessingRepository->update($data, $id);
            $profile_id = $exam_processing['profile_id'];
            $this->ExamProcessingLog($data, $id, $profile_id);
            if ($exam_processing == false) {
                session()->flash('danger', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
            session()->flash('success', 'Application have been Rejected');
            return redirect()->back();
        } catch (\Exception $e) {
            session()->flash('danger', 'Oops! Something went wrong.');
            return redirect()->back()->withInput();
        }
    }

    public function AcceptExamProcessing($id)
    {
        $data['status'] = 'progress';
        $exam_processing = $this->examProcessingRepository->findById($id);
        if ($exam_processing->state === 'subject_committee') {
            if ($exam_processing->subject_committee_count < 3)
                $data['subject_committee_count'] = $exam_processing->subject_committee_count + 1;
            else
                $data['state'] = 'exam_committee';
        }
        try {
            $exam_processing = $this->examProcessingRepository->update($data, $id);
            $profile_id = $exam_processing['profile_id'];
            $this->ExamProcessingLog($data, $id, $profile_id);
            if ($exam_processing == false) {
                session()->flash('danger', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
            session()->flash('success', 'Application Move to forward for Verification');
            return redirect()->back()->refresh()->withInput();
        } catch (\Exception $e) {
            session()->flash('danger', 'Oops! Something went wrong.');
            return redirect()->back()->withInput();
        }
    }

    public function ExamProcessingLog($data, $id, $profile_id)
    {
        if (Auth::user()->mainRole()->name === 'subject_committee') {

            $data['state'] = 'subject_committee';
            $data["created_by"] = Auth::user()->id;
            $data['exam_processing_id'] = $id;
            $data['profile_id'] = $profile_id;
            if ($data['status'] === 'accepted') {
                $data['remarks'] = 'Exam Applied has been accepted by ' . ' ' . Auth::user()->name;
                $data['review_status'] = 'Successful';
            } elseif ($data['status'] === 'rejected') {
                $data['review_status'] = 'Failed';
            }
            $logs = $this->examProcessingDetailsRepository->create($data);
            if ($logs == false)
                return false;
            return true;
        } else {
            return redirect()->route('login');
        }
    }

    public function signatureImage(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;

        $subject_committee = $this->subjectCommitteeUserRepository->getAll()->where('user_id', '=', Auth::user()->id)->first();
        try {
            $profile = $this->subjectCommitteeUserRepository->update($data, $subject_committee['id']);
            if ($profile == false) {
                session()->flash('danger', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
            session()->flash('success', 'Your signature has been uploaded Successfully. ');
            return redirect()->back();
        } catch (\Exception $e) {
            session()->flash('danger', 'Oops! Something went wrong.');
            return redirect()->back()->withInput();
        }
    }


    public function moveExam()
    {
        $subject_Committee = $this->subjectCommitteeUserRepository->getAll()->where('user_id', '=', Auth::user()->id)->first();
        $subject_Committee_number = SubjectCommitteeUser::where('subjecr_committee_id', '=', $subject_Committee['subjecr_committee_id'])->get();
        $subjectCommitteeCount = 4;
        $average = $subjectCommitteeCount / 2;
        $perPage = 500;
        $datas = Profile::join('exam_registration', 'exam_registration.profile_id', '=', 'profiles.id')
            ->join('program', 'program.id', '=', 'exam_registration.program_id')
            ->join('profile_processing', 'profile_processing.profile_id', '=', 'profiles.id')
            ->where('profile_processing.current_state', 'subject_committee')
            // ->where('exam_registration.exam_id', '5')
            ->where('program.subject-committee_id', $subject_Committee['subjecr_committee_id'])
            ->where('profile_processing.status', 'progress')
            ->where('profile_processing.subject_committee_accepted_num', '>', 2)
            ->orderBy('profiles.created_at', 'ASC')
            ->paginate($perPage, ['profiles.*']);

        $data = $this->subjectCommitteeUserRepository->getAll()->where('user_id', '=', Auth::user()->id)->first();
        $subject_committee = $this->subjectCommitteeRepository->findById($data['subjecr_committee_id']);
        return view('subjectCommittee::pages.exam', compact('datas', 'subject_committee'));
    }

    public function moveExamById($id)
    {
        $exam['state'] = 'exam_committee';
        $exam['status'] = 'progress';

        $profile_processing['current_state'] = 'exam_committee';
        $profile_processing['status'] = 'progress';

        $profile['profile_state'] = 'exam_committee';
        $profile['profile_status'] = 'Reviewing';

        $exam_id = $this->examProcessingRepository->getAll()->where('profile_id', '=', $id)->first();
        $profile_processing_id = $this->profileProcessingRepository->getAll()->where('profile_id', '=', $id)->first();
        $this->profileRepository->update($profile, $id);
        $this->profileProcessingRepository->update($profile_processing, $profile_processing_id->id);
        $this->examProcessingRepository->update($exam, $exam_id->id);
        $this->ExamProcessingLog($exam, Auth::user()->id, $id);
        $this->profileLog($profile_processing);

        $data = $this->subjectCommitteeUserRepository->getAll()->where('user_id', '=', Auth::user()->id)->first();
        $subject_committee = $this->subjectCommitteeRepository->findById($data['subjecr_committee_id']);
        return redirect()->back();
    }


    public function moveExamPost()
    {
        $subject_Committee = $this->subjectCommitteeUserRepository->getAll()->where('user_id', '=', Auth::user()->id)->first();
        $subject_Committee_number = SubjectCommitteeUser::where('subjecr_committee_id', '=', $subject_Committee['subjecr_committee_id'])->get();
        $subjectCommitteeCount = 4;
        $average = $subjectCommitteeCount / 2;
        $perPage = 500;
        $datas = Profile::join('exam_registration', 'exam_registration.profile_id', '=', 'profiles.id')
            ->join('program', 'program.id', '=', 'exam_registration.program_id')
            ->join('profile_processing', 'profile_processing.profile_id', '=', 'profiles.id')
            ->where('profile_processing.current_state', 'subject_committee')
            ->where('profile_processing.status', 'progress')
            // ->where('exam_registration.exam_id', '=', '5')
            ->where('program.subject-committee_id', $subject_Committee['subjecr_committee_id'])
            ->where('profile_processing.subject_committee_accepted_num', '>=', 2)
            ->orderBy('profiles.created_at', 'ASC')
            ->paginate($perPage, ['profiles.*']);

        $exam['state'] = 'exam_committee';
        $exam['status'] = 'progress';

        $profile_processing['current_state'] = 'exam_committee';
        $profile_processing['status'] = 'progress';

        $profile['profile_state'] = 'exam_committee';
        $profile['profile_status'] = 'Reviewing';
        foreach ($datas as $data) {
            $exam_id = $this->examProcessingRepository->getAll()->where('profile_id', '=', $data->id)->first();
            $profile_processing_id = $this->profileProcessingRepository->getAll()->where('profile_id', '=', $data->id)->first();
            $this->profileRepository->update($profile, $data->id);
            $this->profileProcessingRepository->update($profile_processing, $profile_processing_id->id);
            $this->examProcessingRepository->update($exam, $exam_id->id);
            $this->ExamProcessingLog($exam, Auth::user()->id, $data->id);
            $this->profileLog($profile_processing);
        }
        $data = $this->subjectCommitteeUserRepository->getAll()->where('user_id', '=', Auth::user()->id)->first();
        $subject_committee = $this->subjectCommitteeRepository->findById($data['subjecr_committee_id']);
        return redirect()->back();
    }
    public function moveCouncil($level)
    {
        $subject_Committee = $this->subjectCommitteeUserRepository->getAll()->where('user_id', '=', Auth::user()->id)->first();
        $subject_Committee_number = SubjectCommitteeUser::where('subjecr_committee_id', '=', $subject_Committee['subjecr_committee_id'])->get();
        $subjectCommitteeCount = $subject_Committee_number->count();
        $average = 0;
        $datas = Profile::join('exam_registration', 'exam_registration.profile_id', '=', 'profiles.id')
            ->join('program', 'program.id', '=', 'exam_registration.program_id')
            ->join('profile_processing', 'profile_processing.profile_id', '=', 'profiles.id')
            ->where('profile_processing.current_state', 'subject_committee')
            ->where('profile_processing.status', 'progress')
            ->where('exam_registration.level_id', '=', 4)
            ->where('program.subject-committee_id', $subject_Committee['subjecr_committee_id'])
            ->where('profile_processing.subject_committee_accepted_num', '>=', $average)
            ->orderBy('profiles.created_at', 'ASC')
            ->get(['profiles.*'])
            ->unique('id');
        //        dd($datas);
        $data = $this->subjectCommitteeUserRepository->getAll()->where('user_id', '=', Auth::user()->id)->first();
        $subject_committee = $this->subjectCommitteeRepository->findById($data['subjecr_committee_id']);
        return view('subjectCommittee::pages.council', compact('datas', 'subject_committee'));
    }

    public function  changeState()
    {
        $data = $this->examProcessingRepository->getAll()->where('state', '=', 'exam_committee')
            ->where('status', '=', 'progress')
            ->where('level_id', '=', 4)
            //             ->where('updated_at','=','2022-07-26')
        ;
        $profile_processing['state'] = 'council';

        dd($data);
        foreach ($data as $datas) {
            //            $profile_processing_id = $this->profileProcessingRepository->getAll()->where('profile_id','=',$datas->id)->first();
            //            $this->profileProcessingRepository->update($profile_processing,$datas->id);
            $exam = $this->examProcessingRepository->update($profile_processing, $datas->id);

            dd($exam);
        }
        //        dd($data);

    }
    public function moveCouncilPost(Request $request)
    {
        $subject_Committee = $this->subjectCommitteeUserRepository->getAll()->where('user_id', '=', Auth::user()->id)->first();
        $subject_Committee_number = SubjectCommitteeUser::where('subjecr_committee_id', '=', $subject_Committee['subjecr_committee_id'])->get();
        $subjectCommitteeCount = $subject_Committee_number->count();
        $average = 0;
        $datas = Profile::join('exam_registration', 'exam_registration.profile_id', '=', 'profiles.id')
            ->join('program', 'program.id', '=', 'exam_registration.program_id')
            ->join('profile_processing', 'profile_processing.profile_id', '=', 'profiles.id')
            ->where('profile_processing.current_state', 'subject_committee')
            ->where('profile_processing.status', 'progress')
            ->where('exam_registration.level_id', '=', 4)
            ->where('program.subject-committee_id', $subject_Committee['subjecr_committee_id'])
            ->where('profile_processing.subject_committee_accepted_num', '>=', $average)
            ->orderBy('profiles.created_at', 'ASC')
            ->get(['profiles.*']);

        $exam['state'] = 'council';
        $exam['status'] = 'progress';

        $profile_processing['current_state'] = 'council';
        $profile_processing['status'] = 'progress';

        $profile['profile_state'] = 'council';
        $profile['profile_status'] = 'Reviewing';
        foreach ($datas as $data) {
            $exam_id = $this->examProcessingRepository->getAll()->where('profile_id', '=', $data->id)->first();
            $profile_processing_id = $this->profileProcessingRepository->getAll()->where('profile_id', '=', $data->id)->first();
            $this->profileRepository->update($profile, $data->id);
            $this->profileProcessingRepository->update($profile_processing, $profile_processing_id->id);
            $this->examProcessingRepository->update($exam, $exam_id->id);
            $this->ExamProcessingLog($exam, Auth::user()->id, $data->id);
            $this->profileLog($profile_processing);
        }
        $data = $this->subjectCommitteeUserRepository->getAll()->where('user_id', '=', Auth::user()->id)->first();
        $subject_committee = $this->subjectCommitteeRepository->findById($data['subjecr_committee_id']);
        return redirect()->back();
    }

    public function backSubjectCommittee()
    {
        $datas = Profile::join('exam_registration', 'exam_registration.profile_id', '=', 'profiles.id')
            ->join('program', 'program.id', '=', 'exam_registration.program_id')
            ->join('profile_processing', 'profile_processing.profile_id', '=', 'profiles.id')
            ->where('profile_processing.current_state', 'exam_committee')
            ->where('profile_processing.status', 'progress')
            ->where('profile_processing.subject_committee_accepted_num', '=', 2)
            ->orderBy('profiles.created_at', 'ASC')
            ->get(['profiles.*', 'profiles.id as profile_id']);

        $exam['state'] = 'subject_committee';
        $exam['status'] = 'progress';

        $profile_processing['current_state'] = 'subject_committee';
        $profile_processing['status'] = 'progress';

        $profile['profile_state'] = 'subject_committee';
        $profile['profile_status'] = 'Reviewing';
        foreach ($datas as $data) {
            $exam_id = $this->examProcessingRepository->getAll()->where('profile_id', '=', $data->profile_id)->first();
            $profile_processing_id = $this->profileProcessingRepository->getAll()->where('profile_id', '=', $data->profile_id)->first();
            $this->profileRepository->update($profile, $data->profile_id);
            $this->profileProcessingRepository->update($profile_processing, $profile_processing_id->id);
            $this->examProcessingRepository->update($exam, $exam_id->id);
            $this->ExamProcessingLog($exam, Auth::user()->id, $data->profile_id);
            $this->profileLog($profile_processing);
        }
        $data = $this->subjectCommitteeUserRepository->getAll()->where('user_id', '=', Auth::user()->id)->first();
        $subject_committee = $this->subjectCommitteeRepository->findById($data['subjecr_committee_id']);
        return redirect()->back();
    }

    public function rejectProfileName()
    {
        $profile_logs = $this->profileLogsRepository->getAll()
            ->where('status', '=', 'rejected');

        foreach ($profile_logs as $profile_log) {
            $user = $this->userRepository->findById($profile_log->created_by);
            $data['remarks'] = "Profile rejected by " . $user->name;
            $this->profileLogsRepository->update($data, $profile_log->id);
        }

        return redirect()->back();
    }

    public function chnageStatus()
    {
        $profiles = Profile::join('exam_registration', 'exam_registration.profile_id', '=', 'profiles.id')
            ->join('program', 'program.id', '=', 'exam_registration.program_id')
            ->join('certificate_history', 'certificate_history.profile_id', '=', 'profiles.id')
            ->join('profile_processing', 'profile_processing.profile_id', '=', 'profiles.id')
            ->where('profile_processing.current_state', 'subject_committee')
            ->where('profile_processing.status', 'progress')
            ->orderBy('profiles.created_at', 'ASC')
            ->get(['profiles.*', 'profiles.id as profile_id']);


        $data['current_state'] = 'council';
        $data['status'] = 'progress';
        $data['state'] = 'council';
        foreach ($profiles as $profile) {
            $profile_processing_id = $this->profileProcessingRepository->getAll()->where('profile_id', '=', $profile->profile_id)->first();
            $this->profileProcessingRepository->update($data, $profile_processing_id->id);
            $exam = $this->examProcessingRepository->getAll()->where('profile_id', '=', $profile->profile_id)->first();
            $this->examProcessingRepository->update($data, $exam->id);
        }
    }

    public function countSubjectCom()
    {


        // $datas = Profile::join('exam_registration', 'exam_registration.profile_id', '=', 'profiles.id')
        //     ->join('program', 'program.id', '=', 'exam_registration.program_id')
        //     ->join('profile_processing', 'profile_processing.profile_id', '=', 'profiles.id')
        //     ->where('profile_processing.current_state', 'subject_committee')
        //     ->where('profile_processing.status', 'progress')
        //     ->where('exam_registration.level_id', '<', '3')
        //     ->where('profile_processing.subject_committee_accepted_num', '>=', 2)
        //     ->orderBy('profiles.created_at', 'ASC')
        //     ->get(['profiles.*']);

        // $exam['state'] = 'exam_committee';
        // $exam['status'] = 'progress';

        // $profile_processing['current_state'] = 'exam_committee';
        // $profile_processing['status'] = 'progress';

        // $profile['profile_state'] = 'exam_committee';
        // $profile['profile_status'] = 'Reviewing';
        // foreach ($datas as $data) {
        //     $exam_id = $this->examProcessingRepository->getAll()->where('profile_id', '=', $data->id)->first();
        //     $profile_processing_id = $this->profileProcessingRepository->getAll()->where('profile_id', '=', $data->id)->first();
        //     $this->profileRepository->update($profile, $data->id);
        //     $this->profileProcessingRepository->update($profile_processing, $profile_processing_id->id);
        //     $this->examProcessingRepository->update($exam, $exam_id->id);
        //     $this->ExamProcessingLog($exam, Auth::user()->id, $data->id);
        //     $this->profileLog($profile_processing);
        // }
        // $data = $this->subjectCommitteeUserRepository->getAll()->where('user_id', '=', Auth::user()->id)->first();
        // return redirect()->back();

        $exam = $this->examProcessingRepository->getAll()->where('state', 'subject_committee')->where('status', 'progress')->where('exam_id', '!=', '6');

        foreach ($exam as $ps) {

            $this->examProcessingRepository->update(['exam_id' => 6], $ps->id);
        }

        dd($exam);

        $sub = $this->subjectCommitteeUserRepository->getAll()->where('user_id', '=', Auth::user()->id)->first();

        $data = Profile::join('profile_processing', 'profile_processing.profile_id', '=', 'profiles.id')
            ->join('exam_registration', 'exam_registration.profile_id', '=', 'profiles.id')
            ->join('program', 'program.id', '=', 'exam_registration.program_id')
            ->where('profile_processing.current_state', 'subject_committee')
            ->where('profile_processing.status', 'progress')
            ->where('profile_processing.subject_committee_accepted_num', '<=', '2')
            ->where('program.subject-committee_id', '=', $sub['subjecr_committee_id'])
            ->orderBy('profiles.created_at', 'ASC')
            // ->whereIn('exam_registration.exam_id', [5, 6])
            ->get(['profiles.id as profile_id']);

        $profiles =
            $data->chunk(100);


        foreach ($profiles as $ps) {

            foreach ($ps as $profile) {


                $logs = Profilelogs::all()->where('profile_id', '=', $profile->profile_id)
                    ->where('state', '=', 'subject_committee')
                    ->where('status', '=', 'progress')
                    ->count();
                // dd($logs);
                $profile_processing_id = $this->profileProcessingRepository->getAll()->where('profile_id', '=', $profile->profile_id)->first();
                $this->profileProcessingRepository->update(['subject_committee_accepted_num' => $logs], $profile_processing_id->id);
            }
        }



        return redirect()->back();
    }

    public function rejectedBySubjectCommittee()
    {
        $data = $this->subjectCommitteeUserRepository->getAll()->where('user_id', '=', Auth::user()->id)->first();
        $subject_committee = $this->subjectCommitteeRepository->findById($data['subjecr_committee_id']);
        $subject_Committee_id = $this->subjectCommitteeUserRepository->getAll()->where('user_id', '=', Auth::user()->id)->first();

        $datas = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
            ->join('program', 'program.id', '=', 'exam_registration.program_id')
            ->join('profile_processing', 'profile_processing.profile_id', '=', 'profiles.id')
            ->where('profile_processing.current_state', '=', 'subject_committee')
            ->where('profile_processing.status', '=', 'rejected')
            ->where('program.subject-committee_id', '=', $data['subjecr_committee_id'])
            ->get(['profiles.*', 'program.name as program_name', 'profile_processing.*', 'profiles.id as profile_id']);


        return view('subjectCommittee::pages.rejected-by-subject-committee', compact('datas'));
    }
}
