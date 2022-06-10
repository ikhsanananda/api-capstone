<?php

use App\Http\Controllers\HospitalController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

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
    return view('index');
});
Route::get('/main', [HospitalController::class, 'index']);
Route::post('/main', [HospitalController::class, 'update']);
Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/login', [LoginController::class, 'index']);