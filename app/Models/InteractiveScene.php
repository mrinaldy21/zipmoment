<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InteractiveScene extends Model
{
    protected $fillable = [
        'invitation_id',
        'name',
        'slug',
        'background_url',
        'background_public_id',
        'background_width',
        'background_height',
        'is_active',
        'sort_order',
    ];

    public function invitation()
    {
        return $this->belongsTo(Invitation::class);
    }

    public function hotspots()
    {
        return $this->hasMany(InteractiveHotspot::class)->orderBy('sort_order');
    }
