<?php
use App\Http\Middleware\AutorizeCheck;
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
Route::get('/', function () {
    return view('home');
});

//Route::match(['get','post'], '/connect',    ['as' => 'connect', 'uses' => 'ParamController@connectAction'])->middleware('autorize.check');


