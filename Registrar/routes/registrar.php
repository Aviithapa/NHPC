<?php

Route::get('/', [\Registrar\Http\Controller\RegistrarController::class,'dashboard'])->middleware(['auth'])->name('registrar.dashboard');

Route::get('/registrar/applicant-list/{status}/{current_state}',[\Registrar\Http\Controller\RegistrarController::class,'exam'])->middleware(['auth'])->name('registrar.applicant.list');
Route::get('/registrar/applicant-profile-list/{status}/{current_state}/{level}/{page?}',[\Registrar\Http\Controller\RegistrarController::class,'profile'])->middleware(['auth'])->name('registrar.applicant.profile.list');
Route::get('/registrar/applicant-list-view/{id}',[\Registrar\Http\Controller\RegistrarController::class,'edit'])->middleware(['auth'])->name('registrar.applicant.list.review');
Route::post('/registrar/applicant-profile-list',[\Registrar\Http\Controller\RegistrarController::class,'status'])->middleware(['auth'])->name('registrar.applicant.profile.list.status');
Route::get('/registrar/verified-applicant-profile-list',[\Registrar\Http\Controller\RegistrarController::class,'verified'])->middleware(['auth'])->name('registrar.verified.applicant.profile.list');
Route::get('/registrar/apply-exam-details/{id}',[\Registrar\Http\Controller\RegistrarController::class,"ExamApplyView"])->middleware(['auth'])->name('registrar.exam.apply');
Route::get('/registrar/accept-exam-applied/{id}',[\Registrar\Http\Controller\RegistrarController::class,"AcceptExamProcessing"])->middleware(['auth'])->name('registrar.accept.exam.apply');
Route::post('/registrar/rejected-exam-applied',[\Registrar\Http\Controller\RegistrarController::class,"RejectExamProcessing"])->middleware(['auth'])->name('registrar.reject.exam.apply');
Route::get('/search/student',[\Registrar\Http\Controller\SearchController::class,"index"])->middleware(['auth'])->name('registrar.search.student');
Route::get('/search',[\Registrar\Http\Controller\SearchController::class,"search"])->middleware(['auth'])->name('search');
Route::get('/subjectCommittee/dashboard',[\Registrar\Http\Controller\RegistrarController::class,'subjectCommitteeDashboard'])->middleware(['auth'])->name('subjectCommittee.dashboard.registrar');
Route::get('/subjectCommittee/dashboard/list/{level?}/{status?}/{subject_committee_id?}/{page?}',[\Registrar\Http\Controller\RegistrarController::class,'subjectCommitteeDashboardList'])->middleware(['auth'])->name('subjectCommittee.dashboard.registrar.list');
Route::post('/subjectCommittee/dashboard/list/{level?}/{status?}/{subject_committee_id?}/{page?}',[\Registrar\Http\Controller\RegistrarController::class,'subjectCommitteeDashboardList'])->middleware(['auth'])->name('subjectCommittee.dashboard.registrar.list');
