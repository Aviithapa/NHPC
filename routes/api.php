<?php

use Council\Http\Controller\CouncilController;
use ExamCommittee\Http\Controller\ExamCommitteeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/dartaBook/council', [CouncilController::class, 'moveToDartaBookAPI'])->name('forward.moveToDartaBookAPI');
Route::post('/change/council/number', [CouncilController::class, 'FileChangeCouncilDateApi'])->name('forward.FileChangeCouncilDateApi');
