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
})->name('welcome');

//验证码
//Route::any('captcha',function(){
//    return captcha_img();
//})->name('captcha');
//文件上传
Route::group(['prefix'=>'upload'],function(){
    Route::post('image/{type?}','UploadController@upImage')->name('upload-image');
});
//系统后台
Route::group(['namespace'=>'Admin','prefix'=>'admin','middleware'=>['checkLoginStatus']], function(){
    Route::get('login','IndexController@login')->name('login');
    Route::post('login-action','IndexController@loginAction')->name('login-action');
    Route::get('index','IndexController@index')->name('index');

    //商品
    //品牌
    Route::get('brand','ProductController@brand')->name('product-brand');
    Route::get('brand-add/{id?}','ProductController@brandAdd')->name('product-brand-add');
    Route::post('brand-operate','ProductController@brandOperate')->name('product-brand-operate');
    Route::post('brand-del/{id?}','ProductController@brandDel')->name('product-brand-del');
    //分类
    Route::get('category','ProductController@category')->name('product-category');
    Route::get('category-add/{id?}','ProductController@categoryAdd')->name('product-category-add');
    Route::get('category-down-list/{id?}','ProductController@categoryDownList')->name('product-category-down-list');
    Route::post('category-operate','ProductController@categoryOperate')->name('product-category-operate');
    Route::post('category-del/{id?}','ProductController@categoryDel')->name('product-category-del');

    //商品
    Route::get('goods-list','GoodsController@goodsList')->name('goods-list');
    Route::get('goods-add{id?}','GoodsController@goodsAdd')->name('goods-add');
    Route::post('goods-operate','GoodsController@goodsOperate')->name('goods-operate');
    Route::post('goods-del{id?}','GoodsController@goodsDel')->name('goods-del');
});