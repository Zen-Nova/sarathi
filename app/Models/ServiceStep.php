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
        'instructions_np',
        'requirements_en',
        'requirements_ne'
    ];

    protected $casts = [
        'requirements_en' => 'array',
        'requirements_ne' => 'array',
    ];

    public function getTitleAttribute(): string
    {
        $locale = App::getLocale();
        return $this->attributes["title_{$locale}"] ?? $this->attributes['title_en'] ?? '';
    }

    public function getTitleNeAttribute()
    {
        return $this->attributes['title_np'] ?? '';
    }

    public function getTitleEnAttribute()
    {
        return $this->attributes['title_en'] ?? '';
    }

    public function getLocationEnAttribute()
    {
        $loc = [];
        if ($this->room_number) $loc[] = $this->room_number;
        if ($this->counter_number) $loc[] = $this->counter_number;
        return count($loc) > 0 ? implode(' — ', $loc) : 'Main Hall';
    }

    public function getLocationNeAttribute()
    {
        $loc = [];
        if ($this->room_number) {
            $loc[] = str_replace(['Room', 'Counter'], ['कोठा नं.', 'काउन्टर नं.'], $this->room_number);
        }
        if ($this->counter_number) {
            $loc[] = str_replace(['Room', 'Counter'], ['कोठा नं.', 'काउन्टर नं.'], $this->counter_number);
        }
        return count($loc) > 0 ? implode(' — ', $loc) : 'मुख्य हल';
    }

    public function getInstructionEnAttribute()
    {
        return $this->attributes['instructions_en'] ?? '';
    }

    public function getInstructionNeAttribute()
    {
        return $this->attributes['instructions_np'] ?? '';
    }

    public function getInstructionsAttribute(): ?string
    {
        $locale = App::getLocale();
        return $this->attributes["instructions_{$locale}"] ?? $this->attributes['instructions_en'] ?? '';
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}