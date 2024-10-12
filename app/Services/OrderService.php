<?php 
namespace App\Services;

use App\Enums\OrderStatus;
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

    public function placeOrder($request){

        $client = auth()->guard('client')->user();

        if (!$client) {
            return $this->responseJson('Client not found', null, 401);
        }

        $commission_rate = 10;
        $total_price = 0;

        $first_product= $this->productRepository->find($request->products[0]);

        if (!$first_product) {
            return $this->responseJson('لا يوجد هذا المنتج', null, 404);
        }

        $restaurant = $first_product->restaurant;

        if (!$restaurant) {
            return $this->responseJson('لا يوجد مطعم', null, 404);
        }

        foreach ($request->products as $index => $product_id) {
            $product = $this->productRepository->find($product_id);

            $quantity = $request->quantities[$index] ?? 1; 
            // if product has an valid offer
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

        //  attactment process 
        foreach ($request->products as $index => $product_id) {
            $product=$this->productRepository->find($product_id);
            $quantity = $request->quantities[$index] ?? 1;

            $dat=[
                'quantity' => $quantity,
                'price_at_order' => $product->price * $quantity,
                'special_order' => $request->special_order ?? null,
            ];
            $this->orderRepository->attachProducts($order, $product, $dat);
        }
        //----------------------------------------------------------------

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
        }

        $this->notifyByFirebase($title,$body,$token,$data);

        //----------------------------------------------------------------

        return $order;
    }
    public function updateOrder($data,$id){

        $order=$this->orderRepository->find($id);

        if(!$order){
            return $this->responseJson('لا يوجد طلب', null, 401);
        }

        $client = auth()->guard('client')->user();

        $restaurant = auth()->guard('restaurant')->user();

        if ($client){
            if ($client->id != $order->client_id){
                return $this->responseJson('لا توجد معلومات لهذا الطلب', null, 401);
            }
            $this->orderRepository->orderStatus($data['status'],$order);

            $notification=[
                'title'=>'New Order #'.$order->id,
                'body'=>'You have an order from '.$order->client->name,
                'is_seen'=> false
            ];

            $restaurant=$this->restaurantRepository->find($order->restaurant_id);

            $this->notificationRepository->add($notification,$restaurant);

            $token = $this->fcmTokenRepository->get($restaurant);


            if($token){
                $title=$notification['title'];
                $body=$notification['body'];
                $orderID=[
                    'order_id'=>$order->id,
                ];
            }
            $this->notifyByFirebase($title,$body,$token,$orderID);
        }

        if ($restaurant){
            if ($restaurant->id != $order->restaurant_id){
                return $this->responseJson('لا توجد معلومات لهذا الطلب', null, 401);
            }

            $this->orderRepository->orderStatus($data['status'],$order);

            $notification=[
                'title'=>'Order '.$order->id.' '.$order->status->name,
                'body'=>'Restaurant '.$order->restaurant->name.' has been '.$order->status->name. ' order '.$order->id,
                'is_seen'=> false
            ];

            $client=$this->clientRepository->find($order->client_id);

            $this->notificationRepository->add($notification,$client);

            $token = $this->fcmTokenRepository->get($client);

            if($token){
                $title=$notification['title'];
                $body=$notification['body'];
                $orderID=[
                    'order_id'=>$order->id,
                ];
            }
            $this->notifyByFirebase($title,$body,$token,$orderID);
        }

        return $order;
    }

    public function getFilteredOrders($search){
        
        if($search != null){

            return $this->orderRepository->filter($search);

        }else{

            return $this->all();

        }
    }

}