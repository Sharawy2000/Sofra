<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Token;
use App\Services\MainService;
use App\Traits\Helper;
use Illuminate\Http\Request;

class MainController extends Controller
{
    protected $mainService;
    public function __construct(MainService $mainService){
        $this->mainService = $mainService;
    }
    use Helper;
    
    public function contactUs(Request $request){
        $data=$request->validate([
            'name' =>'required|string',
            'email' =>'required|email',
            'phone' =>'required|string',
            'message' =>'required|string',
            'type'=>'required|integer|in:1,2,3'
        ]);
    
        $contactMessage = $this->mainService->sendContact($data);
        
        return $this->responseJson("تم ارسال رسالتك بنجاح",$contactMessage);
    }

    public function addFcmToken(Request $request){
        $data=$request->validate([
            'fcm_token' =>'required|string',
            'device_type'=>'required|string|in:Andriod,IOS',
        ]);
        
        $token = $this->mainService->createFcmToken($data);

        return $this->responseJson("تم تسجيل التوكن بنجاح",$token);

    }
}
