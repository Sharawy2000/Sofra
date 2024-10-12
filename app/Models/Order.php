<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Model;

class Order extends Model 
{

    protected $table = 'orders';
    public $timestamps = true;
    // protected $fillable = array('payment_method_id', 'commission_amount', 'status', 'client_id', 'restaurant_id');
    protected $guarded=['created_at', 'updated_at'];

    protected $casts=[
        'status'=>OrderStatus::class,
    ];

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Product')->withPivot('quantity','price_at_order','special_order');
    }

    public function paymentMethod()
    {
        return $this->belongsTo('App\Models\PaymentMethod');
    }

    public function tranactions()
    {
        return $this->hasMany('App\Models\Transaction');
    }

}