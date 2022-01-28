<?php

Route::get('/',  function() {
    return view('registrar::pages.dashboard');})->middleware(['auth'])->name('registrar.dashboard');

Route::get('/registrar/applicant-profile-list',[\Registrar\Http\Controller\RegistrarController::class,'index'])->middleware(['auth'])->name('registrar.applicant.profile.list');
Route::get('/registrar/applicant-list/{id}',[\Registrar\Http\Controller\RegistrarController::class,'edit'])->middleware(['auth'])->name('registrar.applicant.list.review');
Route::post('/registrar/applicant-profile-list',[\Registrar\Http\Controller\RegistrarController::class,'status'])->middleware(['auth'])->name('registrar.applicant.profile.list.status');
Route::get('/registrar/verified-applicant-profile-list',[\Registrar\Http\Controller\RegistrarController::class,'verified'])->middleware(['auth'])->name('registrar.verified.applicant.profile.list');
Route::get('/registrar/apply-exam-details/{id}',[\Registrar\Http\Controller\RegistrarController::class,"ExamApplyView"])->middleware(['auth'])->name('registrar.exam.apply');
Route::get('/registrar/accept-exam-applied/{id}',[\Registrar\Http\Controller\RegistrarController::class,"AcceptExamProcessing"])->middleware(['auth'])->name('registrar.accept.exam.apply');
Route::post('/registrar/rejected-exam-applied',[\Registrar\Http\Controller\RegistrarController::class,"RejectExamProcessing"])->middleware(['auth'])->name('registrar.reject.exam.apply');

