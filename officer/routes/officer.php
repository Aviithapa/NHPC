<?php

use officer\Http\Controller\SearchController;

Route::get('/', [\officer\Http\Controller\OfficerController::class, 'dashboard'])->middleware(['auth'])->name('officer.dashboard');


Route::get('/officer/applicant-list/{status}/{state}', [\officer\Http\Controller\OfficerController::class, 'exam'])->middleware(['auth'])->name('officer.applicant.list');
Route::get('/officer/applicant-profile-list/{status}/{state}/{level}/{page?}', [\officer\Http\Controller\OfficerController::class, 'profile'])->middleware(['auth'])->name('officer.applicant.profile.list');
Route::get('/officer/applicant-list-view/{id}', [\officer\Http\Controller\OfficerController::class, 'edit'])->middleware(['auth'])->name('officer.applicant.list.review');
Route::post('/officer/applicant-profile-list', [\officer\Http\Controller\OfficerController::class, 'status'])->middleware(['auth'])->name('officer.applicant.profile.list.status');
Route::get('/officer/verified-applicant-profile-list', [\officer\Http\Controller\OfficerController::class, 'verified'])->middleware(['auth'])->name('officer.verified.applicant.profile.list');
Route::get('/officer/apply-exam-details/{id}', [\officer\Http\Controller\OfficerController::class, "ExamApplyView"])->middleware(['auth'])->name('officer.exam.apply');
Route::get('/officer/accept-exam-applied/{id}', [\officer\Http\Controller\OfficerController::class, "AcceptExamProcessing"])->middleware(['auth'])->name('officer.accept.exam.apply');
Route::post('/officer/rejected-exam-applied', [\officer\Http\Controller\OfficerController::class, "RejectExamProcessing"])->middleware(['auth'])->name('officer.reject.exam.apply');

Route::get('/search/student', [\officer\Http\Controller\SearchController::class, "index"])->middleware(['auth'])->name('officer.search.student');
Route::get('/search', [\officer\Http\Controller\SearchController::class, "search"])->middleware(['auth'])->name('search');


Route::get('/subjectCommittee/dashboard', [\officer\Http\Controller\OfficerController::class, 'subjectCommitteeDashboard'])->middleware(['auth'])->name('subjectCommittee.dashboard.officer');
Route::get('/subjectCommittee/dashboard/list/{level?}/{status?}/{subject_committee_id?}/{page?}', [\officer\Http\Controller\OfficerController::class, 'subjectCommitteeDashboardList'])->middleware(['auth'])->name('subjectCommittee.dashboard.officer.list');
Route::post('/subjectCommittee/dashboard/list/{level?}/{status?}/{subject_committee_id?}/{page?}', [\officer\Http\Controller\OfficerController::class, 'subjectCommitteeDashboardList'])->middleware(['auth'])->name('subjectCommittee.dashboard.officer.list');



// Route::get('/officer/subjectCommittee/minuteIndex',[\officer\Http\Controller\OfficerController::class,'minuteDataSubjectCommitteeIndex'])->middleware(['auth'])->name('subjectCommittee.minuteDataSubjectCommitteeIndex.officer');
// Route::match(['get', 'post'], '/officer/minute/applicant/list/{id}',[\officer\Http\Controller\OfficerController::class,'minuteDataApplicantIndex'])->middleware(['auth'])->name('subjectCommittee.minute.applicant.list.officer');


Route::get('/exam/view/{id}', [\officer\Http\Controller\OfficerController::class, 'examDetails'])->middleware(['auth'])->name('officer.exam.view');
Route::get('/program/student/{id}/{exam_id}', [\officer\Http\Controller\OfficerController::class, 'getProgramStudent'])->middleware(['auth'])->name('officer.program.student');
Route::post('/program/student/csv', [\officer\Http\Controller\OfficerController::class, 'programWiseStudentCountCSV'])->middleware(['auth'])->name('officer.program.student.csv');



Route::match(['get', 'post'], '/search/lost/students', [SearchController::class, "searchStudent"])->middleware(['auth'])->name('search.lost.students.officer');




Route::get('/certificate/history', [\officer\Http\Controller\OfficerController::class, 'certificateIndex'])->middleware(['auth'])->name('officer.certificateIndex');
Route::post('/certificate/storeCertificateData', [\officer\Http\Controller\OfficerController::class, 'storeCertificateData'])->middleware(['auth'])->name('officer.storeCertificateData');
Route::get('/certificate/history/print/{id}', [\officer\Http\Controller\OfficerController::class, 'printPartilipiCertificate'])->middleware(['auth'])->name('officer.certificateIndex.print');
Route::get('/certificate/history/edit/{id}', [\officer\Http\Controller\OfficerController::class, 'editCertificateData'])->middleware(['auth'])->name('officer.certificateIndex.edit');
Route::post('/certificate/history/update', [\officer\Http\Controller\OfficerController::class, 'updateCertificateData'])->middleware(['auth'])->name('officer.certificateIndex.update');
Route::get('/certificate/history/add', [\officer\Http\Controller\OfficerController::class, 'addPrintCertificate'])->middleware(['auth'])->name('officer.addPrintCertificate');
