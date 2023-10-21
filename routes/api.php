<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NodeController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('/node', [NodeController::class, 'store']);
Route::get('/node/{type}/{id}', [NodeController::class, 'showChildren']);
Route::get('/node', [NodeController::class, 'getCorporations']);
Route::get('/node/availableParents/{type}/{id}', [NodeController::class, 'getAvailableParents']);
// Route::put('/node/changeParent/{type}/{id}/{toId}', [NodeController::class, 'changeParent']);
Route::put('/node/changeParent/{id}', [NodeController::class, 'changeParent']);
