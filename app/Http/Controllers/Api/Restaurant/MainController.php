<?php

namespace App\Http\Controllers\Api\Restaurant;

use App\Http\Controllers\Controller;
use App\Services\RestaurantService;
use App\Traits\Helper;

class MainController extends Controller
{
    protected $restaurantService;

    public function __construct(RestaurantService $restaurantService){
        $this->restaurantService = $restaurantService;
    }
    use Helper;

    public function myProducts(){

        $products=$this->restaurantService->getProducts();
        return $this->responseJson('المنتجات الخاصة بك',$products);

    }
    public function myOffers(){

        $offers=$this->restaurantService->getOffers();
        return $this->responseJson('العروض الخاصة بك',$offers);

    }
    public function myOrders(){

        $orders = $this->restaurantService->getOrders();
        return $this->responseJson('الطلبات الخاصة بك',$orders);

    }
     public function newOrders()
    {
        $orders = $this->restaurantService->newOrders();

        return $this->responseJson('الطلبات الجديدة',$orders);

    }
    public function currentOrders()
    {
        $orders=$this->restaurantService->currentOrders();

        return $this->responseJson('الطلبات الحالية',$orders);

    }
    public function previousOrders()
    {
        $orders=$this->restaurantService->previousOrders();

        return $this->responseJson('الطلبات السابقة',$orders);

    }

    public function myReviews(){

        $reviews = $this->restaurantService->getReviews();

        return $this->responseJson('التقييمات الخاصة بك',$reviews);

    }

    public function myNotifications(){

        $notifications= $this->restaurantService->getNotifications();

        return $this->responseJson('الاشعارات',$notifications);

    }

    public function myCommissions(){
        
        $results = $this->restaurantService->getCommissions();

        return $this->responseJson('العمولات',$results);
    }
}