<?php


namespace ExamCommittee\Http\Controller;


use App\Exports\ResultExport;
use App\Imports\ResultImport;
use App\Models\AdmitCard\AdmitCard;
use App\Models\Exam\ExamProcessing;
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

class ExamCommitteeController extends BaseController
{
    private  $log,$profileProcessing,
        $profileRepository, $userRepository,
        $qualificationRepository,$user_data,
        $profileLogsRepository,$profileProcessingRepository,
        $examRepository,$examProcessingRepository,$admitCardRepository,$examResultRepository;
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
     */

    public function __construct(ProfileRepository $profileRepository, UserRepository $userRepository, QualificationRepository $qualificationRepository,
                                ProfileLogsRepository $profileLogsRepository, ProfileProcessingRepository $profileProcessingRepository,
                                ExamRepository $examRepository,ExamProcessingRepository $examProcessingRepository,
                                AdmitCardRepository $admitCardRepository, ExamResultRepository $examResultRepository)
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
        parent::__construct();
    }

    public function generateAdmitCard($status,$current_state){
        $users = $this->examProcessingRepository->getAll()->where('status' ,'=',$status)
            ->where('state','=',$current_state)
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
                ->where('state', '=', $current_state);
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
     * @return \Illuminate\Support\Collection
     */
    public function fileExport()
    {
        return Excel::download(new ResultExport(), 'users-collection.xlsx');
    }

}

