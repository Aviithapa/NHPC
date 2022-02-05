<?php

namespace SuperAdmin\Http\Controllers\Settings;

use SuperAdmin\Http\Controllers\BaseController;
use App\Modules\Backend\Settings\SiteSetting\Repositories\SiteSettingRepository;
use App\Modules\Backend\Settings\SiteSetting\Requests\CreateSiteSettingRequest;
use App\Modules\Backend\Settings\SiteSetting\Requests\UpdateSiteSettingRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SiteSettingController extends BaseController
{
    private $siteSettingRepository, $log;

    /**
     * PermissionController constructor.
     * @param siteSettingRepository $siteSettingRepository
     */

    public function __construct(SiteSettingRepository $siteSettingRepository )
    {
        $this->siteSettingRepository = $siteSettingRepository;
        parent::__construct();
    }

    /**
     * View all entities
     * @return mixed
     */
    public function index()
    {
        if(\request()->ajax()) {
            $site_settings = $this->siteSettingRepository->getAllForDataTable();
            return DataTables::of($site_settings)
                ->editColumn('id', 'ID: {{$id}}')
                ->make(true);

        }
        return $this->view('settings.site-setting.index');
    }

    /**
     * Create new entity
     * @return mixed
     */
    public function create()
    {
        return $this->view('settings.site-setting.create');
    }

    public function store(CreateSiteSettingRequest $createSiteSettingRequest)
    {
        $data = $createSiteSettingRequest->all();
        try {
            if(isset($data['make_crud']) && $data['make_crud'] == 'on') {
                foreach ($this->crud_actions as $key => $crud_action) {
                    $new_data['name'] = $data['name'].'-'.$crud_action;
                    $new_data['display_name'] =  ucfirst($data['display_name']).' '.ucfirst($crud_action);
                    $new_data['description'] = 'Ability to '.ucfirst($crud_action).' '.ucfirst($data['description']);
                    $this->siteSettingRepository->create($new_data);
                }
            }
            else {
                $this->siteSettingRepository->create($data);
            }
            session()->flash('success', 'Setting created successfully');
            return redirect()->route('dashboard.site-settings.index');
        }
        catch (\Exception $e) {
            $this->log->error('Setting create : '.$e->getMessage());
            session()->flash('danger', 'Oops! Something went wrong.');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Edit entity
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $site_setting = $this->siteSettingRepository->findById($id);
        return $this->view('settings.site-setting.edit', compact('site_setting'));
    }

    /**
     * @param UpdateSiteSettingRequest $updateSiteSettingRequest
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update(UpdateSiteSettingRequest $updateSiteSettingRequest, $id)
    {
        $data = $updateSiteSettingRequest->all();
        try {
            $this->siteSettingRepository->update($data, $id);
            session()->flash('success', 'Setting updated successfully');
            return redirect()->back();
        }
        catch (\Exception $e) {
            $this->log->error('Setting update : '.$e->getMessage());
            session()->flash('danger', 'Oops! Something went wrong.');
            return redirect()->back()->withInput();
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            if(isset($request->hard_delete))
                $this->siteSettingRepository->hardDelete($id);
            else
                $this->siteSettingRepository->delete($id);
            session()->flash('success', 'Setting deleted successfully');
            return redirect()->back();
        }
        catch (\Exception $e) {
            $this->log->error('Setting delete : '.$e->getMessage());
            session()->flash('danger', 'Oops! Something went wrong.');
            return redirect()->back();
        }
    }


    /**
     * @return mixed
     */
    public function getUpdateSiteSettings()
    {
        return $this->view('settings.site-setting.update');
    }

    /**
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function getImageSiteSettings()
    {
        return $this->view('settings.site-setting.images');
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function UpdateSiteSettings(Request $request)
    {
        $inputs = $request->all();
        unset($inputs['_token']);
//        Only because theme send its own field
        if(isset($inputs['_wysihtml5_mode'])) unset($inputs['_wysihtml5_mode']);
        try{
            foreach ($inputs as $k => $v) {
                $display_name = ucfirst(str_replace_first('_', ' ', $k));
                $setting = $this->siteSettingRepository->findByName($k);
                if($setting != null) {
                    $this->siteSettingRepository->update(['name' => $k, 'value' => $v, 'display_name' => $display_name], $setting->id);
                }
                else{
                    $this->siteSettingRepository->create(['name' => $k, 'value' => $v, 'display_name' => $display_name]);
                }
            }
            session()->flash('success', 'Site Settings Updated Successfully');
            return redirect()->back();
        }
        catch (\Exception $e)
        {
            $this->log->error('Setting delete : '.$e->getMessage());
            session()->flash('danger', 'Ops! Something went wrong');
            return redirect()->back();
        }
    }
}
