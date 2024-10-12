<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\ForgotPasswordMail;
use App\Models\Client;
use App\Models\Restaurant;
use App\Traits\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ResetPasswordController extends Controller
{
    use Helper;
    public function forgotPassword(Request $request){
        $request->validate([
            'phone'=>'required|string',
        ]);

        if ($request->phone){

            $client=Client::where('phone',$request->phone)->first();
            // dd($client);
            if ($client){
                $code=rand(111111,999999);
                $client->reset_code=$code;
                $client->save();

                Mail::to($client->email)
                ->bcc('mr.wesamahmed@gmail.com')
                ->send(new ForgotPasswordMail([
                    'code'=>$code,
                    'name'=>$client->name,
                ]));

                return $this->responseJson("تم ارسال رمز التحقق",null,200);

            }
            
            $restaurant=Restaurant::where('phone',$request->phone)->first();
            // dd($restaurant);

            if ($restaurant){
                $code=rand(111111,999999);
                $restaurant->reset_code=$code;
                $restaurant->save();
                // dd($restaurant->email);

                Mail::to($restaurant->email)
                ->bcc('mr.wesamahmed@gmail.com')
                ->send(new ForgotPasswordMail([
                    'code'=>$code,
                    'name'=>$restaurant->name
                ]));

                return $this->responseJson("تم ارسال رمز التحقق",null,200);

            }

            return $this->responseJson("لا يوجد حساب بهذا الرقم",null,400);

        }
    }
    public function resetPassword(Request $request){
        $request->validate([
            'code'=>'required|min:6|max:6',
            'password'=>'required|string|min:6',
            'password_confirmation'=>'required|string|min:6|same:password',
        ]);

        $client=Client::where('reset_code',$request->code)->first();

        if($client){

            $client->password=$request->password;
            $client->reset_code=null;
            $client->save();
            return $this->responseJson("تم تغيير كلمة المرور بنجاح");
        }

        $restaurant=Restaurant::where('reset_code',$request->code)->first();

        if($restaurant){
            
            $restaurant->password=$request->password;
            $restaurant->reset_code=null;
            $restaurant->save();
            return $this->responseJson("تم تغيير كلمة المرور بنجاح");
        }

        return $this->responseJson("رمز التحقق غير صحيح",null,400);


    }
}
