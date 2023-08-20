<?php


namespace ExamCommittee\Http\Controller;


use App\Exports\ResultExport;
use App\Exports\UsersExport;
use App\Imports\ResultImport;
use App\Models\Admin\Program;
use App\Models\AdmitCard\AdmitCard;
use App\Models\AdmitCard\ExamResult;
use App\Models\Exam\ExamProcessing;
use App\Models\SubjectCommittee\SubjectCommittee;
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
use Illuminate\Support\Facades\DB;
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
        $exams = DB::table('exam')->where('id', '>', '2')->get();

        $programs = $this->programRepository->getAll()->where('level', '!=', '4');
        $tslc = ExamProcessing::select(\DB::raw("COUNT(*) as count"), \DB::raw("program_id as program_id"), \DB::raw("status as status"), \DB::raw("state as state"))
            ->where('status', '=', 'progress')
            ->where('state', '=', 'exam_committee')
            ->where('updated_at', '>=', '2022-08-25')
            ->groupBy('program_id', 'status', 'state')
            ->orderBy('count')
            ->where('level_id', '<', 4)
            ->get();

        $count = ExamProcessing::all()->where('status', '=', 'progress')
            ->where('state', '=', 'exam_committee')
            ->where('is_admit_card_generate', '!=', 'yes')
            ->count();

        return view('examCommittee::pages.dashboard', compact('programs', 'tslc', 'count', 'exams'));
    }

    public function generateAdmitCard($status, $current_state, $program_id)
    {
        try {


            $users = $this->examProcessingRepository->getAll()->where('status', '=', $status)
                ->where('state', '=', $current_state)
                ->where('program_id', '=', $program_id)
                ->where('exam_id', '=', '6')
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
                    dd($symbol_number);
                    // $this->admitCardRepository->create($data);
                    $exam_data['is_admit_card_generate'] = 'yes';
                    $exam_data['darta_number'] = $darta;
                    // $this->examProcessingRepository->update($exam_data, $user['id']);
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
        // $now = Carbon::now();
        // $year = $now->year;
        // $year = substr($year, -2);
        $subjectCommittee = $this->programRepository->findById($program);
        $subjectCode = SubjectCommittee::where('id', $subjectCommittee['subject-committee_id'])->first();
        $month = 7;
        $level_id = str_pad($level, 2, "0", STR_PAD_LEFT);
        $program_id = str_pad($program, 2, "0", STR_PAD_LEFT);
        $num =  $month . '-' . $level_id . $program_id . str_pad($index, 3, "0", STR_PAD_LEFT) . '-' . $subjectCode['code'];
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
        $date = '2022-09-25';
        $data['state'] = 'council';
        $data['current_state'] = 'council';
        $data['isPassed'] = true;
        $passed_list = ExamResult::all()->where('status', '=', 'PASSED')->where('remarks', '=', '6');
        foreach ($passed_list as $pass) {
            $admit_card = AdmitCard::all()->where('symbol_number', '=', $pass['symbol_number']);
            foreach ($admit_card as $admit) {
                $examProcesing = $this->examProcessingRepository->update($data, $admit['exam_processing_id']);
                $profileProcessing = $this->profileRepository->update($data, $admit['profile_id']);
            }
        }
        $this->failedStudentList();

        // $this->absentStudentList();
    }
    public function absentStudentList()
    {
        $failed_list = $this->examResultRepository->getAll()->where('status', '=', 'ABSENT')->where('remarks', '=', '6');
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
        $this->failedStudentList();
    }
    public function failedStudentList()
    {
        $failed_list = $this->examResultRepository->getAll()->where('status', '=', 'FAILED')->where('remarks', '=', '6');
        $data['isPassed'] = false;
        $data['status'] = 'rejected';
        $data['attempt'] = 2;
        foreach ($failed_list as $pass) {
            $admit_card = AdmitCard::all()->where('symbol_number', '=', $pass['symbol_number']);
            foreach ($admit_card as $admit) {
                $exam = $this->examProcessingRepository->findById($admit['exam_processing_id']);
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
                ->where('exam_id', '=', 6)
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

    public function removeGeneratedAdmitCard()
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
    public function exportCsv($id)
    {
        $fileName = 'StudentSymbolNumberList.csv';

        // $tasks = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
        //     ->join('program', 'program.id', '=', 'exam_registration.program_id')
        //     ->join('level', 'level.id', '=', 'program.level_id')
        //     ->join('users', 'users.id', '=', 'profiles.user_id')
        //     ->where('exam_registration.status', '=', 'progress')
        //     ->where('exam_registration.state', '=', 'exam_committee')
        //     ->where('exam_registration.exam_id', '=', 6)
        //     ->select('profiles.citizenship_number')
        //     ->groupBy('profiles.citizenship_number')
        //     ->havingRaw('COUNT(profiles.citizenship_number) > 1')
        //     ->get();

        // // dd($duplicateCitizenshipQuery[0]);

        $tasks = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
            // ->join('exam_registration', 'exam_registration.id', '=', 'admit_card.exam_processing_id')
            ->join('program', 'program.id', '=', 'exam_registration.program_id')
            ->join('level', 'level.id', '=', 'program.level_id')
            ->join('users', 'users.id', '=', 'profiles.user_id')
            ->where('exam_registration.status', '=', 'progress')
            ->where('exam_registration.state', '=', 'exam_committee')
            ->where('exam_registration.exam_id', '=', 6)

            // ->where('exam_registration.exam_id', '=', $id)
            // ->where('admit_card.created_at', 'Like', '%' . '2023-02-03' . '%')
            ->get(['level.name as level_name',  'profiles.*', 'program.*', 'users.email as email', 'users.phone_number as phone_number']);

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array(
            'registration_id', 'created_at', 'updated_at', 'deleted_at', 'created_by', 'update_by', 'deleted_by',
            'first_name',
            'middle_name',
            'last_name',
            'symbol_number', 'gender', 'program', 'level', 'photo_link',
            'barcode', 'exam_center', 'vdc_municipality_english', 'phone_id', 'DOB', 'year_dob_nepali_data', 'month_dob_nepali_data',
            'day_dob_nepali_data', 'student_signature', 'collage', 'webcam', 'thumb', 'thumb2', 'email',
            'phone_no', 'result', 'percentage', 'year', 'month'
        );

        $callback = function () use ($tasks, $columns) {

            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            foreach ($tasks as $task) {
                $row['registration_id'] = $task->citizenship_number;
                $row['created_at'] = "2023-02-03 09:51:53";
                $row['updated_at'] = "2023-02-03 09:51:53";
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


    public function examDetails($id)
    {
        $appliedCount = ExamProcessing::all()->where('exam_id', '=', $id)->where('level_id', '<=', 3)->where('state', '=', 'exam_committee')->where('status', '=', 'progress');
        $passedCount = ExamProcessing::all()->where('exam_id', '=', $id)->where('level_id', '!=', '4')->where('state', '=', 'council');
        $failedCount = ExamProcessing::all()->where('exam_id', '=', $id)->where('level_id', '!=', '4')->where('state', '=', 'exam_committee')->where('status', '=', 'rejected');


        $levelWiseCount = $appliedCount->groupBy('level_id')->map->count();
        $programWiseCount = $appliedCount->groupBy('program_id')->map->count();

        $admitCardGeneratedCount = ExamProcessing::all()->where('exam_id', '=', $id)->where('is_admit_card_generate', '=', 'yes')->count();
        return view('examCommittee::pages.exam.show', compact(
            'appliedCount',
            'levelWiseCount',
            'programWiseCount',
            'id',
            'admitCardGeneratedCount',
            'passedCount',
            'failedCount'
        ));
    }

    public function exportAllExamCommitteeStudent($id)
    {

        $fileName = 'StudentDetail.csv';
        $query =  ExamProcessing::query()
            ->join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
            ->join('level', 'level.id', '=', 'exam_registration.level_id')
            ->join('users', 'users.id', '=', 'profiles.user_id')
            // ->where('exam_registration.created_at', '>', '2023-04-06')
            // ->where('exam_registration.created_at', '<', '2023-04-29')
            ->where('exam_registration.status', '=', 'progress')
            ->where('exam_registration.state', '=', 'exam_committee')
            ->where('exam_registration.exam_id', '=', 6);
        // ->where('exam_registration.status', '=', 'progress')
        // ->where('exam_registration.is_admit_card_generate', '=', 'no');

        $tasks = $query->get(['level.name as level_name', 'profiles.*', 'users.email as email', 'users.phone_number as phone_number', 'exam_registration.*', 'exam_registration.id as exam_regisration_id', 'profiles.id as profile_id', 'exam_registration.state as exam_state', 'exam_registration.status as exam_status']);

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array(
            'id', 'Name', 'Father Name', 'Mother Name', 'Date of Birth',
            'Gender', 'Citizenship', 'Program Name', 'Level', 'Email', 'Phone Number', 'State', 'Status', 'Symbol Number'
        );
        // dd($tasks);

        $callback = function () use ($tasks, $columns) {

            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            foreach ($tasks as $task) {
                $row['id'] = $task->profile_id;
                $row['Name'] = $task->first_name . ' ' . $task->middle_name . '' . $task->last_name;
                $row['Father Name'] = $task->father_name;
                $row['Mother Name'] = $task->mother_name;
                $row['Date of Birth'] = $task->dob_nep;
                // $row['Gender'] = $task->sex;
                // $row['Citizenship'] = $task->citizenship_number;
                $row['program_name'] = getProgramName($task->program_id);
                // $row['Level'] = $task->level_name;
                // $row['Email'] = $task->email;
                // $row['Phone Number'] = $task->phone_number;
                $row['State'] = $task->exam_state;
                $row['Status'] = $task->exam_status;




                fputcsv($file, array(
                    $row['id'],
                    $row['Name'],
                    $row['Father Name'],
                    $row['Mother Name'],
                    $row['Date of Birth'],
                    // $row['Gender'],
                    // $row['Citizenship'],
                    $row['program_name'],
                    // $row['Level'],
                    // $row['Email'],
                    // $row['Phone Number'],
                    $row['State'],
                    $row['Status'],
                    // $row['Symbol Number']
                ));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);


        // $fileName = 'StudentSymbolNumberList.csv';

        // $tasks = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
        //     ->join('program', 'program.id', '=', 'exam_registration.program_id')
        //     ->join('level', 'level.id', '=', 'program.level_id')
        //     ->join('users', 'users.id', '=', 'profiles.user_id')
        //     ->where('exam_registration.status', '=', 'progress')
        //     ->where('exam_registration.exam_id', '=', $id)
        //     ->get(['level.name as level_name',  'profiles.*', 'program.*', 'users.email as email', 'users.phone_number as phone_number']);


        // $headers = array(
        //     "Content-type"        => "text/csv",
        //     "Content-Disposition" => "attachment; filename=$fileName",
        //     "Pragma"              => "no-cache",
        //     "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
        //     "Expires"             => "0"
        // );

        // $columns = array(
        //     'registration_id', 'created_at', 'updated_at', 'deleted_at', 'created_by', 'update_by', 'deleted_by',
        //     'first_name',
        //     'middle_name',
        //     'last_name',
        //     'gender', 'program', 'level', 'photo_link',
        //     'barcode', 'exam_center', 'vdc_municipality_english', 'phone_id', 'DOB', 'year_dob_nepali_data', 'month_dob_nepali_data',
        //     'day_dob_nepali_data', 'student_signature', 'collage', 'webcam', 'thumb', 'thumb2', 'email',
        //     'phone_no', 'result', 'percentage', 'year', 'month'
        // );



        // $callback = function () use ($tasks, $columns) {
        //     $file = fopen('php://output', 'w');
        //     fputcsv($file, $columns);
        //     foreach ($tasks as $task) {
        //         $row['registration_id'] = $task->profile_id;
        //         $row['created_at'] = "2023-02-03 09:51:53";
        //         $row['updated_at'] = "2023-02-03 09:51:53";
        //         $row['deleted_at'] = null;
        //         $row['created_by'] = 1;
        //         $row['updated_by'] = 1;
        //         $row['deleted_by'] = 0;
        //         $row['first_name']  = $task->first_name;
        //         $row['middle_name']  =  $task->middle_name;
        //         $row['last_name']  = $task->last_name;
        //         $row['gender']    = $task->sex;
        //         $row['program']  = $task->name;
        //         $row['level'] = $task->level_name;
        //         $row['photo_link'] = 'http://103.175.192.52/storage/documents/' . $task->profile_picture;
        //         $row['bar_code'] = null;
        //         $row['exam_center'] = null;
        //         $row['vdc'] = $task->vdc_municiplality;
        //         $row['phone_id'] = null;
        //         $row['dob']    = null;
        //         $row['year_dob_nepali_data'] = null;
        //         $row['month_dob_nepali_data'] = null;
        //         $row['day_dob_nepali_data'] = null;
        //         $row['student_signature'] = null;
        //         $row['collage'] = null;
        //         $row['webcam'] = null;
        //         $row['thumb'] = null;
        //         $row['thumb2'] = null;
        //         $row['email'] = $task->email;
        //         $row['phone_no'] = $task->phone_number;
        //         $row['result'] = null;
        //         $row['percentage'] = null;
        //         $row['year'] = null;
        //         $row['month'] = null;


        //         fputcsv($file, array(
        //             $row['registration_id'],
        //             $row['created_at'],
        //             $row['updated_at'],
        //             $row['deleted_at'],
        //             $row['created_by'],
        //             $row['updated_by'],
        //             $row['deleted_by'],
        //             $row['first_name'],
        //             $row['middle_name'],
        //             $row['last_name'],
        //             $row['gender'],
        //             $row['program'],
        //             $row['level'],
        //             $row['photo_link'],
        //             $row['bar_code'],
        //             $row['exam_center'],
        //             $row['vdc'],
        //             $row['phone_id'],
        //             $row['dob'],
        //             $row['year_dob_nepali_data'],
        //             $row['month_dob_nepali_data'],
        //             $row['day_dob_nepali_data'],
        //             $row['student_signature'],
        //             $row['collage'],
        //             $row['webcam'],
        //             $row['thumb'],
        //             $row['thumb2'],
        //             $row['email'],
        //             $row['phone_no'],
        //             $row['result'],
        //             $row['percentage'],
        //             $row['year'],
        //             $row['month']
        //         ));
        //     }

        //     fclose($file);
        // };

        // return response()->stream($callback, 200, $headers);
    }

    public function getAllStudentList()
    {

        $exams = ExamProcessing::all()->where('state', '=', 'exam_committee')->where('status', '=', 'progress')->where('is_admit_card_generate', '=', 'yes')->where('exam_id', '=', '6');
        dd($exams);
        foreach ($exams as $exam) {
            $data['exam_id'] = 5;
            $this->examProcessingRepository->update($data, $exam->id);
        }

        // $fileName = 'StudentDetail.csv';
        // $query =  ExamProcessing::query()
        //     ->join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
        //     ->where('level_id', '<=', 3)
        //     ->where('exam_id', '=', '6')
        //     ->join('level', 'level.id', '=', 'exam_registration.level_id')
        //     ->join('users', 'users.id', '=', 'profiles.user_id')
        //     ->where('exam_registration.state', '=', 'exam_committee')
        //     ->where('exam_registration.status', '=', 'progress');

        // $tasks = $query->get(['level.name as level_name', 'profiles.*', 'users.email as email', 'users.phone_number as phone_number', 'exam_registration.*', 'exam_registration.id as exam_regisration_id']);;

        // $headers = array(
        //     "Content-type"        => "text/csv",
        //     "Content-Disposition" => "attachment; filename=$fileName",
        //     "Pragma"              => "no-cache",
        //     "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
        //     "Expires"             => "0"
        // );

        // $columns = array(
        //     'Name', 'Father Name', 'Mother Name', 'Date of Birth',
        //     'Gender', 'Citizenship', 'Program Name', 'Level', 'Email', 'Phone Number', 'State', 'Status', 'Symbol Number'
        // );

        // $callback = function () use ($tasks, $columns) {

        //     $file = fopen('php://output', 'w');
        //     fputcsv($file, $columns);
        //     foreach ($tasks as $task) {
        //         $row['Name'] = $task->first_name . ' ' . $task->middle_name . '' . $task->last_name;
        //         $row['Father Name'] = $task->father_name;
        //         $row['Mother Name'] = $task->mother_name;
        //         $row['Date of Birth'] = $task->dob_nep;
        //         $row['Gender'] = $task->sex;
        //         $row['Citizenship'] = $task->citizenship_number;
        //         $row['program_name'] = getProgramName($task->program_id);
        //         $row['Level'] = $task->level_name;
        //         $row['Email'] = $task->email;
        //         $row['Phone Number'] = $task->phone_number;
        //         $row['State'] = $task->state;
        //         $row['Status'] = $task->status;
        //         $row['Symbol Number'] = getSymbolNo($task->exam_regisration_id);




        //         fputcsv($file, array(
        //             $row['Name'],
        //             $row['Father Name'],
        //             $row['Mother Name'],
        //             $row['Date of Birth'],
        //             $row['Gender'],
        //             $row['Citizenship'],
        //             $row['program_name'],
        //             $row['Level'],
        //             $row['Email'],
        //             $row['Phone Number'],
        //             $row['State'],
        //             $row['Status'],
        //             $row['Symbol Number']
        //         ));
        //     }

        //     fclose($file);
        // };

        // return response()->stream($callback, 200, $headers);
    }


    public function subjectCommitteeDashboardList(Request $request, $level = 1, $status = "progress", $subject_commitee_id = 1, $page = 0)
    {
        $take = 20;
        $data = $request->all();
        if ($data != null) {
            if ($data['level_id'] != null)
                $level = $data['level_id'];
            if ($data['status'] != null)
                $status = $data['status'];
        }
        $datas = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
            ->where('exam_registration.level_id', '=', $level)
            ->join('program', 'program.id', '=', 'exam_registration.program_id')
            ->join('profile_processing', 'profile_processing.profile_id', '=', 'profiles.id')
            ->where('profile_processing.current_state', '=', 'subject_committee')
            ->where('profile_processing.status', '=', $status)
            ->where('program.subject-committee_id', '=', $subject_commitee_id)
            ->skip($page * $take)
            ->take($take)
            ->get(['profiles.*', 'program.name as program_name', 'profile_processing.*', 'profiles.id as profile_id']);
        $page = (int)$page;


        return view('examCommittee::pages.subjectCommiteeList', compact('datas', 'level', 'status', 'subject_commitee_id', 'page'));
    }

    public function subjectCommitteeDashboard()
    {
        $examApplied = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
            ->where('exam_registration.level_id', '<', '4')
            ->join('program', 'program.id', '=', 'exam_registration.program_id')
            ->join('profile_processing', 'profile_processing.profile_id', '=', 'profiles.id')
            ->where('profile_processing.current_state', '=', 'subject_committee')
            ->where('program.subject-committee_id', '=', '1')
            ->count(['profiles.id']);

        $GM = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
            ->where('exam_registration.level_id', '<', '4')
            ->join('program', 'program.id', '=', 'exam_registration.program_id')
            ->join('profile_processing', 'profile_processing.profile_id', '=', 'profiles.id')
            ->where('profile_processing.current_state', '=', 'subject_committee')
            ->where('program.subject-committee_id', '=', '2')
            ->count(['profiles.id']);

        $lM = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
            ->where('exam_registration.level_id', '<', '4')
            ->join('program', 'program.id', '=', 'exam_registration.program_id')
            ->join('profile_processing', 'profile_processing.profile_id', '=', 'profiles.id')
            ->where('profile_processing.current_state', '=', 'subject_committee')
            ->where('program.subject-committee_id', '=', '3')
            ->count(['profiles.id']);

        $radio = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
            ->where('exam_registration.level_id', '<', '4')
            ->join('program', 'program.id', '=', 'exam_registration.program_id')
            ->join('profile_processing', 'profile_processing.profile_id', '=', 'profiles.id')
            ->where('profile_processing.current_state', '=', 'subject_committee')
            ->where('program.subject-committee_id', '=', '4')
            ->count(['profiles.id']);

        $opt = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
            ->where('exam_registration.level_id', '<', '4')
            ->join('program', 'program.id', '=', 'exam_registration.program_id')
            ->join('profile_processing', 'profile_processing.profile_id', '=', 'profiles.id')
            ->where('profile_processing.current_state', '=', 'subject_committee')
            ->where('program.subject-committee_id', '=', '5')
            ->count(['profiles.id']);

        $den = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
            ->where('exam_registration.level_id', '<', '4')
            ->join('program', 'program.id', '=', 'exam_registration.program_id')
            ->join('profile_processing', 'profile_processing.profile_id', '=', 'profiles.id')
            ->where('profile_processing.current_state', '=', 'subject_committee')
            ->where('program.subject-committee_id', '=', '6')
            ->count(['profiles.id']);

        $phy = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
            ->where('exam_registration.level_id', '<', '4')
            ->join('program', 'program.id', '=', 'exam_registration.program_id')
            ->join('profile_processing', 'profile_processing.profile_id', '=', 'profiles.id')
            ->where('profile_processing.current_state', '=', 'subject_committee')
            ->where('program.subject-committee_id', '=', '7')
            ->count(['profiles.id']);

        $mis = ExamProcessing::join('profiles', 'profiles.id', '=', 'exam_registration.profile_id')
            ->where('exam_registration.level_id', '<', '4')
            ->join('program', 'program.id', '=', 'exam_registration.program_id')
            ->join('profile_processing', 'profile_processing.profile_id', '=', 'profiles.id')
            ->where('profile_processing.current_state', '=', 'subject_committee')
            ->where('program.subject-committee_id', '=', '8')
            ->count(['profiles.id']);

        return view('examCommittee::pages.subjectCommittee', compact('examApplied', 'GM', 'lM', 'radio', 'opt', 'den', 'phy', 'mis'));
    }
}
