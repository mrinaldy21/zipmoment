<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Guest extends Model
{
    protected $fillable = ['invitation_id', 'guest_name', 'guest_slug'];

    protected static function booted()
    {
        static::creating(function ($guest) {
            if (!$guest->guest_slug) {
                $guest->guest_slug = Str::slug($guest->guest_name);
            }
        });
    }

    public function invitation()
    {
        return $this->belongsTo(Invitation::class);
    }
}
