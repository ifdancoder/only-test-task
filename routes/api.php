<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

   
Route::controller(UserController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');

    Route::middleware('auth:sanctum')->group(function(){
        Route::get('comfort-categories', 'getAvailableComfortCategories');
        Route::get('car-models', 'getAvailableCarModels');
        Route::get('available-cars', 'getAvailableCars');
        Route::post('car-booking', 'carBooking');
    });
});