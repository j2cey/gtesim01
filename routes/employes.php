<?php

use App\Http\Controllers\Employes\EmployeController;
use App\Http\Controllers\Employes\PhoneNumController;
use App\Http\Controllers\Employes\DepartementController;
use App\Http\Controllers\Employes\EmailAddressController;
use App\Http\Controllers\Employes\FonctionEmployeController;
use App\Http\Controllers\Employes\TypeDepartementController;


#region Email Adresses

Route::resource('emailaddresses',EmailAddressController::class)->middleware('auth');

#endregion

#region Phone Nums

Route::resource('phonenums',PhoneNumController::class)->middleware('auth');
Route::match(['put','patch'],'phonenums.changeesim/{phonenum}',[PhoneNumController::class, 'changeesim'])
    ->name('phonenums.changeesim')
    ->middleware('auth');
Route::get('phonenums.getchangeesim/{id}',[PhoneNumController::class, 'getchangeesim'])
    ->name('phonenums.getchangeesim')
    ->middleware('auth');

#endregion

#region types departements

Route::resource('typedepartements',TypeDepartementController::class)->middleware('auth');
Route::get('typedepartements.fetch',[TypeDepartementController::class,'fetch'])
    ->name('typedepartements.fetch')
    ->middleware('auth');
Route::get('typedepartements.fetchall',[TypeDepartementController::class,'fetchall'])
    ->name('typedepartements.fetchall')
    ->middleware('auth');

#endregion

#region departements
Route::resource('departements',DepartementController::class)->middleware('auth');
Route::get('departements.fetch',[DepartementController::class,'fetch'])
    ->name('departements.fetch')
    ->middleware('auth');
Route::get('departements.fetchall',[DepartementController::class,'fetchall'])
    ->name('departements.fetchall')
    ->middleware('auth');

#endregion

#region fonctions employe
Route::resource('fonctionemployes',FonctionEmployeController::class)->middleware('auth');
Route::get('fonctionemployes.fetch',[FonctionEmployeController::class,'fetch'])
    ->name('fonctionemployes.fetch')
    ->middleware('auth');
Route::get('fonctionemployes.fetchall',[FonctionEmployeController::class,'fetchall'])
    ->name('fonctionemployes.fetchall')
    ->middleware('auth');

#endregion

#region employes
Route::resource('employes',EmployeController::class)->middleware('auth');
Route::get('employes.fetch',[EmployeController::class,'fetch'])
    ->name('employes.fetch')
    ->middleware('auth');
Route::get('employes.fetchall',[EmployeController::class,'fetchall'])
    ->name('employes.fetchall')
    ->middleware('auth');

#endregion