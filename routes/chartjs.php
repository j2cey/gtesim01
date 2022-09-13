<?php

use App\Http\Controllers\Chartjs\ChartjsController;


Route::get('chartjs.index',[ChartjsController::class,'index'])
    ->name('chartjs.index')
    ->middleware('auth');
