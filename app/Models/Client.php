<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Client extends Authenticatable 
{
    use Notifiable,HasApiTokens;

    protected $table = 'clients';
    public $timestamps = true;
    protected $guarded=['created_at','updated_at'];

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

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function notifications()
    {
        return $this->morphMany('App\Models\Notification', 'notifiable');
    }
    public function fcmTokens()
    {
        return $this->morphMany('App\Models\Token', 'tokenizable');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

}