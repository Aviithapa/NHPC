<?php

Route::get('/',  function() {
    return view('officer::pages.dashboard');})->middleware(['auth'])->name('officer.dashboard');

Route::get('/officer/applicant-profile-list',[\officer\Http\Controller\OfficerController::class,'index'])->middleware(['auth'])->name('officer.applicant.profile.list');

