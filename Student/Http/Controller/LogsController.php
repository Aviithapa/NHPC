<?php


namespace Student\Http\Controller;

use App\Models\Exam\ExamProcessing;
use App\Modules\Backend\Exam\ExamProcessing\Repositories\ExamProcessingRepository;
use App\Modules\Backend\Profile\Profilelogs\Repositories\ProfileLogsRepository;
use Illuminate\Support\Facades\Auth;
use Student\Modules\Profile\Repositories\ProfileRepository;

class LogsController extends BaseController
{
    private $profileLogsRepository, $examProcessingRepository, $logs, $profileRepository;
    public function __construct(
        ProfileLogsRepository $profileLogsRepository,
        ExamProcessingRepository $examProcessingRepository,
        ProfileRepository $profileRepository
    ) {
        $this->profileLogsRepository = $profileLogsRepository;
        $this->examProcessingRepository = $examProcessingRepository;
        $this->profileRepository = $profileRepository;
        parent::__construct();
    }


    public function index($status)
    {
        $data = $this->profileRepository->getAll()->where('user_id', '=', Auth::user()->id)->first();

        if ($data) {
            $profile_id = $data['id'];
            $examApplieds = $this->examProcessingRepository->getAll()->where('profile_id', '=',  $data['id']);
            if ($status === "profile") {
                $logs = $this->profileLogsRepository->getAll()->where('profile_id', '=', $profile_id);
            } elseif ($status === "exam") {
                $logs = $this->examProcessingRepository->getAll()->where('profile_id', '=', Auth::user()->id);
            }
        } else {
            $logs = "";
        }


        $examApplied = isset($examApplieds) ? $examApplieds : null;
        return view('student::pages.logs', compact('logs', 'examApplied'));
    }
}
