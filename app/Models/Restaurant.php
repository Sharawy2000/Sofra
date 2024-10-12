<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Restaurant extends Authenticatable 
{
    use HasApiTokens,Notifiable;

    protected $table = 'restaurants';
    public $timestamps = true;
    // protected $fillable = array('name', 'email', 'neighborhood_id', 'password', 'minimum_order', 'delivery_fees', 'phone', 'contact_phone', 'contact_whatsapp', 'image', 'overall_rate', 'is_active');
    protected $guarded=['created_at', 'updated_at'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
    public function neighborhood()
    {
        return $this->belongsTo('App\Models\Neighborhood');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function offers()
    {
        return $this->hasMany('App\Models\Offer');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category');
    }

    public function payments()
    {
        return $this->hasMany('App\Models\Payment');
    }

    public function notifications()
    {
        return $this->morphMany('App\Models\Notification', 'notifiable');
    }

    public function fcmTokens()
    {
        return $this->morphMany('App\Models\Token', 'tokenizable');
    }

}