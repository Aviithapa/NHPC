<?php

use App\Http\Controllers\Auth\CaptchaValidationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('web.pages.index');
// });


Route::get('reload-captcha', [CaptchaValidationController::class, 'reloadCaptcha']);


require __DIR__ . '/auth.php';
