<?php 
namespace App\Repositories\SQL;

use App\Models\Payment;
use App\Repositories\Interface\PaymentRepositoryInterface;

class PaymentRepository extends BaseRepository implements PaymentRepositoryInterface{
    protected $payment;

    public function __construct(Payment $payment){
        parent::__construct($payment);
        $this->payment=$payment;
    }

    public function filter($search){
        return $this->payment->whereHas('restaurant',function($query) use($search){
            $query->where('name','like','%'.$search.'%');
        })
        ->orWhere('id',$search)
        ->orWhere('payment_date',$search)
        ->latest()
        ->paginate(5);
        
    }

}