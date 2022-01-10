<?php


namespace App\Http\Controllers\Web\General;


use App\Http\Controllers\Web\BaseController;
use Illuminate\Http\Request;

class HomeController  extends BaseController
{
   private $request,$view_data;


    public function __construct(Request $request)
    {

        $this->request = $request;

        parent::__construct();
    }

    public function index()
    {
        return view('web.pages.index');
    }

    public function slug(){
        return view('web.pages.index');
    }


//    public function slug($slug = null, Request $request)
//    {
//        $slug = $slug ? $slug : 'index';
//        $file_path = resource_path() . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'web/pages' . DIRECTORY_SEPARATOR . $slug . '.blade.php';
//        if (file_exists($file_path)) {
//            switch ($slug) {
//                case 'index':
//
//                    break;
//            }
//            return view('web.pages.' . $slug, $this->view_data);
//        }
//        // 3. No page exist (404)
//        return view('web.pages.404', $this->view_data);
//
//    }

}
