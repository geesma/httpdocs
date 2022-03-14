<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\HistoriaController;
use App\Http\Controllers\TemporadaController;
use App\Http\Controllers\LigaController;
use App\Http\Controllers\TemporadaLigaController;
use App\Http\Controllers\PostController;

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
    return redirect('/user/login');
});

Route::middleware(['notLogged'])->group(function() {
    Route::get('/user/login', [UserController::class, 'login'])->name("user.login");
    Route::post('/user/login', [UserController::class, 'do_login'])->name("user.login.post");
    Route::post('/user/loginPassword', [UserController::class, 'do_login_password'])->name("user.login.password");
});

Route::middleware(['logged'])->group(function() {

    //ADMIN ROUTES
    Route::middleware(['admin'])->group(function() {

    });

    //EDITOR ROUTES
    Route::middleware(['editor'])->group(function() {
        Route::get('/user', [UserController::class, 'all'])->name('user.all');
        Route::delete('/user', [UserController::class, 'destroy'])->name('user.delete');
        Route::post('/user/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/user/{id}/bio', [UserController::class, 'addBioToUser'])->name('user.bio.add');
        Route::delete('/bio/{id}', [UserController::class, 'removeBioToUser'])->name('user.bio.destroy');
        Route::get('/bio', [UserController::class, 'removeBioToUser'])->name('user.bio.get');
    });

    //SELF OR EDITOR ROUTES
    Route::middleware(['selfOrEditor'])->group(function() {
        Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::patch('/user/edit/{id}', [UserController::class, 'update'])->name('user.update');
    });

    //MODERATOR ROUTES
    Route::middleware(['moderator'])->group(function() {
        Route::resource('historia', HistoriaController::class)->only(['update']);
        Route::resource('temporada', TemporadaController::class)->except(['index','show']);
        Route::resource('liga', LigaController::class)->except(['index','show']);
        Route::resource('temporada.liga', TemporadaLigaController::class)->except(['index','show']);
        Route::resource('post', PostController::class)->except(['index','show']);
    });

    //USER ROUTES
    Route::get('/user/logoff', [UserController::class, 'do_logoff'])->name('user.logoff');
    Route::get('/user/{id}', [UserController::class, 'view'])->name('user.view');
    Route::resource('historia', HistoriaController::class)->only(['index']);
    Route::resource('temporada', TemporadaController::class)->only(['index','show']);
    Route::resource('liga', LigaController::class)->only(['index','show']);
    Route::resource('temporada.liga', TemporadaLigaController::class)->only(['index','show']);
    Route::get('historico', [TemporadaController::class, 'historico'])->name('temporada.historico');
    Route::resource('post', PostController::class)->only(['index','show']);
});
