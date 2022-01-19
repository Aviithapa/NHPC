<?php

Route::get('/',  function() {
    return view('operator::pages.dashboard');})->middleware(['auth'])->name('operator.dashboard');
