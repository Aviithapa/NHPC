<?php


namespace App\Http\Controllers\Admin;


use Illuminate\Support\Facades\Auth;
use Student\Modules\Profile\Repositories\ProfileRepository;

class DashboardController extends BaseController
{

    private $profileRepository;
    public function __construct(ProfileRepository $profileRepository)
    {
     $this->profileRepository = $profileRepository;

        parent::__construct();
    }

    public function index()
    {
        $role = Auth::user()->mainRole()?Auth::user()->mainRole()->name:'default';
        switch ($role) {
            case 'Student':
                $authUser = $this->profileRepository->getAll()->where('user_id','=',Auth::user()->id)->first();
                return $this->view('dashboard.administrator',compact('authUser'));
                break;

            default:
                return $this->view('dashboard.default');

        }
    }

}
