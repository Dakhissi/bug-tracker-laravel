<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'auth_settings',
        'llm_token',
    ];

    protected $casts = [
        'auth_settings' => 'array',
    ];
}
