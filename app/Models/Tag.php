<?php

namespace App\Models;

use App\Scopes\UserScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{

    use HasFactory;
    use SoftDeletes;

    protected static function booted()
    {
        static::addGlobalScope(new UserScope);
    }
    protected $table = 'tags';

    protected $fillable = ['user_id', 'name', 'slug', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
