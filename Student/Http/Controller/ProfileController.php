<?php


namespace Student\Http\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Student\Modules\Framework\Request;
use Student\Modules\Profile\Repositories\ProfileRepository;

class ProfileController extends BaseController
{
   private $profileRepository,$log;
    public function __construct(Log $log,ProfileRepository $profileRepository)
    {
        $this->profileRepository=$profileRepository;
        $this->log=$log;
        parent::__construct();
    }


    public function index(){
        dd("Hello World");
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        dd($data);
        $data['image'] = $data['blogger_pic'];
        try {
            $profile = $this->profileRepository->create($data);
            if ($profile == false) {
                session()->flash('danger', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
            session()->flash('success', 'Student Profile Setup successfully');
            return redirect()->route('student.dashboard');
        } catch (\Exception $e) {
            session()->flash('danger', 'Oops! Something went wrong.');
            return redirect()->back()->withInput();
        }
    }

    public function update(Request $request)
    {
        $data = $request->all();
        try {
            $profile = $this->profileRepository->create($data);
            if ($profile == false) {
                session()->flash('danger', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
            session()->flash('success', 'Student Profile Setup successfully');
            return redirect()->route('student.dashboard');
        } catch (\Exception $e) {
            session()->flash('danger', 'Oops! Something went wrong.');
            return redirect()->back()->withInput();
        }
    }



}


