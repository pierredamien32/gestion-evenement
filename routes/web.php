<?php

use App\Models\Sponsor;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\EventMiddleware;
use App\Http\Middleware\AccessMiddleware;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\EntrepriseController;

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

Route::get('/user/passwordforgot/resetLink', [GeneralController::class,'sendResetLink'] )->name('sendResetLink');
Route::get('/', [GeneralController::class,'index'] )->name('index');
Route::get('/user/passwordforgot/sendCode', [GeneralController::class,'sendCode'] )->name('sendCode');
Route::get('/user/passwordforgot/reset', [GeneralController::class,'reset'] )->name('reset');
Route::get('/user/passwordforgot', [GeneralController::class,'pwdForm'] )->name('pwdForm');

Route::get('/form/formEvent', [EvenementController::class,'formEvent'])->name('formEvent')->middleware(EventMiddleware::class);
Route::get('/form/formCoutEvent', [EvenementController::class,'formCoutEvent'])->name('formCoutEvent')->middleware(EventMiddleware::class);
Route::get('/form/formImage', [EvenementController::class,'formImage'])->name('formImage')->middleware(EventMiddleware::class);
Route::get('/event/createEvent', [EvenementController::class,'createEvent'])->name('createEvent')->middleware(EventMiddleware::class);
Route::get('/cout/createCoutEvent', [EvenementController::class,'createCoutEvent'])->name('createCoutEvent')->middleware(EventMiddleware::class);
Route::post('/image/createImageEvent', [EvenementController::class,'createImageEvent'])->name('createImageEvent')->middleware(EventMiddleware::class);
Route::get('/allEvents', [EvenementController::class,'allEvents'])->name('allEvents');
Route::get('/searchEvents', [EvenementController::class,'searchEvents'])->name('searchEvents');
Route::get('/categories/{category}/eventCategory', [EvenementController::class,'eventCategory'])->name('eventCategory');
Route::get('/{id}/events', [EvenementController::class,'oneEvent'])->name('oneEvent');
Route::get('/user/reserver', [EvenementController::class,'reserver'])->name('reserver')->middleware(AccessMiddleware::class);
Route::get('/reserver/reservation', [EvenementController::class,'reservation'])->name('reservation')->middleware(AccessMiddleware::class);
Route::get('/reserver/reservationEvent', [EvenementController::class,'createReservationEvent'])->name('createReservationEvent')->middleware(AccessMiddleware::class);
Route::get('/{user}/myEvents', [EvenementController::class,'myEvents'])->name('myEvents');

Route::get('/categorie/addCategorie', [CategorieController::class,'addCategorie'])->name('addCategorie')->middleware(AccessMiddleware::class);
Route::get('/niveau/addNivAcces', [CategorieController::class,'addNivAcces'])->name('addNivAcces')->middleware(AccessMiddleware::class);
Route::get('/sponsor/addSponsor', [CategorieController::class,'addSponsor'])->name('addSponsor')->middleware(AccessMiddleware::class);

Route::get('/client/form', [ClientController::class,'formClient'])->name('formClient');
Route::get('/client/add', [ClientController::class,'addClient'])->name('addClient');
Route::get('/user/loginPage', [ClientController::class,'loginPage'])->name('loginPage');
Route::post('/user/login', [ClientController::class,'login'])->name('login');
Route::post('/user/logout', [ClientController::class,'logout'])->name('logout');

Route::get('/welcome', [EntrepriseController::class,'welcome'] )->name('welcome');
Route::post('/entreprise/verification', [EntrepriseController::class,'verifyCode'])->name('verifyCode');
Route::get('/entreprise/form', [EntrepriseController::class,'formEntreprise'])->name('formEntreprise');
Route::get('/entreprise/attente-confirm', [EntrepriseController::class,'attenteconfirm'])->name('attenteconfirm');
Route::get('/entreprise/add', [EntrepriseController::class,'addEntreprise'] )->name('addEntreprise');
Route::get('/entreprise/confirmer', [EntrepriseController::class,'confirmer'] )->name('confirmer');

Route::get('/admin/notification', [AdminController::class,'adminNotification'] )->name('adminNotification')->middleware('auth');
Route::get('/admin/allEvents', [AdminController::class,'allEventsAdmin'] )->name('allEventsAdmin');
Route::get('/entrepriseForm/admin', [AdminController::class,'formEntrepriseAdmin'])->name('formEntrepriseAdmin')->middleware('auth');
Route::get('/admin/form', [AdminController::class,'adminRegister'] )->name('adminRegister');
Route::get('/admin/index', [AdminController::class,'superPage'] )->name('superPage')->middleware('auth');
Route::get('/admin/welcome', [AdminController::class,'indexAd'] )->name('indexAd');
Route::get('/admin/register', [AdminController::class,'adminForm'] )->name('adminForm')->middleware(AuthMiddleware::class);
Route::post('/admin/login', [AdminController::class,'adminLogin'] )->name('adminLogin');
Route::get('/admin', [AdminController::class,'adminLoginForm'] )->name('adminLoginForm');
Route::get('/admin/notifications', [AdminController::class,'adminNotification'] )->name('adminNotification');
Route::get('/admin/notifications/{id}/read', [AdminController::class,'markAsRead'] )->name('markAsRead');
Route::get('/admin/notifications/readAll', [AdminController::class,'markAllAsRead'] )->name('markAllAsRead');
Route::get('/admin/notifications/{id}/reject', [AdminController::class,'markAsReject'] )->name('markAsReject');
Route::post('/admin/logout', [AdminController::class, 'adminLogout'])->name('adminLogout');

