<?php

use App\Http\Controllers\EsimStateController;
use App\Http\Controllers\Esims\EsimController;
use App\Http\Controllers\Esims\ClientEsimController;
use App\Http\Controllers\Esims\StatutEsimController;


#region statut esims
Route::resource('statutesims',StatutEsimController::class)->middleware('auth');
Route::get('statutesims.fetch',[StatutEsimController::class,'fetch'])
    ->name('statutesims.fetch')
    ->middleware('auth');
Route::get('statutesims.fetchall',[StatutEsimController::class,'fetchall'])
    ->name('statutesims.fetchall')
    ->middleware('auth');
Route::match(['post'],'statutesims.setnext',[StatutEsimController::class, 'setnext'])
    ->name('statutesims.setnext')
    ->middleware('auth');
Route::match(['post'],'statutesims.modelupdate',[StatutEsimController::class, 'modelupdate'])
    ->name('statuses.modelupdate')
    ->middleware('auth');

#endregion

#region esims
Route::resource('esims',EsimController::class)->middleware('auth');
Route::get('esims.fetch',[EsimController::class,'fetch'])
    ->name('esims.fetch')
    ->middleware('auth');
Route::get('esims.fetchall',[EsimController::class,'fetchall'])
    ->name('esims.fetchall')
    ->middleware('auth');
Route::get('esims.fetchone/{id}',[EsimController::class,'fetchone'])
    ->name('esims.fetchone')
    ->middleware('auth');

Route::get('esims.headfiles',[EsimController::class,'headfiles'])
    ->name('esims.headfiles')
    ->middleware('auth');
Route::post('esims.headfiles',[EsimController::class,'headfilespost'])
    ->name('esims.headfilespost')
    ->middleware('auth');

Route::get('esims.bodyfiles',[EsimController::class,'bodyfiles'])
    ->name('esims.bodyfiles')
    ->middleware('auth');
Route::post('esims.bodyfiles',[EsimController::class,'bodyfilespost'])
    ->name('esims.bodyfilespost')
    ->middleware('auth');

#endregion

#region client esims
Route::resource('clientesims',ClientEsimController::class)->middleware('auth');
Route::get('clientesims.fetch',[ClientEsimController::class,'fetch'])
    ->name('clientesims.fetch')
    ->middleware('auth');
Route::get('clientesims.fetchall',[ClientEsimController::class,'fetchall'])
    ->name('clientesims.fetchall')
    ->middleware('auth');
Route::get('clientesims.generatepdf/{id}',[ClientEsimController::class,'generatePDF'])
->name('clientesims.generatepdf')
->middleware('auth');
Route::get('clientesims.previewpdf/{id}',[ClientEsimController::class,'previewPDF'])
->name('clientesims.previewpdf')
->middleware('auth');
Route::get('clientesims.preprintpdf/{id}',[ClientEsimController::class,'preprintPDF'])
->name('clientesims.preprintpdf')
->middleware('auth');
Route::get('clientesims.mailtest/{id}',[ClientEsimController::class,'mailtest'])
->name('clientesims.mailtest')
->middleware('auth');

Route::post('clientesims.phonenumschangeesim',[ClientEsimController::class,'phonenumschangeesim'])
->name('clientesims.phonenumschangeesim')
->middleware('auth');

Route::get('clientesims.sendmail/{id}',[ClientEsimController::class,'sendMail'])
->name('clientesims.sendmail')
->middleware('auth');

Route::post('clientesims.checkbeforecreate',[ClientEsimController::class,'checkbeforecreate'])
->name('clientesims.checkbeforecreate')
->middleware('auth');
Route::get('clientesims.checkbeforecreate',[ClientEsimController::class,'checkbeforecreate'])
->name('clientesims.checkbeforecreate')
->middleware('auth');

Route::match(['put', 'patch'],'clientesims.deletephone/{clientesim}',[ClientEsimController::class,'deletephone'])
    ->name('clientesims.deletephone')
    ->middleware('auth');

#endregion

#region EsimState

Route::resource('esimstates',EsimStateController::class)->middleware('auth');

#endregion
