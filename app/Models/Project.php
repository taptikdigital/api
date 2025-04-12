<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['user_id', 'subscription_id', 'industry_id', 'name', 'slug', 'whatsapp_number', 'current_status'];

    public function subscription()
    {
        return $this->belongsTo(Subscription::class, 'subscription_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function industry()
    {
        return $this->belongsTo(Industry::class, 'industry_id')->select('id', 'name', 'slug');
    }

    public function configuration()
    {
        return $this->hasOne(Configuration::class, 'project_id');
    }
}
