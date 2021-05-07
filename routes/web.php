<?php

use Illuminate\Support\Facades\Route;

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
// Admin Part
Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        // Amin routes
        Route::resource('admin', 'Admin\AdminController');
        Route::resource('roles', 'Admin\RoleController');
//        Route::resource('categories', 'Admin\CategoryController');
        Route::resource('documents','Admin\DocumentController');
        Route::get('documents/type/{type}','Admin\DocumentController@type')->name('pageType');
        Route::resource('content','Admin\ContentController');
        Route::resource('users', 'Admin\UserController');
        Route::resource('settings', 'Admin\SettingController');
        Route::resource('translates', 'Admin\TranslateController');
        Route::resource('userRoles','Admin\UserRoleController');
        Route::resource('profile','Admin\ProfileController');
        Route::get('users/changeStatus/{id}','Admin\UserController@changeStatus')->name('users.change.status');
        Route::resource('upgradeRequest','Admin\UserUpgradeRequestController');
    });

    Route::prefix('user')->middleware('active')->name('user.')->group(function () {
        // User routes
        Route::resource('documents','User\DocumentController');
        Route::get('documents/type/{type}','User\DocumentController@type')->name('pageType');
        Route::resource('translate','User\TranslateController');
        Route::resource('profile','User\ProfileController');
        Route::resource('upgradeRequest','User\UpgradeRequestController');
    });
    // Default
    Route::get('/home', 'HomeController@index')->name('home');
});
