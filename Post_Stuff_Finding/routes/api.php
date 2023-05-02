<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Requests\Auth\LoginRequest;
use App\Http\Controllers\PostStoreController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

//
//Route::group([
//    'prefix' => 'auth'
//],function (){
//   Route::post('login','AuthController@login');
//    Route::post('register','AuthController@register');
//});

Route::post('/login',[AuthController::class,'login']);
Route::post('/logout',[AuthController::class,'logout']);
Route::post('/register',[AuthController::class,'register']);




Route::get('/AllPostMans',[AuthController::class,'AllPostMans']);
Route::get('/search/postman/{id}',[AuthController::class,'searchPostman']);
Route::get('/search/postman/{name}',[AuthController::class,'searchPostmanName']);





Route::post('/create-post',[PostStoreController::class,'storeNewPost']);


Route::get('/search/{id}',[PostStoreController::class,'search']);

Route::get('/lastvalue',[PostStoreController::class,'lastvalue']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::put('/update/{id}',[PostController::class,'update']);

Route::delete('/delete/{id}',[PostController::class,'destroy']);


// روت های پست چی
//Route::Post('/addpostman',[PostController::class,'store']);

Route::Post('/addpostman',[AuthController::class,'register']);


Route::put('/updatepostman/{id}',[PostController::class,'updatePostman']);

Route::delete('/destroyPostman/{id}',[PostController::class,'destroyPostman']);

