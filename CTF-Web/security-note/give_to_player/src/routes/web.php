<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Middleware\IsLogin;

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
    return view('welcome');
});

Route::post('/login', [
    UserController::class,
    'login'
]);

Route::post('/register', [
    UserController::class,
    'register'
]);

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('/register');
})->name('register');

Route::get('/logout', [
    UserController::class,
    'logout'
]);

Route::get('/home', function () {
    return view('home');
})->name('create')->middleware([IsLogin::class]);

Route::post('/create', [
    NoteController::class,
    'create'
])->name('create')->middleware([IsLogin::class]);

Route::get('/get', [
    NoteController::class,
    'get'
])->middleware([IsLogin::class]);