<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Category extends Model 
{
    use HasFactory;

    protected $table = 'categories';
    public $timestamps = true;

    protected $fillable = array('name');


    public function restaurants()
    {
        return $this->hasMany('App\Models\Client');
    }

    public function categoryRestaurants()
    {
        return $this->belongsToMany('App\Models\Restaurant');
    }

}