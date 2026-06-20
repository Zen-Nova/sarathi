<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\App;

class RequiredDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'title_en',
        'title_np',
        'description_en',
        'description_np',
        'is_required'
    ];

    protected $casts = [
        'is_required' => 'boolean',
    ];

    public function getTitleAttribute(): string
    {
        $locale = App::getLocale();
        return $this->attributes["title_{$locale}"] ?? $this->attributes['title_en'] ?? '';
    }

    public function getDescriptionAttribute(): ?string
    {
        $locale = App::getLocale();
        return $this->attributes["description_{$locale}"] ?? $this->attributes['description_en'] ?? '';
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
