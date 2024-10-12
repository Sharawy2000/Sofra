<?php

namespace App\Models;

use App\Enums\ContactMessageType;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model 
{

    protected $table = 'contact_messages';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'phone', 'message','type');
    protected $casts=['type'=>ContactMessageType::class];

}   