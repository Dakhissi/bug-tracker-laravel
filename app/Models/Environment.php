<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Environment extends Model
{
    use HasFactory;

    protected $fillable = [
        'bug_id',
        'package_documents',
        'pc_environment',
    ];

    protected $casts = [
        'package_documents' => 'array',
    ];

    public function bug()
    {
        return $this->belongsTo(Bug::class);
    }
}
