<?php

use App\Http\Controllers\fileController;
use App\Http\Controllers\folderController;
use App\Http\Controllers\ProcessController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/dashboard', function () {return view('layouts.dashboard'); })->name('dashboard');
Route::get('/main-proccess', function () {return view('layouts.admin.mainProcess'); })->name('mainProccess');


Route::get('/sub-proccess/{process}', [ProcessController::class, 'show'])->name('subProccess');

Route::get('/folders/{SubProcess}', [folderController::class, 'show'])->name('folder');

Route::get('/files/{folder}', [fileController::class, 'show'])->name('file');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
