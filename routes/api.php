<?php

use App\Mail\Mail;
use App\Models\Classe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\coefController;
use App\Http\Controllers\EleveController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\niveauController;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\UserController;

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
// Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api')->name('logout');
Route::post('/users/{id}/logout', [AuthController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::middleware('auth:api')->group(function () {
    Route::get('/classes/discipline', [ClasseController::class, 'getDiscipline']);
    Route::get('/niveaux', [niveauController::class, 'index']);
    Route::apiResource('/eleves', EleveController::class)->only(['store']);
    Route::get('/classes/{id}/eleve', [ClasseController::class, 'show']);
    Route::apiResource('/classes/{id}/coef', coefController::class)->only(['store']);
    Route::get('/classes/{id}/coef', [coefController::class, 'show']);
    Route::get('/classes/evaluation', [ClasseController::class, 'getEvaluation']);
    Route::post('/classes/evaluation', [ClasseController::class, 'storeEvaluation']);
    Route::post('/classes/discipline', [ClasseController::class, 'storeDiscipline']);
    Route::match(['put', 'patch'], '/eleves/sortie', [EleveController::class, 'sortie']);
    Route::post('/classes/{classeId}/disciplines/{disciplineId}/evaluations/{evaluationId}', [ClasseController::class, 'insertNote']);
    Route::match(['put', 'patch'], '/classes/{classeId}/disciplines/{disciplineId}/evaluations/{evaluationId}', [ClasseController::class, 'updateNote']);
    Route::get('/classes/{id}/disciplines/{disciplineId}/notes', [ClasseController::class, 'getNoteByDiscipline']);
    Route::get('/classes/{id}/notes', [ClasseController::class, 'getNoteByClasse']);
    Route::get('/classes/{id}/notes/eleve/{eleveId}', [ClasseController::class, 'getNoteByEleve']);
    Route::get('/evenements', [EvenementController::class, 'index']);
    Route::apiResource('/evenements', EvenementController::class)->only(['index', 'store']);
    Route::post('/evenement/{id}/participation', [EvenementController::class, 'participate']);
    Route::get('/evenement/{id}/eleves', [EvenementController::class, 'getEvents']);
    Route::get('/eleves/{id}/participation', [EleveController::class, 'getEventsByEleve']);
    Route::apiResource('/users', UserController::class);
    Route::get('/users/{id}/evenement', [UserController::class, 'getEventsByUser']);
});
