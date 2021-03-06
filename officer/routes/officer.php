<?php

Route::get('/',  function() {
    return view('officer::pages.dashboard');})->middleware(['auth'])->name('officer.dashboard');


Route::get('/officer/applicant-list/{status}/{state}',[\officer\Http\Controller\OfficerController::class,'exam'])->middleware(['auth'])->name('officer.applicant.list');
Route::get('/officer/applicant-profile-list/{status}/{current_state}/{level}/{page?}',[\officer\Http\Controller\OfficerController::class,'profile'])->middleware(['auth'])->name('officer.applicant.profile.list');
Route::get('/officer/applicant-list-view/{id}',[\officer\Http\Controller\OfficerController::class,'edit'])->middleware(['auth'])->name('officer.applicant.list.review');
Route::post('/officer/applicant-profile-list',[\officer\Http\Controller\OfficerController::class,'status'])->middleware(['auth'])->name('officer.applicant.profile.list.status');
Route::get('/officer/verified-applicant-profile-list',[\officer\Http\Controller\OfficerController::class,'verified'])->middleware(['auth'])->name('officer.verified.applicant.profile.list');
Route::get('/officer/apply-exam-details/{id}',[\officer\Http\Controller\OfficerController::class,"ExamApplyView"])->middleware(['auth'])->name('officer.exam.apply');
Route::get('/officer/accept-exam-applied/{id}',[\officer\Http\Controller\OfficerController::class,"AcceptExamProcessing"])->middleware(['auth'])->name('officer.accept.exam.apply');
Route::post('/officer/rejected-exam-applied',[\officer\Http\Controller\OfficerController::class,"RejectExamProcessing"])->middleware(['auth'])->name('officer.reject.exam.apply');

Route::get('/search/student',[\officer\Http\Controller\SearchController::class,"index"])->middleware(['auth'])->name('officer.search.student');
Route::get('/search',[\officer\Http\Controller\SearchController::class,"search"])->middleware(['auth'])->name('search');


Route::get('/subjectCommittee/dashboard',[\officer\Http\Controller\OfficerController::class,'subjectCommitteeDashboard'])->middleware(['auth'])->name('subjectCommittee.dashboard.officer');
Route::get('/subjectCommittee/dashboard/list/{level?}/{status?}/{subject_committee_id?}/{page?}',[\officer\Http\Controller\OfficerController::class,'subjectCommitteeDashboardList'])->middleware(['auth'])->name('subjectCommittee.dashboard.officer.list');
Route::post('/subjectCommittee/dashboard/list/{level?}/{status?}/{subject_committee_id?}/{page?}',[\officer\Http\Controller\OfficerController::class,'subjectCommitteeDashboardList'])->middleware(['auth'])->name('subjectCommittee.dashboard.officer.list');
