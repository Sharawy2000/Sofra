<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Web\Dashboard\{
    CategoryController,
    CityController,
    ClientController,
    ContactController,
    PaymentController,
    MainController,
    NeighborhoodController,
    OfferController,
    OrderController,
    PaymentMethodController,
    RestaurantController,
    RoleController,
    SettingController,
    UserController
};
use App\Http\Controllers\Web\User\AuthController;
use App\Http\Controllers\Web\User\MainController as UserMainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PayPalController;

Route::get('/', function () {
    return view('welcome');
});

// paypal
Route::get('/cart',[PaypalController::class,'pay']);
Route::post('/pay',[PaypalController::class,'pay_process'])->name('paypal');
Route::get('/success',[PaypalController::class,'success'])->name('success');
Route::get('/cancel',[PaypalController::class,'cancel'])->name('cancel');

// ----------------------------------------------------------------

//paymob -> run in real server host
Route::get('checkout/response',function(Request $request){
    return $request->all();
});

// ----------------------------------------------------------------

Route::post('checkout/{id}', [CheckoutController::class,'index'])->name('checkout');

Route::group([
    'prefix' =>'auth',
    'controller'=>AuthController::class,
    'middleware' =>'change-lang'
], function(){
    Route::view('/login','dashboard.auth.login')->name('login-view');
    // Route::view('/register','dashboard.auth.register');
    Route::post('/login','login')->name('login');
    // Route::post('/register','register')->name('register');
});

Route::get('/change-lang/{lang}',[MainController::class,'changeLang'])->name('change-lang');

Route::group([
    'prefix' => 'v1',
    'middleware' =>'change-lang'
],function(){
    Route::group([
        'prefix' =>'user',
        'middleware' =>'auth'
    ], function(){

        Route::group([
            'controller'=>AuthController::class,
            'middleware' =>'auth'
        ], function(){
            Route::post('/update','update')->name('profile-update');
            Route::get('/profile','profile')->name('profile');
            Route::post('/logout','logout')->name('logout');
        });

        Route::group([
            'controller'=>UserMainController::class 
        ], function(){
            Route::post('/change-password','changePassword')->name('change-password');
        });

    });

    Route::group([
        'prefix' =>'dashboard',
        'middleware' =>['auth','auto-check-permission']
    ], function(){

        Route::view('/','dashboard.index')->name('dashboard');

        Route::resource('cities',CityController::class);
        Route::resource('neighborhoods',NeighborhoodController::class);
        Route::resource('categories',CategoryController::class);
        Route::resource('payments',PaymentController::class);
        Route::resource('contacts',ContactController::class);
        Route::resource('settings',SettingController::class);
        Route::resource('offers',OfferController::class);
        Route::resource('restaurants',RestaurantController::class);
        Route::resource('clients',ClientController::class);
        Route::resource('payment-methods',PaymentMethodController::class);
        Route::resource('orders',OrderController::class);
        Route::resource('users',UserController::class);
        Route::resource('roles',RoleController::class);
    
    });
});

