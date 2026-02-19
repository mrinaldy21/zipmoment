<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'invitation_id',
        'event_type',
        'date',
        'start_time',
        'end_time',
        'location',
        'maps_link',
        'sort_order',
    ];

    public function invitation()
    {
        return $this->belongsTo(Invitation::class);
    }
}
