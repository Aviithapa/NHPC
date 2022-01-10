<?php

Route::get('/',  function() {
    return view('student::pages.dashboard');
})->middleware(['auth'])->name('student.dashboard');

Route::get('/student/personal',function (){
    return view('student::pages.personal');
})->middleware(['auth'])->name('personal');


Route::get('/student/guardian',function (){
    return view('student::pages.guardian');
})->middleware(['auth'])->name('guardian');

Route::get('/student/documents',function (){
    return view('student::pages.documents');
})->middleware(['auth'])->name('documents');

Route::get('/student/specific',function (){
    return view('student::pages.specific');
})->middleware(['auth'])->name('specific');


Route::post('/student/data', [\Student\Http\Controller\ProfileController::class, 'store'])->middleware(['auth'])->name('specific');
