<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invitation extends Model
{
    protected $fillable = [
        'client_id',
        'theme_id',
        'created_by',
        'slug',
        'groom_name',
        'groom_fullname',
        'groom_father',
        'groom_mother',
        'groom_photo',
        'groom_instagram',
        'groom_child_order',
        'bride_name',
        'bride_fullname',
        'bride_father',
        'bride_mother',
        'bride_photo',
        'bride_instagram',
        'bride_child_order',
        'wedding_date',
        'quote_text',
        'quote_source',
        'status',
        'is_active',
        'view_count',
        'meta_title',
        'meta_description',
        'meta_image',
        'published_at',
        'expired_at',
    ];

    protected $casts = [
        'wedding_date' => 'date',
        'is_active' => 'boolean',
        'published_at' => 'datetime',
        'expired_at' => 'datetime',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function theme(): BelongsTo
    {
        return $this->belongsTo(Theme::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class)->orderBy('event_order');
    }

    public function guests(): HasMany
    {
        return $this->hasMany(Guest::class);
    }
}
