<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TicketReply extends Model
{
    protected $table = 'ticket_reply';
    
    protected $fillable = [
        'ticket_id',
        'user_id', 
        'message',
        'is_admin',
        'is_system',
        'attachments',
        'read_at'
    ];

    protected $casts = [
        'is_admin' => 'boolean',
        'is_system' => 'boolean',
        'attachments' => 'array',
        'read_at' => 'datetime'
    ];

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function markAsRead(): void
    {
        if (!$this->read_at) {
            $this->update(['read_at' => now()]);
        }
    }

    public function scopeUnread($query)
    {
        return $query->whereNull('read_at');
    }

    public function scopeFromUser($query)
    {
        return $query->where('is_admin', false)->where('is_system', false);
    }

    public function scopeFromAdmin($query)
    {
        return $query->where('is_admin', true);
    }

    public function scopeSystem($query)
    {
        return $query->where('is_system', true);
    }

    public function hasAttachments()
    {
        return !empty($this->attachments);
    }

    public function getAttachmentsList()
    {
        return $this->attachments ?? [];
    }
}