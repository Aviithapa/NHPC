<?php

Route::get('/', [\SubjectCommittee\Http\Controller\SubjectCommitteeController::class, 'index'])->middleware(['auth'])->name('subjectCommittee.dashboard');

Route::get('/subjectCommittee/applicant-list/{status}/{current_state}', [\SubjectCommittee\Http\Controller\SubjectCommitteeController::class, 'exam'])->middleware(['auth'])->name('subjectCommittee.applicant.list');
Route::get('/subjectCommittee/applicant-profile-list/{status}/{current_state}/{level}/{page?}', [\SubjectCommittee\Http\Controller\SubjectCommitteeController::class, 'profile'])->middleware(['auth'])->name('subjectCommittee.applicant.profile.list');
Route::get('/subjectCommittee/acceptedByMe/{status}/{current_state}/{level}/{page?}', [\SubjectCommittee\Http\Controller\SubjectCommitteeController::class, 'acceptedByMe'])->middleware(['auth'])->name('subjectCommittee.acceptedByMe');
Route::get('/subjectCommittee/applicant-list-view/{id}', [\SubjectCommittee\Http\Controller\SubjectCommitteeController::class, 'edit'])->middleware(['auth'])->name('subjectCommittee.applicant.list.review');
Route::post('/subjectCommittee/applicant-profile-list', [\SubjectCommittee\Http\Controller\SubjectCommitteeController::class, 'status'])->middleware(['auth'])->name('subjectCommittee.applicant.profile.list.status');
Route::get('/subjectCommittee/verified-applicant-profile-list', [\SubjectCommittee\Http\Controller\SubjectCommitteeController::class, 'verified'])->middleware(['auth'])->name('subjectCommittee.verified.applicant.profile.list');
Route::get('/subjectCommittee/apply-exam-details/{id}', [\SubjectCommittee\Http\Controller\SubjectCommitteeController::class, "ExamApplyView"])->middleware(['auth'])->name('subjectCommittee.exam.apply');
Route::get('/subjectCommittee/accept-exam-applied/{id}', [\SubjectCommittee\Http\Controller\SubjectCommitteeController::class, "AcceptExamProcessing"])->middleware(['auth'])->name('subjectCommittee.accept.exam.apply');
Route::post('/subjectCommittee/rejected-exam-applied', [\SubjectCommittee\Http\Controller\SubjectCommitteeController::class, "RejectExamProcessing"])->middleware(['auth'])->name('subjectCommittee.reject.exam.apply');
Route::post('/subjectCommittee/signatureImage', [\SubjectCommittee\Http\Controller\SubjectCommitteeController::class, "signatureImage"])->middleware(['auth'])->name('subjectCommittee.signatureImage');


Route::get('/subjectCommittee/exam', [\SubjectCommittee\Http\Controller\SubjectCommitteeController::class, "moveExam"])->middleware(['auth'])->name('subjectCommittee.application.list.exam');
Route::get('/subjectCommittee/council', [\SubjectCommittee\Http\Controller\SubjectCommitteeController::class, "moveCouncil"])->middleware(['auth'])->name('subjectCommittee.application.list.council');
Route::get('/subjectCommittee/moveCouncilPost', [\SubjectCommittee\Http\Controller\SubjectCommitteeController::class, "moveCouncilPost"])->middleware(['auth'])->name('subjectCommittee.application.list.moveCouncilPost');

Route::get('/search/student', [\SubjectCommittee\Http\Controller\SearchController::class, "index"])->middleware(['auth'])->name('subjectCommittee.search.student');
Route::get('/search', [\SubjectCommittee\Http\Controller\SearchController::class, "search"])->middleware(['auth'])->name('search');
Route::get('/countSubjectCom', [\SubjectCommittee\Http\Controller\SubjectCommitteeController::class, "countSubjectCom"])->middleware(['auth'])->name('countSubjectCom');
Route::get('/backSubjectCommittee', [\SubjectCommittee\Http\Controller\SubjectCommitteeController::class, "backSubjectCommittee"])->middleware(['auth'])->name('backSubjectCommittee');
Route::get('/rejectProfileName', [\SubjectCommittee\Http\Controller\SubjectCommitteeController::class, "rejectProfileName"])->middleware(['auth'])->name('rejectProfileName');
