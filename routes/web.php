<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NewsCategoryController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Auth::routes();


Route::prefix('dashboard')->middleware(['auth'])->group(function() {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

    // News
    Route::get('/news', [NewsController::class, 'index'])->name('news.index');
    Route::get('/news/form', [NewsController::class, 'form'])->name('news.form');
    Route::post('/news', [NewsController::class, 'store'])->name('news.store');
    Route::get('/news/data', [NewsController::class, 'data'])->name('news.data');
    Route::get('/news/edit/{slug}', [NewsController::class, 'edit'])->name('news.edit');
    Route::delete('/news/delete/{slug}', [NewsController::class, 'delete'])->name('news.delete');

    // News Trash
    Route::get('/news/trash', [NewsController::class, 'trash'])->name('news.trash');
    Route::post('/news/restore/{slug}', [NewsController::class, 'restore'])->name('news.restore');

    // News Master
    Route::get('/news-categories', [NewsCategoryController::class, 'index'])->name('news-category.index');
    Route::post('/news-categories', [NewsCategoryController::class, 'store'])->name('news-category.store');
    Route::patch('/news-categories/{slug}', [NewsCategoryController::class, 'update'])->name('news-category.update');
    Route::delete('/news-categories/{slug}', [NewsCategoryController::class,'destroy'])->name('news-category.destroy');
});
