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

    /*Route::get('/', function () {
        return view('welcome_old');
    });*/
    
    Route::resource('/', 'WelcomeController')->only(['index']);
    Route::post('/select', 'WelcomeController@select')->name('select');
    
    Route::get('sendbasicemail','MailController@basic_email');

    Auth::routes(['verify' => true]);
    
//    Route::post('search', 'SearchController@search');
    
    Route::post('getclasses', 'HomeController@getClasses')->name('getclasses');
    
    Route::post('/home/search', 'HomeController@search')->name('home.search');
    Route::get('home/remove/{child}', 'HomeController@remove')->name('home.remove');
    Route::resource('home', 'HomeController');
    
    Route::get('students/confirm/{student}/{parent}', [
        'uses' => 'StudentsController@confirm',
        'as' => 'students.confirm'
    ]);
    
    Route::resource('students', 'StudentsController');
    
    Route::post('getlunches', 'MenuController@getLunches');
    Route::post('loadclasses', 'MenuController@loadClasses');
    Route::post('menu.select', 'MenuController@select')->name('menu.select');
    Route::get('menu/create/{id}', 'MenuController@create')->name('menu.add');
    Route::resource('menu', 'MenuController');
    Route::get('courses/index', 'CoursesController@index')->name('course.index');
    Route::get('courses/{id}/{size?}', [
        'uses' => 'CoursesController@show',
        'as' => 'course.show'
    ]);
    
    Route::resource('courses', 'CoursesController')->only(['index', 'show']);
    
    Route::group([
            'prefix' => 'admin',
            'middleware' => 'auth'
        ], function (){
            Route::get('/',[
                    'uses' => 'Admin\IndexController@index',
                    'as' => 'adminIndex'
                ]
            );
            /*Route::get('/users',[
                    'uses' => 'Admin\UsersController@index',
                    'as' => 'adminUsers'
                ]
            );*/
//            Route::resource('permissions', 'Admin\PermissionsController');
            Route::resource('roles', 'Admin\RolesController');
            Route::get('users/get-users-data', 'Admin\UsersController@getData')->name('datatables.users');
            Route::post('users/search', 'Admin\UsersController@search')->name('users.search');
            Route::resource('users', 'Admin\UsersController');
            /*Route::get('schools/import', [
                    'uses' => 'Admin\SchoolsController@import',
                    'as' => 'schools.import'
                ]
            );*/
            /*Route::post('schools/add', [
                    'uses' => 'Admin\SchoolsController@add',
                    'as' => 'schools.add'
                ]
            );*/
            Route::get('schools/edit/{school}/{type}', [
                    'uses' => 'Admin\SchoolsController@edit',
                    'as' => 'schools.edit.type'
                ]
            );
            Route::get('schools/delete/{school}/{type}', [
                    'uses' => 'Admin\SchoolsController@delete',
                    'as' => 'schools.delete.type'
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
            /*Route::post('school/replicate/{class}', [
                    'uses' => 'Admin\SchoolController@copyClass',
                    'as' => 'school.replicate'
                ]
            );*/
            Route::resource('school', 'Admin\SchoolController');
            Route::get('schoolclass/removeteacher/{class}', 'Admin\SchoolClassesController@removeTeacher')->name('removeteacher');
            Route::post('schoolclass/add', 'Admin\SchoolClassesController@addStudent')->name('addstudent');
            Route::resource('schoolclass', 'Admin\SchoolClassesController');
            Route::post('courses/addproduct', 'Admin\CoursesController@addProduct')->name('addproduct');
            Route::post('courses/delproduct', 'Admin\CoursesController@delProduct')->name('delproduct');
            Route::resource('courses', 'Admin\CoursesController');
            Route::post('product/search', 'Admin\ProductsController@search');
            Route::resource('products', 'Admin\ProductsController');
            Route::resource('sizes', 'Admin\SizesController');
            Route::resource('types', 'Admin\TypesController');
            Route::post('lunches/delcourse', 'Admin\LunchesController@delCourse')->name('delcourse');
            Route::post('lunches/addcourse', 'Admin\LunchesController@addCourse')->name('addcourse');
            Route::post('lunches/getcourses', 'Admin\LunchesController@getCourses')->name('getcourses');
            Route::get('lunches/replicate/{lunch}', 'Admin\LunchesController@replicate')->name('lunch.replicate');
            Route::resource('lunches', 'Admin\LunchesController');
        
    }
    );
