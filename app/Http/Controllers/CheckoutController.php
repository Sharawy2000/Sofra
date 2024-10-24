<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Services\OrderService;

class CheckoutController extends Controller
{
    //
    protected $orderService;
    public function __construct(OrderService $orderService){
        $this->orderService = $orderService;
    }
    public function index($id){
        
        $order=Order::findOrFail($id);

        $paymentKey=PayMobController::pay($order->id,$order->total_price);
        if($paymentKey){
            $order->update([
                'status' => OrderStatus::RECEIVED,

            ]);
        }else{
            $order->update([
                'status' => OrderStatus::PENDING,
            ]);
        }

        return view('paymob')->with(['token' => $paymentKey->token]);


    }
    

}
