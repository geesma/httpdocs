<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\HistoriaController;

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
    Route::get('/user/login', [UserController::class, 'login']);
    Route::post('/user/login', [UserController::class, 'do_login']);
    Route::post('/user/loginPassword', [UserController::class, 'do_login_password']);
});

Route::middleware(['logged'])->group(function() {
    //USER ROUTES
    Route::get('/user/logoff', [UserController::class, 'do_logoff'])->name('user.logoff');
    Route::get('/user/{id}', [UserController::class, 'view'])->name('user.view');
    Route::resource('/historia', HistoriaController::class)->only(['index']);

    //SELF OR EDITOR ROUTES
    Route::middleware(['selfOrEditor'])->group(function() {
        Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    });

    //MODERATOR ROUTES
    Route::middleware(['moderator'])->group(function() {
        Route::resource('/historia', HistoriaController::class)->only(['update']);
    });

    //EDITOR ROUTES
    Route::middleware(['editor'])->group(function() {
        Route::get('/user', [UserController::class, 'all'])->name('user.all');
        Route::delete('/user', [UserController::class, 'destroy'])->name('user.delete');
        Route::post('/user/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/user/{id}/bio', [UserController::class, 'addBioToUser'])->name('user.bio.add');
    });

    //ADMIN ROUTES
    Route::middleware(['admin'])->group(function() {

    });




    Route::any('*', function () {
        echo "error 404";
        return "error";
    });

});
