<?php

use App\Http\Controllers\Dashboard\DashboardController;


Route::get('dashboards.index',[DashboardController::class,'index'])
    ->name('dashboards.index')
    ->middleware('auth');

Route::get('dashboards.details/{agence?}',[DashboardController::class,'detailsget'])
    ->name('dashboards.detailsget')
    ->middleware('auth');
Route::post('dashboards.details',[DashboardController::class,'detailspost'])
    ->name('dashboards.detailspost')
    ->middleware('auth');

Route::get('dashboards.fetchrawstats',[DashboardController::class,'fetchrawstats'])
    ->name('dashboards.fetchrawstats')
    ->middleware('auth');

Route::get('dashboards.fetchmonthsofyear',[DashboardController::class,'fetchmonthsofyear'])
    ->name('dashboards.fetchmonthsofyear')
    ->middleware('auth');

Route::get('dashboards.fetchcurrentmonth',[DashboardController::class,'fetchcurrentmonth'])
    ->name('dashboards.fetchcurrentmonth')
    ->middleware('auth');

Route::get('dashboards.fetchweeksofyear',[DashboardController::class,'fetchweeksofyear'])
    ->name('dashboards.fetchweeksofyear')
    ->middleware('auth');

Route::get('dashboards.fetchcurrentweek',[DashboardController::class,'fetchcurrentweek'])
    ->name('dashboards.fetchcurrentweek')
    ->middleware('auth');

Route::get('dashboards.fetchmonthstats/{month}/{agence}',[DashboardController::class,'fetchmonthstats'])
    ->name('dashboards.fetchmonthstats')
    ->middleware('auth');

Route::get('dashboards.fetchweekstats/{week}/{agence}',[DashboardController::class,'fetchweekstats'])
    ->name('dashboards.fetchweekstats')
    ->middleware('auth');

Route::get('dashboards.fetchyears',[DashboardController::class,'fetchyears'])
    ->name('dashboards.fetchyears')
    ->middleware('auth');

Route::get('dashboards.fetchcurrentyear',[DashboardController::class,'fetchcurrentyear'])
    ->name('dashboards.fetchcurrentyear')
    ->middleware('auth');

Route::get('dashboards.fetchyearstats/{year}/{agence}',[DashboardController::class,'fetchyearstats'])
    ->name('dashboards.fetchyearstats')
    ->middleware('auth');

Route::get('dashboards.fetchagencestats/{agence}',[DashboardController::class,'fetchagencestats'])
    ->name('dashboards.fetchagencestats')
    ->middleware('auth');
