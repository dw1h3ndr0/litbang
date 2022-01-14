<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RisetController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\SettingController;

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
    //return view('welcome');
    return view('login.index');
})->middleware('guest');



Route::get('/home', [DashboardController::class, 'index'])->name('home')->middleware('auth');

Route::get('/login',[LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login',[LoginController::class, 'authenticate']);
Route::post('/logout',[LoginController::class, 'logout'])->name('logout');
Route::get('/register',[RegisterController::class, 'index'])->name('register')->middleware('guest');
Route::post('/register',[RegisterController::class, 'store']);


Route::group(['middleware' => ['auth','checkRole:1,2,4']], function(){	

	//Route User menggunakan Route Model Binding
	Route::get('/user',[UserController::class,'index'])->name('user.index');
	Route::get('/user/create',[UserController::class,'create'])->name('user.create');
	Route::post('/user',[UserController::class,'store'])->name('user.store');
	Route::get('/user/{user:username}/edit',[UserController::class, 'edit'])->name('user.edit');
	Route::put('/user/{user:username}',[UserController::class,'update'])->name('user.update');
	Route::delete('/user/{user:username}/destroy',[UserController::class,'destroy'])->name('user.destroy');	
	Route::get('/user/{id}/removeImage',[UserController::class, 'removeImage'])->name('user.removeImage');

	//Rubah Password
	Route::get('/change-password/{user:username}', [ChangePasswordController::class, 'index'])->name('change.password');
	Route::put('/change-password/{user:username}', [ChangePasswordController::class,'update'])->name('change.password');

	//Setting
	Route::get('/setting',[SettingController::class,'index'])->name('setting.index');
	// Route::get('/setting',[SettingController::class,'create'])->name('setting.create');
	Route::post('/setting',[SettingController::class,'store'])->name('setting.store');
	Route::get('/setting/removeFile/{jenis}',[SettingController::class, 'removeFile'])->name('setting.removeFile');

});

	
Route::group(['middleware' => ['auth','checkRole:1,2,3,4,5,6']], function(){	

	Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');

	//Route Riset menggunakan Route Model Binding
	//jika lebih >1 parameter gunakan Route helper
	// Route::get('/riset','RisetController@index')->name('riset'); <-- Laravel Route versi <8 
	Route::get('/riset', [RisetController::class, 'index'])->name('riset.index');
	Route::get('/riset/create',[RisetController::class, 'create'])->name('riset.create');
	Route::post('/riset',[RisetController::class, 'store'])->name('riset.store');
	Route::get('/riset/{riset:slug}',[RisetController::class, 'show'])->name('riset.show');
	Route::get('/riset/{riset:slug}/edit',[RisetController::class, 'edit'])->name('riset.edit');
	Route::put('/riset/{riset:slug}',[RisetController::class,'update'])->name('riset.update');
	Route::delete('/riset/{riset:slug}',[RisetController::class,'destroy'])->name('riset.destroy');	
	Route::get('/riset/{id}/removeFile/{jenis}',[RisetController::class, 'removeFile'])->name('riset.removeFile');
	Route::get('/riset_export_excel',[RisetController::class, 'export_excel'])->name('riset.export');


	Route::get('/user/{user:username}',[UserController::class, 'show'])->name('user.show');
});