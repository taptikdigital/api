<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class WhatsappMessage extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    
    public $timestamps = true;
        
    protected $table            = 'whatsapp_messages';

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
    
    protected $casts = [
        'json_response_object'                 => 'json',
    ];

    protected $fillable         = [        
        'campaign_id',
        'waba_id',
        'phone_number_id',
        'recipient_name',
        'recipient_id',
        'conversation_id',
        'billable',
        'pricing_model',
        'category',
        'conversation_timestamp',
        'conversation_expire_at',
        'json_response_object',
        'created_at',
        'updated_at',
        'deleted_at',
        'status'
    ];




    public function getCreatedAtAttribute()
    {
        // return Carbon::parse($this->attributes['created_at'])
        //     ->format('d-M-Y');
            // ->format('d-M-Y h:i:s A');


        $createdAt = Carbon::parse($this->attributes['created_at']);
        $formattedDate = $createdAt->format('d-M-Y h:i:s A');

        // Subtract 5 hours
        $createdAtAgo = $createdAt->subHours(5);

        return $formattedDate . ' (' . $createdAtAgo->diffForHumans() . ')';
    }



    
}

