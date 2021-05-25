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

Route::get('test','test@test');

Route::group(['prefix'=>'Admin','namespace'=>'Admin'],function () {
    Route::get('login','adminController@login')->name('Admin.login');
    Route::post('checklogin','adminController@checklogin')->name('Admin.checklogin');
    Route::get('logout','adminController@logout')->name('Admin.logout');
});
// Dashboard Admin
Route::group(['prefix'=>'Admin','namespace'=>'Admin','middleware'=>'admin'],function () {
    Route::get('show','adminController@show')->name('Admin.show');
    Route::resource('user','userController');
    Route::resource('product','productController');
    Route::resource('hoadon','hoadonController')->only(['index','destroy']);
    Route::resource('cart','cartController');
    Route::resource('xeploai','xeploaiController')->only(['index','destroy']);
    Route::resource('chitiethoadon','chitiethoadonController')->only(['index','destroy']);
    Route::resource('comment','commentController')->only(['index','destroy']);
    Route::get('language/{language}','languageController@index')->name('admin.language')->middleware('language');
    
});
// user home
Route::group(['namespace'=>'User'],function () {
    Route::get('/','userController@index');
    Route::get('sanham/{id}','userController@sanpham')->name('user.sanpham');
});
Route::group(['prefix'=>'Admin','namespace'=>'Ajax','middleware'=>'admin'],function () {
    Route::post('searchuser','ajaxController@searchuser')->name('ajax.searchuser');   
    Route::post('searchproduct','ajaxController@searchproduct')->name('ajax.searchproduct');   
    Route::post('searchxeploai','ajaxController@searchxeploai')->name('ajax.searchxeploai');   
});
