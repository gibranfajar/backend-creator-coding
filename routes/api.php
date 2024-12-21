<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CategoryArticleController;
use App\Http\Controllers\CategoryFaqController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\CrewController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\JFYController;
use App\Http\Controllers\OpportunitiesController;
use App\Http\Controllers\PageAboutController;
use App\Http\Controllers\PageArticleController;
use App\Http\Controllers\PageCareerController;
use App\Http\Controllers\PageContactController;
use App\Http\Controllers\PageFaqController;
use App\Http\Controllers\PageHomeController;
use App\Http\Controllers\PageProductController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\VisiMisiController;
use Illuminate\Support\Facades\Route;

// routes api auth
Route::post('/register', [AuthenticationController::class, 'register']);
Route::post('/login', [AuthenticationController::class, 'login']);

// routes api
Route::prefix('admin')->group(function () {
    Route::apiResource('page-homes', PageHomeController::class);
    Route::apiResource('page-about', PageAboutController::class);
    Route::apiResource('page-career', PageCareerController::class);
    Route::apiResource('page-product', PageProductController::class);
    Route::apiResource('page-contact', PageContactController::class);
    Route::apiResource('page-faq', PageFaqController::class);
    Route::apiResource('page-article', PageArticleController::class);
    Route::apiResource('crew', CrewController::class);
    Route::apiResource('service', ServiceController::class);
    Route::apiResource('visi-misi', VisiMisiController::class);
    Route::apiResource('category-faq', CategoryFaqController::class);
    Route::apiResource('faq', FaqController::class);
    Route::apiResource('opportunities', OpportunitiesController::class);
    Route::apiResource('jobforyou', JFYController::class);
    Route::apiResource('category-product', CategoryProductController::class);
    Route::apiResource('product', ProductController::class);
    Route::apiResource('category-article', CategoryArticleController::class);
    Route::apiResource('article', ArticleController::class);
    Route::get('user', AuthenticationController::class . '@getData');
})->middleware('auth:sanctum');

Route::prefix('pages')->group(function () {
    Route::get('/home', [PageHomeController::class, 'index']);
    Route::get('/about', [PageAboutController::class, 'index']);
    Route::get('/career', [PageCareerController::class, 'index']);
    Route::get('/product', [PageProductController::class, 'index']);
    Route::get('/faq', [PageFaqController::class, 'index']);
    Route::get('/article', [PageArticleController::class, 'index']);
    Route::get('/contact', [PageContactController::class, 'index']);
});

Route::get('/service', [ServiceController::class, 'index']);
Route::get('/crew', [CrewController::class, 'index']);
Route::get('/visi-misi', [VisiMisiController::class, 'index']);
Route::get('/opportunities', [OpportunitiesController::class, 'index']);
Route::get('/jobforyou', [JFYController::class, 'index']);
Route::get('/category-faq', [CategoryFaqController::class, 'index']);
Route::get('/faq', [FaqController::class, 'index']);
Route::get('/category-product', [CategoryProductController::class, 'index']);
Route::get('/product', [ProductController::class, 'index']);
Route::get('/category-article', [CategoryArticleController::class, 'index']);
Route::get('/article', [ArticleController::class, 'index']);
