<?php


namespace Student\Http\Controller;


use App\Models\Admin\University;
use App\Models\Profile\ProfileProcessing;
use App\Modules\Backend\Admin\College\Repositories\CollegeRepository;
use App\Modules\Backend\Admin\Level\Repositories\LevelRepository;
use App\Modules\Backend\Admin\Program\Repositories\ProgramRepository;
use App\Modules\Backend\Exam\ExamProcessing\Repositories\ExamProcessingRepository;
use App\Modules\Backend\Profile\Profilelogs\Repositories\ProfileLogsRepository;
use App\Modules\Backend\Profile\ProfileProcessing\Repositories\ProfileProcessingRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use mysql_xdevapi\Exception;
use Student\Models\Qualification;
use Student\Modules\Framework\Request;
use Student\Modules\Profile\Repositories\ProfileRepository;
use Student\Modules\Qualification\Repositories\QualificationRepository;

class QualificationController extends BaseController
{
    private $qualificationRepository, $log, $levelRepository, $profileRepository, $profileProcessingRepository, $profileLogsRepository, $programRepository, $collegeRepository, $examProcessingRepository;
    public function __construct(
        Log $log,
        QualificationRepository $qualificationRepository,
        ProfileRepository $profileRepository,
        ProfileProcessingRepository $profileProcessingRepository,
        ProfileLogsRepository $profileLogsRepository,
        ProgramRepository $programRepository,
        CollegeRepository $collegeRepository,
        LevelRepository $levelRepository,
        ExamProcessingRepository $examProcessingRepository
    ) {
        $this->qualificationRepository = $qualificationRepository;
        $this->profileRepository = $profileRepository;
        $this->profileProcessingRepository = $profileProcessingRepository;
        $this->profileLogsRepository = $profileLogsRepository;
        $this->programRepository = $programRepository;
        $this->collegeRepository = $collegeRepository;
        $this->levelRepository = $levelRepository;
        $this->examProcessingRepository = $examProcessingRepository;
        $this->log = $log;
        parent::__construct();
    }


    public function index(Request $request)
    {
        $qualifications = $this->qualificationRepository->getAll()->where('user_id', '=', Auth::user()->id);
        $profile = $this->profileRepository->getAll()->where('user_id', '=', Auth::user()->id)->first();

        return view('student::pages.qualification.index', compact('qualifications', 'profile'));
    }

    public function updateRejectedInformationIndex($id = null)
    {
        $id = $id ? $id : 1;

        $data = $this->qualificationRepository->getAll()->where('user_id', '=', Auth::user()->id)
            ->where('level', '=', $id)->first();
        $slc_program = $this->programRepository->getAll()->where('level_id', '=', 4);
        $plus_2_program = $this->programRepository->getAll()->where('level_id', '=', 3);
        $bachelor_program = $this->programRepository->getAll()->where('level_id', '=', 2);
        $master_program = $this->programRepository->getAll()->where('level_id', '=', 1);
        $collage = $this->collegeRepository->getAll();
        $university = University::get();
        if ($data)
            return view('student::pages.qualification.update.form', compact('data', 'slc_program', 'plus_2_program', 'bachelor_program', 'master_program', 'collage', 'university'));
        else
            return redirect()->route('student.dashboard');
    }

