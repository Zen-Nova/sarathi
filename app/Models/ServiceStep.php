<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\App;

class ServiceStep extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'step_number',
        'room_number',
        'counter_number',
        'title_en',
        'title_np',
        'instructions_en',
        'instructions_np'
    ];

    public function getTitleAttribute(): string
    {
        return $this->{"title_" . App::getLocale()} ?? $this->title_en;
    }

    public function getInstructionsAttribute(): ?string
    {
        return $this->{"instructions_" . App::getLocale()} ?? $this->instructions_en;
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}