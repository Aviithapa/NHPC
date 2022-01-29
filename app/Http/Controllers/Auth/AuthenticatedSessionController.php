<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        if ( Auth::check() ) {
            if(Auth::user()->active()) {
                if (Auth::user()->mainRole()->name === 'administrator') {
                    dd("Student");
                } else if (Auth::user()->mainRole()->name === 'Student') {
                    return  redirect()->route('student.dashboard');
                }  else if (Auth::user()->mainRole()->name === 'operator') {
                    return  redirect()->route('operator.dashboard');
                } else if (Auth::user()->mainRole()->name === 'officer') {
                    return  redirect()->route('officer.dashboard');
                }
            }
            else{
                Auth::logout();
                return redirect()->back()->withErrors([
                    'active' => 'You must be an active user'
                ]);
            }


            //send them where they are going

        }
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
