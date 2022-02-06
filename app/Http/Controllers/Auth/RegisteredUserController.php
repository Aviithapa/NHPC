<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MailController;
use App\Models\Auth\Role;
use App\Models\Auth\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{


    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }



    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone_number' => ['required', 'string', 'min:10','max:10','unique:users'],
            'captcha' => ['required','captcha']
        ]);
    }



    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\Auth\User
     */
    protected function create(array $data)
    {
        $role = Role::where('name', 'Student')->first();
        $data['password_reference'] = $data['password'];
        $data['password'] = bcrypt($data['password']);
        $user =  User::create($data);
        $user->attachRole($role);
        return $user;
    }
    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function registerNew( Request $request)
    {
        $this->validator($request->all())->validate();
        $data = $request->all();
        $data['role'] = "Student";
        $data['verification_code'] =sha1(time());
        event(new Registered($user = $this->create($data)));

        if($user != null){
            MailController::sendSignupEmail($data["name"], $data['email'], $data['verification_code']);
            return view('auth.verify-email');
        }

        return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong!'));
    }

    public function verifyUser(Request $request){
        $verification_code = \Illuminate\Support\Facades\Request::get('code');
        $user = User::where(['verification_code' => $verification_code])->first();
        if($user != null){
            $user->status = 'active';
            $user->save();
            return redirect()->route('login')->with(session()->flash('alert-success', 'Your account is verified. Please login!'));
        }

        return redirect()->route('login')->with(session()->flash('alert-danger', 'Invalid verification code!'));
    }

    public function success()
    {
        return redirect()->intended('/');
    }




}
