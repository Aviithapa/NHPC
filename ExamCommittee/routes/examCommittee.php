<?php

Route::get('/', [\ExamCommittee\Http\Controller\ExamCommitteeController::class,'index'])->middleware(['auth'])->name('examCommittee.dashboard');



Route::get('/examCommittee/admit-card-generate/{status}/{current_state}', [\ExamCommittee\Http\Controller\ExamCommitteeController::class, 'admit'])->middleware(['auth'])->name('examCommittee.all.user');
Route::get('examCommittee/dashboard/examCommittee/generate-admit-card/{status}/{current_state}/{program_id}', [ \ExamCommittee\Http\Controller\ExamCommitteeController ::class, 'generateAdmitCard'])->middleware(['auth'])->name('examCommittee.admit.card.generate');
Route::get('examCommittee/dashboard/examCommittee/view-admit-card/{id}', [ \ExamCommittee\Http\Controller\ExamCommitteeController ::class, 'viewAdmitCardDetails'])->middleware(['auth'])->name('examCommittee.view.admit.card');
Route::get('examCommittee/dashboard/examCommittee/admit-Card-Generated-Student', [ \ExamCommittee\Http\Controller\ExamCommitteeController ::class, 'admitCardGeneratedStudent'])->middleware(['auth'])->name('examCommittee.admit.card.generated');
Route::get('examCommittee/dashboard/examCommittee/view-program-wise-registered-student/{program_id}', [ \ExamCommittee\Http\Controller\ExamCommitteeController ::class, 'programWiseStudent'])->middleware(['auth'])->name('examCommittee.program.wise.student');
Route::get('/export', [ \ExamCommittee\Http\Controller\ExamCommitteeController ::class, 'exportCsv'])->middleware(['auth'])->name('examCommittee.export');
Route::get('/removeFlagGeneratedYes', [ \ExamCommittee\Http\Controller\ExamCommitteeController ::class, 'removeFlagGeneratedYes'])->middleware(['auth'])->name('examCommittee.removeFlagGeneratedYes');
Route::post('examCommittee/dashboard/examCommittee/import-result', [ \ExamCommittee\Http\Controller\ExamCommitteeController ::class, 'fileImport'])->middleware(['auth'])->name('examCommittee.import.result');


Route::get('/examCommittee/search/student',[\ExamCommittee\Http\Controller\SearchController::class,"index"])->middleware(['auth'])->name('examCommittee.search.student');
Route::get('/examCommittee/search',[\ExamCommittee\Http\Controller\SearchController::class,"search"])->middleware(['auth'])->name('examCommittee.search');

Route::get('/examCommittee/FileForwardCouncil', [\ExamCommittee\Http\Controller\SearchController::class,"FileForwardCouncil"])->middleware(['auth'])->name('examCommittee.FileForwardCouncil');