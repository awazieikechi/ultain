<?php

use App\Http\Controllers\ArticleController;
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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
return $request->user();
});*/

Route::get('/articles', [ArticleController::class, 'index']);
Route::get('/articles/{id}', [ArticleController::class, 'getArticle']);
Route::post('/articles/{id}/comment', [ArticleController::class, 'addComment']);
Route::get('/articles/{id}/like', [ArticleController::class, 'getLikes']);
Route::get('/articles/{id}/view', [ArticleController::class, 'getviews']);
