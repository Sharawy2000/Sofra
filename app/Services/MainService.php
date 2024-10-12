<?php 
namespace App\Services;
use App\Repositories\Interface\ContactMessageRepositoryInterface;
use App\Repositories\Interface\TokenRepositoryInterface;
use App\Traits\Helper;

class MainService 
{
    use Helper;
    protected $contactRepository;
    protected $fcmTokenRepository;

    public function __construct(ContactMessageRepositoryInterface $contactRepository,
    TokenRepositoryInterface $fcmTokenRepository){
        $this->contactRepository=$contactRepository;
        $this->fcmTokenRepository=$fcmTokenRepository;
    }

    public function sendContact($data){

        return $this->contactRepository->store($data);
        
    }

    public function createFcmToken($data){

        $client = auth()->guard('client')->user();
        $restaurant = auth()->guard('restaurant')->user();

        if($client){

            return $this->fcmTokenRepository->add($data,$client);
        }

        if($restaurant){

            return $this->fcmTokenRepository->add($data,$restaurant);

        }

    }
}