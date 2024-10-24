<?php

namespace App\Services;

use App\Enums\OrderStatus;
use App\Repositories\Interface\ClientRepositoryInterface;
use App\Repositories\Interface\CommentRepositoryInterface;
use App\Repositories\Interface\NotificationRepositoryInterface;
use App\Repositories\Interface\OfferRepositoryInterface;
use App\Repositories\Interface\OrderRepositoryInterface;
use App\Repositories\Interface\RestaurantRepositoryInterface;
use App\Repositories\Interface\ProductRepositoryInterface;
use App\Traits\Helper;
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
    protected $offerRepository;
    public function __construct(
        ClientRepositoryInterface $clientRepository,
        CommentRepositoryInterface $commentRepository,
        RestaurantRepositoryInterface $restaurantRepository,
        ProductRepositoryInterface $productRepository,
        OrderRepositoryInterface $orderRepository,
        NotificationRepositoryInterface $notificationRepository,
        OfferRepositoryInterface $offerRepository,
    )
    {
        parent::__construct($clientRepository);
        $this->clientRepository = $clientRepository;
        $this->commentRepository = $commentRepository;
        $this->restaurantRepository = $restaurantRepository;
        $this->productRepository = $productRepository;
        $this->orderRepository = $orderRepository;
        $this->notificationRepository = $notificationRepository;
        $this->offerRepository = $offerRepository;
    }

    public function login($data){

        $client = $this->clientRepository->validateLogin($data);

        if(!$client || !Hash::check($data['password'],$client->password)){
            return['errorInfo'=>true];
        }
        if($client->is_activated == 0){
            return['errorActivate'=>true];
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

        $client=auth()->user();

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

        return $this->orderRepository->getOrders($client);

    }

    public function allValidOffers(){
        return $this->offerRepository->validOffers();
    }

    public function notifications(){

        $client=$this->profile();

        return $this->notificationRepository->all($client);

    }
    public function currentOrders(){

        $client=$this->profile();

        return $this->orderRepository->getOrders($client,OrderStatus::ACCEPTED);

    }
    public function previousOrders(){

        $client=$this->profile();

        return $this->orderRepository->getOrders($client,[OrderStatus::CANCELLED,OrderStatus::DELIVERED]);


    }

    public function addReview($request,$restaurant_id){

        if($request->comment== null && $request->rate == null){
            return['errorReview'=>true];
        }

        $client=$this->profile();

        $restaurant=$this->restaurantRepository->find($restaurant_id);

        if(!$restaurant){
            return['errorRestaurant'=>true];
        }

        if($request->has('rate')){

            $this->restaurantRepository->overallRateCalc($restaurant);

        }

        $request->merge(['restaurant_id'=>$restaurant->id,'client_id'=>$client->id]);

        return $this->commentRepository->store($request->all());

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
