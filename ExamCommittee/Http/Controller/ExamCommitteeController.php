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
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Operator\Modules\Framework\Request;
use Student\Modules\Profile\Repositories\ProfileRepository;
use Student\Modules\Qualification\Repositories\QualificationRepository;
use function Livewire\str;

class  ExamCommitteeController extends BaseController
{
    private  $log,$profileProcessing,
        $profileRepository, $userRepository,
        $qualificationRepository,$user_data,
        $profileLogsRepository,$profileProcessingRepository,
        $examRepository,$examProcessingRepository,$admitCardRepository,$examResultRepository, $programRepository;
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

    public function __construct(ProfileRepository $profileRepository, UserRepository $userRepository, QualificationRepository $qualificationRepository,
                                ProfileLogsRepository $profileLogsRepository, ProfileProcessingRepository $profileProcessingRepository,
                                ExamRepository $examRepository,ExamProcessingRepository $examProcessingRepository,
                                AdmitCardRepository $admitCardRepository, ExamResultRepository $examResultRepository, ProgramRepository $programRepository)
    {
        $this->profileRepository=$profileRepository;
        $this->userRepository=$userRepository;
        $this->qualificationRepository=$qualificationRepository;
        $this->profileLogsRepository = $profileLogsRepository;
        $this->profileProcessingRepository = $profileProcessingRepository;
        $this->examRepository=$examRepository;
        $this->examProcessingRepository=$examProcessingRepository;
        $this->admitCardRepository=$admitCardRepository;
        $this->examResultRepository=$examResultRepository;
        $this->programRepository = $programRepository;
        parent::__construct();
    }

    public function index() {
        $programs = $this->programRepository->getAll()->where('level','!=','4');
        $tslc = ExamProcessing::select(\DB::raw("COUNT(*) as count"), \DB::raw("program_id as program_id"), \DB::raw("status as status"), \DB::raw("state as state"))
            ->where('status','=','progress')
            ->where('state','=','exam_committee')
            ->groupBy('program_id','status','state')
            ->orderBy('count')
            ->where('level_id', '<', 4)
            ->get();
        return view('examCommittee::pages.dashboard',compact('programs','tslc'));
    }

    public function generateAdmitCard($status,$current_state, $program_id){
        $users = $this->examProcessingRepository->getAll()->where('status' ,'=',$status)
            ->where('state','=',$current_state)
//            ->where('level_id', '<', 4)
            ->where('program_id','=',$program_id)
            ->where('is_admit_card_generate', '!=' ,'yes');
        if ($users->isEmpty()){
            session()->flash('success','Admit Card Already Been Generated');
            return redirect()->back()->withInput();
        }else {
            $i = 1;
            $index = ExamProcessing::orderBy('darta_number', 'desc')->first();
            $darta_number = $index['darta_number'];
            foreach ($users as $user) {
                $index = $i++;
                $darta = ++$darta_number;
                $data['profile_id'] = $user['profile_id'];
                $data['exam_processing_id'] = $user['id'];
                $data['symbol_number'] = $this->generateSymbolNumber($index,$user['level_id'],$user['program_id']);
                $data['created_by'] = Auth::user()->id;
                $this->admitCardRepository->create($data);
                $exam_data['is_admit_card_generate'] = 'yes';
                $exam_data['darta_number'] = $darta;
                $this->examProcessingRepository->update($exam_data, $user['id']);
            }
            session()->flash('success', 'Admit Card Successfully Generated');
            return redirect()->back()->withInput();
        }
    }

    public function generateSymbolNumber($index,$level,$program){
        $now = Carbon::now();
        $year = $now->year;
        $year = substr( $year, -2);
        $month = $now->format('m');
        $level_id =str_pad($level,2,"0",STR_PAD_LEFT);
        $program_id =str_pad($program,2,"0",STR_PAD_LEFT);
        $num =$year.$month.$level_id.$program_id.str_pad($index, 3, "0", STR_PAD_LEFT);
        return $num;
    }

    public function admit($status, $current_state)
    {
        if (Auth::user()->mainRole()->name === 'exam_committee') {
            $users = $this->examProcessingRepository->getAll()->where('status', '=', $status)
                ->where('state', '=', $current_state)
                ->where('level_id', '<', 4)
                ->where('is_admit_card_generate', '!=' ,'yes');
            return $this->view('pages.application-list', $users);
        }else{
            return redirect()->route('login');
        }
    }

