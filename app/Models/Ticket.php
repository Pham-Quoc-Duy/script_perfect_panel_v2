<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ticket extends Model
{
    protected $fillable = [
        'user_id', 
        'domain',
        'subject_id',
        'subject', 
        'message', 
        'custom_fields',
        'status', 
        'priority', 
        'last_reply_at',
        'assigned_to'
    ];

    protected $casts = [
        'last_reply_at' => 'datetime',
        'custom_fields' => 'array'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function ticketSubject(): BelongsTo
    {
        return $this->belongsTo(TicketSubject::class, 'subject_id');
    }

    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function replies(): HasMany
    {
        return $this->hasMany(TicketReply::class)->orderBy('created_at');
    }

    public function latestReply(): HasMany
    {
        return $this->hasMany(TicketReply::class)->latest();
    }

    public function scopeOpen($query)
    {
        return $query->where('status', 'open');
    }

    public function scopeByPriority($query, $priority)
    {
        return $query->where('priority', $priority);
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeByDomain($query, $domain)
    {
        return $query->where('domain', $domain);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->whereHas('ticketSubject', function ($q) use ($category) {
            $q->where('category', $category);
        });
    }

    public function getUnreadRepliesCountAttribute()
    {
        return $this->replies()->whereNull('read_at')->where('is_admin', true)->count();
    }

    public function updateLastReply()
    {
        $this->update(['last_reply_at' => now()]);
    }

    public function getCustomFieldValue($fieldId)
    {
        if (!$this->custom_fields) {
            return null;
        }
        
        return $this->custom_fields[$fieldId] ?? null;
    }

    public function getCategoryAttribute()
    {
        return $this->ticketSubject ? $this->ticketSubject->category : null;
    }

    public function getSubcategoryAttribute()
    {
        return $this->ticketSubject ? $this->ticketSubject->subcategory : null;
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'open' => 'badge-primary',
            'answered' => 'badge-warning', 
            'closed' => 'badge-secondary'
        ];
        
        return $badges[$this->status] ?? 'badge-secondary';
    }

    public function getStatusTextAttribute()
    {
        $statuses = [
            'open' => 'Open',
            'answered' => 'Answered',
            'closed' => 'Closed'
        ];
        
        return $statuses[$this->status] ?? 'Unknown';
    }

    public function getPriorityBadgeAttribute()
    {
        $badges = [
            'low' => 'badge-info',
            'medium' => 'badge-warning',
            'high' => 'badge-danger'
        ];
        
        return $badges[$this->priority] ?? 'badge-secondary';
    }

    public function getPriorityTextAttribute()
    {
        $priorities = [
            'low' => 'Low',
            'medium' => 'Medium',
            'high' => 'High'
        ];
        
        return $priorities[$this->priority] ?? 'Unknown';
    }

    // Get display name for ticket
    public function getDisplayNameAttribute()
    {
        return $this->ticketSubject ? $this->ticketSubject->display_name : $this->subject;
    }

    // Check if ticket has custom fields
    public function hasCustomFields()
    {
        return !empty($this->custom_fields);
    }

    // Get custom fields from subject
    public function getRequiredFields()
    {
        return $this->ticketSubject ? $this->ticketSubject->required_fields : [];
    }
}