    public function updateRejectedQualification(Request $request, $id)
    {
        $data = $request->all();
        $qualification = Qualification::get()->where('user_id', '=', Auth::user()->id)->last();
        try {
            switch ($data['level']) {
                case 1:
                    $data['transcript_image'] = $data['transcript_slc'];
                    $data['provisional_image'] = $data['provisional_slc'];
                    $data['character_image'] = $data['character_slc'];
                    break;
                case 2:
                    $data['transcript_image'] = $data['transcript_tslc'];
                    $data['provisional_image'] = $data['provisional_tslc'];
                    $data['character_image'] = $data['character_tslc'];
                    $data['ojt_image'] = $data['ojt_tslc'];
                    break;
                case 3:
                    $data['transcript_image'] = $data['transcript_pcl'];
                    $data['provisional_image'] = $data['provisional_pcl'];
                    $data['character_image'] = $data['character_pcl'];
                    $data['ojt_image'] = $data['ojt_pcl_image'];
                    break;
                case 4:
                    $data['transcript_image'] = $data['transcript_bac'];
                    $data['provisional_image'] = $data['provisional_bac'];
                    $data['character_image'] = $data['character_bac'];
                    $data['intership_image'] = $data['intership_bac'];
                    $data['noc_image'] = $data['noc_bac'];
                    $data['visa_image'] = $data['visa_bac'];
                    $data['passport_image'] = $data['passport_bac'];
                    break;
                case 5:
                    $data['transcript_image'] = $data['transcript_mas'];
                    $data['provisional_image'] = $data['provisional_mas'];
                    $data['character_image'] = $data['character_mas'];
                    $data['intership_image'] = $data['intership_mas'];
                    $data['noc_image'] = $data['noc_mas'];
                    $data['visa_image'] = $data['visa_mas'];
                    $data['passport_image'] = $data['passport_mas'];
                    break;
            }
            $post = $this->qualificationRepository->update($data, $id);
            if ($post == false) {
                session()->flash('danger', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
            if ($data['level'] == $qualification->level) {
                $id = $this->profileRepository->findByFirst('user_id', Auth::user()->id, '=');
                $profile_pro['status'] = 'progress';
                $profile_processing_id = ProfileProcessing::get()->where('profile_id', '=', $id['id'])->last();
                $profiles_processing = $this->profileProcessingRepository->update($profile_pro, $profile_processing_id['id']);
                $profiles['profile_status'] = "Reviewing";
                $profiles['profile_state'] = $profiles_processing['current_state'];
                $profile = $this->profileRepository->update($profiles, $id['id']);
                $exam['status'] = 'progress';
                $examed = $this->examProcessingRepository->getAll()->where('profile_id', '=', $id['id'])->first();
                if ($examed != null) {
                    $exams = $this->examProcessingRepository->update($exam, $examed->id);
                }
                $this->profileLog($id['id']);
                session()->flash('success', 'Profile is send for Re Revewing');
                return redirect()->route("student.dashboard");
            }
            session()->flash('success', 'Qualification updated successfully');

            $qualifications = Qualification::get()->where('user_id', '=', Auth::user()->id);
            foreach ($qualifications as $qualification) {
                if ($qualification['level'] != 2) {
                    $data['level'] = 2;
                }
            }
            return redirect()->route('qualification.update.index', ['id' => ++$data['level']]);
        } catch (\Exception $e) {
            dd($e);
            session()->flash('danger', 'Oops! Something went wrong.');
            return redirect()->back()->withInput();
        }
    }



    public function create(Request $request)
    {
        $profile = $this->profileRepository->getAll()->where('user_id', '=', Auth::user()->id);
        $qualifications = $this->qualificationRepository->getAll()->where('user_id', '=', Auth::user()->id)->max('level');
        $slc_data = $this->qualificationRepository->slcData(Auth::user()->id);
        $tslc_data = $this->qualificationRepository->tslcData(Auth::user()->id);
        $plus_2 = $this->qualificationRepository->pclData(Auth::user()->id);
        $bachelor = $this->qualificationRepository->bachelorData(Auth::user()->id);
        $master = $this->qualificationRepository->masterData(Auth::user()->id);
        $slc_program = $this->programRepository->getAll()->where('level_id', '=', 4);
        $plus_2_program = $this->programRepository->getAll()->where('level_id', '=', 3);
        $bachelor_program = $this->programRepository->getAll()->where('level_id', '=', 2);
        $master_program = $this->programRepository->getAll()->where('level_id', '=', 1);
        $collage = $this->collegeRepository->getAll();
        $university = University::get();
        return view('student::pages.qualification.form', compact(
            'master_program',
            'collage',
            'qualifications',
            'slc_data',
            'plus_2',
            'bachelor',
            'master',
            'slc_program',
            'plus_2_program',
            'bachelor_program',
            'master_program',
            'tslc_data',
            'collage',
            'university'
        ));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $qualification = Qualification::get()->where('user_id', '=', Auth::user()->id)->last();
        $profile = $this->profileRepository->findByFirst('user_id', Auth::user()->id, '=');
        $data['name'] = $data['level'];
        $data['user_id'] = Auth::user()->id;
        $level_number = $this->levelRepository->findById($profile['level']);
        switch ($data['level']) {
            case 1:
                $data['transcript_image'] = $data['transcript_slc'];
                $data['provisional_image'] = $data['provisional_slc'];
                $data['character_image'] = $data['character_slc'];
                break;
            case 2:
                $data['transcript_image'] = $data['transcript_tslc'];
                $data['provisional_image'] = $data['provisional_tslc'];
                $data['character_image'] = $data['character_tslc'];
                $data['ojt_image'] = $data['ojt_tslc'];
                break;
            case 3:
                $data['transcript_image'] = $data['transcript_pcl'];
                $data['provisional_image'] = $data['provisional_pcl'];
                $data['character_image'] = $data['character_pcl'];
                $data['ojt_image'] = $data['ojt_pcl_image'];
                break;
            case 4:
                $data['transcript_image'] = $data['transcript_bac'];
                $data['provisional_image'] = $data['provisional_bac'];
                $data['character_image'] = $data['character_bac'];
                $data['intership_image'] = $data['intership_bac'];
                $data['noc_image'] = $data['noc_bac'];
                $data['visa_image'] = $data['visa_bac'];
                $data['passport_image'] = $data['passport_bac'];
                break;
            case 5:
                $data['transcript_image'] = $data['transcript_mas'];
                $data['provisional_image'] = $data['provisional_mas'];
                $data['character_image'] = $data['character_mas'];
                $data['intership_image'] = $data['intership_mas'];
                $data['noc_image'] = $data['noc_mas'];
                $data['visa_image'] = $data['visa_mas'];
                $data['passport_image'] = $data['passport_mas'];
                break;
        }

        try {
            $qualification = $this->qualificationRepository->create($data);
            if ($qualification == false) {
                session()->flash('danger', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
            $slc_data = $this->qualificationRepository->slcData(Auth::user()->id);
            $tslc_data = $this->qualificationRepository->tslcData(Auth::user()->id);
            $plus_2 = $this->qualificationRepository->pclData(Auth::user()->id);
            $bachelor = $this->qualificationRepository->bachelorData(Auth::user()->id);
            $master = $this->qualificationRepository->masterData(Auth::user()->id);
            $collage = $this->collegeRepository->getAll();


            //            if($level_number['level_number'] == $level){
            //                $qualification = $this->qualificationRepository->getAll()->where('user_id','=',Auth::user()->id)
            //                    ->where('level','!=' , 1);
            //                if ($qualification != null){
            //                    foreach ($qualification as $quali)
            //                        if (is_numeric($quali['program_id']) )
            //                            $all_program[] = $this->programRepository->findById($quali['program_id']);
            //                }
            //                return view('student::pages.apply-exam', compact( 'all_program'));
            //            }

            session()->flash('success', $data["level_name"] . ' Qualification have been Saved Successfully');
            return redirect()->route('student.specific', compact('slc_data', 'plus_2', 'bachelor', 'master', 'tslc_data'));
        } catch (\Exception $e) {
            session()->flash('danger', 'Oops! Something went wrong.');
            return redirect()->back()->withInput();
        }
    }


    public function newQualificationStore(Request $request)
    {
        $data = $request->all();
        $data['name'] = $data['level'];
        $data['user_id'] = Auth::user()->id;
        $data['transcript_image'] = $data['transcript_mas'];
        $data['provisional_image'] = $data['provisional_mas'];
        $data['character_image'] = $data['character_mas'];
        $data['intership_image'] = $data['intership_mas'];
        $data['noc_image'] = $data['noc_mas'];
        $data['visa_image'] = $data['visa_mas'];
        $data['passport_image'] = $data['passport_mas'];
        $profiles['level'] = $data['level'];
        $profiles['profile_state'] = 'computer_operator';
        try {
            $qualification = $this->qualificationRepository->create($data);
            if ($qualification == false) {
                session()->flash('danger', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
            $this->checkLevel($profiles);
            session()->flash('success', $data["level_name"] . ' Qualification have been Saved Successfully');
            $slc_data = $this->qualificationRepository->slcData(Auth::user()->id);
            $tslc_data = $this->qualificationRepository->tslcData(Auth::user()->id);
            $plus_2 = $this->qualificationRepository->pclData(Auth::user()->id);
            $bachelor = $this->qualificationRepository->bachelorData(Auth::user()->id);
            $master = $this->qualificationRepository->masterData(Auth::user()->id);
            $collage = $this->collegeRepository->getAll();
            return redirect()->route('student.specific', compact('slc_data', 'plus_2', 'bachelor', 'master', 'tslc_data'));
        } catch (\Exception $e) {
            session()->flash('danger', 'Oops! Something went wrong.');
            return redirect()->back()->withInput();
        }
    }

    public function checkLevel($profiles)
    {
        $id = $this->profileRepository->findByFirst('user_id', Auth::user()->id, '=');
        if ($id['level'] < $profiles['level']) {
            $profiles['profile_status'] = "Reviewing";
            $profile = $this->profileRepository->update($profiles, $id['id']);
        } else {
            $pros['profile_status'] = "Reviewing";
            $pros['profile_state'] = "computer_operator";
            $profile = $this->profileRepository->update($pros, $id['id']);
        }
    }

    public function edit($id)
    {
        $qualification = $this->qualificationRepository->findById($id);
        return view('student::pages.qualification.edit-qualification', compact('qualification'));
    }


    public function update(Request $request, $id)
    {
        $data = $request->all();
        $data['name'] = $data['level'];
        $data['user_id'] = Auth::user()->id;
        $data['transcript_image'] = $data['transcript'];
        $data['provisional_image'] = $data['provisional'];
        $data['character_image'] = $data['character'];
        try {
            $post = $this->qualificationRepository->update($data, $id);
            $profile = $this->profileRepository->getAll()->where('user_id', '=', Auth::user()->id)->first();
            $profile_processing = $this->profileProcessingRepository->getAll()->where('profile_id', '=', $profile['id'])->first();
            $data['profile_status'] = 'Reviewing';
            $profile = $this->profileRepository->update($data, $profile['id']);

            $profiles['status'] = 'progress';
            $profiles_processing = $this->profileProcessingRepository->update($profiles, $profile_processing['id']);
            if ($post == false) {
                session()->flash('danger', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
            session()->flash('success', 'Qualification updated successfully');
            return redirect()->route('qualification.index');
        } catch (\Exception $e) {
            $this->log->error('Content update : ' . $e->getMessage());
            session()->flash('danger', 'Oops! Something went wrong.');
            return redirect()->back()->withInput();
        }
    }

    public function profileLog($id)
    {
        $data['remarks'] = "Profile Updated by" . Auth::user()->name;
        $data['status'] = "progress";
        $data['profile_id'] = $id;
        $logs = $this->profileLogsRepository->create($data);
        if ($logs == false)
            return false;
        return true;
    }
}
