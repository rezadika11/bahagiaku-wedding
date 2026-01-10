<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    protected $fillable = [
        'invitation_id',
        'event_type',
        'event_name',
        'event_date',
        'event_time_start',
        'event_time_end',
        'timezone',
        'venue_name',
        'venue_address',
        'venue_map_url',
        'venue_latitude',
        'venue_longitude',
        'dress_code',
        'notes',
        'event_order',
    ];

    protected $casts = [
        'event_date' => 'date',
        'venue_latitude' => 'decimal:8',
        'venue_longitude' => 'decimal:8',
    ];

    public function invitation(): BelongsTo
    {
        return $this->belongsTo(Invitation::class);
    }
}
