<?php

use App\Models\DaySlot;
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

//Route::get('/', function () {
//    dump(Session::get('message'));
//    return view('welcome');
//})->name('welcome');
//
Route::get('/user', function (\Illuminate\Http\Request $request) {
    dump($request->user()->toArray());
})->middleware(['auth:web']);

Route::get('/test', function (\Illuminate\Http\Request $request) {

    $doctor =     \App\Models\Doctor::find(29);

    $daySlots = DaySlot::whereReplacementId($doctor->id)->get();
//    dd($daySlots);
//    $daySlots = DaySlot::whereId($doctor->id)->get();
//dump($daySlots);


//    $daySlot = \App\Models\DaySlot::whereId(21)->first();
//
//    $daySlot->replacement()->disassociate();
//    $daySlot->save();

//    dump($daySlot->replacement()->disassociate());
});


Route::get('/set',function (){
    $month = 1;
    $year = 2024;

    $date = \Carbon\Carbon::createFromDate($year, $month);
    dump($date->startOfMonth());
    dd($date->endOfMonth());

//    $doctor = \App\Models\Doctor::find(2);


    dd('end');

    dd($doctor->photo);
    \Session::push('test','hello');
});
Route::get('/get',function (){
    dump(\Session::all());
    dump(\Session::get('test'));
});

Route::get('/login', [\App\Http\Controllers\AuthController::class,'showLoginForm'])
    ->name('login');
Route::post('/login', [\App\Http\Controllers\AuthController::class,'loginProcess'])->name('loginProcess');
