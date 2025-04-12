<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class UserSubscription extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    
    public $timestamps = true;
        
    protected $table            = 'user_subscriptions';

    protected $hidden           = [
        'updated_at',
        'deleted_at',
        'status'
    ];

    protected $dates            = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    

    protected $fillable         = [        
        
        'user_id',
        'rzp_plan_id',
        'rzp_subscription_id',
        'rzp_payment_id',
        'rzp_order_id',
        'rzp_invoice_id',
        'rzp_customer_id',
        'amount',
        'currency',

        'status',
        'subscription_status',
        'next_payment_date',
        'created_at',
        'updated_at',
        'deleted_at'
    ];




    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])
            // ->format('d-M-Y')
            ->format('d-M-Y h:i:s A');

    }





    
}
