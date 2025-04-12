<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject; 

class User extends Authenticatable implements JWTSubject
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email_key',
        'mobile_key',
        'user_role_id',
        'is_active',
        'google_id',
        'facebook_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'status',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    // Implement JWTSubject methods
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class, 'subscription_id')->select('id', 'name', 'slug');
    }
    
    public function userActiveSubscription()
    {
        return $this->hasOne(UserSubscription::class, 'user_id')->select('id', 'subscription_status', 'next_payment_date', 'created_at')->latestOfMany();
    }

    public function project()
    {
        return $this->hasMany(Project::class, 'user_id', 'id');
    }

    public function configuration()
    {
        return $this->hasMany(Configuration::class, 'user_id', 'id');
    }
}
