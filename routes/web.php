<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UuidController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\SystemController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\Esims\EsimController;
use App\Http\Controllers\HowTos\HowToController;
use App\Http\Controllers\Esims\ClientEsimController;
use App\Http\Controllers\Esims\StatutEsimController;
use App\Http\Controllers\HowTos\HowToStepController;
use App\Http\Controllers\HowTos\HowToTypeController;
use App\Http\Controllers\Employes\PhoneNumController;
use App\Http\Controllers\Authorization\RoleController;
use App\Http\Controllers\HowTos\HowToThreadController;
use App\Http\Controllers\Employes\EmailAddressController;

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

Route::get('/', function () {
    if (Auth::check()) {
        return view('admin02');
    }
    return redirect('/login');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

#region System Settings

Route::get('systems.index',[SystemController::class,'index'])
    ->name('systems.index')
    ->middleware('auth');

Route::resource('settings',SettingController::class);
Route::get('settings.fetch',[SettingController::class,'fetch'])
    ->name('settings.fetch')
    ->middleware('auth');

Route::get('uuid.generate',[UuidController::class,'generate'])
    ->name('uuid.generate')
    ->middleware('auth');

#endregion

#region permissions & roles

Route::get('permissions',[RoleController::class, 'permissions'])->middleware('auth');

Route::resource('roles',RoleController::class)->middleware('auth');
Route::get('roles.fetch',[RoleController::class,'fetch'])
    ->name('roles.fetch')
    ->middleware('auth');
Route::get('hasrole/{roleid}',[RoleController::class, 'hasrole'])->middleware('auth');

Route::resource('users',UserController::class)->middleware('auth');
Route::get('users.fetch',[UserController::class,'fetch'])
    ->name('users.fetch')
    ->middleware('auth');
Route::get('users.fetchall',[UserController::class,'fetchall'])
    ->name('users.fetchall')
    ->middleware('auth');
Route::get('users.online', [UserController::class, 'onlineusers'])
    ->name('users.online')
    ->middleware('auth');

Route::get('users.sendmail/{id}',[UserController::class,'sendMail'])
    ->name('users.sendmail')
    ->middleware('auth');

#endregion

#region Email Adresses

Route::resource('emailaddresses',EmailAddressController::class)->middleware('auth');

#endregion

#region Phone Nums

Route::resource('phonenums',PhoneNumController::class)->middleware('auth');

#endregion

Route::resource('statuses',StatusController::class);
Route::get('statuses.fetch',[StatusController::class,'fetch'])
    ->name('statuses.fetch')
    ->middleware('auth');
Route::get('statuses.fetchone/{id}',[StatusController::class,'fetchone'])
    ->name('statuses.fetchone')
    ->middleware('auth');
Route::match(['post'],'statuses.modelupdate',[StatusController::class, 'modelupdate'])
    ->name('statuses.modelupdate')
    ->middleware('auth');

Route::resource('statutesims',StatutEsimController::class)->middleware('auth');
Route::get('statutesims.fetch',[StatutEsimController::class,'fetch'])
    ->name('statutesims.fetch')
    ->middleware('auth');
Route::get('statutesims.fetchall',[StatutEsimController::class,'fetchall'])
    ->name('statutesims.fetchall')
    ->middleware('auth');

Route::resource('esims',EsimController::class)->middleware('auth');
Route::get('esims.fetch',[EsimController::class,'fetch'])
    ->name('esims.fetch')
    ->middleware('auth');
Route::get('esims.fetchall',[EsimController::class,'fetchall'])
    ->name('esims.fetchall')
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
Route::post('clientesims.phonenums',[ClientEsimController::class,'phonenumstore'])
->name('clientesims.phonenums')
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

Route::get('pdf/preview', [PDFController::class, 'preview'])->name('pdf.preview');
Route::get('pdf/generate', [PDFController::class, 'generatePDF'])->name('pdf.generate');

Route::resource('howtotypes',HowToTypeController::class)->middleware('auth');
Route::get('howtotypes.fetch',[HowToTypeController::class,'fetch'])
    ->name('howtotypes.fetch')
    ->middleware('auth');
Route::get('howtotypes.fetchall',[HowToTypeController::class,'fetchall'])
    ->name('howtotypes.fetchall')
    ->middleware('auth');

Route::resource('howtos',HowToController::class)->middleware('auth');
Route::get('howtos.fetch',[HowToController::class,'fetch'])
    ->name('howtos.fetch')
    ->middleware('auth');
Route::get('howtos.fetchall',[HowToController::class,'fetchall'])
    ->name('howtos.fetchall')
    ->middleware('auth');
Route::get('howtos.edithtml/{id}',[HowToController::class,'edithtml'])
    ->name('howtos.edithtml')
    ->middleware('auth');
Route::post('howtos.storehtml',[HowToController::class,'storehtml'])
    ->name('howtos.storehtml')
    ->middleware('auth');
Route::get('howtos.readhtml/{id}',[HowToController::class,'readhtml'])
    ->name('howtos.readhtml')
    ->middleware('auth');

Route::resource('howtothreads',HowToThreadController::class)->middleware('auth');
Route::get('howtothreads.fetch',[HowToThreadController::class,'fetch'])
    ->name('howtothreads.fetch')
    ->middleware('auth');
Route::get('howtothreads.fetchall',[HowToThreadController::class,'fetchall'])
    ->name('howtothreads.fetchall')
    ->middleware('auth');
Route::get('howtothreads.fetchone/{id}',[HowToThreadController::class,'fetchone'])
    ->name('howtothreads.fetchone')
    ->middleware('auth');
Route::get('howtothreads.read/{id}/{posi}',[HowToThreadController::class,'read'])
    ->name('howtothreads.read')
    ->middleware('auth');

Route::get('howtothreads.posimax/{id}',[HowToThreadController::class,'posimax'])
    ->name('howtothreads.posimax')
    ->middleware('auth');
Route::post('howtothreads.storestep',[HowToThreadController::class,'storestep'])
    ->name('howtothreads.storestep')
    ->middleware('auth');

Route::resource('howtosteps',HowToStepController::class)->middleware('auth');
Route::get('howtosteps.fetch',[HowToStepController::class,'fetch'])
    ->name('howtosteps.fetch')
    ->middleware('auth');
Route::get('howtosteps.fetchall',[HowToStepController::class,'fetchall'])
    ->name('howtosteps.fetchall')
    ->middleware('auth');

Route::get('tags.fetchall',[TagController::class,'fetchall'])
    ->name('tags.fetchall')
    ->middleware('auth');
