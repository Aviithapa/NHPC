<?php

Route::get('/',  function() {
    return view('operator::pages.dashboard');})->middleware(['auth'])->name('operator.dashboard');


Route::get('/operator/applicant-list',[\Operator\Http\Controller\OperatorController::class,'index'])->middleware(['auth'])->name('operator.applicant.list');
Route::get('/operator/applicant-list/{id}',[\Operator\Http\Controller\OperatorController::class,'edit'])->middleware(['auth'])->name('operator.applicant.list.review');
