<?php

use Illuminate\Support\Facades\Route;
use App\Models\Pairs;
use App\Models\Currency;
use App\Models\Converts;

use App\Http\Controllers\API\AdminCurrencyController;

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


Route::get('/', function () {
    return redirect('/api/currencies');
});

