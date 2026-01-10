<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ThemeSection extends Model
{
    protected $fillable = [
        'theme_id',
        'section_type',
        'section_name',
        'component_name',
        'section_order',
        'is_enabled',
        'default_settings',
    ];

    protected $casts = [
        'is_enabled' => 'boolean',
        'default_settings' => 'array',
    ];

    public function theme(): BelongsTo
    {
        return $this->belongsTo(Theme::class);
    }
}
