<?php

use ExamCommittee\Http\Controller\ExamCommitteeController;

Route::get('/', [\ExamCommittee\Http\Controller\ExamCommitteeController::class, 'index'])->middleware(['auth'])->name('examCommittee.dashboard');



Route::get('/examCommittee/admit-card-generate/{status}/{current_state}', [\ExamCommittee\Http\Controller\ExamCommitteeController::class, 'admit'])->middleware(['auth'])->name('examCommittee.all.user');
Route::get('examCommittee/dashboard/examCommittee/generate-admit-card/{status}/{current_state}/{program_id}', [\ExamCommittee\Http\Controller\ExamCommitteeController::class, 'generateAdmitCard'])->middleware(['auth'])->name('examCommittee.admit.card.generate');
Route::get('examCommittee/dashboard/examCommittee/view-admit-card/{id}', [\ExamCommittee\Http\Controller\ExamCommitteeController::class, 'viewAdmitCardDetails'])->middleware(['auth'])->name('examCommittee.view.admit.card');
Route::get('examCommittee/dashboard/examCommittee/admit-Card-Generated-Student', [\ExamCommittee\Http\Controller\ExamCommitteeController::class, 'admitCardGeneratedStudent'])->middleware(['auth'])->name('examCommittee.admit.card.generated');
Route::get('examCommittee/dashboard/examCommittee/view-program-wise-registered-student/{program_id}', [\ExamCommittee\Http\Controller\ExamCommitteeController::class, 'programWiseStudent'])->middleware(['auth'])->name('examCommittee.program.wise.student');
Route::get('/export/{id}', [\ExamCommittee\Http\Controller\ExamCommitteeController::class, 'exportCsv'])->middleware(['auth'])->name('examCommittee.export');

Route::get('/exportAllExamCommitteeStudent/{id}', [\ExamCommittee\Http\Controller\ExamCommitteeController::class, 'exportAllExamCommitteeStudent'])->middleware(['auth'])->name('examCommittee.exportAllExamCommitteeStudent');

Route::get('/removeFlagGeneratedYes', [\ExamCommittee\Http\Controller\ExamCommitteeController::class, 'removeFlagGeneratedYes'])->middleware(['auth'])->name('examCommittee.removeFlagGeneratedYes');
Route::post('examCommittee/dashboard/examCommittee/import-result', [\ExamCommittee\Http\Controller\ExamCommitteeController::class, 'fileImport'])->middleware(['auth'])->name('examCommittee.import.result');


Route::get('/examCommittee/search/student', [\ExamCommittee\Http\Controller\SearchController::class, "index"])->middleware(['auth'])->name('examCommittee.search.student');
Route::get('/examCommittee/search', [\ExamCommittee\Http\Controller\SearchController::class, "search"])->middleware(['auth'])->name('examCommittee.search');

Route::get('/examCommittee/FileForwardCouncil', [\ExamCommittee\Http\Controller\ExamCommitteeController::class, "FileForwardCouncil"])->middleware(['auth'])->name('examCommittee.FileForwardCouncil');


Route::get('/exam/view/{id}', [\ExamCommittee\Http\Controller\ExamCommitteeController::class, 'examDetails'])->middleware(['auth'])->name('examCommittee.exam.view');

Route::get('/getAllStudentList', [\ExamCommittee\Http\Controller\ExamCommitteeController::class, 'getAllStudentList']);


Route::get('/subjectCommittee/dashboard', [ExamCommitteeController::class, 'subjectCommitteeDashboard'])->middleware(['auth'])->name('subjectCommittee.dashboard.exam');
Route::get('/subjectCommittee/dashboard/list/{level?}/{status?}/{subject_committee_id?}/{page?}', [ExamCommitteeController::class, 'subjectCommitteeDashboardList'])->middleware(['auth'])->name('subjectCommittee.dashboard.exam.list');
Route::post('/subjectCommittee/dashboard/list/{level?}/{status?}/{subject_committee_id?}/{page?}', [ExamCommitteeController::class, 'subjectCommitteeDashboardList'])->middleware(['auth'])->name('subjectCommittee.dashboard.exam.list');

