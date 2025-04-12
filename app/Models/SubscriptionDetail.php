<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubscriptionDetail extends Model
{
    use HasFactory;
    use SoftDeletes;

    // Belongs to one subscription
    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    // Belongs to one subscription name
    public function subscriptionName()
    {
        return $this->belongsTo(SubscriptionName::class);
    }
}
