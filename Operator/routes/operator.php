<?php

use Illuminate\Support\Facades\Auth;

Route::get('/',  [\Operator\Http\Controller\OperatorController::class,'dashboard'])->middleware(['auth'])->name('operator.dashboard');
Route::get('/operator/applicant-list/{status}/{state}',[\Operator\Http\Controller\OperatorController::class,'exam'])->middleware(['auth'])->name('operator.applicant.list');
Route::get('/operator/applicant-profile-list/{status}/{state}/{level}',[\Operator\Http\Controller\OperatorController::class,'profile'])->middleware(['auth'])->name('operator.applicant.profile.list');
Route::post('/operator/applicant-profile-list',[\Operator\Http\Controller\OperatorController::class,'status'])->middleware(['auth'])->name('operator.applicant.profile.list.status');
Route::get('/operator/applicant-list-view/{id}',[\Operator\Http\Controller\OperatorController::class,'edit'])->middleware(['auth'])->name('operator.applicant.list.review');
Route::get('/operator/accept-exam-applied/{id}',[\Operator\Http\Controller\OperatorController::class,"AcceptExamProcessing"])->middleware(['auth'])->name('operator.accept.exam.apply');
Route::post('/operator/rejected-exam-applied',[\Operator\Http\Controller\OperatorController::class,"RejectExamProcessing"])->middleware(['auth'])->name('operator.reject.exam.apply');
Route::post('/operator/rejected-re-exam-applied',[\Operator\Http\Controller\OperatorController::class,"ReExamProcessing"])->middleware(['auth'])->name('operator.re-exam.exam.apply');
Route::get('/search/student',[\Operator\Http\Controller\SearchController::class,"index"])->middleware(['auth'])->name('search.student');
Route::get('/search',[\Operator\Http\Controller\SearchController::class,"search"])->middleware(['auth'])->name('search');

Route::post('/update/apply/exam',[\Operator\Http\Controller\OperatorController::class,'applyExam'])->middleware(['auth'])->name('update.apply.exam');
Route::get('/apply/exam/{id}',[\Operator\Http\Controller\OperatorController::class,'editExamApply'])->middleware(['auth'])->name('apply.exam');

Route::post('/applicant-profile-list/level',[\Operator\Http\Controller\OperatorController::class,'level'])->middleware(['auth'])->name('operator.applicant.profile.list.level');
Route::get('/applicant-profile-list/doubleDustur',[\Operator\Http\Controller\OperatorController::class,'doubleDustur'])->middleware(['auth'])->name('operator.applicant.profile.list.doubleDustur');

Route::get('/search/collage',[\Operator\Http\Controller\SearchController::class,"collageIndex"])->middleware(['auth'])->name('search.collage.index');
Route::post('/collage/search',[\Operator\Http\Controller\SearchController::class,"collageSearch"])->middleware(['auth'])->name('collage.search');
Route::get('/view/certificate/{id}/{level}',  [\Operator\Http\Controller\OperatorController::class,'printCertificate'])->middleware(['auth'])->name('operator.dashboard.view');
Route::get('/certificate/index/{status}/{program_id}',  [\Operator\Http\Controller\OperatorController::class,'printCertificateIndex'])->middleware(['auth'])->name('operator.dashboard.printCertificateIndex');
Route::get('/certificate/isPrinted/{id}',  [\Operator\Http\Controller\OperatorController::class,'printedCertificate'])->middleware(['auth'])->name('operator.dashboard.printedCertificate');
Route::get('/certificate/card/{status}',  [\Operator\Http\Controller\OperatorController::class,'printCertificateDashboard'])->middleware(['auth'])->name('operator.dashboard.printCertificateDashboard');
Route::get('/view/printedCertificate/{id}/{level}',  [\Operator\Http\Controller\OperatorController::class,'printed'])->middleware(['auth'])->name('operator.dashboard.view.printedCertificate');


Route::get('/student/program/{id}/{status}/{state}',  [\Operator\Http\Controller\OperatorController::class,'getProgramWiseStudent'])->middleware(['auth'])->name('operator.dashboard.getProgramWiseStudent');

Route::get('/subjectCommittee/dashboard',[\Operator\Http\Controller\OperatorController::class,'subjectCommitteeDashboard'])->middleware(['auth'])->name('subjectCommittee.dashboard.operator');
Route::get('/subjectCommittee/dashboard/list/{level?}/{status?}/{subject_committee_id?}/{page?}',[\Operator\Http\Controller\OperatorController::class,'subjectCommitteeDashboardList'])->middleware(['auth'])->name('subjectCommittee.dashboard.operator.list');
Route::post('/subjectCommittee/dashboard/list/{level?}/{status?}/{subject_committee_id?}/{page?}',[\Operator\Http\Controller\OperatorController::class,'subjectCommitteeDashboardList'])->middleware(['auth'])->name('subjectCommittee.dashboard.operator.list');
Route::get('/exam/dashboard/{level_id}',[\Operator\Http\Controller\OperatorController::class,'examStudentCount'])->middleware(['auth'])->name('examStudentCount.dashboard.operator');

Route::get('/update/certificate/{certificate_id}/{level}',[\Operator\Http\Controller\OperatorController::class,'updateCertificateIndex'])->middleware(['auth'])->name('examStudentCount.dashboard.updateCertificateIndex');
Route::post('/update/certificates',[\Operator\Http\Controller\OperatorController::class,'updateCertificate'])->middleware(['auth'])->name('examStudentCount.dashboard.updateCertificate');


Route::post('/operator/fowardStudents',[\Operator\Http\Controller\OperatorController::class,'fowardStudentState'])->middleware(['auth'])->name('operator.fowardStudentState');

Route::get('examApplied/{id}/{profile_id}',[\Operator\Http\Controller\OperatorController::class,'deleteExamApplied'])->middleware(['auth'])->name('operator.deleteExamApplied');
Route::get('/exportCSV',[\Operator\Http\Controller\OperatorController::class,'exportCsv'])->middleware(['auth'])->name('operator.exportCsv');

Route::get('/move/exam_committee/{id}',[\Operator\Http\Controller\OperatorController::class,'examAppliedReExam'])->middleware(['auth'])->name('operator.examApplied');


Route::get('statusUpdateExam', [\Operator\Http\Controller\OperatorController::class,'statusUpdateExam'])->middleware(['auth'])->name('operator.statusUpdate');
Route::get('deleteDuplicate/{id}', [\Operator\Http\Controller\OperatorController::class,'deleteDuplicate'])->middleware(['auth'])->name('operator.deleteDuplicate');


Route::get('/exportPCLCertificate',[\Operator\Http\Controller\OperatorController::class,'exportPCLCertificate'])->middleware(['auth'])->name('operator.exportPCLCertificate');
