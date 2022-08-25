<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AdminUserController;
use App\Http\Controllers\API\AdminPairsController;
use App\Http\Controllers\API\AdminCurrencyController;
use App\Http\Controllers\API\AdminConvertsController;

use App\Models\Pairs;
use App\Models\Currency;
use App\Models\Converts;

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

Route::apiResource("users", AdminUserController::class);

Route::apiResource("currencies", AdminCurrencyController::class)->except(['create','edit','delete']);
Route::apiResource("pairs", AdminPairsController::class)->except(['create','edit','delete']);
Route::apiResource("converts", AdminConvertsController::class)->except(['create','edit']);

Route::get("converts/{change}/{currencyInit}/{currencyDest}", [AdminConvertsController::class, 'convert']);

//Route::apiResource("converts/{change}/{currencyInit}/{currencyDest}", function ($change, $curencyInit, $curencyDest){


// });
