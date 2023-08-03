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



Auth::routes();
Route::get('/', 'Controller@main')->name('main');
Route::post('/checkPassword','Controller@checkPassword')->name('checkPassword');
Route::post('/checkPhone','Controller@checkPhone')->name('checkPhone');
Route::post('/correctPhone','Controller@correctPhone')->name('correctPhone');
Route::post('/correctEmail','Controller@correctEmail')->name('correctEmail');
Route::post('/checkEmail','Controller@checkEmail')->name('checkEmail');
Route::post('/checkUser','Controller@checkUser')->name('checkUser');
Route::post('/serviceRegistration','Controller@serviceRegistration')->name('serviceRegistration');
Route::post('/selectTime','Controller@selectTime')->name('selectTime');
Route::post('/freeDateS','Controller@freeDateS')->name('freeDateS');


Route::get('/cosmetics', 'Controller@cosmetics')->name('cosmetics');
Route::post('/chooseRemedy','Controller@chooseRemedy')->name('chooseRemedy');
Route::post('/sortCosmetics','Controller@sortCosmetics')->name('sortCosmetics');

Route::get('/services', 'Controller@services')->name('services');
Route::post('/sortServices','Controller@sortServices')->name('sortServices');

Route::get('/masters', 'Controller@masters')->name('masters');
Route::post('/rate','Controller@rate')->name('rate');


Route::get('/reviews','Controller@reviews')->name('reviews');
Route::post('/sendReview','Controller@sendReview')->name('sendReview');


Route::get('/contacts','Controller@contacts')->name('contacts');
Route::post('/contact',  'Controller@mailToAdmin'); 

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/updateUser','HomeController@updateUser')->name('updateUser');
Route::post('/freeMaster','HomeController@freeMaster')->name('freeMaster');
Route::post('/freeDate','HomeController@freeDate')->name('freeDate');
Route::post('/freeTime','HomeController@freeTime')->name('freeTime');
Route::post('/update','HomeController@update')->name('update');
Route::get('/sort','HomeController@sort')->name('sort');
Route::get('deleteSchedule/{id}','HomeController@deleteSchedule')->name('deleteSchedule');
Route::get('/deleteMark','HomeController@deleteMark')->name('deleteMark');
Route::post('/rateMaster','HomeController@rateMaster')->name('rateMaster');
Route::post('/publReview','HomeController@publReview')->name('publReview');
Route::get('deleteReview/{id}','HomeController@deleteReview')->name('deleteReview');
Route::post('/updateReview','HomeController@updateReview')->name('updateReview');

Route::post('/search','Controller@search')->name('search');
Route::get('/search/{page}-finde:{query}','Controller@searchQ')->name('searchQ');

Route::post('/upload','HomeController@upload')->name('upload');
Route::post('/addServ','HomeController@addServ')->name('addServ');
Route::get('/deleteServ/{id}','HomeController@deleteServ')->name('deleteServ');
Route::get('/deleteMaster/{id}','HomeController@deleteMaster')->name('deleteMaster');
Route::get('/deleteCosm/{id}','HomeController@deleteCosm')->name('deleteCosm');



