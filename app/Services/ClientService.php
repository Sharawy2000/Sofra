<?php

namespace App\Services;

use App\Repositories\Interface\ClientRepositoryInterface;
use App\Repositories\Interface\CommentRepositoryInterface;
use App\Repositories\Interface\NotificationRepositoryInterface;
use App\Repositories\Interface\OrderRepositoryInterface;
use App\Repositories\Interface\RestaurantRepositoryInterface;
use App\Repositories\Interface\ProductRepositoryInterface;
use App\Traits\Helper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClientService extends BaseService
{
    use Helper;
    protected $clientRepository;
    protected $commentRepository;
    protected $restaurantRepository;
    protected $productRepository;
    protected $orderRepository;
    protected $notificationRepository;
    public function __construct(
        ClientRepositoryInterface $clientRepository,
        CommentRepositoryInterface $commentRepository,
        RestaurantRepositoryInterface $restaurantRepository,
        ProductRepositoryInterface $productRepository,
        OrderRepositoryInterface $orderRepository,
        NotificationRepositoryInterface $notificationRepository
    )
    {
        parent::__construct($clientRepository);
        $this->clientRepository = $clientRepository;
        $this->commentRepository = $commentRepository;
        $this->restaurantRepository = $restaurantRepository;
        $this->productRepository = $productRepository;
        $this->orderRepository = $orderRepository;
        $this->notificationRepository = $notificationRepository;
    }

    public function login($data){

        $client = $this->clientRepository->validateLogin($data);

        // if(!$client){
        //     return abort(401,'البيانات التي أدخلتها غير صحيحة');
        // }
        // if(!Hash::check($data['password'],$client->password)){        
        //     return abort(401,'كلمة المرور غير صحيحة');

        // }
        if(!$client || !Hash::check($data['password'],$client->password)){

            // return $this->responseJson('البيانات التي ادخلتها غير صحيحة',null,400);
            return abort(401,'البيانات التي ادخلتها غير صحيحة');
        }
        if($client->is_activated == 0){
            return abort(401,'تم إيقاف حسابك ، برجاء التواصل معنا');
        }

        $token=$this->clientRepository->createToken($client);

        return ['client'=>$client , 'token'=>$token];

    }

    public function register($data){
        
        $client = $this->clientRepository->store($data);

        $token=$this->clientRepository->createToken($client);

        return ['client'=>$client , 'token'=>$token];

    }

    public function profile(){

        $client=Auth::guard('client')->user();

        if(!$client){
            return abort(401,'لا توجد بيانات');

        }

        return $client;  

    }
    public function updateProfile($data){

        $client=$this->profile();

        return $this->clientRepository->update($data,$client->id);

    }

    public function logout(){

        $client=$this->profile();

        $this->clientRepository->removeToken($client);

    }
    
    public function allOrders(){

        $client=$this->profile();

        return $this->orderRepository->orders($client);


    }
    public function notifications(){

        $client=$this->profile();

        return $this->notificationRepository->all($client);


    }
    public function currentOrders(){

        $client=$this->profile();

        return $this->orderRepository->orders($client);

    }
    public function previousOrders(){

        $client=$this->profile();

        return $this->orderRepository->previousOrders($client);

    }

    public function review($request,$restaurant_id){

        if($request->comment== null && $request->rate == null){
            return abort(401,'من فضلك قم بإضافة تعليق أو تقييم');

            
        }
        
        $client=$this->profile();

        $restaurant=$this->restaurantRepository->find($restaurant_id);

        if(!$restaurant){
            return abort(401,'لا توجد بيانات');

        }

        if($request->has('rate')){
            
            $this->restaurantRepository->overallRateCalc($restaurant);
            
        }

        $request->merge(['restaurant_id'=>$restaurant->id]);
        
        return $this->clientRepository->addReview($request->all(),$client);

    }

    public function deAcivate($request,$id){
        if($request->is_activated==0){
            $this->clientRepository->removeAllTokens($id);
        }else{
            return false;
        }
    }

    public function getFiltered($search){

        if($search != null){
            return $this->clientRepository->filter($search);

        }else{

            return $this->all();
        }
    }

}