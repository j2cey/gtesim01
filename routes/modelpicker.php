<?php

use App\Http\Controllers\ModelPickerController;


Route::resource('modelpickers',ModelPickerController::class)->middleware('auth');
Route::get('modelpickers.test',[ModelPickerController::class,'test'])
    ->name('modelpickers.test')
    ->middleware('auth');
