<?php
namespace App\Services;

use App\Enums\OrderStatus;
use App\Repositories\Interface\CommentRepositoryInterface;
use App\Repositories\Interface\NotificationRepositoryInterface;
use App\Repositories\Interface\OfferRepositoryInterface;
use App\Repositories\Interface\OrderRepositoryInterface;
use App\Repositories\Interface\ProductRepositoryInterface;
use App\Repositories\Interface\RestaurantRepositoryInterface;
use App\Traits\Helper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RestaurantService extends BaseService
{
    use Helper;
    protected $restaurantRepository;
    protected $offerRepository;
    protected $orderRepository;
    protected $notificationRepository;
    protected $commentRepository;
    protected $productRepository;


    public function __construct(RestaurantRepositoryInterface $restaurantRepository ,
     OrderRepositoryInterface $orderRepository,
     OfferRepositoryInterface $offerRepository,
     NotificationRepositoryInterface $notificationRepository,
     CommentRepositoryInterface $commentRepository,
     ProductRepositoryInterface $productRepository
     ){
        parent::__construct($restaurantRepository);
        $this->restaurantRepository = $restaurantRepository;
        $this->orderRepository = $orderRepository;
        $this->offerRepository = $offerRepository;
        $this->commentRepository = $commentRepository;
        $this->notificationRepository = $notificationRepository;
        $this->productRepository = $productRepository;

    }

    public function register($data,$request){

        $restaurant = $this->restaurantRepository->store($data);

        $restaurant->categories()->sync($data['categories']);

        $token=$this->restaurantRepository->createToken($restaurant);

        if($request->hasFile('image')){
            $this->UploadImage($request,'image',$restaurant,'restaurants/images');
        }

        return ['token' => $token , 'restaurant' => $restaurant];

    }

    public function login($data){

        $restaurant = $this->restaurantRepository->validateLogin($data);

        if(!$restaurant || !Hash::check($data['password'],$restaurant->password)){

            return ['errorInfo'=>true];
        }

        if($restaurant->is_activated == 0){
            return ['errorActivate'=>true];
        }

        $token=$this->restaurantRepository->createToken($restaurant);

        return ['token' => $token , 'restaurant' => $restaurant];

    }

    public function profile(){
        return auth()->user();
    }

    public function updateProfile($restaurant,$request){

       if($request->has('image')){
            $this->UploadImage($request,'image',$restaurant,'restaurants/images');
       }

       $restaurant = $this->restaurantRepository->update($request->except('image'),$restaurant->id);

       if($request->has('categories')){
            $restaurant->categories()->detach();
            $restaurant->categories()->attach($request->categories);
       }

       return $restaurant;
    }

    public function logout(){

        $restaurant = $this->profile();

        $this->restaurantRepository->removeToken($restaurant);

    }

    public function getProducts(){

        $restaurant=$this->profile();

        return $this->productRepository->all($restaurant);

    }
    public function getNotifications(){

        $restaurant=$this->profile();

        return $this->notificationRepository->all($restaurant);

    }
    public function getOrders(){

        $restaurant=$this->profile();

        return $this->orderRepository->getOrders($restaurant);

    }
    public function getOffers(){

        $restaurant=$this->profile();

        return $this->offerRepository->all($restaurant);

    }
    public function getReviews(){

        $restaurant=$this->profile();

        return $this->commentRepository->all($restaurant);

    }
    public function notifications(){

        $restaurant=$this->profile();

        return $this->notificationRepository->all($restaurant);

    }
    public function newOrders(){

        $restaurant=$this->profile();

        return $this->orderRepository->getOrders($restaurant,OrderStatus::PENDING);

    }
    public function currentOrders(){

        $restaurant=$this->profile();

        return $this->orderRepository->getOrders($restaurant,OrderStatus::RECEIVED);

    }
    public function previousOrders(){

        $restaurant=$this->profile();

        return $this->orderRepository->getOrders($restaurant,[OrderStatus::DELIVERED,OrderStatus::REJECTED]);

    }

    public function getCommissions(){

        $restaurant=$this->profile();

        return $this->restaurantRepository->myComissionsCalc($restaurant);

    }

    public function deAcivate($request,$id){
        if($request->is_activated==0){
            $this->restaurantRepository->removeAllTokens($id);
        }else{
            return false;
        }
    }

    public function getFiltered($search){

        if($search != null){
            return $this->restaurantRepository->filter($search);

        }else{

            return $this->all();
        }
    }

}
