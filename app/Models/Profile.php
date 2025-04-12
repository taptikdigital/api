<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user_id',
        'project_id',
        'profile_picture',
        'description',
        'address',
        'email',
        'vertical',
        'full_vertical',
        'about',
        'websites',
    ];

    protected $casts = [
        'websites' => 'array', // Cast the websites JSON field to an array
    ];

    public function getProfilePictureAttribute($value)
    {
        return $value ? config('app.image_url') . 'profiles/' . $value : null;
    }
}
