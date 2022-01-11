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
        $data=$this->profileRepository->findByFirst('user_id',Auth::user()->id,'=');
        if(!$data){
            return view('student::pages.personal');
        }else{
            if(!$data["citizenship_number"]) {
                return view('student::pages.personal');
            }else{
                return redirect()->route('student.guardian')->with('already','Personal Information has already Setup');
            }
        }

    }


    public function guardianIndex(){
        $data=$this->profileRepository->findByFirst('user_id',Auth::user()->id,'=');
        if(!$data){
            return view('student::pages.guardian');
        }else{
            if(!$data["father_name"]) {
                return view('student::pages.guardian');
            }else{
                return redirect()->route('student.specific')->with('already','All Information upto here has already Setup');
            }
        }
    }

    public function specificIndex(){
        $data=$this->profileRepository->findByFirst('user_id',Auth::user()->id,'=');
        if(!$data){
            return view('student::pages.specific');
        }else{
            if(!$data["collage_name"]) {
                return view('student::pages.specific');
            }else{
                return back()->with('already','documents');
            }
        }

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

            $data = $request->all();
            $data['user_id'] = Auth::user()->id;
            try {
                $profile = $this->profileRepository->create($data);
                if ($profile == false) {
                    session()->flash('danger', 'Oops! Something went wrong.');
                    return redirect()->back()->withInput();
                }
                return redirect()->route('student.guardian')->with('success','Personal Information have been Saved Successfully');
            } catch (\Exception $e) {
                session()->flash('danger', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
        }



    public function update(Request $request)
    {
        $data = $request->all();
        try {
            $id=$this->profileRepository->findByFirst('user_id',Auth::user()->id,'=');
            $profile = $this->profileRepository->update($data,$id['id']);
            if ($profile == false) {
                session()->flash('danger', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }

            if ($data['father_name']){
                return redirect()->route('student.specific')->with('success','Guardian Information have been saved successfully');
            }elseif ($data['collage_name']){
                return redirect()->route('student.documents')->with('success','Specific Information have been saved successfully');
            }else{
                return redirect()->route('student.dashboard');
            }
//
        } catch (\Exception $e) {
            session()->flash('danger', 'Oops! Something went wrong.');
            return redirect()->back()->withInput();
        }
    }


    public function save_image(Request $request,$fieldName)
    {
        try{
            $path =  $request->{$fieldName.'_image'}->store('public/'.$fieldName);
            if (!$path)
                return url('storage');
            $dirs = explode('/', $path);
            if ($dirs[0] === 'public')
                $dirs[0] = 'storage';
            $response['full_url'] = url(implode('/', $dirs));
            $response['image_name'] = ($request->{$fieldName.'_image'})->hashName();
            return $response;

        }
        catch (\Exception $e)
        {
            dd($e);
        }


    }


}


