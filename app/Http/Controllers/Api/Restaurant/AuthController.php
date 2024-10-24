<?php

namespace App\Http\Controllers\Api\Restaurant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Restaurant\LoginRequest;
use App\Http\Requests\Restaurant\RegisterRequest;
use App\Services\RestaurantService;
use App\Traits\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
     protected $restaurantService;
     public function __construct(RestaurantService $restaurantService){
          $this->restaurantService = $restaurantService;
     }
    use Helper;

    public function register(RegisterRequest $request){

          $data=$request->validated();

          $result = $this->restaurantService->register($data,$request);

          return $this->responseJson('تم تسجيل الحساب بنجاح',[
               'token'=>$result['token'],
               'token_type'=>'Bearer',
               'restaurant'=>$result['restaurant'],
          ]);

    }
    public function login(LoginRequest $request){

          $data=$request->validated();

          $result = $this->restaurantService->login($data);

          if(isset($result['errorInfo'])){
               return $this->responseJson('البيانات التي ادخلتها غير صحيحة',null,400);
          }
          if(isset($result['errorActivate'])){
               return $this->responseJson('تم إيقاف حسابك ، برجاء التواصل معنا',null,400);
          }
          return $this->responseJson('تم تسجيل الدخول بنجاح',[
               'token'=>$result['token'],
               'token_type'=>'Bearer',
               'restaurant'=>$result['restaurant'],
          ]);

    }
    public function profile(){

          $restaurant = $this->restaurantService->profile();

          return $this->responseJson('البيانات الخاصة بك',$restaurant);
    }

     public function update(Request $request){

          $restaurant = $this->restaurantService->profile();

          $request->validate([
               'name'=>'nullable|string',
               'phone'=>'nullable|string|unique:restaurants,phone,'.$restaurant->id,
               'email'=>'nullable|string|unique:restaurants,email,'.$restaurant->id,
               'neighborhood_id'=>'nullable|integer',
               'image'=>'nullable|file|mimes:jpg,jpeg,png,gif,svg,ico',
               'minimum_order'=>'nullable',
               'delivery_fees'=>'nullable',
               'contact_phone'=>'nullable|string',
               'contact_whatsapp'=>'nullable|string',
               'is_active'=>'nullable|boolean',
               'categories'=>'nullable|array',
               'categories.*'=>'exists:categories,id'

          ]);

          $restaurant=$this->restaurantService->updateProfile($restaurant,$request);

          return $this->responseJson('تم تحديث بياناتك بنجاح',$restaurant);

     }

     public function logout(){

          $this->restaurantService->logout();

          return $this->responseJson('تم تسجيل الخروج بنجاح');


     }

}
