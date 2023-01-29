<?php

use App\Http\Controllers\MenuContentController;
use App\Http\Controllers\MenuContentImageController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\SubMenuContentController;
use App\Http\Controllers\SubMenuContentImageController;
use App\Http\Controllers\SubMenuController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Menus
Route::resource('menus', MenuController::class);
Route::resource('menu-contents', MenuContentController::class);
Route::resource('menu-content-images', MenuContentImageController::class);

// Sub Menus
Route::resource('sub-menus', SubMenuController::class);
Route::resource('sub-menu-contents', SubMenuContentController::class);
Route::resource('sub-menu-content-images', SubMenuContentImageController::class);