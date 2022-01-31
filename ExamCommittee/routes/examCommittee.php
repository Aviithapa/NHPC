<?php

Route::get('/', function () {
    return view('examCommittee::pages.dashboard');
})->middleware(['auth'])->name('examCommittee.dashboard');


Route::get('/examCommittee/admit-card-generate/{status}/{current_state}', [\ExamCommittee\Http\Controller\ExamCommitteeController::class, 'admit'])->middleware(['auth'])->name('examCommittee.all.user');
Route::get('examCommittee/dashboard/examCommittee/generate-admit-card/{status}/{current_state}', [ \ExamCommittee\Http\Controller\ExamCommitteeController ::class, 'generateAdmitCard'])->middleware(['auth'])->name('examCommittee.admit.card.generate');
Route::get('examCommittee/dashboard/examCommittee/view-admit-card/{id}', [ \ExamCommittee\Http\Controller\ExamCommitteeController ::class, 'viewAdmitCardDetails'])->middleware(['auth'])->name('examCommittee.view.admit.card');
Route::post('examCommittee/dashboard/examCommittee/import-result', [ \ExamCommittee\Http\Controller\ExamCommitteeController ::class, 'fileImport'])->middleware(['auth'])->name('examCommittee.import.result');
