<?php
Route::get('/', function () {
    return view('council::pages.dashboard');
})->middleware(['auth'])->name('council.dashboard');


Route::get('/council/darta/book', [\Council\Http\Controller\CouncilController::class,'dartaBookIndex'])->middleware(['auth'])->name('council.darta.book');
Route::get('/council/applicant/darta/book/{id}', [\Council\Http\Controller\CouncilController::class,'applicantdartaBookIndex'])->middleware(['auth'])->name('applicant.darta.details');
Route::get('/council/applicant/passed/list', [\Council\Http\Controller\CouncilController::class,'getallExamPassedList'])->middleware(['auth'])->name('council.pass.list');
Route::get('/council/applicant/move/to/darta/book', [\Council\Http\Controller\CouncilController::class,'moveToDartaBook'])->middleware(['auth'])->name('council.move.to.darta.book');
