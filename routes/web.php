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
    
    Auth::routes();
    
    Route::get('/home', 'HomeController@index')->name('home');
    
    Route::group([
            'prefix' => 'admin',
            'middleware' => 'auth'
        ], function (){
            Route::get('/',[
                    'uses' => 'Admin\IndexController@index',
                    'as' => 'adminIndex'
                ]
            );
            Route::get('/users',[
                    'uses' => 'Admin\UsersController@index',
                    'as' => 'adminUsers'
                ]
            );
            Route::resource('permissions', 'Admin\PermissionsController');
            Route::resource('roles', 'Admin\RolesController');
            Route::resource('users', 'Admin\UsersController');
            Route::get('schools/import', [
                    'uses' => 'Admin\SchoolsController@import',
                    'as' => 'schools.import'
                ]
            );
            Route::post('schools/add', [
                    'uses' => 'Admin\SchoolsController@add',
                    'as' => 'schools.add'
                ]
            );Route::post('schools/generate', [
                    'uses' => 'Admin\SchoolsController@generate',
                    'as' => 'schools.generate'
                ]
            );
            Route::resource('schools', 'Admin\SchoolsController');
        }
    );
