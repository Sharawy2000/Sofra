<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model 
{

    protected $table = 'transactions';
    public $timestamps = true;
    // protected $fillable = array('order_id', 'payment_method_id', 'tranaction_id', 'amount', 'status', 'transaction_date');
    protected $guarded=['created_at', 'updated_at'];
    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }

    public function paymentMethod()
    {
        return $this->belongsTo('App\Models\PaymentMethod');
    }

}