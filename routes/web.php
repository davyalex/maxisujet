<?php


use App\Models\Telechargement;
use App\Models\CategoryInformation;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\NewsController;
use App\Http\Controllers\backend\RoleController;
use App\Http\Controllers\backend\SujetController;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\backend\NiveauController;
use App\Http\Controllers\backend\MatiereController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\frontend\AccountController;
use App\Http\Controllers\backend\AuthAdminController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\frontend\AuthUserController;
use App\Http\Controllers\frontend\NewsFrontController;
use App\Http\Controllers\frontend\SujetFrontController;
use App\Http\Controllers\backend\CategoryNewsController;
use App\Http\Controllers\frontend\CommentaireController;
use App\Http\Controllers\backend\EtablissementController;
use App\Http\Controllers\frontend\TelechargementController;

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

##login  for dashboard
Route::controller(AuthAdminController::class)->group(function () {
  route::get('/sign-in', 'login')->name('auth.login');
  route::post('/sign-in', 'login')->name('auth.login');
});

Route::prefix("admin")->middleware(['admin'])->group(function () {
  //Authentification 
  Route::controller(AuthAdminController::class)->prefix('auth-admin')->group(function () {
    route::get('', 'listUser')->name('user.index');
    // route::get('create', 'create')->name('user.create');
    route::post('store', 'store')->name('user.store');
    route::get('edit/{id}', 'edit')->name('user.edit');
    route::post('update/{id}', 'update')->name('user.update');
    route::post('destroy/{id}', 'destroy')->name('user.destroy');
    route::get('logout', 'logout')->name('user.logout');
  });

  //role dashboard
  Route::controller(RoleController::class)->prefix('role')->group(function () {
    Route::get('/', 'index')->name('role.index');
    Route::post('/store', 'store')->name('role.store');
    route::post('update/{id}', 'update')->name('role.update');
    route::post('destroy/{id}', 'destroy')->name('role.destroy');
  });

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


  //Category news dashboard
  Route::controller(CategoryNewsController::class)->prefix('categorie-news')->group(function () {
    Route::get('/', 'index')->name('categorie-news.index');
    Route::post('/store', 'store')->name('categorie-news.store');
    route::post('update/{id}', 'update')->name('categorie-news.update');
    route::post('destroy/{id}', 'destroy')->name('categorie-news.destroy');
  });


  //news  dashboard
  Route::controller(NewsController::class)->prefix('news')->group(function () {
    Route::get('/', 'index')->name('news.index');
    Route::get('/creer-un-news', 'create')->name('news.create');
    Route::post('/store', 'store')->name('news.store');
    Route::get('edit/{slug}', 'edit')->name('news.edit');
    route::post('update/{id}', 'update')->name('news.update');
    route::post('destroy/{id}', 'destroy')->name('news.destroy');
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


  //Sujet dashboard
  Route::controller(SujetController::class)->prefix('sujet')->group(function () {
    Route::get('/', 'index')->name('sujet.index');
    Route::post('/store', 'store')->name('sujet.store');
    route::get('edit/{id}', 'edit')->name('sujet.edit');
    route::post('update/{id}', 'update')->name('sujet.update');
    route::post('destroy/{id}', 'destroy')->name('sujet.destroy');

    // route for insert data from file
    route::get('insert-data-from-file', 'insertDataFromFile')->name('sujet.insert-data-from-file');

    route::get('import-from-csv', 'importFromCsv');
    route::get('import-niveaux-from-csv', 'importNiveauxSujetsFromFile');


  });
});

//Sujet dashboard and user
Route::controller(SujetController::class)->prefix('sujet')->group(function () {
  Route::get('/', 'index')->name('sujet.index')->middleware('auth');;
  Route::post('/store', 'store')->name('sujet.store');
  route::get('edit/{id}', 'edit')->name('sujet.edit');
  route::post('update/{id}', 'update')->name('sujet.update');
  route::post('destroy/{id}', 'destroy')->name('sujet.destroy');
  route::get('approved/{id}', 'approved')->name('sujet.approved');
});


/*********************ROUTE FRONTEND ********************************************** */

// Route::get('/'  , function(){
//   return view('front.pages.home');
// });

//Home page
Route::controller(HomeController::class)->group(function () {
  Route::get('/', 'home')->name('home');
});

//All sujet page
Route::controller(SujetFrontController::class)->group(function () {
  Route::get('/sujet', 'allsujet')->name('allsujet');
  Route::get('/liste-des-sujets', 'search')->name('search');
});


Route::controller(NewsFrontController::class)->group(function () {
  Route::get('/news', 'news')->name('news');
  Route::get('/news-detail', 'detail')->name('news.detail');

  // Route::post('/liste-des-sujets', 'search')->name('search');
});

//Auth user
Route::controller(AuthUserController::class)->group(function () {
  route::get('/connexion', 'login')->name('user.login');
  route::post('/connexion', 'login')->name('user.login');
  route::post('/connexion', 'login')->name('user.login');
  route::get('account/verify/{token}', [AuthUserController::class, 'verifyAccount'])->name('user.verifyEmail');

  route::get('/inscription', 'register')->name('user.register');
  route::post('/inscription', 'register')->name('user.register');
  route::get('logout', 'logout')->name('user.logout')->middleware(['auth', 'is_verify_email']);

  //forget password
  Route::get('forget-password', [AuthUserController::class, 'showForgetPasswordForm'])->name('forget.password.get');
  Route::post('forget-password', [AuthUserController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
  Route::get('reset-password', [AuthUserController::class, 'showResetPasswordForm'])->name('reset.password.get');
  Route::post('reset-password', [AuthUserController::class, 'submitResetPasswordForm'])->name('reset.password.post');
});

//user account dashboard
Route::controller(AccountController::class)->group(function () {
  route::get('/mon-compte', 'dashboard')->name('user_account.dashboard')->middleware(['auth', 'is_verify_email']);
  route::get('/mon-compte/sujet/edit/{id}', 'edit')->name('user_account.edit-sujet')->middleware(['auth', 'is_verify_email']);
  route::get('/edit-profil', 'editProfil')->name('user_account.edit-profil')->middleware(['auth', 'is_verify_email']);
  route::post('/profil/update/{id}', 'updateProfilInfo')->name('user_account.update-profil-info')->middleware(['auth', 'is_verify_email']);
  route::post('/profil/update-password/{id}', 'updateProfilPwd')->name('user_account.update-profil-pwd')->middleware(['auth', 'is_verify_email']);

});

Route::controller(CommentaireController::class)->group(function () {
  route::post('store', 'store')->name('addComment')->middleware(['auth', 'is_verify_email']);
});

Route::controller(TelechargementController::class)->group(function () {
  route::get('saveDownload', 'download')->name('download')->middleware(['auth', 'is_verify_email']);
});
