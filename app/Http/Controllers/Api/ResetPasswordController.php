<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\ForgotPasswordMail;
use App\Models\Client;
use App\Models\Restaurant;
use App\Services\PasswordService;
use App\Traits\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ResetPasswordController extends Controller
{
    protected $passwordService;
    public function __construct(PasswordService $passwordService){
        $this->passwordService=$passwordService;
    }
    use Helper;
    public function forgotPassword(Request $request){
        $request->validate([
            'phone'=>'required|string',
        ]);

        $result = $this->passwordService->forgot($request);

        if($result['errorPhone']){
            return $this->responseJson('رقم الهاتف غير صحيح',null,400);
        }
        
        return $this->responseJson("تم ارسال رمز التحقق", null, 200);
        
    }
    public function resetPassword(Request $request){
        $request->validate([
            'code'=>'required|min:6|max:6',
            'password'=>'required|string|min:6',
            'password_confirmation'=>'required|string|min:6|same:password',
        ]);
        
        $result = $this->passwordService->reset($request);

        if($result['errorPhone']){
            return $this->responseJson('الكود غير صحيح',null,400);
        }

        return $this->responseJson("تم تغيير كلمة المرور بنجاح");

    }
}
