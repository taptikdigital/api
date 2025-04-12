<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Configuration extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'project_id',
        'session_info_response',
        'code',
        'code_expire_at',
        'sdk_response',
        'wba_status',
        'quality_rating',
        'messaging_limit',
        'current_limit_tier',
        'code_verification_status',
        'profile_updated',
        'health_status_json',
        'health_status',
        'phone_no_entity',
        'waba_entity',
        'business_entity',
        'app_entity',
        'meta_payment_configuration',
        'meta_gst_added',
        'whatsapp_business_account_id',
        'phone_number_id',
        'permanent_access_token',
        'phone_no_pin',
        'phone_number_status',
        'current_status',
        'is_active',
        'status',
    ];

    protected $casts = [
        'business_entity' => 'object', // Use 'array' if you prefer arrays instead of objects

    ];

    public function configurationHealthStatusEntities()
    {
        return $this->hasMany(ConfigurationHealthStatusEntity::class, 'configuration_id')->select('id', 'configuration_id', 'entity_id', 'entity_type', 'entity_status', 'additional_info', 'errors');
    }

}
