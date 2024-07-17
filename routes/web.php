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

Route::get('/about', [
    App\Http\Controllers\ExampleController::class, 'aboutPage',
]);

Route::get('/contact', [
    App\Http\Controllers\ExampleController::class, 'contactPage',
]);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');

//Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])->name('user.index');
//Route::get('/user/create', [App\Http\Controllers\UserController::class, 'create'])->name('user.create');
//Route::get('/user', [App\Http\Controllers\UserController::class, 'store'])->name('user.store');

Route::resource('user', 'App\Http\Controllers\UserController'); //index,create,store,edit,update,show,delete
