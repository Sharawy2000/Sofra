<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model 
{

    protected $table = 'offers';
    public $timestamps = true;
    protected $fillable = array('name', 'description', 'image', 'date_begin', 'date_end','discount','restaurant_id');

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::saved(function ($offer) {
    //         $offer->restaurant->products()->each(function ($product) {
    //             $product->updatePriceInOffer();
    //         });
    //     });

    //     static::deleted(function ($offer) {
    //         $offer->restaurant->products()->each(function ($product) {
    //             $product->updatePriceInOffer();
    //         });
    //     });
    // }

    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }



}