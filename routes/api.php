<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('orcid/SaveOrcid', [\App\Http\Controllers\OrcidController::class, 'SaveOrcid']);
Route::post('orcid/create', [\App\Http\Controllers\OrcidController::class, 'store']);
Route::put('orcid/update/{id}', [\App\Http\Controllers\OrcidController::class, 'update']);
Route::put('keyword/update/{id}', [\App\Http\Controllers\keywordController::class, 'update']);

Route::delete('orcid/delete/{orcid}', [\App\Http\Controllers\OrcidController::class, 'destroy']);
Route::get('orcid/list', [App\Http\Controllers\OrcidController::class, 'index']);
Route::get('orcid/{orcid}', [\App\Http\Controllers\OrcidController::class, 'show']);

Route::post('keyword/create', [\App\Http\Controllers\keywordController::class, 'store']);
