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
| Middleware options can be located in `app/Http/Kernel.php`
|
*/

// Homepage Route
Route::get('/', 'WelcomeController@welcome')->name('welcome');

// Authentication Routes
Auth::routes();

// Registered and Activated User Routes
Route::group(['middleware' => ['auth']], function () {

    // Activation Routes
    Route::get('/logout', ['uses' => 'Auth\LoginController@logout'])->name('logout');

    //  Dashboard Page
    Route::get('/dashboard', ['uses' => 'UserController@index'])->name('user.dashboard');
    Route::get('/home', ['uses' => 'UserController@index'])->name('public.home');
    Route::get('/profile', ['uses' => 'UserController@show'])->name('public.profile');
    Route::get('/profile/edit', ['uses' => 'UserController@edit'])->name('public.showProfile');
    Route::post('/profile/edit', ['uses' => 'UserController@update'])->name('public.updateProfile');
    Route::get('/profile-picture', ['uses' => 'UserController@getProfileUrl'])->name('public.profile-picture');
    
    Route::get('/attend/{subjectID}', ['uses' => 'UserController@showAttend'])->name('public.attend');
    Route::get('/attend/{subjectID}/checkin', ['uses' => 'UserController@doAttend'])->name('user.attend');

    // Reports
    Route::get('/reports', ['uses' => 'UserController@reports']);
});

Route::group(['middleware'=> ['auth', 'admin']], function () {

    // users
    Route::resource('users', 'UsersManagementController', [
        'names' => [
            'index'   => 'users',
            'destroy' => 'user.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);
    // End users

    // Courses
    Route::resource('courses', 'CourseManagementController', [
        'names' => [
            'index'   => 'courses',
            'destroy' => 'user.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);
    // End courses

    // Venues
    Route::get('/venues', ['uses' => 'CourseManagementController@showVenues']);
    Route::get('/venues/create', ['uses' => 'CourseManagementController@showCreateVenue']);
    Route::post('/venues/create', ['uses' => 'CourseManagementController@doCreateVenue']);
    Route::get('/venues/{id}/edit', ['uses' => 'CourseManagementController@showUpdateVenue']);
    Route::post('/venues/{id}/update', ['uses' => 'CourseManagementController@doUpdateVenue']);
    // End venue

    // Subject
    Route::get('/subject/create/{courseID}', ['uses' => 'CourseManagementController@showCreateSubject']);
    Route::post('/subject/create/{courseID}', ['uses' => 'CourseManagementController@doCreateSubject']);
    Route::post('/subject/update/{id}', ['uses' => 'CourseManagementController@doUpdateSubjectTime']);
    // End Subject
});
