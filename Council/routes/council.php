<?php
Route::get('/', function () {
    return view('council::pages.dashboard');
})->middleware(['auth'])->name('council.dashboard');
