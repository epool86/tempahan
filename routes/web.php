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

Route::get('/firstlogin', function(){
    $user = Auth::User();
    if($user->role == 'admin'){
        return redirect()->route('admin.dashboard');
    } else {
        return redirect()->route('user.dashboard');
    }
});

Route::group([
    'prefix' => 'admin', 
    'as' => 'admin.',
    'middleware' => ['auth'],
], function(){

    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');
    Route::resource('user', 'App\Http\Controllers\UserController');
    Route::resource('room', 'App\Http\Controllers\RoomController');

});

Route::group([
    'prefix' => 'user', 
    'as' => 'user.',
    'middleware' => ['auth'],
], function(){

    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboardUser'])->name('dashboard');

});

