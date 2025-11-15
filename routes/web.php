<?php

use App\Http\Controllers\admin\adminLoginController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'admin'], function () {

    // Routes for guests (not logged in admins)
    Route::group(['middleware' => 'admin.guest'], function () {
        // Example: login routes
        Route::get('/login', [adminLoginController::class , 'index'])->name('admin.login');
        Route::post('/authenticate', [adminLoginController::class , 'authenticate'])->name('admin.authenticate');

    });

    // Routes for authenticated admins
    Route::group(['middleware' => 'admin.auth'], function () {

         Route::get('/dashboard', [HomeController::class , 'index'])->name('admin.dashboard');
         Route::get('/logout', [HomeController::class , 'logout'])->name('admin.logout');

         // category route
         Route::get('/categories/create', [CategoryController::class , 'create'])->name('categories.create');
         Route::post('/categories', [CategoryController::class , 'store'])->name('categories.store');



         Route::get('/getSlug',function(){

         });
        
    });

});