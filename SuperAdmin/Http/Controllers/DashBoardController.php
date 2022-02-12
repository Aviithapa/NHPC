<?php


namespace SuperAdmin\Http\Controllers;


class DashBoardController extends BaseController
{
    public function index(){
        return $this->view('dashboard.administrator');
    }

}
