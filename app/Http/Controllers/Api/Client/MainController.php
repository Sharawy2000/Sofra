<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Services\ClientService;
use App\Traits\Helper;
use Illuminate\Http\Request;

class MainController extends Controller
{
    protected $clientService;

    public function __construct(ClientService $clientService){
        $this->clientService = $clientService;
    }
    use Helper;

    public function myOrders(){
        $orders = $this->clientService->allOrders();
        return $this->responseJson('الطلبات الخاصة بك',$orders);

    }
    public function validOffers()
    {
        $offers = $this->clientService->allValidOffers();

        return $this->responseJson('جديد العروض',$offers);
        
    }
    public function myNotifications(){
        $notifications = $this->clientService->notifications();
        return $this->responseJson('الاشعارات',$notifications);

    }
    public function currentOrders()
    {
        $orders=$this->clientService->currentOrders();

        return $this->responseJson('الطلبات الحالية',$orders);

    }
    public function previousOrders()
    {
        $orders=$this->clientService->previousOrders();

        return $this->responseJson('الطلبات السابقة',$orders);

    }

    public function addReview(Request $request , $restaurant_id){
        
        $request->validate([
            'comment'=>'nullable|string',
            'rate'=>'nullable|integer|in:1,2,3,4,5',
        ]);

        $comment=$this->clientService->review($request,$restaurant_id);

        if(isset($comment['errorReview'])){
            return $this->responseJson('من فضلك قم بإضافة تعليق أو تقييم',null,400);
        }

        if(isset($comment['errorRestaurant'])){
            return $this->responseJson('لا يوجد مطعم',null,400);
        }

        return $this->responseJson("تم اضافة تقييمك بنجاح", $comment->load(['client','restaurant']));

    }
}
