<?php

use App\Http\Controllers\StatusController;
use App\Livewire\Home;
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

Route::get('/status', StatusController::class);

Route::get('/', function () {
    return redirect()->route('home');
});

Route::group(['middleware' => 'auth:web'], function () {
    Route::get('/home', Home::class)->name('home');
});
