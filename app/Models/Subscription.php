<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model
{
    use HasFactory;
    use SoftDeletes;

     // One Subscription can have multiple pricings
     public function pricing()
     {
         return $this->hasMany(SubscriptionPricing::class);
     }
 
     // One Subscription can have multiple details
     public function details()
     {
         return $this->hasMany(SubscriptionDetail::class);
     }
}
