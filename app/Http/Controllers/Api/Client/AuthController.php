<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\LoginRequest;
use App\Http\Requests\Client\RegisterRequest;
use App\Services\ClientService;
use App\Traits\Helper;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $clientService;

    public function __construct(ClientService $clientService){
        $this->clientService = $clientService;
    }
    use Helper;
    public function login(LoginRequest $request){

        $data = $request->validated(); 
        
        $result = $this->clientService->login($data);
        
        return $this->responseJson('تم تسجيل الدخول بنجاح',[
            'token'=>$result['token'],
            'token_type'=>'Bearer',
            'client'=>$result['client'],
        ]);

    }
    public function register(RegisterRequest $request){
        
        $data = $request->validated(); 

        $result = $this->clientService->register($data);

        return $this->responseJson('تم التسجيل بنجاح',[
            'token'=>$result['token'],
            'token_type'=>'Bearer',
            'client'=>$result['client'],
        ]);
    }

    public function profile(){

        $client = $this->clientService->profile();

        return $this->responseJson('البيانات الخاصة بك',$client);

    }

    public function update(Request $request){

        $client = $this->clientService->profile();

        $data=$request->validate([
            'name'=>'nullable|string',
            'email'=>'nullable|string|unique:clients,email,'.$client->id,
            'phone'=>'nullable|string|unique:clients,phone,'.$client->id,
            'neighborhood_id'=>'nullable|integer'

        ]);
        
        $client = $this->clientService->updateProfile($data);

        return $this->responseJson('تم تحديث بياناتك بنجاح',$client);

    }

    public function logout(){
        
        $this->clientService->logout();

        return $this->responseJson('تم تسجيل الخروج بنجاح');

    }
}
