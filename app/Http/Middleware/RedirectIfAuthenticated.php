<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        if (Auth::guard($guards)->check()) {
            if(Auth::user()->mainRole()->name ==='council') {
                return  redirect()->route('council.dashboard');
            }
            elseif(Auth::user()->mainRole()->name ==='student'){
                return  redirect()->route('student.dashboard');
            }elseif (Auth::user()->mainRole()->name ==='operator'){
                return  redirect()->route('operator.dashboard');
            }elseif (Auth::user()->mainRole()->name ==='officer'){
                return  redirect()->route('officer.dashboard');
            } else if (Auth::user()->mainRole()->name === 'registrar') {
                return  redirect()->route('registrar.dashboard');
            } else if (Auth::user()->mainRole()->name === 'subject_committee') {
                return  redirect()->route('subjectCommittee.dashboard');
            } else if (Auth::user()->mainRole()->name === 'exam_committee') {
                return  redirect()->route('examCommittee.dashboard');
            } else if (Auth::user()->mainRole()->name === 'council') {
                return  redirect()->route('council.dashboard');
            } else if (Auth::user()->mainRole()->name === 'superadmin'){
                return  redirect()->route('superAdmin.dashboard.index');
            }
        }

        return $next($request);
    }
}
