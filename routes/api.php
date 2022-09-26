<?php

use App\Http\Controllers\Api\NewsCategoryController;
use App\Http\Controllers\Api\NewsController;
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

// News category
Route::get('/news-categories', [NewsCategoryController::class, 'index']);
Route::post('/news-categories', [NewsCategoryController::class, 'store']);
Route::patch('/news-categories/{slug}', [NewsCategoryController::class, 'update']);
Route::delete('/news-categories/{slug}', [NewsCategoryController::class, 'destroy']);

// News
Route::get('/news/form', [NewsController::class, 'form']);
Route::post('/news', [NewsController::class, 'store']);
Route::get('/news/data', [NewsController::class, 'data']);
Route::get('/news/edit/{slug}', [NewsController::class, 'edit']);
Route::delete('/news/delete/{slug}', [NewsController::class, 'delete']);

// Trash News
Route::get('/news/trash', [NewsController::class, 'trash']);
Route::post('/news/restore/{slug}', [NewsController::class, 'restore']);
