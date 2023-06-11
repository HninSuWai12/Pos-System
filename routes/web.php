<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\userController;
use App\Http\Controllers\User\userAuthController;



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

Route::middleware(['admin_auth'])->group(function(){
    Route::redirect('/', 'loginPage');
Route::get('loginPage', [AuthController::class, 'loginPage'])->name('auth#loginPage');
Route::get('registerPage', [AuthController::class, 'registerPage'])->name('auth#registerPage');
});

Route::middleware(['auth'])->group(function () {
//dashboard
Route::get('dashboard' , [AuthController::class,'dashboard'])->name('auth#dashboard');


    //admin
   Route::middleware(['admin_auth'])->group(function(){
    //category
   Route::prefix('admin')->group(function(){
    Route::get('list',[CategoryController::class,'list'])->name('admin#list');
    Route::get('addCategory',[CategoryController::class,'add'])->name('admin#addCategory');
    Route::post('createCategory',[CategoryController::class,'create'])->name('admin#createCategory');
    Route::get('delete/{id}',[CategoryController::class,'delete'])->name('admin#delete');
    Route::get('edit/{id}',[CategoryController::class,'edit'])->name('admin#edit');
    Route::post('update',[CategoryController::class,'update'])->name('admin#update');


   });
   //Products
   Route::prefix('products')->group(function(){
    Route::get('productList',[ProductController::class ,'list'])->name('products#list');
    Route::get('add',[ProductController::class , 'add'])->name('product#add');
    Route::post('create',[ProductController::class , 'create'])->name('product#create');
    Route::get('edit/{id}',[ProductController::class ,'edit'])->name('product#edit');
    Route::post('update',[ProductController::class ,'update'])->name('product#update');
    Route::get('delete/{id}',[ProductController::class , 'delete'])->name('product#delete');
    Route::get('seeMore/{id}',[ProductController::class , 'seeMore'])->name('product#seeMore');
   });
   //changePassword
   Route::prefix('profile')->group(function(){
    Route::get('change',[adminController::class , 'changePassword'])->name('profile#change');
    Route::post('updatePassword',[adminController::class , 'updatePassword'])->name('profile#updatePassword');
   });

   //Account Info
   Route::prefix('info')->group(function(){
    Route::get('infoPage',[adminController::class ,'infoPage'])->name('info#infoPage');
    Route::get('editInfo',[adminController::class,'editInfo'])->name('info#editInfo');
    Route::post('updateInfop',[adminController::class, 'updateInfo'])->name('info#updateInfo');
    Route::get('role',[adminController::class , 'adminRole'])->name('info#role');
    Route::get('delete/{id}',[adminController::class ,'delete'])->name('info#delete');
    Route::get('changeRole',[adminController::class,'change'])->name('info#change');
    Route::post('changeRoleupdate',[adminController::class,'changeRole'])->name('info#changeRole');

   });

   });

    //User
        Route::middleware(['user_auth'])->group(function(){
            Route::prefix('user')->group(function(){
                Route::get('userList',[userController::class,'list'])->name('user#user');
                Route::get('fliter/{id}',[userController::class ,'fliter'])->name('user#fliter');
                Route::get('detail/{id}',[userController::class , 'detail'])->name('user#detail');
                Route::get('cart',[userController::class , 'cart'])->name('user#cart');


            });

            //For Ajax
            Route::prefix('ajax')->group(function(){
            Route::get('pizzaList',[AjaxController::class , 'pizzaList'])->name('ajax#pizzaList');
            //Create Cart
            Route::get('createCart',[AjaxController::class ,'createCart'])->name('ajax#createCart');
            });
            Route::prefix('info')->group(function(){
            Route::get('password',[userAuthController::class , 'passwordPage'])->name('info#passwordPage');
            Route::post('change',[userAuthController::class , 'changePassword'])->name('userInfo#changePassword');
            Route::get('info',[userAuthController::class , 'info'])->name('user#info');
            Route::get('edit',[userAuthController::class ,'editPage'])->name('user#editPage');
            Route::post('update',[userAuthController::class,'update'])->name('user#update');
            });

        });

});

