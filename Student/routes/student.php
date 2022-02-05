<?php

Route::get('/',  [ \Student\Http\Controller\ProfileController::class, 'dashboard'])->middleware(['auth'])->name('student.dashboard');
Route::get('/student/{slug}', [ \Student\Http\Controller\ProfileController::class, 'index'])->middleware(['auth'])->name('student.{slug}');
Route::get('/student/qualification/index', [ \Student\Http\Controller\QualificationController::class, 'index'])->middleware(['auth'])->name('qualification.index');
Route::get('/student/qualification/from', [ \Student\Http\Controller\QualificationController::class, 'create'])->middleware(['auth'])->name('qualification.from');
//Route::get('/student/specific', [ \Student\Http\Controller\ProfileController::class, 'index'])->middleware(['auth'])->name('student.specific');
Route::post('/save_image/{id?}', [\Student\Http\Controller\ProfileController::class, 'save_image'])->middleware(['auth'])->name('save_image');
Route::post('/student/data', [\Student\Http\Controller\ProfileController::class, 'store'])->middleware(['auth'])->name('specific');
Route::post('/student/collage/data', [\Student\Http\Controller\QualificationController::class, 'store'])->middleware(['auth'])->name('collage.data');
Route::post('/student/data/update', [\Student\Http\Controller\ProfileController::class, 'update'])->middleware(['auth'])->name('information.update');
Route::get('/student/status/index/{status}', [\Student\Http\Controller\LogsController::class, 'index'])->middleware(['auth'])->name('status.index');
Route::get('/apply/for/exam', [\Student\Http\Controller\ProfileController::class, 'applyforExam'])->middleware(['auth'])->name('apply.for.exam');
Route::get('/admit/card/template', [\Student\Http\Controller\ProfileController::class, 'admitCardTemplate'])->middleware(['auth'])->name('admit.card.template');
Route::post('/apply/exam', [\Student\Http\Controller\ProfileController::class, 'applyExam'])->middleware(['auth'])->name('apply.exam');
Route::get('/qualification/edit/{id}', [\Student\Http\Controller\QualificationController::class, 'edit'])->middleware(['auth'])->name('qualification.edit');
Route::post('/qualification/update/{id}', [\Student\Http\Controller\QualificationController::class, 'update'])->middleware(['auth'])->name('qualification.update');
Route::post('/student/update/data/{id}', [\Student\Http\Controller\ProfileController::class, 'updateInformation'])->middleware(['auth'])->name('profile.update');
