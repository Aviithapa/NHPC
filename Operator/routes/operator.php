<?php

Route::get('/',  function() {
    return view('operator::pages.dashboard');})->middleware(['auth'])->name('operator.dashboard');


Route::get('/operator/applicant-list',[\Operator\Http\Controller\OperatorController::class,'index'])->middleware(['auth'])->name('operator.applicant.list');
Route::get('/operator/applicant-profile-list',[\Operator\Http\Controller\OperatorController::class,'profile'])->middleware(['auth'])->name('operator.applicant.profile.list');
Route::get('/operator/reject-applicant-profile-list',[\Operator\Http\Controller\OperatorController::class,'reject'])->middleware(['auth'])->name('operator.reject.applicant.profile.list');
Route::get('/operator/verified-applicant-profile-list',[\Operator\Http\Controller\OperatorController::class,'verified'])->middleware(['auth'])->name('operator.verified.applicant.profile.list');
Route::post('/operator/applicant-profile-list',[\Operator\Http\Controller\OperatorController::class,'status'])->middleware(['auth'])->name('operator.applicant.profile.list.status');
Route::get('/operator/applicant-list/{id}',[\Operator\Http\Controller\OperatorController::class,'edit'])->middleware(['auth'])->name('operator.applicant.list.review');

Route::get('/operator/accept-exam-applied/{id}',[\Operator\Http\Controller\OperatorController::class,"AcceptExamProcessing"])->middleware(['auth'])->name('operator.accept.exam.apply');
Route::post('/operator/rejected-exam-applied',[\Operator\Http\Controller\OperatorController::class,"RejectExamProcessing"])->middleware(['auth'])->name('operator.reject.exam.apply');
