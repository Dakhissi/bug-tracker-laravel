<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bug extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_id',
        'title',
        'description',
        'steps_to_reproduce',
        'context',
        'environments',
        'attachments',
        'solution',
        'branch',
        'reporter_by',
        'reporter_at',
        'status',
        'start_date',
        'end_date',
        'assigned_to',
        'assigned_at',
        'resolved_at',
        'priority',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'environments' => 'array',
        'attachments' => 'array',
        'reporter_at' => 'datetime',
        'assigned_at' => 'datetime',
        'resolved_at' => 'datetime',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    /**
     * Get the project that owns the bug.
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Get the user who reported the bug.
     */
    public function reporter()
    {
        return $this->belongsTo(User::class, 'reporter_by');
    }

    /**
     * Get the user the bug is assigned to.
     */
    public function assignee()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * The environments associated with the bug.
     */
    public function environment()
    {
        return $this->hasOne(Environment::class);
    }
}
