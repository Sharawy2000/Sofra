<?php
namespace App\Services;

use App\Mail\ForgotPasswordMail;
use App\Models\Client;
use App\Repositories\Interface\ClientRepositoryInterface;
use App\Repositories\Interface\RestaurantRepositoryInterface;
use App\Traits\Helper;
use Illuminate\Support\Facades\Mail;

class PasswordService
{
    use Helper;


    protected $clientRepository;
    protected $restaurantRepository;

    public function __construct(ClientRepositoryInterface $clientRepository , RestaurantRepositoryInterface $restaurantRepository){
        $this->clientRepository=$clientRepository;
        $this->restaurantRepository=$restaurantRepository;
    }

    public function forgot($request)
    {
        $target = $this->clientRepository->validateLogin($request);
        $target ??= $this->restaurantRepository->validateLogin($request);

        if($target){
            $code = rand(111111, 999999);
            $data=['reset_code'=>$code];

            if($target instanceof Client){
                $this->clientRepository->update($data,$target->id);
            }else{
                $this->restaurantRepository->update($data,$target->id);
            }

            Mail::to($target->email)
                ->bcc('mr.wesamahmed@gmail.com')
                ->send(new ForgotPasswordMail([
                    'code' => $code,
                    'name' => $target->name,
                ]));

        }else{
            return ['errorPhone'=>true];
        }
    }

    public function reset($request){

        $target=$this->clientRepository->validateResetCode($request->code);
        $target??=$this->restaurantRepository->validateResetCode($request->code);

        if ($target){
            $data=['password'=>$request->password,'reset_code'=>null];

            if($target instanceof Client){
                $this->clientRepository->update($data,$target->id);
            }else{
                $this->restaurantRepository->update($data,$target->id);
            }

        }else{
            return ['errorCode'=>true];

        }
    }
}
