<?php

use Council\Http\Controller\CouncilController;
use ExamCommittee\Http\Controller\ExamCommitteeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Matrix\Operators\Operator;
use Operator\Http\Controller\OperatorController;
use SubjectCommittee\Http\Controller\SubjectCommitteeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/result/import', [ExamCommitteeController::class, 'fileImport'])->name('result.import');

Route::get('/forward/council', [ExamCommitteeController::class, 'FileForwardCouncil'])->name('forward.council');

Route::get('/dartaBook/council', [CouncilController::class, 'moveToDartaBookAPI'])->name('forward.moveToDartaBookAPI'); // For bachelor, pcl, master
Route::get('/dartaBook/tslc', [CouncilController::class, 'moveTSLCToDartaBookAPI'])->name('forward.moveTSLCToDartaBookAPI'); // For TSLC






Route::post('/change/council/number', [CouncilController::class, 'FileChangeCouncilDateApi'])->name('forward.FileChangeCouncilDateApi');

Route::post('/change/council/date', [CouncilController::class, 'ChangeCouncilDateApi'])->name('forward.ChangeCouncilDateApi');

Route::post('/reject/exam_committee', [CouncilController::class, 'RejectExamCommitteeFileApi'])->name('forward.RejectExamCommitteeFileApi');
Route::post('/old-applicant/import', [\Operator\Http\Controller\OperatorController::class, 'OldfileImport'])->name('operator.import.old.file');
Route::post('/re-exam/exam_committee', [CouncilController::class, 'ReExamCommitteeFileApi'])->name('forward.ReExamCommitteeFileApi');

Route::get('/updateCount', [SubjectCommitteeController::class, 'updateCount']);


Route::get('/updateLogs', [\Operator\Http\Controller\OperatorController::class, 'updateLogs']);

Route::get('/exportCsvWithUniversity', [OperatorController::class, 'exportCsvWithUniversity']);
