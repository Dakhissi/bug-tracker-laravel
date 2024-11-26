<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'stack_technologies',
        'environments',
        'created_by',
        'status',
        'deadline',
        'team_members',
        'progress',
        'priority',
        'repository_url',
        'documentation_url',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'environments' => 'array',
        'team_members' => 'array',
        'deadline' => 'date',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function bugs()
    {
        return $this->hasMany(Bug::class);
    }
}
