<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Visit extends Model
{
    use HasFactory;

    protected $fillable = [
        'tracking_token',
        'department_id',
        'service_id',
        'entered_at',
        'exited_at',
        'is_completed',
        'rating',
        'failure_reason',
        'citizen_comments',
        'citizen_name',
        'citizen_phone',
    ];

    // Cast attributes to native Carbon dates automatically
    protected $casts = [
        'entered_at' => 'datetime',
        'exited_at' => 'datetime',
        'is_completed' => 'boolean',
    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}