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
            'rate'=>'nullable|integer',
        ]);
        
        $comment=$this->clientService->review($request,$restaurant_id);

        return $this->responseJson("تم اضافة تقييمك بنجاح", $comment->load(['client','restaurant']));

    }
}
