<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Models\Order;
use PayMob\Facades\PayMob;
use Illuminate\Http\Request;

class PayMobController extends Controller
{
    //
    static public function pay($id,$total_price)
    {
        $auth = PayMob::AuthenticationRequest();
        $order = PayMob::OrderRegistrationAPI([
            'auth_token' => $auth->token,
            'amount_cents' => $total_price * 100, //put your price
            'currency' => 'EGP',
            'delivery_needed' => false, // another option true
            'merchant_order_id' => $id, //put order id from your database must be unique id
            'items' => [] // all items information or leave it empty
        ]);

        if(isset($order->message)){
            abort(403,'Duplicate order id in PayMob');
        }

        $PaymentKey = PayMob::PaymentKeyRequest([
            'auth_token' => $auth->token,
            'amount_cents' => $total_price * 100, //put your price
            'currency' => 'EGP',
            'order_id' => $order->id,
            "billing_data" => [ // put your client information
                "apartment" => "803",
                "email" => "claudette09@exa.com",
                "floor" => "42",
                "first_name" => "Clifford",
                "street" => "Ethan Land",
                "building" => "8028",
                "phone_number" => "+86(8)9135210487",
                "shipping_method" => "PKG",
                "postal_code" => "01898",
                "city" => "Jaskolskiburgh",
                "country" => "CR",
                "last_name" => "Nicolas",
                "state" => "Utah"
            ]
        ]);


        return $PaymentKey;
    }

    public function checkout_process(Request $request){

        $request_hmac = $request->hmac;
            $calc_hmac = PayMob::calcHMAC($request);
        
            if ($request_hmac == $calc_hmac) {
                $order_id = $request->obj['order']['merchant_order_id'];
                $amount_cents = $request->obj['amount_cents'];
                $transaction_id = $request->obj['id'];

        
                $order = Order::find($order_id);
        
                if ($request->obj['success'] == true && ($order->total_price * 100) == $amount_cents) {
                    $order->update([
                        'status' => OrderStatus::RECEIVED,
                        'transaction_id' => $transaction_id
                    ]);
                    
                } else {
                    $order->update([
                        'status' => OrderStatus::CANCELLED,
                        'transaction_id' => $transaction_id
                    ]);
                    
                }
            }
    }
}