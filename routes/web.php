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

Route::get('/', function () {
    return view('welcome');
});
//web文件上传
Route::post('upload','ShopCategoryController@upload')->name('upload');
//资源路由-商家分类管理
Route::resource('shopcategories','ShopCategoryController');

//商家信息审核页面
Route::get('shops/home','ShopController@home')->name('shops.home');
//web文件上传
Route::post('shops/upload','ShopCategoryController@upload')->name('shops.upload');
//资源路由-商家信息管理
Route::resource('shops','ShopController');

//资源路由-商家账号管理
Route::resource('users','UserController');

//资源路由-管理员管理
Route::resource('admins','AdminController');
//保存管理员密码修改
Route::post('admins/savepwd','AdminController@savepwd')->name('admins.savepwd');

//管理员登录界面
Route::get('login','LoginController@create')->name('login');
//管理员登录验证
Route::post('login','LoginController@store')->name('login');
//注销
Route::get('logout','LoginController@destroy')->name('logout');

//未开始的活动
Route::get('prepare','ActivityController@prepare')->name('prepare');
//进行中的活动
Route::get('conduct','ActivityController@conduct')->name('conduct');
//已结束的活动
Route::get('end','ActivityController@end')->name('end');
//资源路由-活动管理
Route::resource('activities','ActivityController');


