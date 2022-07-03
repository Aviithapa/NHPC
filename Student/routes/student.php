<?php

Route::get('/',  [ \Student\Http\Controller\ProfileController::class, 'dashboard'])->middleware(['auth'])->name('student.dashboard');
Route::get('/student/{slug}', [ \Student\Http\Controller\ProfileController::class, 'index'])->middleware(['auth'])->name('student.{slug}');
Route::post('/save_image/{id?}', [\Student\Http\Controller\ProfileController::class, 'save_image'])->middleware(['auth'])->name('save_image');
Route::post('/student/data', [\Student\Http\Controller\ProfileController::class, 'store'])->middleware(['auth'])->name('specific');
Route::post('/student/data/update', [\Student\Http\Controller\ProfileController::class, 'update'])->middleware(['auth'])->name('information.update');
Route::get('/apply/for/exam', [\Student\Http\Controller\ProfileController::class, 'applyforExam'])->middleware(['auth'])->name('apply.for.exam');
Route::post('/update/apply/exam', [\Student\Http\Controller\ProfileController::class, 'updateApplyExam'])->middleware(['auth'])->name('update.apply.exam');
Route::get('/admit/card/template', [\Student\Http\Controller\ProfileController::class, 'admitCardTemplate'])->middleware(['auth'])->name('admit.card.template');
Route::post('/apply/exam', [\Student\Http\Controller\ProfileController::class, 'applyExam'])->middleware(['auth'])->name('apply.exam');
Route::post('/student/update/data/{id}', [\Student\Http\Controller\ProfileController::class, 'updateInformation'])->middleware(['auth'])->name('profile.update');

Route::get('/qualification/edit/{id}', [\Student\Http\Controller\QualificationController::class, 'edit'])->middleware(['auth'])->name('qualification.edit');
Route::post('/qualification/update/{id}', [\Student\Http\Controller\QualificationController::class, 'update'])->middleware(['auth'])->name('qualification.update');
Route::post('/student/collage/data', [\Student\Http\Controller\QualificationController::class, 'store'])->middleware(['auth'])->name('collage.data');
Route::get('/student/qualification/from', [ \Student\Http\Controller\QualificationController::class, 'create'])->middleware(['auth'])->name('qualification.from');
Route::get('/student/qualification/index', [ \Student\Http\Controller\QualificationController::class, 'index'])->middleware(['auth'])->name('qualification.index');
//Route::get('/student/specific', [ \Student\Http\Controller\ProfileController::class, 'index'])->middleware(['auth'])->name('student.specific');
Route::get('/student/qualification/slc/{id}', [\Student\Http\Controller\QualificationController::class, 'updateRejectedInformationIndex'])->middleware(['auth'])->name('qualification.update.index');
Route::post('/student/qualification/data/{id}', [\Student\Http\Controller\QualificationController::class, 'updateRejectedQualification'])->middleware(['auth'])->name('qualification.update.data');

Route::post('/qualification/student/collage/data', [\Student\Http\Controller\QualificationController::class, 'newQualificationStore'])->middleware(['auth'])->name('new.collage.data');



Route::get('/student/status/index/{status}', [\Student\Http\Controller\LogsController::class, 'index'])->middleware(['auth'])->name('status.index');
Route::get('/address/district', [\Student\Http\Controller\ProfileController::class, 'getDistrict'])->middleware(['auth'])->name('address.district');
Route::get('/address/municipality', [\Student\Http\Controller\ProfileController::class, 'getMunicipality'])->middleware(['auth'])->name('address.municipality');


Route::get('/link/certificate', [\Student\Http\Controller\CertificateController::class, 'index'])->middleware(['auth'])->name('certificate.index');
Route::get('/link/certificate/form', [\Student\Http\Controller\CertificateController::class, 'edit'])->middleware(['auth'])->name('certificate.edit');
Route::post('/link/certificate/validateCertificate', [\Student\Http\Controller\CertificateController::class, 'validateCertificate'])->middleware(['auth'])->name('certificate.validateCertificate');

//Route::get('/admit/card/print/index', [\Student\Http\Controller\ProfileController::class, 'admitCardPrintSection'])->middleware(['auth'])->name('admit.card.admitCardPrintSection');
//Route::post('/admit/card/print', [\Student\Http\Controller\ProfileController::class, 'admitCardRequestTemplate'])->middleware(['auth'])->name('admit.card.admitCardRequestTemplate');
Route::get('/admit/admitCardProfileId/{id}', [\Student\Http\Controller\ProfileController::class, 'admitCardProfileId'])->middleware(['auth'])->name('admit.card.admitCardProfileId');
