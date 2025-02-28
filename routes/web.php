<?php

use App\Http\Controllers\AlternativeController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\InputParameterController;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListDSSController;
use App\Http\Controllers\ProcessCountController;
use Symfony\Component\Process\Process;

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
    return view('auth.login');
});


Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('/user', ListDSSController::class);
    Route::post('/user/storeParameters', [InputParameterController::class, 'storeParameters'])->name('user.storeParameters');
    Route::get('/user/{dssId}/process', [InputParameterController::class, 'runToProcess'])->name('user.process');
    Route::post('/user/storeDecMatrix/process', [ProcessCountController::class, 'storeDecMatrix'])->name('user.store-decMatrix');
    Route::get('/user/calculateAras/{dssId}/process/{flagUpdate}', [ProcessCountController::class, 'calculateAras'])->name('user.calculate-dss');

    // For Alternative
    Route::post('/user/updateCreate/alternative', [AlternativeController::class, 'updateCreateAlt'])->name('user.updateCreateAlt');
    Route::get('/user/remove/{altId}/alternative', [AlternativeController::class, 'removeAlt'])->name('user.deleteOneAlt');

    // For Criteria
    Route::post('/user/updateCreate/criteria', [CriteriaController::class, 'updateCreateCri'])->name('user.updateCreateCri');
    Route::get('/user/remove/{criId}/criteria', [CriteriaController::class, 'removeCri'])->name('user.deleteOneCri');
});
