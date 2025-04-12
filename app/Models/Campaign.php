<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campaign extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'project_id',
        'campaign_name',
        'template_id',
        'template_type',
        'header_parameter',
        'body_parameter',
        'file_upload_id',
        'schedule_campaign',
        'schedule_date',
        'audience',
        'campaign_status',
        'campaign_type',
        'schedule_time',
        'schedule_timezone',
        'campaign_end_at',
        'is_active',
        'status',
    ];

    protected $casts = [
        'header_parameter'  => 'array', 
        'body_parameter'    => 'array',
    ];

    public function template()
    {
        return $this->belongsTo(Template::class, 'template_id', 'id');
    }
}
