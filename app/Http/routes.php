<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
Route::get('test', function(){
    return "1";
});
Route::group(['prefix'=>'admin'], function(){
    Route::group(['prefix'=>'cate'], function(){
        Route::get('list',['as'=>'admin.cate.getList', 'uses'=>'CateController@getList']);
        Route::get('add',['as'=>'admin.cate.getAdd', 'uses'=>'CateController@getAdd']);
        Route::post('add',['as'=>'admin.cate.postAdd', 'uses'=>'CateController@postAdd']);
        Route::get('delete/{id}',['as'=>'admin.cate.getDel', 'uses'=>'CateController@getDel']);
        Route::get('edit/{id}',['as'=>'admin.cate.getEdit', 'uses'=>'CateController@getEdit']);
        Route::post('edit/{id}',['as'=>'admin.cate.postEdit', 'uses'=>'CateController@postEdit']);
    });
    Route::group(['prefix'=>'product'],function(){
        Route::get('list',['as'=>'admin.product.getList', 'uses'=>'ProductController@getList']);
        Route::get('edit/{id}',['as'=>'admin.product.getEdit','uses'=>'ProductController@getEdit']);
        Route::post('edit/{id}',['as'=>'admin.product.postEdit','uses'=>'ProductController@postEdit']);

        Route::get('add',['as'=>'admin.product.getAdd', 'uses'=>'ProductController@getAdd']);
        Route::post('add',['as'=>'admin.product.postAdd','uses'=>'ProductController@postAdd']);
        Route::get('delimg/{id}',['as'=>'admin.product.getDelImg','uses'=>'ProductController@getDelImg']);
    });
    Route::group(['prefix'=>'user'],function(){

        Route::get('list',['as'=>'admin.user.list', 'uses'=>'ProductController@getList']);
        Route::get('edit/{id}',['as'=>'admin.user.getEdit','uses'=>'ProductController@getEdit']);
        Route::post('edit/{id}',['as'=>'admin.user.postEdit','uses'=>'ProductController@postEdit']);

        Route::get('add',['as'=>'admin.user.getAdd', 'uses'=>'ProductController@getAdd']);
        Route::post('add',['as'=>'admin.user.postAdd','uses'=>'ProductController@postAdd']);
        Route::get('delimg/{id}',['as'=>'admin.user.getDelImg','uses'=>'ProductController@getDelImg']);
    });
});


