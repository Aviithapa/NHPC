<?php

use Illuminate\Support\Facades\Auth;

Route::get('/',  [\Operator\Http\Controller\OperatorController::class, 'dashboard'])->middleware(['auth'])->name('operator.dashboard');
Route::get('/operator/applicant-list/{status}/{state}', [\Operator\Http\Controller\OperatorController::class, 'exam'])->middleware(['auth'])->name('operator.applicant.list');
Route::get('/operator/applicant-profile-list/{status}/{state}/{level}', [\Operator\Http\Controller\OperatorController::class, 'profile'])->middleware(['auth'])->name('operator.applicant.profile.list');
Route::post('/operator/applicant-profile-list', [\Operator\Http\Controller\OperatorController::class, 'status'])->middleware(['auth'])->name('operator.applicant.profile.list.status');
Route::get('/operator/applicant-list-view/{id}', [\Operator\Http\Controller\OperatorController::class, 'edit'])->middleware(['auth'])->name('operator.applicant.list.review');
Route::get('/operator/accept-exam-applied/{id}', [\Operator\Http\Controller\OperatorController::class, "AcceptExamProcessing"])->middleware(['auth'])->name('operator.accept.exam.apply');
Route::post('/operator/rejected-exam-applied', [\Operator\Http\Controller\OperatorController::class, "RejectExamProcessing"])->middleware(['auth'])->name('operator.reject.exam.apply');
Route::post('/operator/rejected-re-exam-applied', [\Operator\Http\Controller\OperatorController::class, "ReExamProcessing"])->middleware(['auth'])->name('operator.re-exam.exam.apply');
Route::get('/search/student', [\Operator\Http\Controller\SearchController::class, "index"])->middleware(['auth'])->name('search.student');
Route::get('/search', [\Operator\Http\Controller\SearchController::class, "search"])->middleware(['auth'])->name('search');

Route::post('/update/apply/exam', [\Operator\Http\Controller\OperatorController::class, 'applyExam'])->middleware(['auth'])->name('update.apply.exam');
Route::get('/apply/exam/{id}', [\Operator\Http\Controller\OperatorController::class, 'editExamApply'])->middleware(['auth'])->name('apply.exam');

Route::post('/applicant-profile-list/level', [\Operator\Http\Controller\OperatorController::class, 'level'])->middleware(['auth'])->name('operator.applicant.profile.list.level');
Route::get('/applicant-profile-list/doubleDustur', [\Operator\Http\Controller\OperatorController::class, 'doubleDustur'])->middleware(['auth'])->name('operator.applicant.profile.list.doubleDustur');

Route::get('/search/collage', [\Operator\Http\Controller\SearchController::class, "collageIndex"])->middleware(['auth'])->name('search.collage.index');
Route::post('/collage/search', [\Operator\Http\Controller\SearchController::class, "collageSearch"])->middleware(['auth'])->name('collage.search');
Route::get('/view/certificate/{id}/{level}',  [\Operator\Http\Controller\OperatorController::class, 'printCertificate'])->middleware(['auth'])->name('operator.dashboard.view');
Route::get('/certificate/index/{status}/{program_id}',  [\Operator\Http\Controller\OperatorController::class, 'printCertificateIndex'])->middleware(['auth'])->name('operator.dashboard.printCertificateIndex');
Route::get('/certificate/isPrinted/{id}',  [\Operator\Http\Controller\OperatorController::class, 'printedCertificate'])->middleware(['auth'])->name('operator.dashboard.printedCertificate');
Route::get('/certificate/card/{status}',  [\Operator\Http\Controller\OperatorController::class, 'printCertificateDashboard'])->middleware(['auth'])->name('operator.dashboard.printCertificateDashboard');
Route::get('/view/printedCertificate/{id}/{level}',  [\Operator\Http\Controller\OperatorController::class, 'printed'])->middleware(['auth'])->name('operator.dashboard.view.printedCertificate');


Route::get('/student/program/{id}/{status}/{state}',  [\Operator\Http\Controller\OperatorController::class, 'getProgramWiseStudent'])->middleware(['auth'])->name('operator.dashboard.getProgramWiseStudent');

