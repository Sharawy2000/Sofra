<?php

use App\Http\Controllers\Api\{
    OrderController,
    MainController,
    ProductsController,
    ResetPasswordController,
    OfferController,
};
use App\Http\Controllers\Api\Restaurant\{
    AuthController as RestaurantAuthController,
    MainController as RestaurantMainController,
};
use App\Http\Controllers\Api\Client\{
    AuthController as ClientAuthController,
    MainController as ClientMainController,
};

use Illuminate\Support\Facades\Route;


Route::group([
    'prefix'=>'v1'
],function(){

    Route::group([
        'prefix'=>'auth'
    ],function(){

        Route::group([
            'prefix'=>'client',
            'controller'=>ClientAuthController::class,
        ],function(){
            Route::post('/login','login');
            Route::post('/register','register');
        });
        
        Route::group([
            'prefix'=>'restaurant',
            'controller'=>RestaurantAuthController::class,
        ],function(){
            Route::post('/login','login');
            Route::post('/register','register');
        });
        
    });
    Route::group([
        'prefix'=>'password',
        'controller'=>ResetPasswordController::class,
    ],function(){
        Route::post('/forgot','forgotPassword');
        Route::post('/reset','resetPassword');
    });

    Route::group([
        'controller'=>MainController::class,
    ],function(){
        Route::post('/contact-us','contactUs');
        Route::post('/add-fcm-token','addFcmToken')->middleware('auth:sanctum');
    });
    
    
    Route::group([
        'prefix'=>'client',
        'middleware'=>'auth:sanctum'
    ],function(){
        Route::get('/profile',[ClientAuthController::class,'profile']);
        Route::patch('/update-profile',[ClientAuthController::class,'update']);
        Route::post('/logout',[ClientAuthController::class,'logout']);

        Route::get('/my-orders',[ClientMainController::class,'myOrders']);
        Route::get('/my-notifications',[ClientMainController::class,'myNotifications']);
        Route::get('/current-orders',[ClientMainController::class,'currentOrders']);
        Route::get('/previous-orders',[ClientMainController::class,'previousOrders']);
        Route::post('/add-review/{restaurant_id}',[ClientMainController::class,'addReview']);

    });
    
    Route::group([
        'prefix'=>'restaurant',
        'middleware'=>'auth:sanctum'
    ],function(){
        Route::get('/profile',[RestaurantAuthController::class,'profile']);
        Route::patch('/update-profile',[RestaurantAuthController::class,'update']);
        Route::post('/logout',[RestaurantAuthController::class,'logout']);

        Route::get('/my-products',[RestaurantMainController::class,'myProducts']);
        Route::get('/my-orders',[RestaurantMainController::class,'myOrders']);
        Route::get('/my-reviews',[RestaurantMainController::class,'myReviews']);
        Route::get('/my-notifications',[RestaurantMainController::class,'myNotifications']);

        Route::get('/new-orders',[RestaurantMainController::class,'newOrders']);
        Route::get('/current-orders',[RestaurantMainController::class,'currentOrders']);
        Route::get('/previous-orders',[RestaurantMainController::class,'previousOrders']);

        Route::get('my-comissions',[RestaurantMainController::class,'myCommissions']);


    });

    Route::name('api.')->group(function(){
        Route::resource('products',ProductsController::class)->middleware('auth:sanctum');
        Route::resource('offers',OfferController::class)->middleware('auth:sanctum');
        Route::resource('orders',OrderController::class)->middleware('auth:sanctum');

    });

});
