<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WhatsAppMessageStatus extends Model
{
    use SoftDeletes;
    protected $table = 'whatsapp_messages_status';
}
