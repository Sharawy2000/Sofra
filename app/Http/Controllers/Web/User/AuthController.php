<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService){
        $this->userService = $userService;
    }
    public function login(Request $request){
        $validator= Validator::make($request->all(),[
            'email'=>'required|email',
            'password'=>'required|string',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator->errors());
        }
        
        return $this->userService->login($request);
    }

    public function register(Request $request){
        
        $validator= Validator::make($request->all(),[
            'name'=>'required|string',
            'email'=>'required|email',
            'password'=>'required|string',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator->errors());
        }

        $this->userService->register($request);

        return redirect()->route('login-view');
    }
    
    
    public function profile(){
        $user = $this->userService->profile();
        return view('dashboard.users.profile',get_defined_vars());

    }

    public function update(Request $request){

        $user = $this->userService->profile();

        $validator= Validator::make($request->all(),[
            'name'=>'nullable|string',
            'email'=>'nullable|email|unique:users,email,'.$user->id,
            'password'=>'nullable|string',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator->errors());
        }
        return $this->userService->updateProfile($request);

    }
    public function logout(){
        
        $this->userService->logout();

        return redirect()->route('login-view')->with('success','تم تسجيل الخروج');

    }
}

