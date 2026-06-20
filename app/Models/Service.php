<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\App;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'slug',
        'name_en',
        'name_np',
        'desc_en',
        'desc_ne',
        'est_en',
        'est_ne',
        'is_active'
    ];

    public function getNameAttribute(): string
    {
        $locale = App::getLocale();

        if ($locale === 'ne') {
            return $this->attributes['name_np'] ?? $this->attributes['name_en'] ?? '';
        }

        return $this->attributes['name_en'] ?? '';
    }

    public function getNameNeAttribute()
    {
        return $this->attributes['name_np'] ?? '';
    }

    public function getDescNeAttribute()
    {
        return $this->attributes['desc_ne'] ?? '';
    }

    public function getEstNeAttribute()
    {
        return $this->attributes['est_ne'] ?? '';
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function steps(): HasMany
    {
        return $this->hasMany(ServiceStep::class)->orderBy('step_number', 'asc');
    }

    public function requiredDocuments(): HasMany
    {
        return $this->hasMany(RequiredDocument::class)->orderBy('id', 'asc');
    }

    /**
     * A service has many citizen visits.
     * This fixes the Filament dashboard error!
     */
    public function visits(): HasMany
    {
        return $this->hasMany(Visit::class);
    }
}