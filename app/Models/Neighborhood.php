<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Neighborhood extends Model 
{

    protected $table = 'neighborhoods';
    public $timestamps = true;
    protected $fillable = array('name', 'city_id');

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

}