<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WhatsAppMessageHistory extends Model
{
    use SoftDeletes;
    protected $table = 'whatsapp_messages_history';

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
        'recipient_id',
        'campaign_id',
        'message_id',
        'waba_id',
        'phone_num_id',
        'message',
        'from',
        'to',
        'message_type',
        'json_response_object',
        'created_at',
        'updated_at',
        'deleted_at',
        'status'
    ];

    public function getSentMessage()
    {
        return $this->hasMany(WhatsAppMessageStatus::class, 'message_id', 'message_id')->where('message_status', 'sent');
    }
    public function getDeliverMessage()
    {
        return $this->hasMany(WhatsAppMessageStatus::class, 'message_id', 'message_id')->where('message_status', 'delivered');
    }
    public function getReadMessage()
    {
        return $this->hasMany(WhatsAppMessageStatus::class, 'message_id', 'message_id')->where('message_status', 'read');
    }
    public function getFailedMessage()
    {
        return $this->hasMany(WhatsAppMessageStatus::class, 'message_id', 'message_id')->where('message_status', 'failed');
    }

    // New accessor to determine the final status
    public function getFinalStatusAttribute()
    {
        if ($this->message_type === 'user') {
            return 'received';
        }
        // if ($this->message_type === 'system') {
        //     return 'send';
        // }
        if ($this->getReadMessage->count() > 0) {
            return 'read'; // Blue tick
        } elseif ($this->getDeliverMessage->count() > 0) {
            return 'delivered'; // Double tick (grey)
        } elseif ($this->getSentMessage->count() > 0) {
            return 'sent'; // Single tick
        } elseif ($this->getFailedMessage->count() > 0) {
            return 'failed'; // Optional: failed icon
        }
        return 'queued';
    }
}