Route::get('/subjectCommittee/dashboard', [\Operator\Http\Controller\OperatorController::class, 'subjectCommitteeDashboard'])->middleware(['auth'])->name('subjectCommittee.dashboard.operator');
Route::get('/subjectCommittee/dashboard/list/{level?}/{status?}/{subject_committee_id?}/{page?}', [\Operator\Http\Controller\OperatorController::class, 'subjectCommitteeDashboardList'])->middleware(['auth'])->name('subjectCommittee.dashboard.operator.list');
Route::post('/subjectCommittee/dashboard/list/{level?}/{status?}/{subject_committee_id?}/{page?}', [\Operator\Http\Controller\OperatorController::class, 'subjectCommitteeDashboardList'])->middleware(['auth'])->name('subjectCommittee.dashboard.operator.list');
Route::get('/exam/dashboard/{level_id}', [\Operator\Http\Controller\OperatorController::class, 'examStudentCount'])->middleware(['auth'])->name('examStudentCount.dashboard.operator');

Route::get('/update/certificate/{certificate_id}/{level}', [\Operator\Http\Controller\OperatorController::class, 'updateCertificateIndex'])->middleware(['auth'])->name('examStudentCount.dashboard.updateCertificateIndex');
Route::post('/update/certificates', [\Operator\Http\Controller\OperatorController::class, 'updateCertificate'])->middleware(['auth'])->name('examStudentCount.dashboard.updateCertificate');


Route::post('/operator/fowardStudents', [\Operator\Http\Controller\OperatorController::class, 'fowardStudentState'])->middleware(['auth'])->name('operator.fowardStudentState');

Route::get('examApplied/{id}/{profile_id}', [\Operator\Http\Controller\OperatorController::class, 'deleteExamApplied'])->middleware(['auth'])->name('operator.deleteExamApplied');
Route::get('/exportCSV', [\Operator\Http\Controller\OperatorController::class, 'exportCsv'])->middleware(['auth'])->name('operator.exportCsv');

Route::get('/move/exam_committee/{id}', [\Operator\Http\Controller\OperatorController::class, 'examAppliedReExam'])->middleware(['auth'])->name('operator.examApplied');


Route::get('statusUpdateExam', [\Operator\Http\Controller\OperatorController::class, 'statusUpdateExam'])->middleware(['auth'])->name('operator.statusUpdate');
Route::get('deleteDuplicate/{id}', [\Operator\Http\Controller\OperatorController::class, 'deleteDuplicate'])->middleware(['auth'])->name('operator.deleteDuplicate');


Route::get('/exportPCLCertificate', [\Operator\Http\Controller\OperatorController::class, 'exportPCLCertificate'])->middleware(['auth'])->name('operator.exportPCLCertificate');

Route::get('/failedStudentList', [\Operator\Http\Controller\OperatorController::class, 'failedStudentList'])->middleware(['auth'])->name('operator.failedStudentList');

Route::match(['get', 'post'], '/search/lost/students', [\Operator\Http\Controller\SearchController::class, "searchStudent"])->middleware(['auth'])->name('search.lost.students');



Route::get('/exam/view/{id}', [\Operator\Http\Controller\OperatorController::class, 'examDetails'])->middleware(['auth'])->name('operator.exam.view');
Route::get('/program/student/{id}/{exam_id}', [\Operator\Http\Controller\OperatorController::class, 'getProgramStudent'])->middleware(['auth'])->name('operator.program.student');
Route::post('/program/student/csv', [\Operator\Http\Controller\OperatorController::class, 'programWiseStudentCountCSV'])->middleware(['auth'])->name('operator.program.student.csv');
Route::post('/student/detail/csv', [\Operator\Http\Controller\OperatorController::class, 'studentDetailCSV'])->middleware(['auth'])->name('operator.student.detail.csv');




Route::get('/studentUpdateExamApplyId', [\Operator\Http\Controller\SearchController::class, 'studentUpdateExamApplyId'])->middleware(['auth'])->name('operator.studentUpdateExamApplyId');
Route::get('/getDisappearStudents', [\Operator\Http\Controller\OperatorController::class, 'getDisappearStudents'])->middleware(['auth'])->name('operator.getDisappearStudents');


Route::get('/student/card/{id}', [\Operator\Http\Controller\OperatorController::class, 'studentCardShow'])->middleware(['auth'])->name('operator.student.card.show');




