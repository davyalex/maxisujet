<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\DashboardController;

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

  
  Route::prefix("admin")->group(function(){

//Home dashboard
        Route::controller(DashboardController::class)->group(function(){
            Route::get('/', 'index')->name('dashboard.index');
        });


        //Category dashboard
        Route::controller(CategoryController::class)->group(function(){
            Route::get('/categorie', 'index')->name('categorie.index');
        });

  });
