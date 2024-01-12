<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\NiveauController;
use App\Http\Controllers\backend\MatiereController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\EtablissementController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('admin.pages.dashboard_home');
// });


/*********************ROUTE BACKEND ********************************************** */


Route::prefix("admin")->group(function () {

  //Home dashboard
  Route::controller(DashboardController::class)->group(function () {
    Route::get('/', 'index')->name('dashboard.index');
  });


  //Category dashboard
  Route::controller(CategoryController::class)->prefix('categorie')->group(function () {
    Route::get('/', 'index')->name('categorie.index');
    Route::post('/store', 'store')->name('categorie.store');
    route::post('update/{id}', 'update')->name('categorie.update');
    route::post('destroy/{id}', 'destroy')->name('categorie.destroy');
  });

  //Niveau dashboard
  Route::controller(NiveauController::class)->prefix('niveau')->group(function () {
    Route::get('/', 'index')->name('niveau.index');
    Route::post('/store', 'store')->name('niveau.store');
    route::post('update/{id}', 'update')->name('niveau.update');
    route::post('destroy/{id}', 'destroy')->name('niveau.destroy');
  });

  //Matiere dashboard
  Route::controller(MatiereController::class)->prefix('matiere')->group(function () {
    Route::get('/', 'index')->name('matiere.index');
    Route::post('/store', 'store')->name('matiere.store');
    route::post('update/{id}', 'update')->name('matiere.update');
    route::post('destroy/{id}', 'destroy')->name('matiere.destroy');
  });


  //Etablissement dashboard
  Route::controller(EtablissementController::class)->prefix('etablissement')->group(function () {
    Route::get('/', 'index')->name('etablissement.index');
    Route::post('/store', 'store')->name('etablissement.store');
    route::post('update/{id}', 'update')->name('etablissement.update');
    route::post('destroy/{id}', 'destroy')->name('etablissement.destroy');
  });


});
