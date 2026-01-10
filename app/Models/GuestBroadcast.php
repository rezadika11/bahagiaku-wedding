<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GuestBroadcast extends Model
{
    protected $fillable = [
        'guest_id',
        'invitation_id',
        'sent_by',
        'phone_number',
        'whatsapp_url',
        'message_template',
        'message_rendered',
        'message_encoded',
        'invitation_url',
        'status',
        'url_generated_at',
        'url_clicked_at',
        'sent_at',
        'opened_at',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'url_generated_at' => 'datetime',
        'url_clicked_at' => 'datetime',
        'sent_at' => 'datetime',
        'opened_at' => 'datetime',
    ];

    public function guest(): BelongsTo
    {
        return $this->belongsTo(Guest::class);
    }

    public function invitation(): BelongsTo
    {
        return $this->belongsTo(Invitation::class);
    }

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sent_by');
    }
}
