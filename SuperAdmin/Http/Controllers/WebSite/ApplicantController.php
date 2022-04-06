<?php

namespace SuperAdmin\Http\Controllers\WebSite;

use App\Http\Controllers\Admin\BaseController;
use App\Models\Website\Post;
use App\Modules\Backend\Website\Post\Repositories\PostRepository;
use App\Modules\Backend\Website\Post\Requests\CreatePostRequest;
use App\Modules\Backend\Website\Post\Requests\UpdatePostRequest;
use Yajra\DataTables\Facades\DataTables;

class ApplicantController  extends BaseController
{

    public function __construct(  )
    {

        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('superAdmin::admin.applicant.search-student');
    }

}
