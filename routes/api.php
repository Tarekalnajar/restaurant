<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Resturantcontroller;
use App\Http\Controllers\Menucontroller;
use App\Http\Controllers\Ordercontroller;
use App\Http\Controllers\Usercontroller;
use App\Http\Controllers\detail_ordercontroller;
use App\Http\Controllers\Ratecontroller;







/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('regester',[Usercontroller::class,'regester']);
Route::get('login',[Usercontroller::class,'login']);



Route::middleware(['auth:sanctum'])->group(function ()
{
//////////user
Route::get('logout',[Usercontroller::class,'logout']);

/////////////////////Resturant
Route::get('search/rest',[ResturantController::class,'search']);
Route::get('show/rest',[ResturantController::class,'show']);
Route::get('showrate/rest',[ResturantController::class,'showrate']);
Route::get('index/rest',[ResturantController::class,'index']);
Route::post('store/rest/{avg}',[ResturantController::class,'store']);
Route::post('update/rest/{id}',[ResturantController::class,'update']);
Route::get('destore/rest/{id}',[ResturantController::class,'destore']);
////////////////////menue
Route::post('store/menu',[Menucontroller::class,'store']);
Route::post('update/menu/{id}',[Menucontroller::class,'update']);
Route::get('destore/menu/{id}',[Menucontroller::class,'destore']);
Route::get('index/menu',[Menucontroller::class,'index']);


//////////////////Ordercontroller
Route::post('store/order/{idtotal}',[Ordercontroller::class,'store']);
Route::post('update/order/{id}',[Ordercontroller::class,'update']);
Route::get('index/order',[Ordercontroller::class,'index']);
Route::get('destore/order/{id}',[Ordercontroller::class,'destore']);


/////////////////detail_ordercontroller
Route::get('store/detail',[detail_ordercontroller::class,'store']);
Route::get('update/detail/{id}',[detail_ordercontroller::class,'update']);
Route::get('destore/detail/{id}',[detail_ordercontroller::class,'destore']);

///////////////Ratecontroller
Route::post('store/rate',[Ratecontroller::class,'store']);
Route::post('update/rate/{id}',[Ratecontroller::class,'update']);
Route::get('destore/rate/{id}',[Ratecontroller::class,'destore']);
Route::get('index/rate',[Ratecontroller::class,'index']);







}
);


