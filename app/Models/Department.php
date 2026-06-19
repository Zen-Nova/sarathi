<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'name_en',
        'name_np',
        'description_en',
        'description_np',
        'is_active',
    ];

    /**
     * Helper attribute to automatically fetch the correct language 
     * variant based on the current application locale.
     * Usage: $department->name
     */
    public function getNameAttribute(): string
    {
        $locale = App::getLocale(); // 'en' or 'np'
        return $this->{"name_{$locale}"} ?? $this->name_en;
    }

    /**
     * Helper attribute for dynamic description localization.
     * Usage: $department->description
     */
    public function getDescriptionAttribute(): ?string
    {
        $locale = App::getLocale();
        return $this->{"description_{$locale}"} ?? $this->description_en;
    }
}