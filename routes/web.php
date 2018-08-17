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


Route::get('/', [
    'uses'=>'WelcomeController@getWelcome',
    'as'=>'/'
]);


Route::get('/login',[
    'uses'=>'AuthController@getLogin',
    'as'=>'login'
]);

Route::post('/login',[
    'uses'=>'AuthController@postLogin',
    'as'=>'login'
]);


Route::group(['middleware'=>'auth'], function (){


    Route::group(['prefix'=>'posts'], function (){
        Route::get('/new',[
            'uses'=>'PostController@getNewPost',
            'as'=>'post.new'
        ]);
        Route::post('/new',[
            'uses'=>'PostController@postNewPost',
            'as'=>'post.new'
        ]);
        Route::get('/show',[
            'uses'=>'PostController@getPosts',
            'as'=>'posts'
        ]);
        Route::get('/{user}/show',[
            'uses'=>'PostController@getUserPosts',
            'as'=>'user.posts'
        ]);
        Route::post('/delete/post',[
            'uses'=>'PostController@deletePost',
            'as'=>'post.delete'
        ]);
        Route::get('/edit/{slug}',[
            'uses'=>'PostController@getEditPost',
            'as'=>'edit.post'
        ]);
        Route::post('/update',[
            'uses'=>'PostController@postUpdate',
            'as'=>'post.update'
        ]);
    });


    Route::group(['prefix'=>'user'], function (){

        Route::get('/account/setting',[
            'uses'=>'AdminController@getUserAccountSetting',
            'as'=>'account.setting'
        ]);
        Route::post('/password/update',[
            'uses'=>'AdminController@postUpdatePassword',
            'as'=>'password.update'
        ]);
        Route::get('/dashboard',[
            'uses'=>'AdminController@getDashboard',
            'as'=>'dashboard'
        ]);

        Route::get('/logout',[
            'uses'=>'AuthController@getLogout',
            'as'=>'logout'
        ]);
        Route::get('/error',[
            'uses'=>'AdminController@getError',
            'as'=>'error'
        ]);
    });

});





    Route::group(['prefix'=>'admin', ], function (){

        Route::group(['middleware'=>'ntg.auth:Administrator'], function (){

            Route::get('/users',[
                'uses'=>'AdminController@getUsers',
                'as'=>'users'
            ]);
            Route::get('/user/new',[
                'uses'=>'AdminController@getNewUser',
                'as'=>'user.new'
            ]);
            Route::post('/user/new',[
                'uses'=>'AdminController@postNewUser',
                'as'=>'user.new'
            ]);
            Route::post('/user/delete',[
                'uses'=>'AdminController@postDeleteUser',
                'as'=>'user.delete'
            ]);

            Route::post('/user/update',[
                'uses'=>'AdminController@postUpdateUser',
                'as'=>'user.update'
            ]);

        });

    });





