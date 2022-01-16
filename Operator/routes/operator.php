<?php

Route::get('/',  function() {
    dd("you are here");
    return view('operator::pages.dashboard');})->middleware(['auth'])->name('operator.dashboard');