Route::get('/certificate/history', [\Operator\Http\Controller\OperatorController::class, 'certificateIndex'])->middleware(['auth'])->name('operator.certificateIndex');
Route::post('/certificate/storeCertificateData', [\Operator\Http\Controller\OperatorController::class, 'storeCertificateData'])->middleware(['auth'])->name('operator.storeCertificateData');
Route::get('/certificate/history/print/{id}', [\Operator\Http\Controller\OperatorController::class, 'printPartilipiCertificate'])->middleware(['auth'])->name('operator.certificateIndex.print');
Route::get('/certificate/history/edit/{id}', [\Operator\Http\Controller\OperatorController::class, 'editCertificateData'])->middleware(['auth'])->name('operator.certificateIndex.edit');
Route::post('/certificate/history/update', [\Operator\Http\Controller\OperatorController::class, 'updateCertificateData'])->middleware(['auth'])->name('operator.certificateIndex.update');
Route::get('/certificate/history/add', [\Operator\Http\Controller\OperatorController::class, 'addPrintCertificate'])->middleware(['auth'])->name('operator.addPrintCertificate');
Route::get('/certificate/history/duplicate/{id}', [\Operator\Http\Controller\OperatorController::class, 'printDuplicateCertificate'])->middleware(['auth'])->name('operator.certificateIndex.duplicate');

Route::get('/certificate/back/{id}', [\Operator\Http\Controller\OperatorController::class, 'backCertificate'])->middleware(['auth'])->name('operator.certificateIndex.backCertificate');
Route::post('/certificate/storebackData', [\Operator\Http\Controller\OperatorController::class, 'storeBackData'])->middleware(['auth'])->name('operator.storeCertificateData');
Route::get('/certificate/backData/edit/{id}', [\Operator\Http\Controller\OperatorController::class, 'editCertificateData'])->middleware(['auth'])->name('operator.certificateIndex.edit');
Route::post('/certificate/backData/update', [\Operator\Http\Controller\OperatorController::class, 'updateCertificateData'])->middleware(['auth'])->name('operator.certificateIndex.update');
Route::get('/certificate/back/add/{id}', [\Operator\Http\Controller\OperatorController::class, 'addDataCertificate'])->middleware(['auth'])->name('operator.backCertificate.add');



Route::post('/old-applicant/import', [\Operator\Http\Controller\OperatorController::class, 'OldfileImport'])->middleware(['auth'])->name('operator.import.old.file');




Route::get('/certificate/data/print/{id}', [\Operator\Http\Controller\OperatorController::class, 'printCertificateBackUpData'])->middleware(['auth'])->name('operator.printCertificateBackUpData');
Route::get('/certificate/edit/print/{id}', [\Operator\Http\Controller\OperatorController::class, 'editCertificateBackUpData'])->middleware(['auth'])->name('operator.editCertificateBackUpData');
Route::post('/certificate/back/update', [\Operator\Http\Controller\OperatorController::class, 'updateCertificateBackUpData'])->middleware(['auth'])->name('operator.updateCertificateBackUpData');

// Route::get('/certificate/history/edit/{id}', [\Operator\Http\Controller\OperatorController::class, 'editCertificateData'])->middleware(['auth'])->name('operator.certificateIndex.edit');
// Route::post('/certificate/history/update', [\Operator\Http\Controller\OperatorController::class, 'updateCertificateData'])->middleware(['auth'])->name('operator.certificateIndex.update');
// Route::get('/certificate/history/add', [\Operator\Http\Controller\OperatorController::class, 'addPrintCertificate'])->middleware(['auth'])->name('operator.addPrintCertificate');
// Route::get('/certificate/history/duplicate/{id}', [\Operator\Http\Controller\OperatorController::class, 'printDuplicateCertificate'])->middleware(['auth'])->name('operator.certificateIndex.duplicate');


Route::match(['get', 'post'], '/search/certificate/students', [\Operator\Http\Controller\SearchController::class, "searchCertificateStudent"])->middleware(['auth'])->name('search.lost.searchCertificateStudent');



Route::get('/kyc', [\Operator\Http\Controller\OperatorController::class, 'kycIndex'])->middleware(['auth'])->name('operator.kyc');

Route::get('/allocate/{id}', [\Operator\Http\Controller\OperatorController::class, 'allocate'])->middleware(['auth'])->name('operator.allocate');

// Route::get('/certificate/edit/print/{id}', [\Operator\Http\Controller\OperatorController::class, 'editCertificateBackUpData'])->middleware(['auth'])->name('operator.editCertificateBackUpData');
// Route::post('/certificate/back/update', [\Operator\Http\Controller\OperatorController::class, 'updateCertificateBackUpData'])->middleware(['auth'])->name('operator.updateCertificateBackUpData');
