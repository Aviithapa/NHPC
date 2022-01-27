<?php

Route::get('/',  function() {
    return view('officer::pages.dashboard');})->middleware(['auth'])->name('officer.dashboard');

Route::get('/officer/applicant-profile-list',[\officer\Http\Controller\OfficerController::class,'index'])->middleware(['auth'])->name('officer.applicant.profile.list');
Route::get('/officer/applicant-list/{id}',[\officer\Http\Controller\OfficerController::class,'edit'])->middleware(['auth'])->name('officer.applicant.list.review');
Route::post('/officer/applicant-profile-list',[\officer\Http\Controller\OfficerController::class,'status'])->middleware(['auth'])->name('officer.applicant.profile.list.status');
Route::get('/officer/verified-applicant-profile-list',[\officer\Http\Controller\OfficerController::class,'verified'])->middleware(['auth'])->name('officer.verified.applicant.profile.list');
Route::get('/officer/apply-exam-details/{id}',[\officer\Http\Controller\OfficerController::class,"ExamApplyView"])->middleware(['auth'])->name('officer.exam.apply');

