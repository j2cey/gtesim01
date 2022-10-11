<?php

use App\Mail\TestMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UuidController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\SystemController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\Audit\AuditController;
use App\Http\Controllers\HowTos\HowToController;
use App\Http\Controllers\Comments\CommentController;
use App\Http\Controllers\HowTos\HowToStepController;
use App\Http\Controllers\HowTos\HowToTypeController;
use App\Http\Controllers\Authorization\RoleController;
use App\Http\Controllers\HowTos\HowToThreadController;
use App\Http\Controllers\Authorization\PermissionController;

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

/**
 * Test mail
 */
/*
Route::get('/send-email', function() {
    Mail::to('j2cey@j2cey.dev')->send(new TestMail);
});*/

/**
 * Test Redis
 */
/*Route::get('/store', function() {
    Redis::set('foo', 'bar');
});

Route::get('/retrieve', function() {
    return Redis::get('foo');
});*/

Route::get('/', function () {
    if (Auth::check()) {
        return view('admin02');
    }
    return redirect('/login');
})->name('home');

require __DIR__.'/auth.php';

#region System Settings

Route::get('systems.index',[SystemController::class,'index'])
    ->name('systems.index')
    ->middleware('auth');

Route::resource('settings',SettingController::class);
Route::get('settings.fetch',[SettingController::class,'fetch'])
    ->name('settings.fetch')
    ->middleware('auth');
Route::get('settings.types',[SettingController::class,'settingtypes'])
    ->name('settings.types')
    ->middleware('auth');

Route::get('audits.index', [AuditController::class,'index'])
    ->name('audits.index')
    ->middleware('auth');
Route::get('audits.fetch',[AuditController::class,'fetch'])
->name('audits.fetch')
->middleware('auth');

Route::get('audits.fetchall',[AuditController::class,'fetchall'])
    ->name('audits.fetchall')
    ->middleware('auth');

Route::get('uuid.generate',[UuidController::class,'generate'])
    ->name('uuid.generate')
    ->middleware('auth');

#endregion

#region permissions & roles

//Route::get('permissions',[RoleController::class, 'permissions'])->middleware('auth');

Route::resource('permissions',PermissionController::class)->middleware('auth');
Route::get('permissions.fetch',[PermissionController::class,'fetch'])
    ->name('permissions.fetch')
    ->middleware('auth');

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
Route::get('users.fetchone/{id}',[UserController::class,'fetchone'])
    ->name('users.fetchone')
    ->middleware('auth');

Route::get('users.online', [UserController::class, 'onlineusers'])
    ->name('users.online')
    ->middleware('auth');

Route::get('users.sendmail/{id}',[UserController::class,'sendMail'])
    ->name('users.sendmail')
    ->middleware('auth');

#endregion

#region statuses

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

#endregion

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
Route::get('howtothreads.read/{id}',[HowToThreadController::class,'read'])
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
Route::get('howtosteps.read/{id}',[HowToStepController::class,'read'])
    ->name('howtosteps.read')
    ->middleware('auth');
Route::get('howtosteps.relativesteps/{id}',[HowToStepController::class,'relativesteps'])
    ->name('howtosteps.relativesteps')
    ->middleware('auth');

Route::get('tags.fetchall',[TagController::class,'fetchall'])
    ->name('tags.fetchall')
    ->middleware('auth');

Route::resource('comments',CommentController::class)->middleware('auth');
Route::get('comments.fetchall',[CommentController::class,'fetchall'])
    ->name('comments.fetchall')
    ->middleware('auth');
