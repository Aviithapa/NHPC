<?php


namespace Registrar\Http\Controller;


use Illuminate\Support\Facades\View;
use officer\Modules\Framework\Request;

class BaseController  extends Controller
{
    public function __construct()
    {

    }

    public function view($view, $data)
    {
        return View::make('registrar::'.$view, compact('data'));
    }

    public function save_image(Request $request,$fieldName)
    {
        try{
            $path =  $request->{$fieldName.'_image'}->store('public/documents');
            if (!$path)
                return url('storage');
            $dirs = explode('/', $path);
            if ($dirs[0] === 'public')
                $dirs[0] = 'storage';
            $response['full_url'] = url(implode('/', $dirs));
            $response['image_name'] = ($request->{$fieldName.'_image'})->hashName();
            $response['path'] = (implode('/', $dirs));
            return $response;

        }
        catch (\Exception $e)
        {
            dd($e);
        }

    }
}
