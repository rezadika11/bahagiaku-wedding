<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Theme extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'thumbnail',
        'preview_url',
        'category',
        'style',
        'color_family',
        'color_scheme',
        'fonts',
        'layout_type',
        'is_active',
    ];

    protected $casts = [
        'color_scheme' => 'array',
        'fonts' => 'array',
        'is_active' => 'boolean',
    ];

    public function invitations(): HasMany
    {
        return $this->hasMany(Invitation::class);
    }

    public function sections(): HasMany
    {
        return $this->hasMany(ThemeSection::class);
    }
}
