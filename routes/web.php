<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function (\Illuminate\Http\Request $request) {
    return redirect('/graphiql');
});

Route::get('/version', function (\Illuminate\Http\Request $request) {
    return '1.1';
});

Route::get('/login', [\App\Http\Controllers\AuthController::class,'showLoginForm'])
    ->name('login');
Route::post('/login', [\App\Http\Controllers\AuthController::class,'loginProcess'])->name('loginProcess');
