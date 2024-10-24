<?php
namespace App\Repositories\SQL;

use App\Models\Order;
use App\Repositories\Interface\OrderRepositoryInterface;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface{
    protected $order;

    public function __construct(Order $order){
        parent::__construct($order);
        $this->order = $order;
    }
    public function getOrders($model, $status = null)
    {
        $query = $model->orders()->latest();

        if (is_array($status)) {
            $query->whereIn('status', $status);
        } elseif ($status !== null) {
            $query->where('status', $status);
        }

        return $query->paginate(5);
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