    public function viewAdmitCardDetails($id){
        if (Auth::user()->mainRole()->name === 'exam_committee') {

            $admitcard = $this->admitCardRepository->getAll()->where('exam_processing_id', '=', $id)->first();
            $profileDetails = $this->profileRepository->findById($admitcard['profile_id']);
            $exam = $this->examProcessingRepository->findById($admitcard['exam_processing_id']);

            return \view('examCommittee::pages.view-admit-card', compact('admitcard', 'profileDetails', 'exam'));
        }else{
            return redirect()->to('login');
        }
    }

    public function fileImport(Request $request)
    {
        Excel::import(new ResultImport(), $request->file('file')->store('temp'));
        $this->FileForwardCouncil();
        return back();
    }

    public function FileForwardCouncil(){
        $passed_list = $this->examResultRepository->getAll()->where('status','=','pass');
        foreach ($passed_list as $pass){
            $admit_card = AdmitCard::all()->where('symbol_number','=', $pass['symbol_number']);
            foreach ($admit_card as $admit){
                   $data['state'] = 'council';
                   $examProcesing = $this->examProcessingRepository->update($data,$admit['exam_processing_id']);
            }
        }
        session()->flash('success', 'Passed Student has been forwarded to council');
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

        $callback = function() use($tasks, $columns) {
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

    public function programWiseStudent($id){
        if (Auth::user()->mainRole()->name === 'exam_committee') {
            $data = $this->examProcessingRepository->getAll()->where('status', '=', 'progress')
                ->where('state', '=', 'exam_committee')
                ->where('program_id', '=' ,$id);
            return view('examCommittee::pages.program-wise-application-list', compact('data','id'));
        }else{
            return redirect()->route('login');
        }
    }

    public function admitCardGeneratedStudent(){
        if (Auth::user()->mainRole()->name === 'exam_committee') {
            $users = $this->examProcessingRepository->getAll()->where('status', '=', 'progress')
                ->where('state', '=', 'exam_committee')
                ->where('is_admit_card_generate', '=' ,'yes');
            return $this->view('pages.admit-card-generated-list', $users);
        }else{
            return redirect()->route('login');
        }
    }

    public function exportCsv(Request $request)
    {
        $fileName = 'tasks.csv';
        $tasks = AdmitCard::all();

        $tasks = AdmitCard::join('profiles','profiles.id','=','admit_card.profile_id')
            ->join('exam_registration','exam_registration.id','=','admit_card.exam_processing_id')
            ->join('program','program.id','=','exam_registration.program_id')
            ->get();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Full Name', 'Data of birth', 'Symbol Number', 'Father Name', 'Citizenship Number','Program Name');

        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tasks as $task) {
                $row['Name']  = $task->first_name . $task->middle_name . $task->last_name;
                $row['dob']    = $task->dob_nep;
                $row['symbol']    = $task->symbol_number;
                $row['father']  = $task->father_name;
                $row['citizen']  = $task->citizenship_number;
                $row['program']  = $task->name;

                fputcsv($file, array($row['Name'], $row['dob'], $row['symbol'], $row['father'], $row['citizen'], $row['program']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
//        $tasks = $this->examProcessingRepository->getAll()->where('status', '=', 'progress')
//            ->where('state', '=', 'exam_committee')
//            ->where('is_admit_card_generate', '=' ,'yes');
//        return Excel::download(new UsersExport($tasks), 'student-collection.xlsx');

//        $fileName = 'admit_card_generated_list.csv';
//        $tasks = $this->examProcessingRepository->getAll()->where('status', '=', 'progress')
//            ->where('state', '=', 'exam_committee')
//            ->where('is_admit_card_generate', '=' ,'yes');
//
//        $headers = array(
//            "Content-type"        => "text/csv",
//            "Content-Disposition" => "attachment; filename=$fileName",
//            "Pragma"              => "no-cache",
//            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
//            "Expires"             => "0"
//        );
//
//        $columns = array('Title', 'Assign', 'Description', 'Start Date', 'Due Date');
//
//        $callback = function() use($tasks, $columns) {
//            $file = fopen('php://output', 'w');
//            fputcsv($file, $columns);
//
//            foreach ($tasks as $task) {
//                $row['First Name']  = $task->getFirstName();
//                $row['Middle Name']    = $task->getMiddleName();
//                $row['Last Name']    = $task->getLastName();
//                $row['Symbol Number']  = $task->symbolNumber($task->id);
//                $row['Gender']  = $task->getGender();
//                $row['Program']  = $task->getProgramName();
//                $row['Level']  = $task->getLevelName;
//
//                fputcsv($file, array($row['First Name'], $row['Middle Name'], $row['Last Name'], $row['Symbol Number'], $row['Gender'], $row['Program'], $row['Level']));
//            }
//
//            fclose($file);
//        };
//
//        return  redirect()->back();
    }


}

