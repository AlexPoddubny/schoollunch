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
    
    Auth::routes(['verify' => true]);
    
    Route::post('search', 'SearchController@search');//->name('search.result');
    
    Route::post('getclasses', [
            'uses' => 'HomeController@getClasses',
            'as' => 'getclasses'
        ]
    );
    
    Route::post('/home/search', 'HomeController@search');
    Route::resource('home', 'HomeController');
    
//    Route::get('/search','SearchController@search')->name('search');

    Route::get('students/confirm/{student}/{parent}', [
        'uses' => 'StudentsController@confirm',
        'as' => 'students.confirm'
    ]);
    
    Route::resource('students', 'StudentsController');
    
    Route::post('getlunches', 'MenuController@getLunches');
    Route::post('loadclasses', 'MenuController@loadClasses');
    Route::get('menu/view/{id?}', [
        'uses' => 'MenuController@index',
        'as' => 'menu.view'
    ]);
    Route::resource('menu', 'MenuController');
    Route::get('courses/{id}/{size?}', [
        'uses' => 'CoursesController@show',
        'as' => 'course.show'
    ]);
    Route::resource('courses', 'CoursesController');
    
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
            );
            Route::get('schools/edit/{school}/{type}', [
                    'uses' => 'Admin\SchoolsController@edit',
                    'as' => 'schools.edit.type'
                ]
            );
            Route::post('schools/generate', [
                    'uses' => 'Admin\SchoolsController@generate',
                    'as' => 'schools.generate'
                ]
            );
            Route::resource('schools', 'Admin\SchoolsController');
            
            Route::post('school/select', [
                    'uses' => 'Admin\SchoolController@select',
                    'as' => 'school.select'
                ]
            );
            Route::post('school/add_break', [
                    'uses' => 'Admin\SchoolController@addBreak',
                    'as' => 'school.add_break'
                ]
            );
            Route::post('school/add_class', [
                    'uses' => 'Admin\SchoolController@addClass',
                    'as' => 'school.add_class'
                ]
            );
            Route::post('school/copy_class/{class}', [
                    'uses' => 'Admin\SchoolController@copyClass',
                    'as' => 'school.copy_class'
                ]
            );
            Route::resource('school', 'Admin\SchoolController');
            Route::resource('schoolclass', 'Admin\SchoolClassesController');
            Route::post('courses/addproduct', 'Admin\CoursesController@addProduct');
            Route::post('courses/delproduct', 'Admin\CoursesController@delProduct');
            Route::resource('courses', 'Admin\CoursesController');
            Route::post('product/search', 'Admin\ProductsController@search');
            Route::resource('products', 'Admin\ProductsController');
            Route::resource('sizes', 'Admin\SizesController');
            Route::resource('types', 'Admin\TypesController');
            Route::post('lunches/addcourse', 'Admin\LunchesController@addCourse');
            Route::post('lunches/getcourses', 'Admin\LunchesController@getCourses');
            Route::resource('lunches', 'Admin\LunchesController');
        
    }
    );
