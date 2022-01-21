<?php

Route::get('/',  function() {
    return view('officer::pages.dashboard');})->middleware(['auth'])->name('officer.dashboard');
