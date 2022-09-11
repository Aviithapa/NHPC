<?php


namespace ExamCommittee\Http\Controller;


use App\Exports\ResultExport;
use App\Exports\UsersExport;
use App\Imports\ResultImport;
use App\Models\Admin\Program;
use App\Models\AdmitCard\AdmitCard;
use App\Models\Exam\ExamProcessing;
use App\Modules\Backend\Admin\Program\Repositories\ProgramRepository;
use App\Modules\Backend\AdmitCard\Repositories\AdmitCardRepository;
use App\Modules\Backend\Authentication\User\Repositories\UserRepository;
use App\Modules\Backend\Exam\Exam\Repositories\ExamRepository;
use App\Modules\Backend\Exam\ExamProcessing\Repositories\ExamProcessingRepository;
use App\Modules\Backend\Profile\Profilelogs\Repositories\ProfileLogsRepository;
use App\Modules\Backend\Profile\ProfileProcessing\Repositories\ProfileProcessingRepository;
use App\Modules\Backend\Result\Repositories\ExamResultRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Operator\Modules\Framework\Request;
use Student\Modules\Profile\Repositories\ProfileRepository;
use Student\Modules\Qualification\Repositories\QualificationRepository;
use function Livewire\str;

class  ExamCommitteeController extends BaseController
{
    private  $log, $profileProcessing,
        $profileRepository, $userRepository,
        $qualificationRepository, $user_data,
        $profileLogsRepository, $profileProcessingRepository,
        $examRepository, $examProcessingRepository, $admitCardRepository, $examResultRepository, $programRepository;
    private $viewData, $exam_processing;

