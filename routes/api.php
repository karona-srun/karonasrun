<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContentsController;
use App\Http\Controllers\ContentTypesController;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('/contents/search/{name}',  [ContentsController::class,'searchName']);
Route::get('/contents/new',  [ContentsController::class,'newContents']);
Route::resource('/content-types', ContentTypesController::class);
Route::resource('/contents', ContentsController::class);
Route::get('/contents/filter-content-type/{id}', [ContentsController::class,'filterContentType']);

