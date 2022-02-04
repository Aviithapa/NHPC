<?php


namespace SuperAdmin\Http\Controllers\Authentication;

use App\Modules\Backend\Authentication\Role\Repositories\RoleRepository;
use SuperAdmin\Http\Controllers\BaseController;
use App\Events\UserApprove;
use App\Modules\Backend\Authentication\User\Repositories\UserRepository;
use App\Modules\Backend\Authentication\User\Requests\CreateUserRequest;
use App\Modules\Backend\Authentication\User\Requests\UpdateUserRequest;
use Illuminate\Contracts\Logging\Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class UserController extends BaseController
{
    private $userRepository, $roleRepository, $log, $postRepository;
    use SendsPasswordResetEmails;


    /**
     * UserController constructor.
     * @param UserRepository $userRepository
     * @param RoleRepository $roleRepository
     * @param Log $log
     * @param PostRepository $postRepository
     */
    public function __construct(UserRepository $userRepository, RoleRepository $roleRepository, Log $log, PostRepository $postRepository)
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
        $this->postRepository = $postRepository;
        $this->log = $log;
        parent::__construct();
    }


    /**
     * View all user
     * @return mixed
     */
    public function index()
    {
        $this->authorize('read',$this->userRepository->getModel());
        $users = $this->userRepository->getAllForDataTable();
        if(\request()->ajax()) {
            $users = $this->userRepository->getAllForDataTable();
            return DataTables::of($users)
                ->addColumn('action', function ($user) {
                    $data = $user;
                    $name = 'dashboard.users';
                    $view = true;
                    return $this->view('partials.common.action', compact('data', 'name', 'view'))->render();
                })
                ->editColumn('id', 'ID: {{$id}}')
                ->make(true);

        }
        $terms= $this->postRepository->findById(152);
        return $this->view('authentication.user.index', compact('users', 'terms'));
    }

    /**
     * Create new user
     * @return mixed
     */
    public function create()
    {
        $this->authorize('create',$this->userRepository->getModel());
        return $this->view('authentication.user.create');
    }

    /**
     * @param CreateUserRequest $createUserRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateUserRequest $createUserRequest)
    {
        $this->authorize('create',$this->userRepository->getModel());
        $data = $createUserRequest->all();
        try {
            $data['password'] = bcrypt($data['password']);
            $user = $this->userRepository->create($data);
            if($user == false)
            {
                session()->flash('danger', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
            session()->flash('success', 'User added successfully');
            return redirect()->route('dashboard.users.index');
        }
        catch (\Exception $e) {
            $this->log->error('User create : '.$e->getMessage());
            session()->flash('danger', 'Oops! Something went wrong.');
            return redirect()->back()->withInput();
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        $this->authorize('read', $this->userRepository->getModel());
        $user = $this->userRepository->findById($id);
        $role = Auth::user()->mainRole()?Auth::user()->mainRole()->name:'default';
        $terms= $this->postRepository->findById(152);
        return $this->view('authentication.user.show', compact('user','role', 'terms'));
    }
    /**
     * Edit User
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $this->authorize('update',$this->userRepository->getModel());
        $user = $this->userRepository->findById($id);
        $terms= $this->postRepository->findById(152);
        return $this->view('authentication.user.edit', compact('user','terms'));
    }


    public function update(UpdateUserRequest $updateUserRequest, $id)
    {
        $this->authorize('update',$this->userRepository->getModel());
        $data = $updateUserRequest->all();
        if(isset($data['email'])) {
            unset($data['email']);
        }
        try {
            $user = $this->userRepository->findById($id);
            if(isset($data['password']) && !is_null($data['password']))
            {
                $data['password_reference'] = $data['password'];
                $data['password'] = bcrypt($data['password']);
                /*if(!Hash::check($data['old_password'], $user->password))
                {
                    session()->flash('warning', 'Old password does not match');
                    return redirect()->back();
                }
                else {
                    $data['password'] = bcrypt($data['password']);
                }*/
            }
            else {
                unset($data['password']);
            }
            $user = $this->userRepository->update($data, $id);
            if($user == false)
            {
                session()->flash('danger', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
            session()->flash('success', 'User updated successfully');
            return redirect()->route('dashboard.users.index');
        }
        catch (\Exception $e) {
            $this->log->error('User update : '.$e->getMessage());
            session()->flash('danger', 'Oops! Something went wrong.');
            return redirect()->back();
        }
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id, Request $request)
    {
        $this->authorize('delete',$this->userRepository->getModel());
        try {
            if(isset($request->hard_delete))
                $this->userRepository->hardDelete($id);
            else
                $this->userRepository->delete($id);

            session()->flash('success', 'User deleted successfully');
            return redirect()->back();
        }
        catch (\Exception $e) {
            $this->log->error('User delete : '.$e->getMessage());
            session()->flash('danger', 'Oops! Something went wrong.');
            return redirect()->back();
        }
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approve(Request $request, $id)
    {
        $this->authorize('update',$this->userRepository->getModel());
        $data = $request->only('status');
        try {
            $data['password_change_code']=str_random(16);
            $user = $this->userRepository->update($data, $id);
            event(new UserApprove($user));
            $request['email']=$user->email;
//            $this->sendResetLinkEmail($request);
            session()->flash('success', 'User Activated successfully');
            return redirect()->back();
        }
        catch (\Exception $e) {
            $this->log->error('User update : '.$e->getMessage());
            session()->flash('danger', 'Oops! Something went wrong.');
            return redirect()->back();
        }
    }


    /**
     * @return mixed
     */
    public function getProfile()
    {
        $id = Auth::id();
        $user = $this->userRepository->findById($id);
        $terms= $this->postRepository->findById(152);
        $role = Auth::user()->mainRole()?Auth::user()->mainRole()->name:'default';
        return $this->view('authentication.user.profile', compact('user','role','terms'));
    }

    public function postProfile(UpdateUserRequest $updateUserRequest)
    {
        $user = Auth::user();
        $data = $updateUserRequest->all();
        if(isset($data['email'])) {
            unset($data['email']);
        }
        $data['role'] = $user->mainRole()?$user->mainRole()->id:null;
        try {
            $user = $this->userRepository->findById($user->id);
            if(isset($data['password']) && !is_null($data['password']))
            {
                if(!Hash::check($data['old_password'], $user->password))
                {
                    session()->flash('warning', 'Old password does not match');
                    return redirect()->back();
                }
                else {
                    $data['password'] = bcrypt($data['password']);
                }
            }
            else {
                unset($data['password']);
            }
            $user = $this->userRepository->update($data, $user->id);
            if($user == false)
            {
                session()->flash('danger', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
            session()->flash('success', 'Profile updated successfully');
            return redirect()->back();
        }
        catch (\Exception $e) {
            $this->log->error('User update : '.$e->getMessage());
            session()->flash('danger', 'Oops! Something went wrong.');
            return redirect()->back();
        }
    }

    public function rating(Request $updateUserRequest, $id,$rating){;
          $use=$updateUserRequest->all();
          $user=$this->userRepository->findById($id);
          $rate=$user['rating'] + $rating;
          $use['rating']=$rate;

        try {
            $user = $this->userRepository->update($use, $id);
            if ($rating<0) {

                $mailData = array('user' => $user);
                Mail::send('emails.negativeRating', $mailData, function ($message) use ($user) {
                    $message->to($user['email'])
                        ->subject('Negative Rating');
                    $message->from('houseofbooksnepal@gmail.com');
                });
            }
            if($user == false)
            {
                session()->flash('danger', 'Oops! Something went wrong.');
                return redirect()->back()->withInput();
            }
            session()->flash('success', 'Rating updated');
            return redirect()->back();
        }
        catch (\Exception $e) {
            $this->log->error('User update : '.$e->getMessage());
            session()->flash('danger', 'Oops! Something went wrong.');
            return redirect()->back();
        }
    }


}
