<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['user_id', 'subscription_id', 'industry_id', 'name', 'slug', 'whatsapp_number', 'current_status'];


    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])
            
            ->format('d-M-Y h:i:s A');


        // $createdAt = Carbon::parse($this->attributes['created_at']);
        // $formattedDate = $createdAt->format('d-M-Y h:i:s A');

        // // Subtract 5 hours
        // $createdAtAgo = $createdAt->subHours(5);

        // return $formattedDate . ' (' . $createdAtAgo->diffForHumans() . ')';
    }




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
