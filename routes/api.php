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
use App\Http\Controllers\PayMobController;
use Illuminate\Support\Facades\Route;

//paymob -> success when in real server host

Route::post('/checkout/processed',[PayMobController::class,'checkout_process']);

// ----------------------------------------------------------------

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
        'middleware'=>['auth:sanctum','is-client']
    ],function(){

        Route::controller(ClientAuthController::class)->group(function(){
            Route::get('/profile','profile');
            Route::patch('/update-profile','update');
            Route::post('/logout','logout');
        });

        Route::controller(ClientMainController::class)->group(function(){
            Route::get('/my-orders','myOrders');
            Route::get('/valid-offers','validOffers');
            Route::get('/my-notifications','myNotifications');
            Route::get('/current-orders','currentOrders');
            Route::get('/previous-orders','previousOrders');
            Route::post('/add-review/{restaurant_id}','addReview');
        });

        Route::group([
            'prefix'=>'order',
            'controller'=>OrderController::class
        ],function(){
            Route::get('/{id}/received','receivedOrder');
            Route::get('/{id}/cancelled','cancelledOrder');
        });

    });
    
    Route::group([
        'prefix'=>'restaurant',
        'middleware'=>['auth:sanctum','is-restaurant']
    ],function(){

        Route::controller(RestaurantAuthController::class)->group(function(){
            Route::get('/profile','profile');
            Route::patch('/update-profile','update');
            Route::post('/logout','logout');
        });

        Route::controller(RestaurantMainController::class)->group(function(){
            Route::get('/my-orders','myOrders');
            Route::get('/my-offers','myOffers');
            Route::get('/my-products','myProducts');
            Route::get('/my-reviews','myReviews');
            Route::get('/my-notifications','myNotifications');
            Route::get('/new-orders','newOrders');
            Route::get('/current-orders','currentOrders');
            Route::get('/previous-orders','previousOrders');
            Route::get('/my-comissions','myCommissions');
        });

        Route::group([
            'prefix'=>'order',
            'controller'=>OrderController::class
        ],function(){
            Route::get('/{id}/accepted','acceptOrder');
            Route::get('/{id}/rejected','rejectOrder');
            Route::get('/{id}/delivered','deliveredOrder');
        });

        
       
    });
        
    Route::name('api.')->group(function(){
        Route::resource('products',ProductsController::class)->middleware(['auth:sanctum','is-restaurant']);
        Route::resource('offers',OfferController::class)->middleware(['auth:sanctum','is-restaurant']);
        Route::resource('orders',OrderController::class)->middleware(['auth:sanctum','is-client']);
    });
        
});
                