<?php

use App\Http\Controllers\StatusController;
use App\Http\Controllers\WebhookController;
use App\Livewire\Home;
use App\Livewire\Projects\EditProject;
use App\Livewire\Projects\ListProjects;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
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

Route::any('/projects/{project}/api/{any?}', WebhookController::class)->where('any', '.*')->withoutMiddleware(VerifyCsrfToken::class);

Route::group(['middleware' => 'auth:web'], function () {
    Route::get('/home', Home::class)->name('home');
    Route::get('/projects', ListProjects::class)->name('projects.index');
    Route::get('/projects/{project}', EditProject::class)->name('projects.edit');
});
