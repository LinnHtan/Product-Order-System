<?php

use App\Http\Controllers\Api\RouteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



//get method
Route::get('apiTesting', function(){
    $data = [
        'status' => 'success',
        'message' => 'This is api testing'
    ];
    return response()->json($data, 200);
});  //127.0.0.1:8000/api/apiTesting
Route::get('product/list',[RouteController::class,'productList']);      //127.0.0.1:8000/api/product/list
Route::get('category/list',[RouteController::class,'categoryList']);    //127.0.0.1:8000/api/category/list
Route::get('list',[RouteController::class,'list']);     //127.0.0.1:8000/api/list
Route::get('user',[RouteController::class,'userList']);     //127.0.0.1:8000/api/user

//delete category
Route::get('delete/get/category/{id}',[RouteController::class,'deleteGetCategory']);  //127.0.0.1:8000/api/delete/get/category
//detail
Route::get('detail/get/product/{id}',[RouteController::class,'detailGetProduct']);     //127.0.0.1:8000/api/detail/get/product



//post method
Route::post('create/user',[RouteController::class,'createUser']);   //127.0.0.1:8000/api/create/user
Route::post('create/category',[RouteController::class,'createCategory']);    //127.0.0.1:8000/api/create/category
Route::post('create/contact',[RouteController::class,'createContact']);     //127.0.0.1:8000/api/create/contact

//delete category
Route::post('delete/post/category',[RouteController::class,'deletePostCategory']);  //127.0.0.1:8000/api/delete/post/category
//detail
Route::post('detail/post/product',[RouteController::class,'detailPostProduct']);     //127.0.0.1:8000/api/detail/post/product
//update
Route::post('update/product',[RouteController::class,'updateProduct']);   //127.0.0.1:8000/api/update/product
Route::post('update/contact',[RouteController::class,'updateContact']);     //127.0.0.1:8000/api/update/contact





