<?php
namespace App\Services;

use App\Enums\OrderStatus;
use App\Models\Client;
use App\Repositories\Interface\ClientRepositoryInterface;
use App\Repositories\Interface\TokenRepositoryInterface;
use App\Repositories\Interface\NotificationRepositoryInterface;
use App\Repositories\Interface\OrderRepositoryInterface;
use App\Repositories\Interface\ProductRepositoryInterface;
use App\Repositories\Interface\RestaurantRepositoryInterface;
use App\Traits\Helper;

class OrderService extends BaseService
{
    use Helper;
    protected $orderRepository;
    protected $productRepository;
    protected $notificationRepository;
    protected $clientRepository;
    protected $restaurantRepository;
    protected $fcmTokenRepository;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        ProductRepositoryInterface $productRepository,
        NotificationRepositoryInterface $notificationRepository,
        ClientRepositoryInterface $clientRepository,
        RestaurantRepositoryInterface $restaurantRepository,
        TokenRepositoryInterface $fcmTokenRepository){

        parent::__construct($orderRepository);

        $this->orderRepository = $orderRepository;
        $this->productRepository = $productRepository;
        $this->notificationRepository = $notificationRepository;
        $this->clientRepository = $clientRepository;
        $this->restaurantRepository = $restaurantRepository;
        $this->fcmTokenRepository = $fcmTokenRepository;

    }

    private function changeStatus($id,$orderStatus,$status){

        $order = $this->get($id);

        if($order->status != $orderStatus){
            return false;
        }

        $target = auth()->user();

        $this->orderRepository->orderStatus($status,$order);
        
        if($target instanceof Client){

            $notification=[
                'title'=>'Order '.$order->id.' '.$order->status->name,
                'body'=>$order->client->name.' '.$order->status->name." ".'the order',
                'is_seen'=> false
            ];
    
            $restaurant=$this->restaurantRepository->find($order->restaurant_id);
    
            $this->notificationRepository->add($notification,$restaurant);
    
            $token = $this->fcmTokenRepository->get($restaurant);
    
        }else{

            $notification=[
                'title'=>$order->status->name == OrderStatus::DELIVERED->name ? "Order $order->id" : 'Order '.$order->id.' '.$order->status->name,
                'body'=>$order->status->name == OrderStatus::DELIVERED->name ? 'Thank you for choosing our service, have a nice day :)' : $order->restaurant->name.' '.$order->status->name." ".'the order',
                'is_seen'=> false
            ];

            $client=$this->clientRepository->find($order->client_id);

            $this->notificationRepository->add($notification,$client);

            $token = $this->fcmTokenRepository->get($client);

        }
        if($token){
            $title=$notification['title'];
            $body=$notification['body'];
            $orderID=[
                'order_id'=>$order->id,
            ];
            $this->notifyByFirebase($title,$body,$token,$orderID);
        }
        
        return $order;
    }

    public function placeOrder($request){

        $client = auth()->user();

        $commission_rate = 10;
        $total_price = 0;

        $first_product= $this->productRepository->find($request->products[0]);

        if (!$first_product) {
            return ['errorProduct'=>true];
        }

        $restaurant = $first_product->restaurant;

        if (!$restaurant) {
            return ['errorRestaurant'=>true];
        }

        foreach ($request->products as $index => $product_id) {
            $product = $this->productRepository->find($product_id);

            $quantity = $request->quantities[$index] ?? 1;

            if($product->price_in_offer){

                $total_price += $product->price_in_offer * $quantity;

            }else{

                $total_price += $product->price * $quantity;
            }
        }
        $total_price=$total_price + $restaurant->delivery_fees;

        $commission_amount = $total_price * $commission_rate / 100;

        $request->merge([
            'restaurant_id'=>$restaurant->id,
            'client_id'=>$client->id,
            'status'=>OrderStatus::PENDING->value,
            'total_price'=>$total_price,
            'commission_amount'=>$commission_amount
        ]);

        $order=$this->orderRepository->store($request->all());

        //  attachment process
        
        foreach ($request->products as $index => $product_id) {
            $product=$this->productRepository->find($product_id);
            $quantity = $request->quantities[$index] ?? 1;

            $dat=[
                'quantity' => $quantity,
                'price_at_order' => $product->price * $quantity,
                'special_order' => $request->special_order ?? null,
            ];
            $this->orderRepository->attach($order, 'products', $product->id,$dat);
        }

        // Send and store notification

        $notification=[
            'title'=>'New Order #'.$order->id,
            'body'=>'You have an order from '.$order->client->name,
            'is_seen'=> false
        ];

        $this->notificationRepository->add($notification,$restaurant);

        $token = $this->fcmTokenRepository->get($restaurant);

        if($token){
            $title=$notification['title'];
            $body=$notification['body'];
            $data=[
                'order_id'=>$order->id,
            ];

            $this->notifyByFirebase($title,$body,$token,$data);

        }

        return $order;
    }
    // method accept , reject , etc ,
    // logic pending  , method prv

    public function accept($id){
        
        return $this->changeStatus($id,OrderStatus::PENDING,OrderStatus::ACCEPTED);
    }
    public function reject($id){
        
        return $this->changeStatus($id,OrderStatus::PENDING,OrderStatus::REJECTED);

    }
    public function received($id){
        
        return $this->changeStatus($id,OrderStatus::ACCEPTED,OrderStatus::RECEIVED);

    }
    public function cancelled($id){
        
        return $this->changeStatus($id,OrderStatus::ACCEPTED,OrderStatus::CANCELLED);

    }
    public function delivered($id){
        
        return $this->changeStatus($id,OrderStatus::RECEIVED,OrderStatus::DELIVERED);

    }
    
    public function getFilteredOrders($search){

        if($search != null){

            return $this->orderRepository->filter($search);

        }else{

            return $this->all();

        }
    }

}
