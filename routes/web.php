<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MenuController;

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
    return view('index');
})->name('Home');

Route::post('/auth/save',[MainController::class,'save'])->name('auth.save');
Route::post('/auth/send',[MainController::class,'send'])->name('auth.send');
Route::get('/auth/reset',[MainController::class,'reset'])->name('auth.reset');
Route::get('/auth/logout',[MainController::class,'logout'])->name('auth.logout');
Route::post('/auth/check',[MainController::class,'check'])->name('auth.check');
Route::get('/homemenu',[MainController::class,'menu'])->name('homemenu');
Route::get('/auth/enternewpass/{token}',[MainController::class,'enternewpass'])->name('enternewpass');
Route::post('/auth/savenewpass',[MainController::class,'savenewpass'])->name('savenewpass');

Route::group(['middleware'=>['Authcheck']],function(){
    Route::get('/admin/dashboard',[MainController::class,'dashboard'])->name('admin.dashboard');
    // Route::get('/admin/users',[MainController::class,'users'])->name('admin.users');
    Route::get('/admin/profile',[MainController::class,'profile'])->name('admin.profile');
    Route::post('/admin/edit',[MainController::class,'editinfo'])->name('admin.edit');
    Route::post('/admin/editpass',[MainController::class,'editpass'])->name('admin.editpass');
    Route::get('/auth/login',[MainController::class,'login'])->name('auth.login');
    Route::get('/auth/register',[MainController::class,'register'])->name('auth.register');
    Route::resource('menu',MenuController::class);
    
}); 