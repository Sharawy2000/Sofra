<?php 
namespace App\Services;

use App\Repositories\Interface\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService extends BaseService
{
    protected $userRepository;
    public function __construct(UserRepositoryInterface $userRepository){
        parent::__construct($userRepository);
        $this->userRepository=$userRepository;
    }

    public function login($request){

        $user = $this->userRepository->validateLogin($request->email);

        if(!$user || !Hash::check($request->password,$user->password)){
            return back()->withErrors('البيانات التي أدخلتها غير صحيحة');
        }

        Auth::login($user,true);

        return redirect()->route('dashboard');

    }

    public function register($data){
        
        $this->store($data);

    }

    public function profile(){

        $user=Auth::user();

        if(!$user){
            return abort(401,'لا توجد بيانات');
        }

        return $user;  

    }
    public function updateProfile($request){

        $user=$this->profile();
        if(!Hash::check($request->password,$user->password)){
            return redirect()->back()->withErrors('كلمة المرور غير صحيحة');

        }

        $this->update($request,$user->id);

        return redirect()->back()->with('success','تم تحديث البيانات');
    }

    public function logout(){
        $this->profile();

        Auth::logout();
    }

    public function attachRoles($request,$user){
        if($request->role_list != null){
            $this->userRepository->attach($user,$request->role_list);
        }
    }
    public function syncRoles($request,$user){
        $this->userRepository->sync($user,$request->role_list);

    }

    public function changePassword($request){
        
        $user=$this->profile();

        if(!Hash::check($request->old_password,$user->password)){
            return back()->withErrors('كلمة المرور غير صحيحة');
        }

        $this->update($request,$user->id);

        return back()->with('success','تم تحديث كلمة المرور بنجاح');
    }

}