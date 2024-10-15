<?php 
namespace App\Repositories\SQL;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Repositories\Interface\OrderRepositoryInterface;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface{
    protected $order;

    public function __construct(Order $order){
        parent::__construct($order);
        $this->order = $order;
    }

    public function attachProducts($order,$product,$data){
        $order->products()->attach($product->id,$data);
    }

    public function orders($model){
        return $model->orders()->latest()->paginate(5);
    }
    public function newOrders($model){
        return $model->orders()
        ->where('status',OrderStatus::PENDING)
        ->latest()
        ->paginate(5);
    }
    public function currentOrders($model){
        return $model->orders()
        ->where('status',OrderStatus::ACCEPTED)
        ->latest()
        ->paginate(5);
    }
    public function previousOrders($model){
        return $model->orders()
        ->where(function($query){
            $query->where('status',OrderStatus::DELIVERED)
                  ->orWhere('status',OrderStatus::CANCELLED)
                  ->orWhere('status',OrderStatus::REJECTED);
        })
        ->latest()
        ->paginate(5);
    }
    public function orderStatus($status,$order){
        $order->status = $status;
        $order->save();
    }

    public function filter($search){
        return $this->model->whereHas('client',function($query) use($search){
            $query->where('name','like','%' . $search . '%');
        })
        ->orWhereHas('restaurant',function($query) use($search){
            $query->where('name','like','%' . $search . '%');
        })
        ->orWhereHas('paymentMethod',function($query) use($search){
            $query->where('name','like','%' . $search . '%');
        })
        ->orWhere('id',$search)
        ->latest()
        ->paginate(5);
    }


}