<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\backend\coffee\IndexController as coffeeIndexController;
use \App\Http\Controllers\backend\coffeeCategories\indexController as coffeeCategoriesIndexController;
use \App\Http\Controllers\backend\syrup\indexController as syrupIndexController;
use \App\Http\Controllers\backend\milk\indexController as milkIndexController;
use \App\Http\Controllers\backend\sugar\indexController as sugarIndexController;
use \App\Http\Controllers\backend\size\indexController as sizeIndexController;
use \App\Http\Controllers\front\indexController as FrontIndexController;
use App\Http\Controllers\Auth\LoginController;

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

    Route::get('sign-in/github',[LoginController::class,'github'])->name('signinGithub');
    Route::get('sign-in/github/redirect',[LoginController::class,'githubRedirect']);

    Route::get('sign-in/facebook',[LoginController::class,'facebook'])->name('signinFacebook');
    Route::get('sign-in/facebook/redirect',[LoginController::class,'facebookRedirect']);




Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::controller(coffeeIndexController::class)->name('coffee.')->group(function (){
        Route::get('/coffees','index')->name('index');
        Route::get('/create-coffee','create')->name('create');
        Route::post('/store-coffee','store')->name('store');
        Route::get('/edit-coffee/{slug}','edit')->name('edit');
        Route::post('/update-coffee/{slug}','update')->name('update');
        Route::post('/destroy-coffee/{slug}','destroy')->name('destroy');
        Route::get('/show-coffee/{slug}','show')->name('show');
    });

    Route::controller(coffeeCategoriesIndexController::class)->name('coffeeCategories.')->group(function (){
        Route::get('/coffee-categories','index')->name('index');
        Route::get('/create-coffee-categories','create')->name('create');
        Route::post('/store-coffee-categories','store')->name('store');
        Route::get('/edit-coffee-categories/{slug}','edit')->name('edit');
        Route::post('/update-coffee-categories/{slug}','update')->name('update');
        Route::post('/destroy-coffee-categories/{slug}','destroy')->name('destroy');
    });

    Route::controller(milkIndexController::class)->name('milk.')->group(function (){
        Route::get('/milk','index')->name('index');
        Route::get('/create-milk','create')->name('create');
        Route::post('/store-milk','store')->name('store');
        Route::get('/edit-milk/{slug}','edit')->name('edit');
        Route::post('/update-milk/{slug}','update')->name('update');
        Route::post('/destroy-milk/{slug}','destroy')->name('destroy');
    });

    Route::controller(syrupIndexController::class)->name('syrup.')->group(function (){
        Route::get('/syrup','index')->name('index');
        Route::get('/create-syrup','create')->name('create');
        Route::post('/store-syrup','store')->name('store');
        Route::get('/edit-syrup/{slug}','edit')->name('edit');
        Route::post('/update-syrup/{slug}','update')->name('update');
        Route::post('/destroy-syrup/{slug}','destroy')->name('destroy');
    });

    Route::controller(sugarIndexController::class)->name('sugar.')->group(function (){
        Route::get('/sugar','index')->name('index');
        Route::get('/create-sugar','create')->name('create');
        Route::post('/store-sugar','store')->name('store');
        Route::get('/edit-sugar/{slug}','edit')->name('edit');
        Route::post('/update-sugar/{slug}','update')->name('update');
        Route::post('/destroy-sugar/{slug}','destroy')->name('destroy');
    });

    Route::controller(sizeIndexController::class)->name('size.')->group(function (){
        Route::get('/size','index')->name('index');
        Route::get('/create-size','create')->name('create');
        Route::post('/store-size','store')->name('store');
        Route::get('/edit-size/{slug}','edit')->name('edit');
        Route::post('/update-size/{slug}','update')->name('update');
        Route::post('/destroy-size/{slug}','destroy')->name('destroy');
    });

});
Route::name('front.')->group(function (){
    Route::get('/',[FrontIndexController::class,'index'])->name('index');
    Route::post('/getCoffees',[FrontIndexController::class,'getCoffees'])->name('getCoffees');
    Route::post('/getCoffeeCustomization',[FrontIndexController::class,'getCoffeeCustomizations'])->name('getCoffeeCustomization');
    Route::post('/getSelectedValues',[FrontIndexController::class,'getSelectedValues'])->name('getSelectedValues');
});
