<?php

use App\Http\Controllers\ActionController;
use App\Http\Controllers\AnnaleController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CalendrierController;
use App\Http\Controllers\CandidatureController;
use App\Http\Controllers\DiplomeController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\EcueController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\UeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});

Route::group(['middleware' => ['auth:sanctum']], function () {
 
});
Route::post('/user/connexion', [AuthenticatedSessionController::class, 'store']);
Route::post('/user/inscription', [RegisteredUserController::class, 'store']);
Route::get('/user/all', [RegisteredUserController::class, 'usr']);
Route::get('/user/{user}', [RegisteredUserController::class, 'show']);
Route::post('/user/final_inscription/{user}', [RegisteredUserController::class, 'updateUser']);
Route::post('/login', [RegisteredUserController::class, 'login']);
Route::resource("candidature", CandidatureController::class)->except('destroy', 'create', 'update', 'edit');
Route::resource("ue", UeController::class)->except('destroy', 'create', 'update', 'edit');
Route::resource("ecue", EcueController::class)->except('destroy', 'create', 'update', 'edit');
Route::resource("notes", NoteController::class)->except('destroy', 'create', 'update', 'edit');
Route::resource("document", DocumentController::class)->except('create', 'update', 'edit');
Route::get('/pdf/{document}', [DocumentController::class, 'dpdf']);
Route::get('/pdfD/{diplome}', [DiplomeController::class, 'dpdf']);
Route::get('/pdfR/{result}', [ResultController::class, 'dpdf']);
Route::resource("annale", AnnaleController::class)->except('create', 'update', 'edit');
Route::resource("calendrier", CalendrierController::class)->except('create', 'update', 'edit');
Route::get("/diplome/notification", [ActionController::class, "notifi"]);
Route::post("/diplome/updateRq", [ActionController::class, "updaterq"]);
Route::resource("diplome", DiplomeController::class)->except('create', 'edit');
Route::resource("result", ResultController::class)->except('create', 'edit');
Route::post('/logout', [RegisteredUserController::class, 'perform']); 