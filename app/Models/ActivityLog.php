<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['user_id', 'type', 'activity', 'domain'];
    protected $casts = ['activity' => 'array', 'created_at' => 'datetime'];

    /**
     * Get the user that owns the activity log
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}