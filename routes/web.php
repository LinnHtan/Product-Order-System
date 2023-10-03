<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserListController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UserContactController;

  //login register
Route::middleware(['admin_auth'])->group(function(){

    Route::redirect('/','loginPage');
    Route::get('/loginPage',[AuthController::class,'loginPage'])->name('auth#loginPage');
    Route::get('/registerPage',[AuthController::class,'registerPage'])->name('auth#registerPage');

});




Route::middleware(['auth'])->group(function () {


    //dashboard
    Route::get('dashboard',[AuthController::class,'dashboard'])->name('dashboard');




    Route::middleware(['admin_auth'])->group(function(){

        //admin
        Route::group(['prefix' => 'admin'], function(){
             //account
            Route::get('password/changePage',[AdminController::class,'changePasswordPage'])->name('admin#changePasswordPage');
            Route::post('change/password',[AdminController::class,'changePassword'])->name('admin#changePassword');

            //profile
            Route::get('detail/page',[AdminController::class,'detailPage'])->name('admin#detailPage');
            Route::get('edit/page',[AdminController::class,'editPage'])->name('admin#editPage');
            Route::post('update/{id}',[AdminController::class,'update'])->name('admin#update');

            //admin list
            Route::get('list/page',[AdminController::class,'list'])->name("admin#listPage");
            Route::get('delete/{id}',[AdminController::class,'delete'])->name('admin#delete');
            Route::get('detail/{id}',[AdminController::class,'adminDetail'])->name('admin#adminDetail');
            Route::get('change{id}',[AdminController::class,'changeRole'])->name('admin#changeRole');
            Route::post('change/role/{id}',[AdminController::class,'change'])->name('admin#change');



        });

         //admin user list
         Route::group(['prefix' => 'userList'], function(){

            Route::get('userList/page',[UserListController::class,'userListPage'])->name('userList#listPage');
            Route::get('userDetail/{id}',[UserListController::class,'userDetail'])->name('userList#detailPage');
            Route::get('userDelete/{id}',[UserListController::class,'userDelete'])->name('userList#delete');
            Route::get('userChange/page/{id}',[UserListController::class,'userChangePage'])->name('userList#userChangePage');
            Route::post('userChange/role/{id}',[UserListController::class,'userChangeRole'])->name('userList#userChangeRole');

         });

        //category
         Route::group(['prefix'=>'category'],function(){
            Route::get('list',[CategoryController::class,'listPage'])->name('category#listPage');
            Route::get('create/page',[CategoryController::class,'createPage'])->name('category#createPage');
            Route::post('create',[CategoryController::class,'create'])->name('category#create');
            Route::get('delete/{id}',[CategoryController::class,'delete'])->name('category#delete');
            Route::get('edit/{id}',[CategoryController::class,'edit'])->name('category#edit');
            Route::post('update/{id}',[CategoryController::class,'update'])->name('category#update');

            });

        //products
        Route::group(['prefix'=>'products'],function(){
            Route::get('list',[ProductController::class,'list'])->name('products#list');
            Route::get('create/page',[ProductController::class,'createPage'])->name('products#createPage');
            Route::post('create',[ProductController::class,'create'])->name('products#create');
            Route::get('delete/{id}',[ProductController::class,'delete'])->name('products#delete');
            Route::get('detail/{id}',[ProductController::class,'detail'])->name('products#detail');
            Route::get('edit/{id}',[ProductController::class,'edit'])->name('products#edit');
            Route::post('update/{id}',[ProductController::class,'update'])->name("products#update");

        });

         //contact
         Route::group(['prefix'=>'contact'],function(){
            Route::get('contact/list',[ContactController::class,'contactList'])->name('contact#adminListPage');
            Route::get('delete/message/{id}',[ContactController::class,'deleteMessage'])->name('contact#deleteMessage');

        });

         //order
         Route::group(['prefix'=>'order'],function(){
            Route::get('list',[OrderController::class,'listPage'])->name('order#listPage');
            Route::post('change/status',[OrderController::class,'changeStatus'])->name('order#changeStatus');
            Route::get('listInfo/{orderCode}',[OrderController::class,'listInfo'])->name('order#listInfo');
            //ajax
            Route::get('ajax/change/status',[OrderController::class,'ajaxChangeStatus'])->name('admin#ajaxChangeStatus');

        });


    });




    //user
    //home
    Route::group(['prefix' => 'user' ,'middleware' => 'user_auth'], function(){
         Route::get('/homePage',[UserController::class,'home'])->name('user#home');
         Route::get('home/filter/{id}',[UserController::class,'filter'])->name('user#filter');
         Route::get('/history',[UserController::class,'history'])->name('user#history');


         Route::prefix('account')->group(function(){
            Route::get('change',[UserController::class,'changePasswordPage'])->name('user#changePasswordPage');
            Route::post('change',[UserController::class,'changePassword'])->name('user#changePassword');
            Route::get('detail',[UserController::class,'detailPage'])->name('user#detailPage');
         });

         Route::prefix('profile')->group(function(){
            Route::get('change',[UserController::class,'profileChangePage'])->name('user#profileChangePage');
            Route::post('change/{id}',[UserController::class,'profileChange'])->name('user#profileChange');
         });

         Route::prefix('product')->group(function(){
            Route::get('detail/{id}',[UserController::class,'productDetailPage'])->name('user#productDetailPage');

         });

         Route::prefix('cart')->group(function(){
            Route::get('list',[UserController::class,'cartListPage'])->name('user#cartDetailPage');

         });

         Route::prefix('contact')->group(function(){
            Route::get('contact/page',[UserContactController::class,'contactPage'])->name('contact#contactPage');
            Route::post('contact/send',[UserContactController::class,'contact'])->name('contact#contactAdmin');

         });

         Route::prefix('ajax')->group(function(){
            Route::get('product/list',[AjaxController::class,'ProductList'])->name('ajax#productList');
            Route::get('addToCart',[AjaxController::class,'addToCart'])->name('ajax#addToCart');
            Route::get('order',[AjaxController::class,'order'])->name('ajax#order');
            Route::get('clear/cart',[AjaxController::class,'clearCart'])->name('ajax#clearCart');
            Route::get('clear/current/product',[AjaxController::class,'clearCurrentProduct'])->name('ajax#clearCurrentProduct');
            Route::get('increase/viewCount',[AjaxController::class,'increaseViewCount'])->name('ajax#increaseViewCount');
         });
    });


});


Route::get('webTesting', function(){
    $data = [
        'status' => 'success',
        'message' => 'This is web testing'
    ];
    return response()->json($data, 200);
});

//127.0.0.1:8000/webTesting











