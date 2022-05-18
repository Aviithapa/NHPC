<?php

use Illuminate\Support\Facades\Auth;

Route::get('/',  function() {
        if (Auth::user()->mainRole()->name === 'operator') {
            return view('operator::pages.dashboard');
         }else{
        return redirect()->route('login');
         }
})->middleware(['auth'])->name('operator.dashboard');
Route::get('/operator/applicant-list/{status}/{state}',[\Operator\Http\Controller\OperatorController::class,'exam'])->middleware(['auth'])->name('operator.applicant.list');
Route::get('/operator/applicant-profile-list/{status}/{state}/{exam}',[\Operator\Http\Controller\OperatorController::class,'profile'])->middleware(['auth'])->name('operator.applicant.profile.list');
Route::post('/operator/applicant-profile-list',[\Operator\Http\Controller\OperatorController::class,'status'])->middleware(['auth'])->name('operator.applicant.profile.list.status');
Route::get('/operator/applicant-list-view/{id}',[\Operator\Http\Controller\OperatorController::class,'edit'])->middleware(['auth'])->name('operator.applicant.list.review');
Route::get('/operator/accept-exam-applied/{id}',[\Operator\Http\Controller\OperatorController::class,"AcceptExamProcessing"])->middleware(['auth'])->name('operator.accept.exam.apply');
Route::post('/operator/rejected-exam-applied',[\Operator\Http\Controller\OperatorController::class,"RejectExamProcessing"])->middleware(['auth'])->name('operator.reject.exam.apply');
Route::get('/search/student',[\Operator\Http\Controller\SearchController::class,"index"])->middleware(['auth'])->name('search.student');
Route::get('/search',[\Operator\Http\Controller\SearchController::class,"search"])->middleware(['auth'])->name('search');

