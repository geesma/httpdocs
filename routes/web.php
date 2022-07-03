<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\HistoriaController;
use App\Http\Controllers\TemporadaController;
use App\Http\Controllers\LigaController;
use App\Http\Controllers\TemporadaLigaController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\DiplomasController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\EstatutoController;
use App\Http\Controllers\PremioController;
use App\Http\Controllers\UserImagesController;

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
        Route::delete('temporada/{temporada}/galeria', [GalleryController::class, 'destroy'])->name('temporada.galeria.delete');
        Route::get('temporada/{temporada}/galeria/edit', [GalleryController::class, 'edit'])->name('temporada.galeria.edit');
        Route::delete('temporada/{temporada}/diploma', [DiplomasController::class, 'destroy'])->name('temporada.diploma.delete');
        Route::get('temporada/{temporada}/diploma/edit', [DiplomasController::class, 'edit'])->name('temporada.diploma.edit');
        Route::get('temporada/{temporada}/album/create', [AlbumController::class, 'create'])->name('temporada.album.create');
        Route::post('temporada/{temporada}/album', [AlbumController::class, 'store'])->name('temporada.album.save');
        Route::get('albums', [AlbumController::class, 'index'])->name('album.index');
        Route::resource('temporada.galeria', GalleryController::class)->except(['index','show','delete', 'edit']);
        Route::get('galeria/create', [GalleryController::class, 'createGaleria'])->name('temporada.createGaleria');
        Route::resource('temporada.diploma', DiplomasController::class)->except(['index','show','delete', 'edit']);
        Route::get('diploma/create', [DiplomasController::class, 'createDiploma'])->name('temporada.createDiploma');
    });

    //SELF OR EDITOR ROUTES
    Route::middleware(['selfOrEditor'])->group(function() {
        Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::patch('/user/edit/{id}', [UserController::class, 'update'])->name('user.update');
        Route::post('/user_images/{id}', [UserImagesController::class, 'store'])->name('user_images.store');
        Route::delete('/user_images/{id}', [UserImagesController::class, 'destroy'])->name('user_images.delete');
    });

    //MODERATOR ROUTES
    Route::middleware(['moderator'])->group(function() {
        Route::resource('historia', HistoriaController::class)->only(['update']);
        Route::resource('estatuto', EstatutoController::class)->except(['index','show']);
        Route::resource('premio', PremioController::class)->except(['index','show']);
        Route::post('media', [MediaController::class, 'upload'])->name('media.upload');
        Route::resource('temporada', TemporadaController::class)->except(['index','show']);
        Route::resource('liga', LigaController::class)->except(['index','show']);
        Route::resource('temporada.liga', TemporadaLigaController::class)->except(['index','show']);
        Route::resource('post', PostController::class)->except(['index','show']);
    });

    //USER ROUTES
    Route::get('/user/logoff', [UserController::class, 'do_logoff'])->name('user.logoff');
    Route::get('/user/{id}', [UserController::class, 'view'])->name('user.view');
    Route::resource('historia', HistoriaController::class)->only(['index']);
    Route::resource('estatuto', EstatutoController::class)->only(['index', 'show']);
    Route::resource('premio', PremioController::class)->only(['index', 'show']);
    Route::resource('temporada', TemporadaController::class)->only(['index','show']);
    Route::resource('liga', LigaController::class)->only(['index','show']);
    Route::resource('temporada.liga', TemporadaLigaController::class)->only(['index','show']);
    Route::get('historico', [TemporadaController::class, 'historico'])->name('temporada.historico');
    Route::resource('post', PostController::class)->only(['index','show']);
    Route::resource('temporada.galeria', GalleryController::class)->only(['index','show']);
    Route::resource('temporada.diploma', DiplomasController::class)->only(['index','show']);
    Route::get('temporada/{temporada}/albums', [AlbumController::class, 'show'])->name('album.show');
    Route::get('/past-champions', [TemporadaController::class, 'past_champions'])->name('temporada.pastChampions');
});
