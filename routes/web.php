<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\Homecontroller;
use App\Http\Controllers\Frontend\LoginController;
use App\Http\Controllers\Frontend\OrderController;
use App\Events\SendLocation;
use Illuminate\Http\Request;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsUser;
use App\Http\Middleware\IsDriver;

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

Route::get('/',[Homecontroller::class,"index"])->name('home');
Route::get('/restaurant',[Homecontroller::class,"restaurant"]);
 
Route::middleware([IsAdmin::class])->group(function () {
    Route::get('/admin/home',[Homecontroller::class,"admin"])->name('admin');
    Route::get('/adminMenu',[Homecontroller::class,"adminMenu"]);
    Route::get('/adminRestaurant',[Homecontroller::class,"adminRestaurant"]);
    Route::get('/adminOrder',[Homecontroller::class,"adminOrder"]);
    Route::get('/adminOrderDetails/userId/{id}/orderId/{orderId}',[Homecontroller::class,"adminOrderDetails"]);
    Route::post('/addmenu',[Homecontroller::class,"addmenu"]);
    Route::post('/addrestaurant',[Homecontroller::class,"addrestaurant"]);
    Route::get('/editrestaurant/{id}',[Homecontroller::class,"editrestaurant"]);
    Route::get('/deleterestaurant/{id}',[Homecontroller::class,"deleterestaurant"]);
    Route::get('/deletemenu/{id}',[Homecontroller::class,"deletemenu"]);
    Route::post('/updaterestaurant/{id}',[Homecontroller::class,"updaterestaurant"]);
    Route::get('/adminAddriver',[OrderController::class,"adminAddriver"]);
    Route::post('/assignorder',[OrderController::class,"assignorder"]);
    Route::get('/driverList',[OrderController::class,"driverList"]);
    Route::post('/driveradd',[OrderController::class,"driveradd"]);
    Route::get('/editmenu/{id}',[Homecontroller::class,"editmenu"]);
});
Route::post('/getmenu',[Homecontroller::class,"getmenu"]);

Route::middleware([IsUser::class])->group(function () {
    Route::get('/menu1',[Homecontroller::class,"menu1"]);
    Route::get('/checkout',[Homecontroller::class,"checkout"])->middleware('checkout');
    Route::get('/profile',[Homecontroller::class,"profile"]);
    Route::get('/changepassword',[Homecontroller::class,"changepassword"]);
    Route::get('/orderhistory',[Ordercontroller::class,"orderhistory"]);
    Route::post('/editprofile',[Homecontroller::class,"editprofile"]);
    Route::get('/restaurantmenu/{restaurantname}',[Homecontroller::class,"restaurantmenu"]);
    Route::post('/addcart/{id}',[LoginController::class,"addcart"]);
    Route::post('/updatecart',[HomeController::class,"updatecart"]);
    Route::post('/changePassword',[LoginController::class, "changePassword"]);
    Route::post('/cartsItem',[LoginController::class, "cartsItem"]);
    Route::post('/deletecart',[HomeController::class, "deletecart"]);
    Route::post('/updatequantity',[OrderController::class, "updatequantity"]);
    Route::post('/checkoutorder',[OrderController::class, "checkoutorder"]);
});

Route::middleware([IsDriver::class])->group(function () {
    Route::get('/assinedorder',[OrderController::class,"assinedorder"]);
    Route::get('/assinedorderdetail/userId/{id}/orderId/{orderId}',[OrderController::class,"assinedorderdetail"]);
    Route::post('/changeOrderStatus',[OrderController::class, "changeOrderStatus"]);
    
});
Route::post('/updatemenu/{id}',[Homecontroller::class,"updatemenu"]);
Route::post('/login',[LoginController::class,"login"]);
Route::post('/register',[LoginController::class,"register"]);
Route::post('/logout',[LoginController::class,"logout"]);
Route::get('/getLocation/driverId/{id}', function ($id){
    $driverId = $id;
    return view('map',compact('driverId'));
});

Route::post('/updateLocation', function (Request $request){
    event(new SendLocation([
            
            'lat' => $request->lat,
            'long' => $request->long,
            'sender' => $request->sender
        ]
    ));
    return response()->json(['sender' => $request->sender]);
});