<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Srmklive\PayPal\Services\PayPal;

class PayPalController extends Controller
{
    //
    public function pay(){
        return view("index");
    }
    public function pay_process(Request $request){

        $provider = new PayPal;

        $provider->setApiCredentials(config('paypal'));

        $provider->getAccessToken();

        $res=$provider->createOrder([
            "intent" => "CAPTURE",
            "application_context"=>[
                "return_url"=>route('success'),
                "cancel_url"=>route('cancel'),
            ],
            "purchase_units" => [
                [ 
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $request->price,
                    ]
                ]
            ]
        ]);
        // dd($res);
        if(isset($res['id']) && $res['id'] != null){
            foreach($res['links'] as $link){
                if ($link['rel']=='approve'){

                    Session::put('product_name',$request->name);
                    Session::put('quantity',$request->quantity);

                    return redirect()->away($link['href']);
                }
            }
        }
        return redirect(route('cancel'));

    }

    public function success(Request $request){

        $provider = new PayPal;

        $provider->setApiCredentials(config('paypal'));
 
        $provider->getAccessToken();

        $response=$provider->capturePaymentOrder($request->token);

        if (isset($response) && $response['status'] == 'COMPLETED'){
            
            $transaction=new Transaction;
            $transaction->payment_id=$response['id'];
            $transaction->amount=$response['purchase_units'][0]['payments']['captures'][0]['amount']['value'];
            $transaction->currency=$response['purchase_units'][0]['payments']['captures'][0]['amount']['currency_code'];
            $transaction->payer_name=$response['payer']['name']['given_name'];
            $transaction->payer_email=$response['payer']['email_address'];
            $transaction->payment_status=$response['status'];
            $transaction->payment_method="Paypal";
            $transaction->save();

            Session::remove('product_name');
            Session::remove('quantity');

            return "Payment is successful";

        }

        return redirect()->route('cancel');

    }
    public function cancel(){
        return "Payment is cancelled";
    }
}
