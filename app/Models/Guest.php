<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Guest extends Model
{
    protected $fillable = [
        'invitation_id',
        'name',
        'phone',
        'email',
        'guest_code',
        'guest_group',
        'quota',
        'notes',
    ];

    public function invitation(): BelongsTo
    {
        return $this->belongsTo(Invitation::class);
    }

    public function broadcasts(): HasMany
    {
        return $this->hasMany(GuestBroadcast::class);
    }
}
