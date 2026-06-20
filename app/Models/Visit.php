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
        'alert_acknowledged_at',
'admin_notes',
    ];

    protected $casts = [
        'entered_at' => 'datetime',
        'exited_at' => 'datetime',
        'is_completed' => 'boolean',
        'rating' => 'integer',
        'alert_acknowledged_at' => 'datetime',
    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }


    public function getIsBriberyAlertAttribute(): bool
{
    return $this->failure_reason === 'bribe_request';
}

public function getIsUnreviewedBriberyAlertAttribute(): bool
{
    return $this->failure_reason === 'bribe_request'
        && is_null($this->alert_acknowledged_at);
}


    public function getFailureReasonLabelAttribute(): ?string
    {
        if (! $this->failure_reason) {
            return null;
        }

        $locale = session('locale', 'ne');

        $reasons = config('visits.failure_reasons', []);

        return $reasons[$this->failure_reason][$locale]
            ?? $reasons[$this->failure_reason]['en']
            ?? $this->failure_reason;
    }
}