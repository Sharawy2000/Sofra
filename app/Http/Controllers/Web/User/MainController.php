<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MainController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService){
        $this->userService = $userService;
    }

    public function changePassword(Request $request){

        $validator=Validator::make($request->all(),[
            'old_password'=>'required|string',
            'password'=>'required|string|confirmed',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator->errors());
        }

        return $this->userService->changePassword($request);

       
    }
}
