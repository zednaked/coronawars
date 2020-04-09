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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index');

Route::get('/call-for-action', 'HomeController@callforaction')->name('home-blink-contribute');

Route::middleware(['auth'])->group(function(){

	Route::get('/request-masks','MaskRequestController@index')->name('request-masks');
	Route::post('/request-masks','MaskRequestController@post')->name('post-request-mask');

	Route::middleware('role:superadministrator|deliverer')->group(	function() {
		Route::get('/masks-requests/list-requests','MaskRequestController@listNotDelivered')->name('list-requests');
		
		Route::post('/masks-requests/assign-work','MaskRequestController@assignWork')->name('assign-work');
		Route::post('/masks-requests/mark-as-delivered','MaskRequestController@markAsDelivered')->name('mark-as-delivered');
		Route::get('/masks-requests/requests-by-deliverer','MaskRequestController@listByDeliverer')->name('list-requests-by-deliverer');

		Route::get('/authentication/users/list-users','AdministrateUsersController@listUsers')->name('list-users');
		Route::get('/authentication/role/assign-role/{userid}/{rolename}','AdministrateUsersController@assignRole')->name('assign-role');
		Route::get('/authentication/role/remove-role/{userid}/{rolename}','AdministrateUsersController@removeRole')->name('remove-role');

		Route::get('/seamstress/requests/list','SeamstressRequestController@list')->name('list-supply-request');
		Route::get('/seamstress/requests/{id?}','SeamstressRequestController@get')->name('get-supply-request');
		Route::get('/seamstress/requests/delete/{id?}','SeamstressRequestController@delete')->name('delete-supply-request');
		Route::get('/seamstress/requests/mark-as-delivered/{id?}','SeamstressRequestController@markAsDelivered')->name('supply-request-mark-as-delivered');
		Route::get('/seamstress/requests/conciliate/{id}/{masks_received?}','SeamstressRequestController@conciliate')->name('supply-request-conciliate');
		Route::post('/seamstress/requests/{id?}','SeamstressRequestController@post')->name('post-supply-request');
		Route::get('/seamstress/requests/archive/{id}','SeamstressRequestController@archive')->name('supply-request-archive');
		Route::get('/seamstress/requests/activate/{id}/{activate}','SeamstressRequestController@archive')->name('supply-request-activate');

		Route::get('/seamstress/list','SeamstressController@list')->name('list-seamstresses');
		Route::get('/seamstress/{seamstress_id?}','SeamstressController@get')->name('get-seamstress');
		Route::post('/seamstress/{id?}','SeamstressController@post')->name('post-seamstresses');
		Route::get('/seamstress/delete/{id}','SeamstressController@delete')->name('delete-seamstress');
	});
});

Route::get('/show-statistics','MaskRequestController@statistics')->name('show-statistics');

Auth::routes();