    /**
     * PermissionController constructor.
     * @param ProfileRepository $profileRepository
     * @param UserRepository $userRepository
     * @param QualificationRepository $qualificationRepository
     * @param ProfileLogsRepository $profileLogsRepository
     * @param ProfileProcessingRepository $profileProcessingRepository
     * @param ExamRepository $examRepository
     * @param ExamProcessingRepository $examProcessingRepository
     * @param AdmitCardRepository $admitCardRepository
     * @param ExamResultRepository $examResultRepository
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
        AdmitCardRepository $admitCardRepository,
        ExamResultRepository $examResultRepository,
        ProgramRepository $programRepository
    ) {
        $this->profileRepository = $profileRepository;
        $this->userRepository = $userRepository;
        $this->qualificationRepository = $qualificationRepository;
        $this->profileLogsRepository = $profileLogsRepository;
        $this->profileProcessingRepository = $profileProcessingRepository;
        $this->examRepository = $examRepository;
        $this->examProcessingRepository = $examProcessingRepository;
        $this->admitCardRepository = $admitCardRepository;
        $this->examResultRepository = $examResultRepository;
        $this->programRepository = $programRepository;
        parent::__construct();
    }

    public function index()
    {
        $programs = $this->programRepository->getAll()->where('level', '!=', '4');
        $tslc = ExamProcessing::select(\DB::raw("COUNT(*) as count"), \DB::raw("program_id as program_id"), \DB::raw("status as status"), \DB::raw("state as state"))
            ->where('status', '=', 'progress')
            ->where('state', '=', 'exam_committee')
            ->where('updated_at', '>=', '2022-09-10')
            ->groupBy('program_id', 'status', 'state')
            ->orderBy('count')
            ->where('level_id', '<', 4)
            ->get();

        $count = ExamProcessing::all()->where('status', '=', 'progress')
            ->where('state', '=', 'exam_committee')
            ->where('is_admit_card_generate', '!=', 'yes')
            ->count();

        return view('examCommittee::pages.dashboard', compact('programs', 'tslc', 'count'));
    }

    public function generateAdmitCard($status, $current_state, $program_id)
    {
        try {


            $users = $this->examProcessingRepository->getAll()->where('status', '=', $status)
                ->where('state', '=', $current_state)
                ->where('program_id', '=', $program_id)
                ->where('is_admit_card_generate', '!=', 'yes');
            if ($users->isEmpty()) {
                session()->flash('success', 'Admit Card Already Been Generated');
                return redirect()->back()->withInput();
            } else {
                $i = 1;
                $index = ExamProcessing::orderBy('darta_number', 'desc')->first();
                $darta_number = $index['darta_number'];
                foreach ($users as $user) {
                    $index = $i++;
                    $darta = ++$darta_number;
                    $data['profile_id'] = $user['profile_id'];
                    $data['exam_processing_id'] = $user['id'];
                    $symbol_number =  $this->generateSymbolNumber($index, $user['level_id'], $program_id);
                    $data['symbol_number'] = $symbol_number;
                    $data['created_by'] = Auth::user()->id;
                    $this->admitCardRepository->create($data);
                    $exam_data['is_admit_card_generate'] = 'yes';
                    $exam_data['darta_number'] = $darta;
                    $this->examProcessingRepository->update($exam_data, $user['id']);
                }
                session()->flash('success', 'Admit Card Successfully Generated');
                return redirect()->back()->withInput();
            }
        } catch (Exception $e) {
            session()->flash('success', 'Admit Card Successfully Generated');


            return redirect()->back()->withInput();
        }
    }

    public function generateSymbolNumber($index, $level, $program)
    {
        $now = Carbon::now();
        $year = $now->year;
        $year = substr($year, -2);
        $month = $now->format('m');
        $level_id = str_pad($level, 2, "0", STR_PAD_LEFT);
        $program_id = str_pad($program, 2, "0", STR_PAD_LEFT);
        $num = $year . $month . $level_id . $program_id . str_pad($index, 3, "0", STR_PAD_LEFT);
        return $num;
    }

    public function admit($status, $current_state)
    {
        if (Auth::user()->mainRole()->name === 'exam_committee') {
            $users = $this->examProcessingRepository->getAll()->where('status', '=', $status)
                ->where('state', '=', $current_state)
                ->where('level_id', '<', 4)
                ->where('is_admit_card_generate', '!=', 'yes');
            return $this->view('pages.application-list', $users);
        } else {
            return redirect()->route('login');
        }
    }

    public function viewAdmitCardDetails($id)
    {
        if (Auth::user()->mainRole()->name === 'exam_committee') {

            $admitcard = $this->admitCardRepository->getAll()->where('exam_processing_id', '=', $id)->first();

            $profileDetails = $this->profileRepository->findById($admitcard['profile_id']);
            $exam = $this->examProcessingRepository->findById($admitcard['exam_processing_id']);

            return \view('examCommittee::pages.view-admit-card', compact('admitcard', 'profileDetails', 'exam'));
        } else {
            return redirect()->to('login');
        }
    }

    public function fileImport(Request $request)
    {
        Excel::import(new ResultImport(), $request->file('file')->store('temp'));
        $this->FileForwardCouncil();

        return back();
    }

    public function FileForwardCouncil()
    {
        $passed_list = $this->examResultRepository->getAll()->where('status', '=', 'PASSED');
        foreach ($passed_list as $pass) {
            $admit_card = AdmitCard::all()->where('symbol_number', '=', $pass['symbol_number']);
            foreach ($admit_card as $admit) {
                $data['state'] = 'council';
                $data['current_state'] = 'council';
                $data['isPassed'] = true;
                $examProcesing = $this->examProcessingRepository->update($data, $admit['exam_processing_id']);
                $profileProcessing = $this->profileRepository->update($data, $admit['profile_id']);
            }
        }
        $this->failedStudentList();
    }

    public function failedStudentList()
    {
        $failed_list = $this->examResultRepository->getAll()->where('status', '!=', 'PASSED');
        foreach ($failed_list as $pass) {
            $admit_card = AdmitCard::all()->where('symbol_number', '=', $pass['symbol_number']);
            foreach ($admit_card as $admit) {
                $exam = $this->examProcessingRepository->findById($admit['exam_processing_id']);
                $data['isPassed'] = false;
                $data['status'] = 'rejected';
                $data['attempt'] = 2;
                $examProcesing = $this->examProcessingRepository->update($data, $admit['exam_processing_id']);
            }
        }
        session()->flash('success', 'Passed Student has been forwarded to council and failed student to operator');
        return redirect()->back()->withInput();
    }

    /**
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function fileExport()
    {
        $fileName = 'tasks.csv';
        $tasks = AdmitCard::all();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Title', 'Assign', 'Description', 'Start Date', 'Due Date');

        $callback = function () use ($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tasks as $task) {
                $row['Title']  = $task->title;
                $row['Assign']    = $task->assign->name;
                $row['Description']    = $task->description;
                $row['Start Date']  = $task->start_at;
                $row['Due Date']  = $task->end_at;

                fputcsv($file, array($row['Title'], $row['Assign'], $row['Description'], $row['Start Date'], $row['Due Date']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
        //        return Excel::download(new ResultExport(), 'users-collection.xlsx');
    }

    public function programWiseStudent($id)
    {
        if (Auth::user()->mainRole()->name === 'exam_committee') {
            $data = ExamProcessing::all()->where('status', '=', 'progress')
                ->where('state', '=', 'exam_committee')
                ->where('program_id', '=', $id)
                ->where('status', '!=', 'rejected')
                ->where('attempt', '=', 1);


            return view('examCommittee::pages.program-wise-application-list', compact('data', 'id'));
        } else {
            return redirect()->route('login');
        }
    }

    public function admitCardGeneratedStudent()
    {
        if (Auth::user()->mainRole()->name === 'exam_committee') {
            $users = $this->examProcessingRepository->getAll()->where('status', '=', 'progress')
                ->where('state', '=', 'exam_committee')
                ->where('is_admit_card_generate', '=', 'yes');
            return $this->view('pages.admit-card-generated-list', $users);
        } else {
            return redirect()->route('login');
        }
    }


    public function removeFlagGeneratedYes()
    {
        if (Auth::user()->mainRole()->name === 'exam_committee') {
            $users = $this->examProcessingRepository->getAll()->where('status', '=', 'progress')
                ->where('state', '=', 'exam_committee')
                ->where('is_admit_card_generate', '=', 'yes');

            foreach ($users as $user) {
                $data['is_admit_card_generate'] = 'no';
                $this->examProcessingRepository->update($data, $user->id);
            }
            return $this->view('pages.admit-card-generated-list', $users);
        } else {
            return redirect()->route('login');
        }
    }

    public function removeGeneratedAdmitCard(){

        if (Auth::user()->mainRole()->name === 'exam_committee') {
            $users = $this->examProcessingRepository->getAll()->where('status', '=', 'progress')
                ->where('state', '=', 'exam_committee')
                ->where('is_admit_card_generate', '=', 'yes');

            foreach ($users as $user) {
                $data['is_admit_card_generate'] = 'no';
                $this->examProcessingRepository->update($data, $user->id);
            }
            return $this->view('pages.admit-card-generated-list', $users);
        } else {
            return redirect()->route('login');
        }
    }
    public function exportCsv(Request $request)
    {
        $fileName = 'StudentSymbolNumberList.csv';

        $tasks = AdmitCard::join('profiles', 'profiles.id', '=', 'admit_card.profile_id')
            ->join('exam_registration', 'exam_registration.id', '=', 'admit_card.exam_processing_id')
            ->join('program', 'program.id', '=', 'exam_registration.program_id')
            ->join('level', 'level.id', '=', 'program.level_id')
            ->join('users', 'users.id', '=', 'profiles.user_id')
            ->where('exam_registration.updated_at', '>=', '2022-09-10')
            ->get(['level.name as level_name', 'admit_card.*', 'profiles.*', 'program.*', 'users.email as email', 'users.phone_number as phone_number']);

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array(
            'registration_id', 'created_at', 'updated_at', 'deleted_at', 'created_by', 'update_by', 'deleted_by',
            'first_name', 'middle_name', 'last_name',  'symbol_number', 'gender', 'program', 'level', 'photo_link',
            'barcode', 'exam_center', 'vdc_municipality_english', 'phone_id', 'DOB', 'year_dob_nepali_data', 'month_dob_nepali_data',
            'day_dob_nepali_data', 'student_signature', 'collage', 'webcam', 'thumb', 'thumb2', 'email',
            'phone_no', 'result', 'percentage', 'year', 'month'
        );

        $callback = function () use ($tasks, $columns) {

            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            foreach ($tasks as $task) {
                $row['registration_id'] = $task->profile_id;
                $row['created_at'] = "2021-12-21 09:51:53";
                $row['updated_at'] = "2021-12-21 09:51:53";
                $row['deleted_at'] = null;
                $row['created_by'] = 1;
                $row['updated_by'] = 1;
                $row['deleted_by'] = 0;
                $row['first_name']  = $task->first_name;
                $row['middle_name']  =  $task->middle_name;
                $row['last_name']  = $task->last_name;
                $row['symbol']    = $task->symbol_number;
                $row['gender']    = $task->sex;
                $row['program']  = $task->name;
                $row['level'] = $task->level_name;
                $row['photo_link'] = 'http://103.175.192.52/storage/documents/' . $task->profile_picture;
                $row['bar_code'] = null;
                $row['exam_center'] = null;
                $row['vdc'] = $task->vdc_municiplality;
                $row['phone_id'] = null;
                $row['dob']    = $task->dob_nep;
                $row['year_dob_nepali_data'] = null;
                $row['month_dob_nepali_data'] = null;
                $row['day_dob_nepali_data'] = null;
                $row['student_signature'] = null;
                $row['collage'] = null;
                $row['webcam'] = null;
                $row['thumb'] = null;
                $row['thumb2'] = null;
                $row['email'] = $task->email;
                $row['phone_no'] = $task->phone_number;
                $row['result'] = null;
                $row['percentage'] = null;
                $row['year'] = null;
                $row['month'] = null;


                fputcsv($file, array(
                    $row['registration_id'],
                    $row['created_at'],
                    $row['updated_at'],
                    $row['deleted_at'],
                    $row['created_by'],
                    $row['updated_by'],
                    $row['deleted_by'],
                    $row['first_name'],
                    $row['middle_name'],
                    $row['last_name'],
                    $row['symbol'],
                    $row['gender'],
                    $row['program'],
                    $row['level'],
                    $row['photo_link'],
                    $row['bar_code'],
                    $row['exam_center'],
                    $row['vdc'],
                    $row['phone_id'],
                    $row['dob'],
                    $row['year_dob_nepali_data'],
                    $row['month_dob_nepali_data'],
                    $row['day_dob_nepali_data'],
                    $row['student_signature'],
                    $row['collage'],
                    $row['webcam'],
                    $row['thumb'],
                    $row['thumb2'],
                    $row['email'],
                    $row['phone_no'],
                    $row['result'],
                    $row['percentage'],
                    $row['year'],
                    $row['month']
                ));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
