<?php

Route::get('/',  function() {
    return view('student::pages.dashboard');
})->middleware(['auth'])->name('student.dashboard');

//Route::get('/student/personal',function (){
//    return view('student::pages.personal');
//})->middleware(['auth'])->name('personal');

//
//Route::get('/student/guardian',function (){
//    return view('student::pages.guardian');
//})->middleware(['auth'])->name('guardian');

Route::get('/student/documents',function (){
    return view('student::pages.documents');
})->middleware(['auth'])->name('documents');
//
//Route::get('/student/specific',function (){
//    return view('student::pages.specific');
//})->middleware(['auth'])->name('specific');
Route::get('/student/specific', [\Student\Http\Controller\ProfileController::class, 'specificIndex'])->middleware(['auth'])->name('student.specific');
Route::get('/student/guardian', [\Student\Http\Controller\ProfileController::class, 'guardianIndex'])->middleware(['auth'])->name('student.guardian');
Route::get('/student/personal', [\Student\Http\Controller\ProfileController::class, 'index'])->middleware(['auth'])->name('personal');
Route::post('/student/data', [\Student\Http\Controller\ProfileController::class, 'store'])->middleware(['auth'])->name('specific');
Route::post('/student/data/update', [\Student\Http\Controller\ProfileController::class, 'update'])->middleware(['auth'])->name('information.update');
