<?php

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

Route::get('/', function () {
    return view('home');
})->name('home');
Route::get('/home', function () {
    return view('home');
});

Route::middleware(['verified'])->group(function(){
	Route::get('/request-masks',function(){return view('request-masks');})->name('request-masks');
	Route::post('/request-masks','MaskRequestController@post')->name('post-request-mask');
});

Route::group(['middleware' => ['role:superadministrator|deliverer']], function() {
	Route::get('/list-requests','MaskRequestController@listNotDelivered')->name('list-requests');
	Route::post('/assign-work','MaskRequestController@assignWork')->name('assign-work');
	Route::post('/mark-as-delivered','MaskRequestController@markAsDelivered')->name('mark-as-delivered');
	Route::get('/requests-by-deliverer','MaskRequestController@listByDeliverer')->name('list-requests-by-deliverer');
	
});

Route::get('/show-statistics','MaskRequestController@statistics')->name('show-statistics');

Auth::routes(['verify' => true]);

