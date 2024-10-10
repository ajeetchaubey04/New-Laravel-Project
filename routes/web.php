<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\UserManagement\Role\RoleController;
use App\Http\Controllers\Admin\UserManagement\User\UserController;
use App\Http\Controllers\Admin\UserManagement\Permission\PermissionController;
use App\Http\Controllers\Admin\Product\ProductController;


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

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    dd('Cache Cleared');
});

Route::get('/',              [Controller::class, 'home'])->name('home');
Route::get('/aboutus',       [Controller::class, 'aboutUs'])->name('aboutUs');
Route::get('/blogs/{slug}',  [Controller::class, 'blogs'])->name('blogs');
Route::get('/contact',       [Controller::class, 'contact'])->name('contact');
Route::get('/services',      [Controller::class, 'services'])->name('services');

/*
|--------------------------------------------------------------------------
| Start Admin Area
|--------------------------------------------------------------------------
*/


Route::get('admin/login',                   [AuthController::class, 'index'])->name('admin.login');
Route::post('admin/login',                  [AuthController::class, 'login'])->name('admin.post-login');
Route::post('admin/note-change',            [AuthController::class, 'noteChange'])->name('admin.note-change');
Route::any('admin/forgot-password',         [AuthController::class, 'forgotPassword'])->name('admin.forgot-password');
Route::get('admin/reset-password/{token}',  [AuthController::class, 'showResetPassword'])->name('admin.reset-password.get');
Route::post('admin/reset-password',         [AuthController::class, 'submitResetPassword'])->name('admin.reset-password.post');
Route::get('admin/account-restricted',      [AuthController::class, 'accountRestricted'])->name('admin.account-restricted');


Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('logout',            [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard',        [AuthController::class, 'dashboard'])->name('dashboard');
    Route::any('change-password',   [AuthController::class, 'changePassword'])->name('change-password');

        /*
        |--------------------------------------------------------------------------
        | Start Our Achievements Area
        |--------------------------------------------------------------------------
        */


        Route::prefix('product')->name('products.')->group(function () {
            Route::get('show/{id}',             [ProductController::class, 'show'])->name('show');
            Route::post('store',                [ProductController::class, 'store'])->name('store');
            Route::put('update',                [ProductController::class, 'update'])->name('update');
            Route::get('status/{id}',           [ProductController::class, 'status'])->name('status');
            Route::get('edit/{id}',             [ProductController::class, 'edit'])->name('edit');
            Route::get('delete/{id}',           [ProductController::class, 'destroy'])->name('delete');
            Route::get('permanent-delete/{id}', [ProductController::class, 'permanentDelete'])->name('permanent-delete');
            Route::get('restore/{id}',          [ProductController::class, 'restore'])->name('restore');
            Route::get('/{items?}',             [ProductController::class, 'index'])->name('index');
        });



     /*
    |--------------------------------------------------------------------------
    | Start User Management Area
    |--------------------------------------------------------------------------
    */

    Route::prefix('user-management')->name('user-management.')->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Start User Area
        |--------------------------------------------------------------------------
        */

        Route::prefix('user')->name('user.')->group(function () {
            // Route::get('/search/{items?}', [PermissionController::class, 'search'])->name('search');
            Route::post('store',                [UserController::class, 'store'])->name('store');
            Route::put('update',                [UserController::class, 'update'])->name('update');
            Route::get('status/{id}',           [UserController::class, 'status'])->name('status');
            Route::get('edit/{id}',             [UserController::class, 'edit'])->name('edit');
            Route::get('delete/{id}',           [UserController::class, 'destroy'])->name('delete');
            Route::get('permanent-delete/{id}', [UserController::class, 'permanentDelete'])->name('permanent-delete');
            Route::get('restore/{id}',          [UserController::class, 'restore'])->name('restore');
            Route::get('{items?}',              [UserController::class, 'index'])->name('index');
        });

        /*
        |--------------------------------------------------------------------------
        | Start Role Area
        |--------------------------------------------------------------------------
        */

        Route::prefix('role')->name('role.')->group(function () {
            // Route::get('/search/{items?}', [PermissionController::class, 'search'])->name('search');
            Route::post('store',                [RoleController::class, 'store'])->name('store');
            Route::put('update',                [RoleController::class, 'update'])->name('update');
            Route::get('status/{id}',           [RoleController::class, 'status'])->name('status');
            Route::get('edit/{id}',             [RoleController::class, 'edit'])->name('edit');
            Route::get('delete/{id}',           [RoleController::class, 'destroy'])->name('delete');
            Route::get('permanent-delete/{id}', [RoleController::class, 'permanentDelete'])->name('permanent-delete');
            Route::get('restore/{id}',          [RoleController::class, 'restore'])->name('restore');
            Route::get('{items?}',              [RoleController::class, 'index'])->name('index');
        });

        /*
        |--------------------------------------------------------------------------
        | Start Permission Area
        |--------------------------------------------------------------------------
        */

        Route::prefix('permission')->name('permission.')->group(function () {
            // Route::get('/search/{items?}', [PermissionController::class, 'search'])->name('search');
            Route::post('store',                [PermissionController::class, 'store'])->name('store');
            Route::put('update',                [PermissionController::class, 'update'])->name('update');
            Route::get('status/{id}',           [PermissionController::class, 'status'])->name('status');
            Route::get('edit/{id}',             [PermissionController::class, 'edit'])->name('edit');
            Route::get('delete/{id}',           [PermissionController::class, 'destroy'])->name('delete');
            Route::get('permanent-delete/{id}', [PermissionController::class, 'permanentDelete'])->name('permanent-delete');
            Route::get('restore/{id}',          [PermissionController::class, 'restore'])->name('restore');
            Route::get('/{items?}',             [PermissionController::class, 'index'])->name('index');
        });


    });
});
