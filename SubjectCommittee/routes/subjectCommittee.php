<?php

Route::get('/',  function () {
    return view('subjectCommittee::pages.dashboard');
})->middleware(['auth'])->name('subjectCommittee.dashboard');


Route::get('/subjectCommittee/applicant-list/{status}/{current_state}', [\SubjectCommittee\Http\Controller\SubjectCommitteeController::class, 'exam'])->middleware(['auth'])->name('subjectCommittee.applicant.list');
Route::get('/subjectCommittee/applicant-profile-list/{status}/{current_state}/{level}', [\SubjectCommittee\Http\Controller\SubjectCommitteeController::class, 'profile'])->middleware(['auth'])->name('subjectCommittee.applicant.profile.list');
Route::get('/subjectCommittee/applicant-list-view/{id}', [\SubjectCommittee\Http\Controller\SubjectCommitteeController::class, 'edit'])->middleware(['auth'])->name('subjectCommittee.applicant.list.review');
Route::post('/subjectCommittee/applicant-profile-list', [\SubjectCommittee\Http\Controller\SubjectCommitteeController::class, 'status'])->middleware(['auth'])->name('subjectCommittee.applicant.profile.list.status');
Route::get('/subjectCommittee/verified-applicant-profile-list', [\SubjectCommittee\Http\Controller\SubjectCommitteeController::class, 'verified'])->middleware(['auth'])->name('subjectCommittee.verified.applicant.profile.list');
Route::get('/subjectCommittee/apply-exam-details/{id}', [\SubjectCommittee\Http\Controller\SubjectCommitteeController::class, "ExamApplyView"])->middleware(['auth'])->name('subjectCommittee.exam.apply');
Route::get('/subjectCommittee/accept-exam-applied/{id}', [\SubjectCommittee\Http\Controller\SubjectCommitteeController::class, "AcceptExamProcessing"])->middleware(['auth'])->name('subjectCommittee.accept.exam.apply');
Route::post('/subjectCommittee/rejected-exam-applied', [\SubjectCommittee\Http\Controller\SubjectCommitteeController::class, "RejectExamProcessing"])->middleware(['auth'])->name('subjectCommittee.reject.exam.apply');
Route::post('/subjectCommittee/signatureImage', [\SubjectCommittee\Http\Controller\SubjectCommitteeController::class, "signatureImage"])->middleware(['auth'])->name('subjectCommittee.signatureImage');
Route::get('/search/student', [\SubjectCommittee\Http\Controller\SearchController::class, "index"])->middleware(['auth'])->name('subjectCommittee.search.student');
Route::get('/search', [\SubjectCommittee\Http\Controller\SearchController::class, "search"])->middleware(['auth'])->name('search');
