<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Http\Controllers\Api\OrderController;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;
use PayMob\PayMob;

class CheckoutController extends Controller
{
    protected $orderService;
    public function __construct(OrderService $orderService){
        $this->orderService = $orderService;
    }
    public function index(Request $request,$id){
        
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
