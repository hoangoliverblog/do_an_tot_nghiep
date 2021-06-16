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
    Route::get('language/{language}',function ($language) {
        App::setlocale($language);
        return redirect()->back();
    })->name('admin.language');
    
});
// user home
Route::group(['namespace'=>'User'],function () {
    Route::get('/','userController@index');
    Route::get('sanham/{id}','userController@sanpham')->name('user.sanpham');
    Route::get('userLogin','userController@userLogin')->name('user.Login');
    Route::get('Resgister','userController@Resgister')->name('user.Resgister');
    Route::get('createUser','userController@createUser')->name('user.createUser');
    Route::get('checkOtp','userController@checkOtp')->name('user.checkOtp');
    Route::get('activeAcount','userController@activeAcount')->name('user.activeAcount');
    Route::get('checkLogin','userController@checkLogin')->name('user.checkLogin');
    Route::get('comment','userController@comment')->name('user.comment');
    Route::get('Logout','userController@Logout')->name('user.Logout');
    Route::get('cosmetics','cosmeticsController@show')->name('cosmetics.show');
    Route::get('perfume','perfumeController@show')->name('perfume.show');
    Route::get('ProductSets','ProductSetsController@show')->name('ProductSets.show');
    Route::get('Trademark','TrademarkController@show')->name('Trademark.show');
});
Route::group(['prefix'=>'Admin','namespace'=>'Ajax','middleware'=>'admin'],function () {
    Route::post('searchuser','ajaxController@searchuser')->name('ajax.searchuser');   
    Route::post('searchproduct','ajaxController@searchproduct')->name('ajax.searchproduct');   
    Route::post('searchxeploai','ajaxController@searchxeploai')->name('ajax.searchxeploai');    
    Route::post('searchcomment','ajaxController@searchcomment')->name('ajax.searchcomment');
    Route::post('searchhoadon','ajaxController@searchhoadon')->name('ajax.searchhoadon');
    Route::post('searchchitiethoadon','ajaxController@searchchitiethoadon')->name('ajax.searchchitiethoadon');
    Route::post('searchcart','ajaxController@searchcart')->name('ajax.searchcart');                
    // Route::post('checkusername','ajaxController@checkusername')->name('ajax.checkusername');                
});
