<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\WeightLogController;
use App\Http\Controllers\GoalController;

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

Route::get('/register/step1', fn() => view('register.step1'))->name('register.step1');
Route::get('/register/step2', fn() => view('register.step2'))->name('register.step2');

Route::post('/register/step1', [RegisterController::class, 'register']);
Route::post('/register/step2', [RegisterController::class, 'storeInitialWeight'])->name('register.step2');

Route::get('/goal/edit', [GoalController::class, 'edit'])->name('goal.edit');
Route::put('/goal/update', [GoalController::class, 'update'])->name('goal.update');

Route::middleware(['auth'])->group(function () {
    Route::get('/weight_logs', [WeightLogController::class, 'index'])->name('weight_logs.index');
    Route::get('/weight_logs/search', [WeightLogController::class, 'search'])->name('weight_logs.search');
    Route::post('/weight_logs', [WeightLogController::class, 'store'])->name('weight_logs.store');
    Route::get('/weight_logs/{id}/edit', [WeightLogController::class, 'edit'])->name('weight_logs.edit');
    Route::put('/weight_logs/{id}', [WeightLogController::class, 'update'])->name('weight_logs.update');
    Route::delete('/weight_logs/{id}', [WeightLogController::class, 'destroy'])->name('weight_logs.destroy');
});
