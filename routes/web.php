<?php

use App\Http\Controllers\AlternativeController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SelectionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use PHPUnit\TextUI\XmlConfiguration\Group;

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
    return redirect()->route('home');
});

Route::group(['middleware' => ['AppInstall:login']], function () {
    Route::get('login', [AuthController::class, 'index'])->name('login');
});

Route::group(['middleware' => ['AppInstall:install']], function () {
    Route::get('install', [AppController::class, 'index'])->name('install');
});

Route::post('install', [AppController::class, 'create'])->name('installing');

Route::post('login', [AuthController::class, 'login'])->name('login.check');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth']], function () {
    Route::get('registration', [AuthController::class, 'register'])->name('register');
    Route::post('registration/process', [AuthController::class, 'registerProcess'])->name('register.process');

    Route::get('home', [HomeController::class, 'index'])->name('home');

    Route::group(['middleware' => ['checkLogin:admin']], function () {
        Route::get('users', [UserController::class, 'index'])->name('users');
        Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::post('users/update', [UserController::class, 'update'])->name('user.update');
        Route::get('users/add', [UserController::class, 'add'])->name('user.add');
        Route::post('users/create', [UserController::class, 'create'])->name('user.create');
        Route::post('users/delete', [UserController::class, 'delete'])->name('user.delete');

        Route::get('app/settings', [AppController::class, 'edit'])->name('app.settings');
        Route::post('app/settings', [AppController::class, 'update'])->name('app.settings.update');
    });

    Route::get('criterias', [CriteriaController::class, 'index'])->name('criterias');
    Route::get('criteria/add', [CriteriaController::class, 'add'])->name('criteria.add');
    Route::post('criteria/create', [CriteriaController::class, 'create'])->name('criteria.create');
    Route::get('criteria/{id_criteria}/edit', [CriteriaController::class, 'edit'])->name('criteria.edit');
    Route::post('criteria/update', [CriteriaController::class, 'update'])->name('criteria.update');
    Route::post('criteria/delete', [CriteriaController::class, 'delete'])->name('criteria.delete');

    Route::get('criteria/{id_criteria}/variable/add', [CriteriaController::class, 'addVariable'])->name('criteria.variable.add');
    Route::post('criteria/variable/create', [CriteriaController::class, 'createVariable'])->name('criteria.variable.create');
    Route::get('criteria/variable/{id_variabel}/edit', [CriteriaController::class, 'editVariable'])->name('criteria.variable.edit');
    Route::post('criteria/variable/delete', [CriteriaController::class, 'deleteVariable'])->name('criteria.variable.delete');
    Route::post('criteria/variable/update', [CriteriaController::class, 'updateVariable'])->name('criteria.variable.update');

    Route::get('alternatives', [AlternativeController::class, 'index'])->name('alternatives');
    Route::get('alternative/add', [AlternativeController::class, 'add'])->name('alternative.add');
    Route::post('alternative/create', [AlternativeController::class, 'create'])->name('alternative.create');
    Route::get('alternative/{id_alternative}/edit', [AlternativeController::class, 'edit'])->name('alternative.edit');
    Route::post('alternative/update', [AlternativeController::class, 'update'])->name('alternative.update');
    Route::post('alternative/delete', [AlternativeController::class, 'delete'])->name('alternative.delete');

    Route::get('selections', [SelectionController::class, 'index'])->name('selections');
    Route::get('selection/add', [SelectionController::class, 'add'])->name('selection.add');
    Route::post('selection/create', [SelectionController::class, 'create'])->name('selection.create');
    Route::get('selection/{id_alternative}/edit', [SelectionController::class, 'edit'])->name('selection.edit');
    Route::post('selection/update', [SelectionController::class, 'update'])->name('selection.update');

    Route::post('users/update', [UserController::class, 'update'])->name('user.update');
    Route::get('profile', [UserController::class, 'profile'])->name('profile');
    Route::get('profile/change-password', function () {
        return view('pages.user_changepassword');
    })->name('profile.change.password');
    Route::post('profile/change-password', [UserController::class, 'changePassword'])->name('profile.update.password');
});

Route::get('terms', function () {
    return view('pages.terms');
})->name('terms');
