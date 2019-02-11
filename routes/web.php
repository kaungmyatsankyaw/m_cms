<?php

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

Route::get('/','ReportController@index');
Route::post('/astrologer','ReportController@show');

Route::get('/status','StatusController@index');
Route::post('/status-data','StatusController@show')->name('status-data');

Route::get('/operator','OperatorController@index');
Route::post('/operator-data','OperatorController@show')->name('operator-data');

Route::get('/operator_chat','ChartController@operator');
Route::post('/operator-chat','ChartController@chart');

Route::get('/mpt','MptController@show');
Route::post('/mpt','MptController@chart');

Route::get('/ooreedoo','OoreedooController@show');
Route::post('/ooreedoo','OoreedooController@chart');

Route::get('/telenor','TelenorController@show');
Route::post('/telenor','TelenorController@chart');

Route::get('/count','CountController@index');
Route::post('/count-data','CountController@show');

Route::get('/test','TestController@index');
//Route::post('/test','TestController@count');

Route::post('/test','TestController@operator');

//Route::post('/test','TestController@operator');
//Route::post('/test','TestController@chart_opera');




