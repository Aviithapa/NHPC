<?php


namespace App\Http\Controllers\Admin;


use Illuminate\Support\Facades\Auth;

class DashboardController extends BaseController
{

    public function __construct()
    {


        parent::__construct();
    }

    public function index()
    {
        $role = Auth::user()->mainRole()?Auth::user()->mainRole()->name:'default';
        switch ($role) {
            case 'Student':
                return $this->view('dashboard.administrator');
                break;

            default:
                return $this->view('dashboard.default');

        }
    }

}
