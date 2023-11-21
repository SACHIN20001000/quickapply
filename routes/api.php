<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PassportAuthController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\BacklinkController;

use App\Http\Middleware\EnsureApiTokenIsValid;
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


Route::post('register', [PassportAuthController::class, 'register']);
Route::post('login', [PassportAuthController::class, 'login']);
Route::post('oauth/token', [PassportAuthController::class, 'oauth_token']);
Route::get('products', [ProductController::class, 'index']);
Route::get('user/{id}', [UserController::class, 'getAllData']);
Route::middleware([EnsureApiTokenIsValid::class])->group(function () {
});
Route::get('backlink', [BacklinkController::class, 'index']);
Route::post('backlink-store', [BacklinkController::class, 'store']);
Route::post('backlink-delete/{id}', [BacklinkController::class, 'delete']);


Route::middleware('auth:api')->group(function () {
  Route::get('profile', [UserController::class, 'userProfile']);
  Route::post('update', [UserController::class, 'updateProfile']);
  Route::get('logout', [PassportAuthController::class, 'logout']);

  Route::group(['middleware' => ['role:User']], function () {
  });
});
