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

    // Added 'slug' to prevent mass-assignment errors during database seeding
    protected $fillable = ['department_id', 'slug', 'name_en', 'name_np', 'is_active'];

    public function getNameAttribute(): string
    {
        return $this->{"name_" . App::getLocale()} ?? $this->name_en;
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function steps(): HasMany
    {
        return $this->hasMany(ServiceStep::class)->orderBy('step_number', 'asc');
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