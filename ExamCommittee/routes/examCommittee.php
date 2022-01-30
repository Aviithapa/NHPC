<?php

Route::get('/', function () {
    return view('examCommittee::pages.dashboard');
})->middleware(['auth'])->name('examCommittee.dashboard');


Route::get('/examCommittee/applicant-list/{status}/{current_state}', [\ExamCommittee\Http\Controller\ExamCommitteeController::class, 'exam'])->middleware(['auth'])->name('examCommittee.applicant.list');
Route::get('/examCommittee/applicant-profile-list/{status}/{current_state}', [ \ExamCommittee\Http\Controller\ExamCommitteeController ::class, 'profile'])->middleware(['auth'])->name('examCommittee.applicant.profile.list');
Route::get('/examCommittee/applicant-list-view/{id}', [\ExamCommittee\Http\Controller\ExamCommitteeController::class, 'edit'])->middleware(['auth'])->name('examCommittee.applicant.list.review');
Route::post('/examCommittee/applicant-profile-list', [\ExamCommittee\Http\Controller\ExamCommitteeController::class, 'status'])->middleware(['auth'])->name('examCommittee.applicant.profile.list.status');
Route::get('/examCommittee/verified-applicant-profile-list', [\ExamCommittee\Http\Controller\ExamCommitteeController::class, 'verified'])->middleware(['auth'])->name('examCommittee.verified.applicant.profile.list');
Route::get('/examCommittee/apply-exam-details/{id}', [\ExamCommittee\Http\Controller\ExamCommitteeController::class, "ExamApplyView"])->middleware(['auth'])->name('examCommittee.exam.apply');
Route::get('/examCommittee/accept-exam-applied/{id}', [\ExamCommittee\Http\Controller\ExamCommitteeController::class, "AcceptExamProcessing"])->middleware(['auth'])->name('examCommittee.accept.exam.apply');
Route::post('/examCommittee/rejected-exam-applied', [\ExamCommittee\Http\Controller\ExamCommitteeController::class, "RejectExamProcessing"])->middleware(['auth'])->name('examCommittee.reject.exam.apply');

