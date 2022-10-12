<?php
Route::get('/', function () {
    return view('council::pages.dashboard');
})->middleware(['auth'])->name('council.dashboard');


Route::match(['get', 'post'], '/council/darta/book', [\Council\Http\Controller\CouncilController::class,'dartaBookIndex'])->middleware(['auth'])->name('council.darta.book');
Route::get('/council/applicant/darta/book/{id?}/{date?}', [\Council\Http\Controller\CouncilController::class,'applicantdartaBookIndex'])->middleware(['auth'])->name('applicant.darta.details');
Route::get('/council/applicant/passed/list', [\Council\Http\Controller\CouncilController::class,'getallExamPassedList'])->middleware(['auth'])->name('council.pass.list');
Route::get('/council/applicant/tslc/list', [\Council\Http\Controller\CouncilController::class,'getallTSLCPassedList'])->middleware(['auth'])->name('council.tslc.list');
Route::get('/council/applicant/move/to/darta/book', [\Council\Http\Controller\CouncilController::class,'moveToDartaBook'])->middleware(['auth'])->name('council.move.to.darta.book');
Route::get('/council/applicant/move/to/tslc/book', [\Council\Http\Controller\CouncilController::class,'moveToTSLCDartaBook'])->middleware(['auth'])->name('council.tslc.move.to.darta.book');
Route::get('/council/decisionDate/Update', [\Council\Http\Controller\CouncilController::class,'changeDecisionDate'])->middleware(['auth'])->name('council.UpdateDecisionDate');
Route::get('/student/view/{id}', [\Council\Http\Controller\CouncilController::class,'edit'])->middleware(['auth'])->name('council.edit');



Route::match(['get', 'post'], '/officer/subjectCommittee/minuteIndex',[\Council\Http\Controller\CouncilController::class,'minuteDataSubjectCommitteeIndex'])->middleware(['auth'])->name('subjectCommittee.minuteDataSubjectCommitteeIndex.officer');
Route::match(['get', 'post'], '/officer/minute/applicant/list/{id}/{date?}',[\Council\Http\Controller\CouncilController::class,'minuteDataApplicantIndex'])->middleware(['auth'])->name('subjectCommittee.minute.applicant.list.officer');
