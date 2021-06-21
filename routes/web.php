<?php
 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\VotersController;
 
Route::get('/', [AuthController::class, 'showFormLogin'])->name('login');
Route::get('login', [AuthController::class, 'showFormLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showFormRegister'])->name('register');
Route::post('register', [AuthController::class, 'register']);


Route::group(['middleware' => 'auth'], function () {
    
    Route::group(['prefix' => 'dashboard'], function(){
        Route::get('home', [HomeController::class, 'index'])->name('home');
    });
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');    
    
    Route::post('event/create', [EventController::class, 'store'])->name('eventcreate');
    Route::post('event/update', [EventController::class, 'update'])->name('eventupdate');
    Route::post('event/addcandidate', [EventController::class, 'storeCandidate'])->name('addcandidate');
    Route::get('event/deletecandidate/{id}', [EventController::class, 'destroyCandidate'])->name('deletecandidate');
    Route::get('event/statuscandidate/{id}/{statval}', [EventController::class, 'statusCandidate'])->name('statuscandidate');
    
});

Route::get('auth/flushsession', [AuthController::class, 'flushsession']);
Route::get('{slug}', [VotersController::class, 'index']);
Route::get('event/pushvote/{idevent}/{idcandidate}/{voters}', [EventController::class, 'pushVote'])->name('pushvote');