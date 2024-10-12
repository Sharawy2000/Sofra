<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model 
{

    protected $table = 'products';
    public $timestamps = true;
    protected $fillable = array('name', 'description', 'image', 'price', 'order_duration','price_in_offer','restaurant_id');

    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }

    public function orders()
    {
        return $this->belongsToMany('App\Models\Order')->withPivot('quantity','price_at_order','special_order');
    }
    
    // public function getBestOffer()
    // {
    //     return $this->restaurant->offers()
    //             ->where('date_begin', '<=', now())
    //             ->where('date_end', '>=', now())
    //             ->orderByDesc('discount')  
    //             ->first(); 
    // }

    // public function updatePriceInOffer()
    // {
    //     $offer = $this->getBestOffer(); 

    //     if ($offer) {
    //         $discountAmount = ($this->price * $offer->discount) / 100;
    //         $this->price_in_offer = $this->price - $discountAmount;  
    //     } else {
    //         $this->price_in_offer = null;  
    //     }

    //     $this->save();  
    // }

}